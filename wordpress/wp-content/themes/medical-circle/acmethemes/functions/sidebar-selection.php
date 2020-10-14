<?php
/**
 * Select sidebar according to the options saved
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('medical_circle_sidebar_selection') ) :
	function medical_circle_sidebar_selection( ) {
		wp_reset_postdata();
		$medical_circle_customizer_all_values = medical_circle_get_theme_options();
		global $post;
		if(
			isset( $medical_circle_customizer_all_values['medical-circle-single-sidebar-layout'] ) &&
			(
				'left-sidebar' == $medical_circle_customizer_all_values['medical-circle-single-sidebar-layout'] ||
				'both-sidebar' == $medical_circle_customizer_all_values['medical-circle-single-sidebar-layout'] ||
				'middle-col' == $medical_circle_customizer_all_values['medical-circle-single-sidebar-layout'] ||
				'no-sidebar' == $medical_circle_customizer_all_values['medical-circle-single-sidebar-layout']
			)
		){
			$medical_circle_body_global_class = $medical_circle_customizer_all_values['medical-circle-single-sidebar-layout'];
		}
		else{
			$medical_circle_body_global_class= 'right-sidebar';
		}

		if ( medical_circle_is_woocommerce_active() && ( is_product() || is_shop() || is_product_taxonomy() )) {
			if( is_product() ){
				$post_class = get_post_meta( $post->ID, 'medical_circle_sidebar_layout', true );
				$medical_circle_wc_single_product_sidebar_layout = $medical_circle_customizer_all_values['medical-circle-wc-single-product-sidebar-layout'];

				if ( 'default-sidebar' != $post_class ){
					if ( $post_class ) {
						$medical_circle_body_classes = $post_class;
					} else {
						$medical_circle_body_classes = $medical_circle_wc_single_product_sidebar_layout;
					}
				}
				else{
					$medical_circle_body_classes = $medical_circle_wc_single_product_sidebar_layout;

				}
			}
			else{
				if( isset( $medical_circle_customizer_all_values['medical-circle-wc-shop-archive-sidebar-layout'] ) ){
					$medical_circle_archive_sidebar_layout = $medical_circle_customizer_all_values['medical-circle-wc-shop-archive-sidebar-layout'];
					if(
						'right-sidebar' == $medical_circle_archive_sidebar_layout ||
						'left-sidebar' == $medical_circle_archive_sidebar_layout ||
						'both-sidebar' == $medical_circle_archive_sidebar_layout ||
						'middle-col' == $medical_circle_archive_sidebar_layout ||
						'no-sidebar' == $medical_circle_archive_sidebar_layout
					){
						$medical_circle_body_classes = $medical_circle_archive_sidebar_layout;
					}
					else{
						$medical_circle_body_classes = $medical_circle_body_global_class;
					}
				}
				else{
					$medical_circle_body_classes= $medical_circle_body_global_class;
				}
			}
		}
		elseif( is_front_page() ){
			if( isset( $medical_circle_customizer_all_values['medical-circle-front-page-sidebar-layout'] ) ){
				if(
					'right-sidebar' == $medical_circle_customizer_all_values['medical-circle-front-page-sidebar-layout'] ||
					'left-sidebar' == $medical_circle_customizer_all_values['medical-circle-front-page-sidebar-layout'] ||
					'both-sidebar' == $medical_circle_customizer_all_values['medical-circle-front-page-sidebar-layout'] ||
					'middle-col' == $medical_circle_customizer_all_values['medical-circle-front-page-sidebar-layout'] ||
					'no-sidebar' == $medical_circle_customizer_all_values['medical-circle-front-page-sidebar-layout']
				){
					$medical_circle_body_classes = $medical_circle_customizer_all_values['medical-circle-front-page-sidebar-layout'];
				}
				else{
					$medical_circle_body_classes = $medical_circle_body_global_class;
				}
			}
			else{
				$medical_circle_body_classes= $medical_circle_body_global_class;
			}
		}

		elseif ( is_singular() && isset( $post->ID ) ) {
			$post_class = get_post_meta( $post->ID, 'medical_circle_sidebar_layout', true );
			if ( 'default-sidebar' != $post_class ){
				if ( $post_class ) {
					$medical_circle_body_classes = $post_class;
				} else {
					$medical_circle_body_classes = $medical_circle_body_global_class;
				}
			}
			else{
				$medical_circle_body_classes = $medical_circle_body_global_class;
			}

		}
		elseif ( is_archive() ) {
			if( isset( $medical_circle_customizer_all_values['medical-circle-archive-sidebar-layout'] ) ){
				$medical_circle_archive_sidebar_layout = $medical_circle_customizer_all_values['medical-circle-archive-sidebar-layout'];
				if(
					'right-sidebar' == $medical_circle_archive_sidebar_layout ||
					'left-sidebar' == $medical_circle_archive_sidebar_layout ||
					'both-sidebar' == $medical_circle_archive_sidebar_layout ||
					'middle-col' == $medical_circle_archive_sidebar_layout ||
					'no-sidebar' == $medical_circle_archive_sidebar_layout
				){
					$medical_circle_body_classes = $medical_circle_archive_sidebar_layout;
				}
				else{
					$medical_circle_body_classes = $medical_circle_body_global_class;
				}
			}
			else{
				$medical_circle_body_classes= $medical_circle_body_global_class;
			}
		}
		else {
			$medical_circle_body_classes = $medical_circle_body_global_class;
		}
		return $medical_circle_body_classes;
	}
endif;