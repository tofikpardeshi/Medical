<?php
/**
 * Main include functions ( to support child theme ) that child theme can override file too
 *
 * @since Medical Circle 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('medical_circle_file_directory') ){

    function medical_circle_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

/**
 * Check empty or null
 *
 * @since  Medical Circle 1.0.0
 *
 * @param string $str, string
 * @return boolean
 *
 */
if( !function_exists('medical_circle_is_null_or_empty') ){
    function medical_circle_is_null_or_empty( $str ){
        return ( !isset($str) || trim($str)==='' );
    }
}

/*file for library*/
require medical_circle_file_directory('acmethemes/library/tgm/class-tgm-plugin-activation.php');
/*
* file for customizer theme options
*/
require medical_circle_file_directory('acmethemes/customizer/customizer.php');

/*
* file for additional functions files
*/
require medical_circle_file_directory('acmethemes/functions.php');

require medical_circle_file_directory('acmethemes/functions/sidebar-selection.php');

/*
* files for hooks
*/
require medical_circle_file_directory('acmethemes/hooks/tgm.php');

require medical_circle_file_directory('acmethemes/hooks/front-page.php');

require medical_circle_file_directory('acmethemes/hooks/slider-selection.php');

require medical_circle_file_directory('acmethemes/hooks/feature-columns.php');

require medical_circle_file_directory('acmethemes/hooks/header.php');

require medical_circle_file_directory('acmethemes/hooks/basic-info.php');

require medical_circle_file_directory('acmethemes/hooks/header-helper.php');

require medical_circle_file_directory('acmethemes/hooks/dynamic-css.php');

require medical_circle_file_directory('acmethemes/hooks/footer.php');

require medical_circle_file_directory('acmethemes/hooks/comment-forms.php');

require medical_circle_file_directory('acmethemes/hooks/excerpts.php');

require medical_circle_file_directory('acmethemes/hooks/siteorigin-panels.php');

require medical_circle_file_directory('acmethemes/hooks/acme-demo-setup.php');

/*
* file for sidebar and widgets
*/
require medical_circle_file_directory('acmethemes/sidebar-widget/acme-department.php');

require medical_circle_file_directory('acmethemes/sidebar-widget/acme-contact.php');

require medical_circle_file_directory('acmethemes/sidebar-widget/acme-gallery.php');

require medical_circle_file_directory('acmethemes/sidebar-widget/acme-about.php');

require medical_circle_file_directory('acmethemes/sidebar-widget/acme-accordion.php');

require medical_circle_file_directory('acmethemes/sidebar-widget/acme-col-posts.php');

require medical_circle_file_directory('acmethemes/sidebar-widget/acme-team.php');

require medical_circle_file_directory('acmethemes/sidebar-widget/acme-testimonial.php');

require medical_circle_file_directory('acmethemes/sidebar-widget/acme-social.php');

require medical_circle_file_directory('acmethemes/sidebar-widget/sidebar.php');

/*file for metaboxes*/
require medical_circle_file_directory('acmethemes/metabox/meta-icons.php');

require medical_circle_file_directory('acmethemes/metabox/metabox-defaults.php');

/*
* file for core functions imported from functions.php while downloading Underscores
*/
require medical_circle_file_directory('acmethemes/core.php');
require medical_circle_file_directory('acmethemes/gutenberg/gutenberg-init.php');

/**
 * Theme options page.
 */
if ( is_admin() ) {
    require_once medical_circle_file_directory('acmethemes/at-theme-info/class-at-theme-info.php');
    require_once medical_circle_file_directory('acmethemes/admin-notice/class-admin-notice-handler.php');
}