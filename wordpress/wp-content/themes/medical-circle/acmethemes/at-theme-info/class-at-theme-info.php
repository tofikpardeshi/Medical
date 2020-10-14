<?php
/**
 * Acme Themes - Theme Info Admin Menu
 * @package Acme Themes
 * @subpackage Admin
 */
if ( ! class_exists( 'Medical_Circle_Theme_Info' ) ) {
    class Medical_Circle_Theme_Info{

        private $config;
        private $theme_name;
        private $theme_slug;
        private $theme_version;
        private $page_title;
        private $menu_title;
        private $tabs;

        /**
         * Constructor.
         */
        public function __construct( $config ) {
            $this->config = $config;
            $this->prepare_class();

            /*admin menu*/
            add_action( 'admin_menu', array( $this, 'at_admin_menu' ) );

            /* enqueue script and style for about page */
            add_action( 'admin_enqueue_scripts', array( $this, 'style_and_scripts' ) );

            /* ajax callback for dismissable required actions */
            add_action( 'wp_ajax_at_theme_info_update_recommended_action', array( $this, 'update_recommended_action_callback' ) );
        }

        /**
         * Prepare and setup class properties.
         */
        public function prepare_class() {
            $theme = wp_get_theme();
            if ( is_child_theme() ) {
                $this->theme_name = $theme->parent()->get( 'Name' );
            } else {
                $this->theme_name = $theme->get( 'Name' );
            }
            $this->theme_slug    = esc_attr( $theme->get_template() );
            $this->theme_version = esc_attr( $theme->get( 'Version' ) );
            $this->page_title    = isset( $this->config['page_title'] ) ? $this->config['page_title'] : esc_html__('Info','medical-circle'). $this->theme_name;
            $this->menu_title    = isset( $this->config['menu_title'] ) ? $this->config['menu_title'] : esc_html__('Info','medical-circle') . $this->theme_name;
            $this->notification  = isset( $this->config['notification'] ) ? $this->config['notification'] : ( '<p>' . sprintf( esc_html__('Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$swelcome page%3$s.','medical-circle'), $this->theme_name, '<a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme_slug . '-info' ) ) . '">', '</a>' ) . '</p><p><a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme_slug . '-info' ) ) . '" class="button" style="text-decoration: none;">' . sprintf( __('Get started with %s','medical-circle'), $this->theme_name ) . '</a></p>' );
            $this->tabs          = isset( $this->config['tabs'] ) ? $this->config['tabs'] : array();
        }

        /**
         * Return the valid array of recommended actions.
         * @return array The valid array of recommended actions.
         */
        /**
         * Dismiss required actions
         */
        public function update_recommended_action_callback() {

            /*getting for provided array*/
            $recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();

            /*from js action*/
            $action_id = esc_attr( ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0 );
            $todo = esc_attr( ( isset( $_GET['todo'] ) ) ? $_GET['todo'] : '' );

            /*getting saved actions*/
            $saved_actions = get_option( $this->theme_slug . '_recommended_actions' );

            echo esc_html( wp_unslash( $action_id ) ); /* this is needed and it's the id of the dismissable required action */

            if ( ! empty( $action_id ) ) {

                if( 'reset' == $todo ){
                    $saved_actions_new = array();
                    if ( ! empty( $recommended_actions ) ) {

                        foreach ( $recommended_actions as $recommended_action ) {
                            $saved_actions[ $recommended_action['id'] ] = true;
                        }
                        update_option( $this->theme_slug . '_recommended_actions', $saved_actions_new );
                    }
                }
                /* if the option exists, update the record for the specified id */
                elseif ( !empty( $saved_actions) and is_array( $saved_actions ) ) {

                    switch ( esc_html( $todo ) ) {
                        case 'add';
                            $saved_actions[ $action_id ] = true;
                            break;
                        case 'dismiss';
                            $saved_actions[ $action_id ] = false;
                            break;
                    }
                    update_option( $this->theme_slug . '_recommended_actions', $saved_actions );

                    /* create the new option,with false for the specified id */
                }
                else {
                    $saved_actions_new = array();
                    if ( ! empty( $recommended_actions ) ) {

                        foreach ( $recommended_actions as $recommended_action ) {
                            echo esc_attr( $recommended_action['id'] );
                            echo " ".esc_attr ( $todo );
                            if ( $recommended_action['id'] == $action_id ) {
                                switch ( esc_html( $todo ) ) {
                                    case 'add';
                                        $saved_actions_new[ $action_id ] = true;
                                        break;
                                    case 'dismiss';
                                        $saved_actions_new[ $action_id ] = false;
                                        break;
                                }
                            }
                        }
                    }
                    update_option( $this->theme_slug . '_recommended_actions', $saved_actions_new );
                }
            }
            exit;
        }

        private function get_recommended_actions() {
            $saved_actions = get_option( $this->theme_slug . '_recommended_actions' );
            if ( ! is_array( $saved_actions ) ) {
                $saved_actions = array();
            }
            $recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
            $valid       = array();
            if( isset( $recommended_actions ) && is_array( $recommended_actions ) ){
                foreach ( $recommended_actions as $recommended_action ) {
                    if (
                        (
                            ! isset( $recommended_action['check'] ) ||
                            ( isset( $recommended_action['check'] ) && ( $recommended_action['check'] == false ) )
                        )
                        &&
                        ( ! isset( $saved_actions[ $recommended_action['id'] ] ) ||
                            ( isset( $saved_actions[ $recommended_action['id']] ) && ($saved_actions[ $recommended_action['id']] == true ) )
                        )
                    ) {
                        $valid[] = $recommended_action;
                    }
                }
            }
            return $valid;
        }

        private function count_recommended_actions() {
            $count = 0;
            $actions_count = $this->get_recommended_actions();
            if ( ! empty( $actions_count ) ) {
                $count = count( $actions_count );
            }
            return $count;
        }
        
        /**
         * Adding Theme Info Menu under Appearance.
         */
        function at_admin_menu() {

            if ( ! empty( $this->page_title ) && ! empty( $this->menu_title ) ) {
                $count = $this->count_recommended_actions();
                $menu_title = $count > 0 ? esc_html( $this->menu_title ) . '<span class="badge-action-count">' . esc_html( $count ) . '</span>' : esc_html( $this->menu_title );
                /* Example
                 * add_theme_page('My Plugin Theme', 'My Plugin', 'edit_theme_options', 'my-unique-identifier', 'my_plugin_function');
                 * */
                add_theme_page( $this->page_title, $menu_title, 'edit_theme_options', $this->theme_slug . '-info', array(
                    $this,
                    'at_theme_info_screen',
                ) );
            }
        }

        /**
         * Render the info content screen.
         */
        public function at_theme_info_screen() {

            if ( ! empty( $this->config['info_title'] ) ) {
                $welcome_title = $this->config['info_title'];
            }
            if ( ! empty( $this->config['info_content'] ) ) {
                $welcome_content = $this->config['info_content'];
            }
            if ( ! empty( $this->config['quick_links'] ) ) {
                $quick_links = $this->config['quick_links'];
            }

            if (
                ! empty( $welcome_title ) ||
                ! empty( $welcome_content ) ||
                ! empty( $quick_links ) ||
                ! empty( $this->tabs )
            ) {
                echo '<div class="wrap about-wrap info-wrap epsilon-wrap">';

                if ( ! empty( $welcome_title ) ) {
                    echo '<h1>';
                    echo esc_html( $welcome_title );
                    if ( ! empty( $this->theme_version ) ) {
                        echo esc_html( $this->theme_version ) . ' </sup>';
                    }
                    echo '</h1>';
                }
                if ( ! empty( $welcome_content ) ) {
                    echo '<div class="about-text">' . wp_kses_post( $welcome_content ) . '</div>';
                }
                $notice_nag = get_option( 'medical_circle_admin_notice_welcome' );
                if ( ! $notice_nag ) {
                    echo '<div class="at-gsm-notice">
                        <small class="plugin-install-notice">'.esc_html__('Clicking the button below will install and activate the Advanced Import plugin.','medical-circle').'</small>
                        <a class="at-gsm-btn button button-primary button-hero" href="#" data-name="" data-slug="" aria-label="'.esc_html__('Get started with Medical Circle','medical-circle').'">
                         '.esc_html__('Get started with Medical Circle','medical-circle').'                   
                         </a>
                    </div>';
                }
                echo '<a href="https://www.acmethemes.com/" target="_blank" class="wp-badge epsilon-info-logo"></a>';

                /*quick links*/
                if( !empty( $quick_links ) && is_array( $quick_links ) ){
                    echo '<p class="quick-links">';
                    foreach ( $quick_links as $quick_key => $quick_link ) {
                        $button = 'button-secondary';
                        if( 'pro_url' == $quick_key ){
                            $button = 'button-primary';
                        }
                        echo '<a href="'.esc_url( $quick_link['url'] ).'" class="button '.esc_attr( $button ).'" target="_blank">'.esc_html( $quick_link['text'] ).'</a>';
                    }
                    echo "</p>";
                }

                /* Display tabs */
                if ( ! empty( $this->tabs ) ) {
                    $current_tab = isset( $_GET['tab'] ) ? wp_unslash( $_GET['tab'] ) : 'getting_started';

                    echo '<h2 class="nav-tab-wrapper wp-clearfix">';
                    $count = $this->count_recommended_actions();
                    foreach ( $this->tabs as $tab_key => $tab_name ) {

                        echo '<a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme_slug . '-info' ) ) . '&tab=' . esc_attr( $tab_key ). '" class="nav-tab ' . ( $current_tab == $tab_key ? 'nav-tab-active' : '' ) . '" role="tab" data-toggle="tab">';
                        echo esc_html( $tab_name );
                        if ( $tab_key == 'recommended_actions' ) {
                            if ( $count > 0 ) {
                                echo '<span class="badge-action-count">' . esc_html( $count ) . '</span>';
                            }
                        }
                        echo '</a>';
                    }

                    echo '</h2>';

                    /* Display content for current tab, dynamic method according to key provided*/
                    if ( method_exists( $this, $current_tab ) ) {

                        echo "<div class='changelog point-releases'>";
                        $this->$current_tab();
                        echo "</div>";
                    }
                }
                echo '</div><!--/.wrap.about-wrap-->';
            }
        }

        /**
         * Getting started tab
         */
        public function getting_started() {
            if ( ! empty( $this->config['getting_started'] ) ) {
                $getting_started = $this->config['getting_started'];
                if ( ! empty( $getting_started ) ) {

                    /*defaults values for getting_started array */
                    $defaults = array(
                        'title'     => '',
                        'desc'       => '',
                        'recommended_actions'=> '',
                        'link_title'   => '',
                        'link_url'   => '',
                        'is_button' => false,
                        'is_new_tab' => false
                    );

                    echo '<div class="feature-section three-col">';

                    foreach ( $getting_started as $getting_started_item ) {

                        /*allowed 6 value in array */
                        $instance = wp_parse_args( (array) $getting_started_item, $defaults );
                        /*default values*/
                        $title = esc_html( $instance[ 'title' ] );
                        $desc = wp_kses_post( $instance[ 'desc' ] );
                        $link_title = esc_html( $instance[ 'link_title' ] );
                        $link_url = esc_url( $instance[ 'link_url' ] );
                        $is_button = $instance[ 'is_button' ];
                        $is_new_tab = $instance[ 'is_new_tab' ];


                        echo '<div class="col">';
                        if ( ! empty( $title ) ) {
                            echo '<h3>' . $title . '</h3>';
                        }
                        if ( ! empty( $desc ) ) {
                            echo '<p>' . $desc . '</p>';
                        }
                        if ( ! empty( $link_title ) && ! empty( $link_url ) ) {

                            echo '<p>';
                            $button_class = '';
                            if ( $is_button ) {
                                $button_class = 'button button-primary';
                            }

                            $count = $this->count_recommended_actions();

                            if ( $getting_started_item['recommended_actions'] && isset( $count ) ) {
                                if ( $count == 0 ) {
                                    echo '<span class="dashicons dashicons-yes"></span>';
                                } else {
                                    echo '<span class="dashicons dashicons-no-alt"></span>';
                                }
                            }

                            $button_new_tab = '_self';
                            if ( $is_new_tab ) {
                                $button_new_tab = '_blank';
                            }

                            echo '<a target="' . esc_attr( $button_new_tab ) . '" href="' . esc_url( $getting_started_item['link_url'] ) . '"class="' . esc_attr( $button_class ) . '">' . esc_attr( $getting_started_item['link_title'] ) . '</a>';
                            echo '</p>';
                        }
                        echo '</div><!-- .col -->';
                    }
                    echo '</div><!-- .feature-section three-col -->';
                }
            }
        }

        /**
         * Recommended Actions tab
         */
        public function check_plugin_status( $slug ) {

            $path = WPMU_PLUGIN_DIR . '/' . $slug . '/' . $slug . '.php';
            if ( ! file_exists( $path ) ) {
                $path = WP_PLUGIN_DIR . '/' . $slug . '/' . $slug . '.php';
                if ( ! file_exists( $path ) ) {
                    $path = false;
                }
            }

            if ( file_exists( $path ) ) {
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

                $needs = is_plugin_active( $slug . '/' . $slug . '.php' ) ? 'deactivate' : 'activate';

                return array( 'status' => is_plugin_active( $slug . '/' . $slug . '.php' ), 'needs' => $needs );
            }
            return array( 'status' => false, 'needs' => 'install' );
        }

        public function create_action_link( $state, $slug ) {

            switch ( $state ) {
                case 'install':
                    return wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'install-plugin',
                                'plugin' => $slug
                            ),
                            esc_url( network_admin_url( 'update.php' ) )
                        ),
                        'install-plugin_' . $slug
                    );
                    break;

                case 'deactivate':
                    return add_query_arg(
                            array(
                                'action'        => 'deactivate',
                                'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
                                'plugin_status' => 'all',
                                'paged'         => '1',
                                '_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . $slug . '/' . $slug . '.php' )
                                ),
                            esc_url( network_admin_url( 'plugins.php' ) )
                    );
                    break;

                case 'activate':
                    return add_query_arg(
                            array(
                                'action'        => 'activate',
                                'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
                                'plugin_status' => 'all',
                                'paged'         => '1',
                                '_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $slug . '/' . $slug . '.php' )
                            ),
                            esc_url( network_admin_url( 'plugins.php' ) )
                    );
                    break;
            }
        }

        public function recommended_actions() {

            $recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
            $hooray = true;
            if ( ! empty( $recommended_actions ) ) {

                echo '<div class="feature-section action-recommended demo-import-boxed" id="plugin-filter">';

                if ( ! empty( $recommended_actions ) && is_array( $recommended_actions ) ) {

                    /*get saved recommend actions*/
                    $saved_recommended_actions = get_option( $this->theme_slug . '_recommended_actions' );

                    /*defaults values for getting_started array */
                    $defaults = array(
                        'title'         => '',
                        'desc'          => '',
                        'check'         => false,
                        'plugin_slug'   => '',
                        'id'            => ''
                    );
                    foreach ( $recommended_actions as $action_key => $action_value ) {
                        $instance = wp_parse_args( (array) $action_value, $defaults );

                        /*allowed 5 value in array */
                        $title = $instance[ 'title' ];
                        $desc = $instance[ 'desc' ];
                        $check = $instance[ 'check' ];
                        $plugin_slug = $instance[ 'plugin_slug' ];
                        $id = $instance[ 'id' ];

                        $hidden = false;

                        /*magic check for recommended actions*/
                        if (
                            isset( $saved_recommended_actions[ $id ] ) &&
                            $saved_recommended_actions[ $id ] == false ) {
                            $hidden = true;
                        }
                        $done = '';
                        if ( $check ) {
                           $done = 'done';
                        }

                        echo "<div class='at-theme-info-action-recommended-box {$done}'>";

                        if ( ! $hidden ) {
                            echo '<span data-action="dismiss" class="dashicons dashicons-visibility at-theme-info-recommended-action-button" id="' . esc_attr( $action_value['id'] ) . '"></span>';
                        } else {
                            echo '<span data-action="add" class="dashicons dashicons-hidden at-theme-info-recommended-action-button" id="' . esc_attr( $action_value['id'] ) .'"></span>';
                        }

                        if ( ! empty( $title) ) {
                            echo '<h3>' . wp_kses_post( $title ) . '</h3>';
                        }

                        if ( ! empty( $desc ) ) {
                            echo '<p>' . wp_kses_post( $desc ) . '</p>';
                        }

                        if ( ! empty( $plugin_slug ) ) {

                            $active = $this->check_plugin_status( $action_value['plugin_slug'] );
                            $url    = $this->create_action_link( $active['needs'], $action_value['plugin_slug'] );
                            $label  = '';
                            $class  = '';
                            switch ( $active['needs'] ) {

                                case 'install':
                                    $class = 'install-now button';
                                    $label = esc_html__( 'Install', 'medical-circle' );
                                    break;

                                case 'activate':
                                    $class = 'activate-now button button-primary';
                                    $label = esc_html__( 'Activate', 'medical-circle' );

                                    break;

                                case 'deactivate':
                                    $class = 'deactivate-now button';
                                    $label = esc_html__( 'Deactivate', 'medical-circle' );

                                    break;
                            }
                            ?>
                            <p class="plugin-card-<?php echo esc_attr( $action_value['plugin_slug'] ) ?> action_button <?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ?>">
                                <a data-slug="<?php echo esc_attr( $action_value['plugin_slug'] ) ?>"
                                   class="<?php echo esc_attr( $class ); ?>"
                                   href="<?php echo esc_url( $url ) ?>"> <?php echo esc_html( $label ) ?> </a>
                            </p>
                            <?php
                        }
                        echo '</div>';
                        $hooray = false;
                    }
                }
                if ( $hooray ){
                    echo '<span class="hooray">' . esc_html__( 'Hooray! There are no recommended actions for you right now.', 'medical-circle' ) . '</span>';
                    echo '<a data-action="reset" id="reset" class="reset-all" href="#">'.esc_html__('Show All Recommended Actions','medical-circle').'</a>';
                }
                echo '</div>';
            }
        }

        /**
         * Recommended plugins tab
         */
        /*
		 * Call plugin api
		 */
        public function call_plugin_api( $slug ) {
            include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );

            if ( false === ( $call_api = get_transient( 'at_theme_info_plugin_information_transient_' . $slug ) ) ) {
                $call_api = plugins_api( 'plugin_information', array(
                    'slug'   => $slug,
                    'fields' => array(
                        'downloaded'        => false,
                        'rating'            => false,
                        'description'       => false,
                        'short_description' => true,
                        'donate_link'       => false,
                        'tags'              => false,
                        'sections'          => true,
                        'homepage'          => true,
                        'added'             => false,
                        'last_updated'      => false,
                        'compatibility'     => false,
                        'tested'            => false,
                        'requires'          => false,
                        'downloadlink'      => false,
                        'icons'             => true
                    )
                ) );
                set_transient( 'at_theme_info_plugin_information_transient_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS );
            }
            return $call_api;
        }

        public function get_plugin_icon( $arr ) {

            if ( ! empty( $arr['svg'] ) ) {
                $plugin_icon_url = $arr['svg'];
            } elseif ( ! empty( $arr['2x'] ) ) {
                $plugin_icon_url = $arr['2x'];
            } elseif ( ! empty( $arr['1x'] ) ) {
                $plugin_icon_url = $arr['1x'];
            } else {
                $plugin_icon_url = get_template_directory_uri() . '/acmethemes/at-theme-info/images/placeholder_plugin.png';
            }
            return $plugin_icon_url;
        }

        public function recommended_plugins() {
            $recommended_plugins = $this->config['recommended_plugins'];

            if ( ! empty( $recommended_plugins ) ) {
                if ( ! empty( $recommended_plugins ) && is_array( $recommended_plugins ) ) {

                    echo '<div class="feature-section recommended-plugins three-col demo-import-boxed" id="plugin-filter">';

                    foreach ( $recommended_plugins as $recommended_plugins_item ) {

                        if ( ! empty( $recommended_plugins_item['slug'] ) ) {
                            $info   = $this->call_plugin_api( $recommended_plugins_item['slug'] );
                            if ( ! empty( $info->icons ) ) {
                                $icon = $this->get_plugin_icon( $info->icons );
                            }

                            $active = $this->check_plugin_status( $recommended_plugins_item['slug'] );

                            if ( ! empty( $active['needs'] ) ) {
                                $url = $this->create_action_link( $active['needs'], $recommended_plugins_item['slug'] );
                            }

                            echo '<div class="col plugin_box">';
                            if ( ! empty( $icon ) ) {
                                echo '<img src="'.esc_url( $icon ).'" alt="plugin box image">';
                            }
                            if ( ! empty(  $info->version ) ) {
                                echo '<span class="version">'. ( ! empty( $this->config['recommended_plugins']['version_label'] ) ? esc_html( $this->config['recommended_plugins']['version_label'] ) : '' ) . esc_html( $info->version ).'</span>';
                            }
                            if ( ! empty( $info->author ) ) {
                                echo '<span class="separator">'.esc_html__('|','medical-circle') .'</span>' . wp_kses_post( $info->author );
                            }

                            if ( ! empty( $info->name ) && ! empty( $active ) ) {
                                echo '<div class="action_bar ' . ( ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ) . '">';
                                echo '<span class="plugin_name">' . ( ( $active['needs'] !== 'install' && $active['status'] ) ? esc_html__('Active:','medical-circle') : '' ) . esc_html( $info->name ) . '</span>';
                                echo '</div>';

                                $label = '';

                                switch ( $active['needs'] ) {

                                    case 'install':
                                        $class = 'install-now button';
                                        $label = esc_html__( 'Install', 'medical-circle' );
                                        break;

                                    case 'activate':
                                        $class = 'activate-now button button-primary';
                                        $label = esc_html__( 'Activate', 'medical-circle' );

                                        break;

                                    case 'deactivate':
                                        $class = 'deactivate-now button';
                                        $label = esc_html__( 'Deactivate', 'medical-circle' );

                                        break;
                                }

                                echo '<span class="plugin-card-' . esc_attr( $recommended_plugins_item['slug'] ) . ' action_button ' . ( ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ) . '">';
                                echo '<a data-slug="' . esc_attr( $recommended_plugins_item['slug'] ) . '" class="' . esc_attr( $class ) . '" href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
                                echo '</span>';
                            }
                            echo '</div><!-- .col.plugin_box -->';
                        }
                    }
                    echo '</div><!-- .recommended-plugins -->';
                }
            }
        }

        /**
         * Child themes
         */
        public function child_themes() {
            echo '<div id="child-themes" class="at-theme-info-tab-pane">';
            $child_themes = isset( $this->config['child_themes'] ) ? $this->config['child_themes'] : array();
            if ( ! empty( $child_themes ) ) {

                /*defaults values for child theme array */
                $defaults = array(
                    'title'        => '',
                    'screenshot'   => '',
                    'download_link'=> '',
                    'preview_link' => ''
                );
                if ( ! empty( $child_themes ) && is_array( $child_themes ) ) {
                    echo '<div class="at-about-row">';
                    $i = 0;
                    foreach ( $child_themes as $child_theme ){
                        $instance = wp_parse_args( (array) $child_theme, $defaults );

                        /*allowed 5 value in array */
                        $title = $instance[ 'title' ];
                        $screenshot = $instance[ 'screenshot'];
                        $download_link = $instance[ 'download_link'];
                        $preview_link = $instance[ 'preview_link'];

                        if( !empty( $screenshot) ){
                            echo '<div class="at-about-child-theme">';
                            echo '<div class="at-theme-info-child-theme-image">';

                            echo '<img src="' . esc_url( $screenshot ) . '" alt="' . ( ! empty( $title ) ? esc_attr( $title ) : '' ) . '" />';

                            if ( ! empty( $title ) ) {
                                echo '<div class="at-theme-info-child-theme-details">';
                                echo '<div class="theme-details">';
                                echo '<span class="theme-name">' . esc_html( $title  ). '</span>';
                                if ( ! empty( $download_link ) ) {
                                    echo '<a href="' . esc_url( $download_link ) . '" class="button button-primary install right">' . esc_html__( 'Download','medical-circle' ) . '</a>';
                                }
                                if ( ! empty( $preview_link ) ) {
                                    echo '<a class="button button-secondary preview right" target="_blank" href="' . $preview_link . '">' . esc_html__( 'Live Preview','medical-circle' ). '</a>';
                                }
                                echo '</div>';
                                echo '</div>';
                            }

                            echo "</div>";
                            echo "</div>";
                            $i++;
                        }
                        if( 0 == $i % 3 ){
                            echo "</div><div class='at-about-row'>";/*.at-about-row end-start*/
                        }
                    }
                    echo '</div>';/*.at-about-row end*/
                }// End if().
            }// End if().
            echo '</div>';
        }

        /**
         * Support tab
         */
        public function support() {
            echo '<div class="feature-section three-col">';

            if ( ! empty( $this->config['support_content'] ) ) {

                $supports = $this->config['support_content'];

                if ( ! empty( $supports ) ) {

                    /*defaults values for child theme array */
                    $defaults = array(
                        'title' => '',
                        'icon' => '',
                        'desc' => '',
                        'button_label' => '',
                        'button_link' => '',
                        'is_button' => true,
                        'is_new_tab' => true
                    );

                    foreach ( $supports as $support ) {
                        $instance = wp_parse_args( (array) $support, $defaults );

                        /*allowed 7 value in array */
	                    /*default values*/
	                    $title = esc_html( $instance[ 'title' ] );
                        $icon = esc_attr( $instance[ 'icon']);
                        $desc = wp_kses_post( $instance[ 'desc' ] );
                        $button_label = esc_html( $instance[ 'button_label'] );
                        $button_link = esc_url( $instance[ 'button_link'] );
                        $is_button = $instance[ 'is_button'];
                        $is_new_tab = $instance[ 'is_new_tab'];
                        
                        echo '<div class="col">';

                        if ( ! empty( $title ) ) {
                            echo '<h3>';
                            if ( ! empty( $icon ) ) {
                                echo '<i class="' . $icon . '"></i>';
                            }
                            echo $title;
                            echo '</h3>';
                        }

                        if ( ! empty( $desc ) ) {
                            echo '<p><i>' . $desc . '</i></p>';
                        }

                        if ( ! empty( $button_link ) && ! empty( $button_label ) ) {

                            echo '<p>';
                            $button_class = '';
                            if ( $is_button ) {
                                $button_class = 'button button-primary';
                            }

                            $button_new_tab = '_self';
                            if ( isset( $is_new_tab ) ) {
                                if ( $is_new_tab ) {
                                    $button_new_tab = '_blank';
                                }
                            }
                            echo '<a target="' . $button_new_tab . '" href="' . $button_link . '" class="' . $button_class . '">' . $button_label . '</a>';
                            echo '</p>';
                        }
                        echo '</div>';
                    }
                }
            }
            echo '</div>';
        }

        /**
         * Changelog tab
         */
        private function parse_changelog() {
            WP_Filesystem();
            global $wp_filesystem;
            $changelog = $wp_filesystem->get_contents( get_template_directory() . '/changelog.txt' );
            if ( is_wp_error( $changelog ) ) {
                $changelog = '';
            }
            return $changelog;
        }

        public function changelog() {
            $changelog = $this->parse_changelog();
            if ( ! empty( $changelog ) ) {
                echo '<div class="featured-section changelog">';
                echo "<pre class='changelog'>";
                echo wp_kses_post( $changelog );
                echo "</pre>";
                echo '</div><!-- .featured-section.changelog -->';
            }
        }

        /**
         * Free vs PRO tab
         */
        public function free_pro() {
            $free_pro = isset( $this->config['free_pro'] ) ? $this->config['free_pro'] : array();
            if ( ! empty( $free_pro ) ) {
                /*defaults values for child theme array */
                $defaults = array(
                    'title'=> '',
                    'desc' => '',
                    'free' => '',
                    'pro'  => '',
                );

                if ( ! empty( $free_pro ) && is_array( $free_pro ) ) {
                    echo '<div class="feature-section">';
                    echo '<div id="free_pro" class="at-theme-info-tab-pane at-theme-info-fre-pro">';
                    echo '<table class="free-pro-table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th></th>';
                    echo '<th>' . esc_html__( 'Medical Circle','medical-circle' ) . '</th>';
                    echo '<th>' . esc_html__( 'Medical Circle Pro','medical-circle' ) . '</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ( $free_pro as $feature ) {

                        $instance = wp_parse_args( (array) $feature, $defaults );

                        /*allowed 7 value in array */
                        $title = $instance[ 'title' ];
                        $desc = $instance[ 'desc'];
                        $free = $instance[ 'free'];
                        $pro = $instance[ 'pro'];

                        echo '<tr>';
                        if ( ! empty( $title ) || ! empty( $desc ) ) {
                            echo '<td>';
                            if ( ! empty( $title ) ) {
                                echo '<h3>' . wp_kses_post( $title ) . '</h3>';
                            }
                            if ( ! empty( $desc ) ) {
                                echo '<p>' . wp_kses_post( $desc ) . '</p>';
                            }
                            echo '</td>';
                        }

                        if ( ! empty( $free )) {
                            if( 'yes' === $free ){
                                echo '<td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>';
                            }
                            elseif ( 'no' === $free ){
                                echo '<td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>';
                            }
                            else{
                                echo '<td class="only-lite">'.esc_html($free ).'</td>';
                            }
                        }
                        if ( ! empty( $pro )) {
                            if( 'yes' === $pro ){
                                echo '<td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>';
                            }
                            elseif ( 'no' === $pro ){
                                echo '<td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>';
                            }
                            else{
                                echo '<td class="only-lite">'.esc_html($pro ).'</td>';
                            }
                        }
                        echo '</tr>';
                    }

                    echo '<tr class="at-theme-info-text-center">';
                    echo '<td></td>';
                    echo '<td colspan="2"><a href="https://www.acmethemes.com/themes/medical-circle-pro/" target="_blank" class="button button-primary button-hero"> Medical Circle Pro</a></td>';
                    echo '</tr>';

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }

        /**
         * Support tab
         */
        public function faq() {
            echo '<div class="feature-section three-col faq">';

            if ( ! empty( $this->config['faq'] ) ) {

                $supports = $this->config['faq'];

                if ( ! empty( $supports ) ) {

                    /*defaults values for child theme array */
                    $defaults = array(
                        'title' => '',
                        'icon' => '',
                        'desc' => '',
                        'button_label' => '',
                        'button_link' => '',
                        'is_button' => true,
                        'is_new_tab' => true
                    );

                    foreach ( $supports as $support ) {
                        $instance = wp_parse_args( (array) $support, $defaults );

                        /*allowed 7 value in array */
	                    $title = esc_html( $instance[ 'title' ] );
	                    $icon = esc_attr( $instance[ 'icon']);
	                    $desc = wp_kses_post( $instance[ 'desc' ] );
	                    $button_label = esc_html( $instance[ 'button_label'] );
	                    $button_link = esc_url( $instance[ 'button_link'] );
	                    $is_button = $instance[ 'is_button'];
	                    $is_new_tab = $instance[ 'is_new_tab'];

                        echo '<div class="col-full">';

                        if ( ! empty( $title ) ) {
                            echo '<h3 class="faq-title">';
                            if ( ! empty( $icon ) ) {
                                echo '<i class="' . $icon . '"></i>';
                            }
                            echo $title;
                            echo '</h3>';
                        }
                        echo "<div class='faq-content'>";

                        if ( ! empty( $desc ) ) {
                            echo '<p><i>' . $desc . '</i></p>';
                        }
                        if ( ! empty( $button_link ) && ! empty( $button_label ) ) {

                            echo '<p>';
                            $button_class = '';
                            if ( $is_button ) {
                                $button_class = 'button button-primary';
                            }

                            $button_new_tab = '_self';
                            if ( isset( $is_new_tab ) ) {
                                if ( $is_new_tab ) {
                                    $button_new_tab = '_blank';
                                }
                            }
                            echo '<a target="' . $button_new_tab . '" href="' . $button_link . '" class="' . $button_class . '">' . $button_label . '</a>';
                            echo '</p>';
                        }
                        echo "</div>";

                        echo '</div>';
                    }
                }
            }
            echo '</div>';
        }

        /**
         * Load css and scripts for the about page
         */
        public function style_and_scripts( $hook_suffix ) {

            // this is needed on all admin pages, not just the about page, for the badge action count in the WordPress main sidebar
            wp_enqueue_style( 'at-theme-info-css', get_template_directory_uri() . '/acmethemes/at-theme-info/css/at-theme-info.css' );

            if ( 'appearance_page_' . $this->theme_slug . '-info' == $hook_suffix ) {

                wp_enqueue_script( 'at-theme-info-js', get_template_directory_uri() . '/acmethemes/at-theme-info/js/at-theme-info.js', array( 'jquery' ) );

                wp_enqueue_style( 'plugin-install' );
                wp_enqueue_script( 'plugin-install' );
                wp_enqueue_script( 'updates' );

                $count = $this->count_recommended_actions();
                wp_localize_script( 'at-theme-info-js', 'at_theme_info_object', array(
                    'nr_actions_recommended'      => $count,
                    'ajaxurl'                  => esc_url( admin_url( 'admin-ajax.php' ) ),
                    'template_directory'       => esc_url( get_template_directory_uri() )
                ) );

            }

        }
    }
}

$config = array(
    // Page title.
    'page_title'               => esc_html__( 'Medical Circle Info', 'medical-circle' ),

    // Menu name under Appearance.
    'menu_title'               => esc_html__( 'Medical Circle Info', 'medical-circle' ),

    // Main welcome title
    'info_title'         => sprintf( esc_html__( 'Welcome to %s - ', 'medical-circle' ), 'Medical Circle' ),

    // Main welcome content
    'info_content'       => sprintf( esc_html__( '%s is now installed and ready to use. We hope the following information will help you. If you want to ask any query or just want to say hello, you can always contact us. We hope you enjoy it! ', 'medical-circle' ), '<b>Medical Circle</b>' ),

    /**
     * Quick links
     */
    'quick_links'                    => array(
        'theme_url'  => array(
                'text' => __('Theme Details','medical-circle'),
                'url' => 'https://www.acmethemes.com/themes/medical-circle/'
        ),
        'demo_url'  => array(
            'text' => __('View Demo','medical-circle'),
            'url' => 'http://www.demo.acmethemes.com/medical-circle/'
        ),
        'pro_url'  => array(
            'text' => __('View Pro Version','medical-circle'),
            'url' => 'https://www.acmethemes.com/themes/medical-circle-pro/'
        ),
        'rate_url'  => array(
            'text' => __('Rate This Theme','medical-circle'),
            'url' => 'https://wordpress.org/support/theme/medical-circle/reviews/?filter=5'
        ),
    ),

    /**
     * Tabs array.
     *'tabs'                    => array(
    'getting_started'  => __( 'Getting Started', 'medical-circle' ),
    'recommended_actions' => __( 'Recommended Actions', 'medical-circle' ),
    'recommended_plugins' => __( 'Useful Plugins','medical-circle' ),
    'support'       => __( 'Support', 'medical-circle' ),
    'changelog'        => __( 'Changelog', 'medical-circle' ),
    'faq'        => __( 'FAQ', 'medical-circle' ),
    'free_pro'         => __( 'Free VS PRO', 'medical-circle' ),
    ),
     * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
     * the will be the name of the function which will be used to render the tab content.
     */
    'tabs'                    => array(
        'getting_started'  => __( 'Getting Started', 'medical-circle' ),
        'recommended_actions' => __( 'Recommended Actions', 'medical-circle' ),
        'recommended_plugins' => __( 'Useful Plugins','medical-circle' ),
        'support'       => __( 'Support', 'medical-circle' ),
        'changelog'        => __( 'Changelog', 'medical-circle' ),
        'faq'        => __( 'FAQ', 'medical-circle' ),
        'free_pro'         => __( 'Free VS PRO', 'medical-circle' ),
    ),

    /*Getting started tab*/
    'getting_started' => array(
        'first' => array(
            'title' => esc_html__( 'Step 1 : Read full documentation','medical-circle' ),
            'desc' => esc_html__( 'Please check our full documentation for detailed information on how to Setup and Use Medical Circle.','medical-circle' ),
            'link_title' => esc_html__( 'Documentation','medical-circle' ),
            'link_url' => 'http://www.doc.acmethemes.com/medical-circle/',
            'is_button' => false,
            'recommended_actions' => false,
            'is_new_tab' => true
        ),
        'second' => array(
            'title' => esc_html__( 'Step 2 : Go to Customizer','medical-circle' ),
            'desc' => esc_html__( 'All Setting, Theme Options, Widgets and Menus are available via Customize screen. Have a quick look or start customization!','medical-circle' ),
            'link_title' => esc_html__( 'Go to Customizer','medical-circle' ),
            'link_url' => esc_url( admin_url( 'customize.php' ) ),
            'is_button' => true,
            'recommended_actions' => false,
            'is_new_tab' => true
        ),
        'third' => array(
            'title' => esc_html__( 'Step 3: Setting Static Front Page','medical-circle' ),
            'desc' => esc_html__( 'Select A static page than Front page and Posts page to enable Slider and Home Main Content Area','medical-circle' ),
            'link_title' => esc_html__( 'Static Front Page','medical-circle' ),
            'link_url' => esc_url( admin_url( 'customize.php' ) ).'?autofocus[section]=static_front_page',
            'is_button' => true,
            'recommended_actions' => false,
            'is_new_tab' => true
        ),
        'forth' => array(
            'title' => esc_html__( 'Step 4 : Setting Featured Section ','medical-circle' ),
            'desc' => esc_html__( 'Add Feature Image or Unlimited Slides on Feature Section. Please do the Step 3 before this.','medical-circle' ),
            'link_title' => esc_html__( 'Featured Section','medical-circle' ),
            'link_url' => esc_url( admin_url( 'customize.php' ) ).'?autofocus[panel]=medical-circle-feature-panel',
            'is_button' => true,
            'recommended_actions' => false,
            'is_new_tab' => true
        ),
        'fifth' => array(
            'title' => esc_html__( 'Step 5 : Setting Home Main Content Area ','medical-circle' ),
            'desc' => esc_html__( 'You can Add, Edit, Remove or Drag, Drop, Reorder widgets on Home Main Content Area. Please do the Step 3 before this.','medical-circle' ),
            'link_title' => esc_html__( 'Home Main Content Area','medical-circle' ),
            'link_url' => esc_url( admin_url( 'customize.php' ) ).'?autofocus[section]=sidebar-widgets-medical-circle-home',
            'is_button' => true,
            'recommended_actions' => false,
            'is_new_tab' => true
        ),
        'sixth' => array (
	        'title' => esc_html__( 'How to disable Page Content  on Front Page? ','medical-circle' ),
	        'desc' => esc_html__( 'Page title and content will show at the bottom of the Front Page, in most of the cases it is not necessary.','medical-circle' ),
	        'link_title' => esc_html__( 'Remove Front Page Content','medical-circle' ),
	        'link_url' => esc_url( admin_url( 'customize.php' ) ).'?autofocus[section]=medical-circle-front-page-content',
	        'is_button' => true,
	        'recommended_actions' => false,
	        'is_new_tab' => true
        ),
    ),

    // recommended actions array.
    'recommended_actions'        => array(
        'demo-content' => array(
            'title' => esc_html__( 'Install Demo Setup','medical-circle' ),
            'desc' => sprintf( esc_html__( 'For the demo content installation, install the Acme Demo Setup plugin, download demo content from %1$s here %2$s. Then go to "Acme Demo Setup" and import demo. ', 'medical-circle' ), '<a target="_blank" href="http://www.doc.acmethemes.com/medical-circle/#DummyData" >','</a>' ),
            'id' => 'acme-demo-setup',
            'check' =>  ( ( function_exists('acme_demo_setup_load_textdomain') )? true : false ),
            'plugin_slug'   => 'acme-demo-setup',
        ),
        'front-page' => array(
            'title' => esc_html__( 'Setting Static Front Page','medical-circle' ),
            'desc' => sprintf( esc_html__( 'Select A static page than Front page and Posts page to enable Slider and Home Main Content Area %1$s Static Front Page %2$s ', 'medical-circle' ), '<p><a target="_blank" href="'.esc_url( admin_url( 'customize.php' ) ).'?autofocus[section]=static_front_page'.'" class="button button-primary">','</a></p>' ),
            'id' => 'front-page',
            'check' =>  ( ( 'page' == get_option('show_on_front') )? true : false )
        )
    ),

    // Plugins array.
    'recommended_plugins'        => array(
        'gutentor' => array(
            'slug' => 'gutentor'
        ),
        'siteorigin-panels' => array(
            'slug' => 'siteorigin-panels'
        )
    ),

    /*FAQ*/
    'faq'      => array(
        'first' => array (
            'title' => esc_html__( 'My slider is not showing on the front page?','medical-circle' ),
            'icon' => 'dashicons dashicons-sos',
            'desc' => esc_html__( 'First select Front Page and Blog page and only you can enable Slider and Home Main Content Area on Front Page','medical-circle' ),
            'button_label' => esc_html__( 'About Us Section','medical-circle' ),
            'button_link' => esc_url( admin_url( 'customize.php' ) ).'?autofocus[section]=static_front_page',
            'is_button' => true,
            'is_new_tab' => true
        ),
        'second' => array (
	        'title' => esc_html__( 'How to add Other sections like about, team on Front ','medical-circle' ),
	        'icon' => 'dashicons dashicons-sos',
	        'desc' => esc_html__( 'You can Add, Edit, Remove or Drag, Drop, Reorder widgets on Home Main Content Area.','medical-circle' ),
	        'button_label' => esc_html__( 'Home Main Content Area','medical-circle' ),
	        'button_link' => esc_url( admin_url( 'customize.php' ) ).'?autofocus[section]=sidebar-widgets-medical-circle-home',
	        'is_button' => true,
	        'is_new_tab' => true
        ),
        'third' => array (
	        'title' => esc_html__( 'Hide Medical Circle by Acme Themes from footer ? ','medical-circle' ),
	        'icon' => 'dashicons dashicons-sos',
	        'desc' => esc_html__( 'Please visit the blog post to know more about it.','medical-circle' ),
	        'button_label' => esc_html__( 'Hide credit text on Footer','medical-circle' ),
	        'button_link' => esc_url( 'https://www.acmethemes.com/blog/2017/01/remove-powered-by-text-on-footer/' ),
	        'is_button' => true,
	        'is_new_tab' => true
        ),
        'fourth' => array (
	        'title' => esc_html__( 'How to make one page site? ','medical-circle' ),
	        'icon' => 'dashicons dashicons-sos',
	        'desc' => esc_html__( 'Create One page site of Medical Circle','medical-circle' ),
	        'button_label' => esc_html__( 'Few Steps for One Page Site','medical-circle' ),
	        'button_link' => esc_url( 'https://www.acmethemes.com/blog/2016/04/corporate-plus-pro-few-steps-to-create-one-page-site/' ),
	        'is_button' => true,
	        'is_new_tab' => true
        ),

        'fifth' => array (
	        'title' => esc_html__( 'How to change the order of slider and other section ? ','medical-circle' ),
	        'icon' => 'dashicons dashicons-sos',
	        'desc' => esc_html__( 'You can just drag and reorder of the Items, Please do not forget to save after reorder ','medical-circle' ),
	        'button_label' => esc_html__( 'See this blog post to change the published date','medical-circle' ),
	        'button_link' => esc_url( 'https://www.acmethemes.com/blog/2016/08/how-to-change-the-post-publish-date-on-wordpress/' ),
	        'is_button' => true,
	        'is_new_tab' => true
        ),

        'sixth' => array (
	        'title' => esc_html__( 'Recent Updates of your Site ? ','medical-circle' ),
	        'icon' => 'dashicons dashicons-sos',
	        'desc' => esc_html__( 'Where i can get the recent updates of theme related updates ? ','medical-circle' ),
	        'button_label' => esc_html__( 'Visit our site blog page','medical-circle' ),
	        'button_link' => esc_url( 'https://www.acmethemes.com/blog/' ),
	        'is_button' => true,
	        'is_new_tab' => true
        )
    ),

    // Support content tab.
    'support_content'      => array(
        'first' => array (
            'title' => esc_html__( 'Contact Support','medical-circle' ),
            'icon' => 'dashicons dashicons-sos',
            'desc' => esc_html__( 'Got theme support question or found bug? Best place to ask your query is our dedicated Support forum.','medical-circle' ),
            'button_label' => esc_html__( 'Contact Support','medical-circle' ),
            'button_link' => esc_url( 'https://www.acmethemes.com/supports/forum/medical-circle/' ),
            'is_button' => true,
            'is_new_tab' => true
        ),
        'second' => array(
            'title' => esc_html__( 'Documentation','medical-circle' ),
            'icon' => 'dashicons dashicons-book-alt',
            'desc' => esc_html__( 'Please check our full documentation for detailed information on how to Setup and Use Medical Circle.','medical-circle' ),
            'button_label' => esc_html__( 'Read full documentation','medical-circle' ),
            'button_link' => 'http://www.doc.acmethemes.com/medical-circle/',
            'is_button' => false,
            'is_new_tab' => true
        ),
        'third' => array(
            'title' => esc_html__( 'Need more features?','medical-circle' ),
            'icon' => 'dashicons dashicons-screenoptions',
            'desc' => esc_html__( 'Upgrade to PRO version for more exciting features and Priority Support.','medical-circle' ),
            'button_label' => esc_html__( 'View Pro Version','medical-circle' ),
            'button_link' => 'https://www.acmethemes.com/themes/medical-circle-pro/',
            'is_button' => true,
            'is_new_tab' => true
        ),
        'fourth' => array(
            'title' => esc_html__( 'Got sales related question?','medical-circle' ),
            'icon' => 'dashicons dashicons-cart',
            'desc' => esc_html__( "Have any query before purchase, you are more than welcome to ask.",'medical-circle' ),
            'button_label' => esc_html__( 'Pre-sale Question?','medical-circle' ),
            'button_link' => 'https://www.acmethemes.com/pre-sale-question/',
            'is_button' => true,
            'is_new_tab' => true
        ),
        'fifth' => array(
            'title' => esc_html__( 'Customization Request','medical-circle' ),
            'icon' => 'dashicons dashicons-hammer',
            'desc' => esc_html__( 'Needed any customization for the theme, you can request from here.','medical-circle' ),
            'button_label' => esc_html__( 'Customization Request','medical-circle' ),
            'button_link' => 'https://www.acmethemes.com/customization-request/',
            'is_button' => false,
            'is_new_tab' => true
        ),
        'sixth' => array(
            'title' => esc_html__( 'Build a page with a drag-and-drop content builder','medical-circle' ),
            'icon' => 'dashicons dashicons-tagcloud',
            'desc' => esc_html__( 'Install the plugin Page Builder by SiteOrigin from Useful Plugins and start to create creative content on page and post.','medical-circle' ),
            'button_label' => esc_html__( 'Install Plugin','medical-circle' ),
            'button_link' => '?page=medical-circle-info&tab=recommended_plugins',
            'is_button' => false,
            'is_new_tab' => false
        )
    ),

    // Free vs pro array.
    'free_pro' => array(
	    array(
		    'title'       => __( 'Custom Widgets', 'medical-circle' ),
		    'desc' => __( 'All added custom widgets are ready for page builder plugin', 'medical-circle' ),
		    'free'  => __('9+ Available','medical-circle'),
		    'pro'   => __('16+ Available','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Widget Options', 'medical-circle' ),
		    'desc' => __( 'Every widgets have multiple options to customize section', 'medical-circle' ),
		    'free'  => __('Limited','medical-circle'),
		    'pro'   => __('Multiple Options','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Google Fonts', 'medical-circle' ),
		    'desc' => __( 'Google fonts options for changing the overall site fonts ', 'medical-circle' ),
		    'free'  => 'yes',
		    'pro'   => __('Unlimited','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Color Options', 'medical-circle' ),
		    'desc' => __( 'Color options for changing overall site colors, Contat us', 'medical-circle' ),
		    'free'  => __('2','medical-circle'),
		    'pro'   => __('Unlimited','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Header Options', 'medical-circle' ),
		    'desc' => __( 'Customze the header section as your need.', 'medical-circle' ),
		    'free'  => __('Limited','medical-circle'),
		    'pro'   => __('Multiple Options','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Menu Options', 'medical-circle' ),
		    'desc' => __( 'Lots of menu options are available to manage the menu section. Appearance > Menus', 'medical-circle' ),
		    'free'  => __('Limited','medical-circle'),
		    'pro'   => __('Multiple Options','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Featured Selection', 'medical-circle' ),
		    'desc' => __( 'This is slider section. Check every options there','medical-circle' ),
		    'free'  => __('Page Only','medical-circle'),
		    'pro'   => __('Page, Post, Category, And Custom','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Featured Section Options', 'medical-circle' ),
		    'desc' => __( 'Options to manage the sliders', 'medical-circle' ),
		    'free'  => __('Limited','medical-circle'),
		    'pro'   => __('Multiple Options','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Sticky Sidebar', 'medical-circle' ),
		    'desc' => __( 'Enable/Disable sticky sidebars', 'medical-circle' ),
		    'free'  => 'no',
		    'pro'   => 'yes',
	    ),
	    array(
		    'title'       => __( 'Blog/Archive Options', 'medical-circle' ),
		    'desc' => __( 'Various Options are available for the blog and archive page management. Check on Appearance > Customize > Layout/Design Options.', 'medical-circle' ),
		    'free'  => __('Limited','medical-circle'),
		    'pro'   => __('Manage Every Entity','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Footer Options', 'medical-circle' ),
		    'desc' => __( 'Manage the every entity related to footer section.', 'medical-circle' ),
		    'free'  => __('Limited','medical-circle'),
		    'pro'   => __('Multiple Options','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Social Options', 'medical-circle' ),
		    'desc' => __( 'Options to manage the social icons like facebook, instagram, linkedin etc.', 'medical-circle' ),
		    'free'  => __('Limited','medical-circle'),
		    'pro'   => __('Multiple Options','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Theme Credit Link', 'medical-circle' ),
		    'desc' => __( 'Options to disable to Powered by text on footer.', 'medical-circle' ),
		    'free'  => __('No Options To Disable','medical-circle'),
		    'pro'   => __('Enable/Disable','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Own Credit Link', 'medical-circle' ),
		    'desc' => __( 'Write your own credit text.', 'medical-circle' ),
		    'free'  => 'no',
		    'pro'   => __('Your Own Text','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Social Icons', 'medical-circle' ),
		    'desc' => __( 'Enter the URL for social icons. ', 'medical-circle' ),
		    'free'  => __('Unlimited','medical-circle'),
		    'pro'   => __('Unlimited','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Intro Loader Options', 'medical-circle' ),
		    'desc' => __( 'It will load before the site loaded completely.', 'medical-circle' ),
		    'free'  => 'no',
		    'pro'   => __('Multiple Options','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Related Post Options', 'medical-circle' ),
		    'desc' => __( 'Related post will appear on single post of each blog article', 'medical-circle' ),
		    'free'   => __('Enable/Disable','medical-circle'),
		    'pro'   => __('Multiple Options','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Author Info Options', 'medical-circle' ),
		    'desc' => __( 'This will appear on single page and archive page of that author.', 'medical-circle' ),
		    'free'   => __('Default','medical-circle'),
		    'pro'   => __('Multiple Options','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Feature Image Options', 'medical-circle' ),
		    'desc' => __( 'Featured image options for the single page and post.', 'medical-circle' ),
		    'free'  => 'no',
		    'pro'   => __('Manage As Your Need','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Navigation Options', 'medical-circle' ),
		    'desc' => __( 'Post Navigation means, previous post and next post. Check on single post.', 'medical-circle' ),
		    'free'   => __('Default','medical-circle'),
		    'pro'   => __('Advanced','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Post Comment Options', 'medical-circle' ),
		    'desc' => __( 'Manage the comment section on single post.', 'medical-circle' ),
		    'free'  => 'no',
		    'pro'   => __('Options Available','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Show/Hide Comment', 'medical-circle' ),
		    'desc' => __( 'Options to show hide comments on page and post.', 'medical-circle' ),
		    'free'  => 'no',
		    'pro'   => 'yes',
	    ),
	    array(
		    'title'       => __( 'Breadcrumb', 'medical-circle' ),
		    'desc' => __( 'Advanced options for manage the Breadcrumb.', 'medical-circle' ),
		    'free'  => 'yes',
		    'pro'   => __('Advanced','medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Video Post On Featured', 'medical-circle' ),
		    'desc' => __( 'Create your video post easily from Youtube and Vimeo video.', 'medical-circle' ),
		    'free'  => 'no',
		    'pro'   => __('Add Own Video On Featured','medical-circle'),
	    ),
	    array(
		    'title'=> __( 'Single Post Options', 'medical-circle' ),
		    'desc' => __( 'Manage every entity of single post.', 'medical-circle' ),
		    'free' => 'no',
		    'pro'  => __('Multiple Options','medical-circle'),
	    ),
	    array(
		    'title'=> __( 'Featured Image Size', 'medical-circle' ),
		    'desc' => __( 'Select the size of the featured image on the single post.', 'medical-circle' ),
		    'free' => 'no',
		    'pro'  => 'yes',
	    ),
	    array(
		    'title'=> __( 'Sidebars', 'medical-circle' ),
		    'desc' => __( 'Global and Individual sidebars are available. You can easily orverride it from single page/post.', 'medical-circle' ),
		    'free' => __('Global And Individuals', 'medical-circle'),
		    'pro'  => __('Global/Individuals and added Sidebars', 'medical-circle'),
	    ),
	    array(
		    'title'=> __( 'WooCommerce', 'medical-circle' ),
		    'desc' => __( 'Create WooCommerce shop easily with the help of WooCommerce plugin.', 'medical-circle' ),
		    'free' => 'yes',
		    'pro'  => 'yes',
	    ),
	    array(
		    'title'=> __( 'Page Builder', 'medical-circle' ),
		    'desc' => __( 'Page builder by site origin plugin compatible with page template.', 'medical-circle' ),
		    'free' => 'yes',
		    'pro'  => 'yes',
	    ),
	    array(
		    'title'=> __( 'Appointment Form', 'medical-circle' ),
		    'desc' => __( 'Use Contact Form 7 to make the Appointment form.', 'medical-circle' ),
		    'free' => 'yes',
		    'pro'  => 'yes',
	    ),
	    array(
		    'title'=> __( 'Quick Contact Section', 'medical-circle' ),
		    'desc' => __( 'Quick contact section including phone, email, website etc including location.', 'medical-circle' ),
		    'free' => 'yes',
		    'pro'  => __('Lots of Options for customization', 'medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Translation', 'medical-circle' ),
		    'desc' => __( 'Both theme are translation ready.', 'medical-circle' ),
		    'free'  => 'yes',
		    'pro'   => 'yes',
	    ),
	    array(
		    'title'       => __( 'SEO', 'medical-circle' ),
		    'desc' => __( 'Developed with high skilled SEO tools.', 'medical-circle' ),
		    'free'  => 'yes',
		    'pro'   => 'yes',
	    ),
	    array(
		    'title'       => __( 'Widget Area On Footer', 'medical-circle' ),
		    'desc' => __( 'Change the number of footers on footer area as you need.', 'medical-circle' ),
		    'free'  => __('4 ', 'medical-circle'),
		    'pro'   => __('Choose On Need', 'medical-circle'),
	    ),
	    array(
		    'title'       => __( 'Support Forum', 'medical-circle' ),
		    'desc' => __( 'Highly dedicated support team are assigned for your help. Try this today.', 'medical-circle' ),
		    'free'  => __('Second', 'medical-circle'),
		    'pro'   => __('Dedicated With High Priority', 'medical-circle'),
	    )
    )
);
return new Medical_Circle_Theme_Info( $config );