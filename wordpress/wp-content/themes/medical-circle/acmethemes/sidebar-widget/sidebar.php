<?php
/**
 * Common functions for widgets
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 *
 * @return array $medical_circle_about_column_number
 *
 */
if ( ! function_exists( 'medical_circle_background_options' ) ) :
	function medical_circle_background_options() {
		$medical_circle_about_column_number = array(
			'default' => __( 'Default', 'medical-circle' ),
			'gray' => __( 'Gray', 'medical-circle' )
		);

		return apply_filters( 'medical_circle_background_options', $medical_circle_about_column_number );
	}
endif;

/**
 * Column Number
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 *
 * @return array $medical_circle_about_column_number
 *
 */
if ( ! function_exists( 'medical_circle_column_number' ) ) :
	function medical_circle_column_number() {
		$medical_circle_about_column_number = array(
			1 => __( '1', 'medical-circle' ),
			2 => __( '2', 'medical-circle' ),
			3 => __( '3', 'medical-circle' ),
			4 => __( '4', 'medical-circle' )
		);
		return apply_filters( 'medical_circle_column_number', $medical_circle_about_column_number );
	}
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function medical_circle_widgets_init() {
	register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'medical-circle' ),
        'id'            => 'medical-circle-sidebar',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2><div class="line"><span></span></div>',
    ) );
    if ( is_customize_preview() ) {
        $medical_circle_home_description = sprintf( __( 'Displays widgets on home page main content area.%1$s Note : Please go to %2$s "Static Front Page"%3$s setting, Select "A static page" then "Front page" and "Posts page" to show added widgets', 'medical-circle' ), '<br />','<b><a class="at-customizer" data-section="static_front_page" style="cursor: pointer">','</a></b>' );
    }
    else{
        $medical_circle_home_description = __( 'Displays widgets on Front/Home page. Note : Please go to Setting => Reading, Select "A static page" then "Front page" and "Posts page" to show added widgets', 'medical-circle' );
    }
    register_sidebar(array(
        'name' => __('Home Main Content Area', 'medical-circle'),
        'id'   => 'medical-circle-home',
        'description'	=> $medical_circle_home_description,
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2><div class="line"><span></span></div>',
    ));

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'medical-circle' ),
		'id'            => 'medical-circle-sidebar-left',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class="line"><span></span></div>'
	) );
    register_sidebar(array(
        'name' => __('Footer Column One', 'medical-circle'),
        'id' => 'footer-col-one',
        'description' => __('Displays items on top footer section.', 'medical-circle'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3><div class="line"><span></span></div>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column Two', 'medical-circle'),
        'id' => 'footer-col-two',
        'description' => __('Displays items on top footer section.', 'medical-circle'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3><div class="line"><span></span></div>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column Three', 'medical-circle'),
        'id' => 'footer-col-three',
        'description' => __('Displays items on top footer section.', 'medical-circle'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3><div class="line"><span></span></div>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column Four', 'medical-circle'),
        'id' => 'footer-col-four',
        'description' => __('Displays items on top footer section.', 'medical-circle'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3><div class="line"><span></span></div>',
    ));

    /*Widgets*/
	register_widget( 'Medical_Circle_About' );
	register_widget( 'Medical_Circle_Accordion' );
	register_widget( 'Medical_Circle_Posts_Col' );
	register_widget( 'Medical_Circle_Contact' );
	register_widget( 'Medical_Circle_Department' );
	register_widget( 'Medical_Circle_Gallery' );
	register_widget( 'Medical_Circle_Social' );
	register_widget( 'Medical_Circle_Team' );
	register_widget( 'Medical_Circle_Testimonial' );
}
add_action( 'widgets_init', 'medical_circle_widgets_init' );

/* ajax callback for get_edit_post_link*/
add_action( 'wp_ajax_at_get_edit_post_link', 'medical_circle_get_edit_post_link' );
function medical_circle_get_edit_post_link(){
    if( isset( $_GET['id'] ) ){
	    $id = absint( $_GET['id'] );
	    if( get_edit_post_link( $id ) ){
		    ?>
            <a class="button button-link at-postid alignright" target="_blank" href="<?php echo esc_url( get_edit_post_link( $id ) ); ?>">
			    <?php _e('Full Edit','medical-circle');?>
            </a>
		    <?php
	    }
	    else{
		    echo 0;
	    }
	    exit;
    }
}