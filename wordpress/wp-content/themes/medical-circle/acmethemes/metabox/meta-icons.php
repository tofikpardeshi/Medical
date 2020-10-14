<?php
/**
 * Custom Metabox
 * Only added icon not special data
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'medical_circle_meta_add_featured_icon' )):
    function medical_circle_meta_add_featured_icon() {
        add_meta_box(
            'medical_circle_meta_fields', // $id
            __( 'Featured Icon', 'medical-circle' ), // $title
            'medical_circle_meta_featured_icon_callback', // $callback
            'page', // $page
            'side', // $context
            'core'// $priority
        );
    }
endif;
add_action('add_meta_boxes', 'medical_circle_meta_add_featured_icon');

/**
 * Callback function for metabox
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('medical_circle_meta_featured_icon_callback') ) :
    function medical_circle_meta_featured_icon_callback(){
        global $post;
        $medical_circle_featured_icon = get_post_meta( $post->ID, 'medical-circle-featured-icon', true );
        wp_nonce_field( basename( __FILE__ ), 'medical_circle_meta_fields_nonce' );
        ?>
        <div class="at-icons-wrapper">
            <div class="icon-preview">
                <?php if( !empty( $medical_circle_featured_icon ) ) { echo '<i class="fa '. $medical_circle_featured_icon .'"></i>'; } ?>
            </div>
            <div class="icon-toggle">
                <?php echo ( empty( $medical_circle_featured_icon )? __('Add Icon','medical-circle'): __('Edit Icon','medical-circle') ); ?>
                <span class="dashicons dashicons-arrow-down"></span>
            </div>
            <div class="icons-list-wrapper hidden">
                <input class="icon-search widefat" type="text" placeholder="<?php esc_attr_e('Search Icon','medical-circle')?>">
                <?php
                $fa_icon_list_array = medical_circle_icons_array();
                foreach ( $fa_icon_list_array as $single_icon ) {
                    if( $medical_circle_featured_icon == $single_icon ) {
                        echo '<span class="single-icon selected"><i class="fa '. $single_icon .'"></i></span>';
                    } else {
                        echo '<span class="single-icon"><i class="fa '. $single_icon .'"></i></span>';
                    }
                }
                ?>
            </div>
            <input class="widefat at-icon-value" id="medical-circle-featured-icon" type="hidden" name="medical-circle-featured-icon" value="<?php echo esc_attr( $medical_circle_featured_icon ); ?>" placeholder="fa-desktop"/>
        </div>
        <?php
}
endif;

/**
 * Save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('medical_circle_meta_save_featured_icon') ) :
    function medical_circle_meta_save_featured_icon( $post_id ) {
        /*
         * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
         *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
         * */
        if (
            !isset( $_POST[ 'medical_circle_meta_fields_nonce' ] ) ||
            !wp_verify_nonce( $_POST[ 'medical_circle_meta_fields_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
            ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
            ! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
        ){
            return;
        }
        //Execute this saving function
        if(isset($_POST['medical-circle-featured-icon'])){
            $new = sanitize_text_field( $_POST['medical-circle-featured-icon'] );
            update_post_meta( $post_id, 'medical-circle-featured-icon', $new );
        }
    }
endif;
add_action('save_post', 'medical_circle_meta_save_featured_icon');