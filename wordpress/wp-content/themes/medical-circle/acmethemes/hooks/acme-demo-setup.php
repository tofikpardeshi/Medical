<?php
if( !function_exists( 'medical_circle_demo_nav_data') ){
    function medical_circle_demo_nav_data(){
        $demo_navs = array(
            'top-menu' => 'Top Menu',
            'primary'  => 'Primary Menu',
            'footer-menu'  => 'Footer Menu'
        );
        return $demo_navs;
    }
}
add_filter('acme_demo_setup_nav_data','medical_circle_demo_nav_data');

if( !function_exists( 'medical_circle_demo_wp_options_data') ){
    function medical_circle_demo_wp_options_data(){
        $wp_options = array(
            'blogname'       => 'Medical Circle',
            'site_description'=> 'Multipurpose Medical Theme',
            'page_on_front'  => 'Front Page',
            'page_for_posts' => 'Blog',
        );
        return $wp_options;
    }
}
add_filter('acme_demo_setup_wp_options_data','medical_circle_demo_wp_options_data');