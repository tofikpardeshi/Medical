<?php
/**
 * Medical Circle sidebar layout options
 *
 * @since Medical Circle  1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('medical_circle_sidebar_layout_options') ) :
    function medical_circle_sidebar_layout_options() {
        $medical_circle_sidebar_layout_options = array(
	        'default-sidebar' => array(
		        'value'     => 'default-sidebar',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/default-sidebar.png'
	        ),
	        'left-sidebar' => array(
		        'value'     => 'left-sidebar',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/left-sidebar.png'
	        ),
	        'right-sidebar' => array(
		        'value' => 'right-sidebar',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/right-sidebar.png'
	        ),
	        'both-sidebar' => array(
		        'value'     => 'both-sidebar',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/both-sidebar.png'
	        ),
	        'middle-col' => array(
		        'value'     => 'middle-col',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/middle-col.png'
	        ),
	        'no-sidebar' => array(
		        'value'     => 'no-sidebar',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/no-sidebar.png'
	        )
        );
        return apply_filters( 'medical_circle_sidebar_layout_options', $medical_circle_sidebar_layout_options );
    }
endif;

/**
 * Custom Metabox
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'medical_circle_meta_add_sidebar' )):
    function medical_circle_meta_add_sidebar() {
        add_meta_box(
            'medical_circle_sidebar_layout', // $id
            __( 'Sidebar Layout', 'medical-circle' ), // $title
            'medical_circle_meta_sidebar_layout_callback', // $callback
            'post', // $page
            'normal', // $context
            'high'
        ); // $priority

        add_meta_box(
            'medical_circle_sidebar_layout', // $id
            __( 'Sidebar Layout', 'medical-circle' ), // $title
            'medical_circle_meta_sidebar_layout_callback', // $callback
            'page', // $page
            'normal', // $context
            'high'
        ); // $priority
    }
endif;
add_action('add_meta_boxes', 'medical_circle_meta_add_sidebar');

/**
 * Callback function for metabox
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('medical_circle_meta_sidebar_layout_callback') ) :
    function medical_circle_meta_sidebar_layout_callback(){
        global $post;
        $medical_circle_sidebar_layout_options = medical_circle_sidebar_layout_options();
        $medical_circle_sidebar_layout = 'default-sidebar';
        $medical_circle_sidebar_meta_layout = get_post_meta( $post->ID, 'medical_circle_sidebar_layout', true );
        if( !medical_circle_is_null_or_empty($medical_circle_sidebar_meta_layout) ){
            $medical_circle_sidebar_layout = $medical_circle_sidebar_meta_layout;
        }
        wp_nonce_field( basename( __FILE__ ), 'medical_circle_sidebar_layout_nonce' );
        ?>
        <table class="form-table page-meta-box">
            <tr>
                <td colspan="4"><h4><?php _e( 'Choose Sidebar Template', 'medical-circle' ); ?></h4></td>
            </tr>
            <tr>
                <td>
                    <?php
                    foreach ($medical_circle_sidebar_layout_options as $field) {
                        ?>
                        <div class="hide-radio radio-image-wrapper">
                            <input id="<?php echo $field['value']; ?>" type="radio" name="medical_circle_sidebar_layout" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $medical_circle_sidebar_layout ); ?>/>
                            <label class="description" for="<?php echo $field['value']; ?>">
                                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" />
                            </label>
                        </div>
                    <?php } // end foreach
                    ?>
                    <div class="clear"></div>
                </td>
            </tr>
            <tr>
                <td><em class="f13"><?php _e( 'You can set up the sidebar content', 'medical-circle' ); ?> <a href="<?php echo esc_url( admin_url('/widgets.php') ); ?>"><?php _e( 'here', 'medical-circle' ); ?></a></em></td>
            </tr>
        </table>
    <?php
}
endif;

/**
 * save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('medical_circle_save_sidebar_layout') ) :
    function medical_circle_save_sidebar_layout( $post_id ) {

        /*
          * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
          *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
          * */
        if (
            !isset( $_POST[ 'medical_circle_sidebar_layout_nonce' ] ) ||
            !wp_verify_nonce( $_POST[ 'medical_circle_sidebar_layout_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
            ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
            ! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
        ){
            return;
        }

        //Execute this saving function
        if(isset($_POST['medical_circle_sidebar_layout'])){
            $old = get_post_meta( $post_id, 'medical_circle_sidebar_layout', true);
            $new = sanitize_text_field($_POST['medical_circle_sidebar_layout']);
            if ($new && $new != $old) {
                update_post_meta($post_id, 'medical_circle_sidebar_layout', $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id,'medical_circle_sidebar_layout', $old);
            }
        }
    }
endif;
add_action('save_post', 'medical_circle_save_sidebar_layout');