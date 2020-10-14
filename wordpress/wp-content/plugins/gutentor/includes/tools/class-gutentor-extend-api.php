<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Gutentor_Extend_Api' ) ) {
	/**
	 * Gutentor_Woo
	 *
	 * @package Gutentor
	 * @since 2.1.9
	 */
	class Gutentor_Extend_Api {

		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artefacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @since 2.1.9
		 * @return object
		 */
		public static function get_instance() {
			// Store the instance locally to avoid private static replication.
			static $instance = null;

			// Only run these methods if they haven't been ran previously.
			if ( null === $instance ) {
				$instance = new self();
			}

			// Always return the instance.
			return $instance;
		}

		/**
		 * Initialize the class
		 */
		public function run() {
			add_filter( 'gutentor_rest_prepare_data_post', array( $this, 'add_post_comment_data' ), 10, 3 );
			add_filter( 'gutentor_rest_prepare_data_page', array( $this, 'add_post_comment_data' ), 10, 3 );
			add_filter( 'gutentor_rest_prepare_data_product', array( $this, 'add_product_data' ), 10, 3 );
			add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'alter_cart_link' ), 10, 3 );

		}

        /**
         * Add Comment data
         *
         * @static
         * @access public
         * @since 2.1.9
         * @return array
         */
		public function add_post_comment_data( $data, $post, $request ) {

			$comments_count           = wp_count_comments( $post->ID );
			$data['gutentor_comment'] = $comments_count->total_comments;
			return $data;

		}

        /**
         * Add new badge on product
         *
         * @static
         * @access public
         * @since 2.1.9
         * @return string
         */
		public function new_badge_product( $class,$post, $product ) {

			if ( ! $product ) {
				global $product;
			}
			$newness_days = 30;
			$created      = strtotime( $product->get_date_created() );
			if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
				return apply_filters( 'gutentor_woocommerce_new_badge', '<span class="'.$class.'">' . esc_html__( 'New!', 'gutentor' ) . '</span>', $post, $product );

			}
			return '';
		}

        /**
         * Add product data on gutentor rest data
         *
         * @static
         * @access public
         * @since 2.1.9
         * @return array
         */
		public function add_product_data( $data, $post, $request ) {

			$product        = wc_get_product( $post->ID );
			$rating         = $product->get_average_rating();
			$count          = $product->get_rating_count();
			$comments_count = wp_count_comments( $post->ID );
			$author_id      = $post->post_author;
			$product_new_badge = 'gutentor-wc-new';
			$product_fp_new_badge = 'gutentor-pf-wc-new';

			if ( $product->is_on_sale() ) {
				$data['product_sales_text'] = apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'gutentor' ) . '</span>', $post, $product );
			}
			$data['product_regular_price']   = $product->get_regular_price();
			$data['product_sale_price']      = wc_format_sale_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ), wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
			$data['product_price']           = $product->get_price_html();
			$data['product_cart_label']      = $product->add_to_cart_text();
			$data['product_rating_html']     = wc_get_rating_html( $rating, $count );
			$data['product_new_badge']       = $this->new_badge_product($product_new_badge, $post, $product );
            $data['product_fp_new_badge']    = $this->new_badge_product($product_fp_new_badge, $post, $product );
			$data['product_author_name']     = get_the_author_meta( 'display_name', $author_id );
			$data['product_author_url']      = get_the_author_meta( 'user_url', $author_id );
			$data['product_comment']         = $comments_count->total_comments;
			$data['product_placeholder_url'] = WC()->plugin_url() . '/assets/images/placeholder.png';

			return $data;

		}

        /**
         * Modify cart html if gutentor-attributes set
         *
         * @static
         * @access public
         * @since 2.1.9
         * @return string
         */
		public function alter_cart_link( $output, $product, $args ) {
			$attributes = isset( $args['gutentor-attributes'] ) ? $args['gutentor-attributes'] : false;
			if ( ! $attributes ) {
				return $output;
			}
			$icon = '';

			$btnClass          = isset( $attributes['pBtnCName'] ) ? $attributes['pBtnCName'] : '';
			$default_class     = gutentor_concat_space( 'gutentor-button', 'gutentor-post-button', $btnClass );
			$woo_class         = esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' );
			$icon_options      = ( isset( $attributes['pBtnIconOpt'] ) ) ? $attributes['pBtnIconOpt'] : '';
			$icon_post_options = isset( $icon_options['position'] ) ? $icon_options['position'] : '';
			if ( $icon_post_options == 'before' || $icon_post_options == 'after' ) {
				$icon = ( isset( $attributes['pBtnIcon'] ) && $attributes['pBtnIcon']['value'] ) ? '<i class="gutentor-button-icon ' . $attributes['pBtnIcon']['value'] . '" ></i>' : '<i class="gutentor-button-icon fas fa-book" ></i>';
			}
			$output = '<a href="' . esc_url( $product->add_to_cart_url() ) . '" data-quantity="' . esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ) . '" 
			class="' . gutentor_concat_space( $default_class, $woo_class, GutentorButtonOptionsClasses( $icon_options ) ) . '" ' . ( isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '' ) . '>
			' . $icon . '<span>' . esc_html( $product->add_to_cart_text() ) . '</span></a>';
			return $output;

		}
	}
}
Gutentor_Extend_Api::get_instance()->run();
