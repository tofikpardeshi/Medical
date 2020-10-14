<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Gutentor_P1_Duplex_Template1' ) ) {

	/**
	 * Gutentor_P1_Duplex_Template1 Class For Gutentor
	 *
	 * @package Gutentor
	 * @since 2.0.0
	 */
	class Gutentor_P1_Duplex_Template1 extends Gutentor_Query_Elements {

		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artefacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @since 2.0.0
		 * @return object
		 */
		public static function get_instance() {

			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new self();
			}

			// Always return the instance
			return $instance;

		}

		/**
		 * Run Block
		 *
		 * @access public
		 * @since 2.0.0
		 * @return void
		 */
		public function run() {
			add_filter( 'gutentor_p6_post_module_template_data', array( $this, 'template_data' ), 999, 3 );
		}

        /**
         * Get Featured Single item data
         *
         * @param {string} $data
         * @param {array}  $post
         * @param {array}  $attributes
         * @return {mix}
         */
        public function p6_template1_featured_woo_single_article( $post, $attributes, $index ) {

            $product = wc_get_product( $post->ID );
            $rating  = $product->get_average_rating();
            $count   = $product->get_rating_count();
            $rating_html  = wc_get_rating_html( $rating, $count );

            $output              = '';
            $query_sorting       = array_key_exists( 'blockFPSortableItems', $attributes ) ? $attributes['blockFPSortableItems'] : false;
            $enable_featured_image  = ( isset( $attributes['pOnFPFImg'] ) ) ? $attributes['pOnFPFImg'] : false;

            $enable_post_format  = ( isset( $attributes['pOnFPPostFormatOpt'] ) ) ? $attributes['pOnFPPostFormatOpt'] : false;
            $post_format_pos     = ( isset( $attributes['pFPPostFormatPos'] ) ) ? $attributes['pFPPostFormatPos'] : false;
            $cat_pos             = ( isset( $attributes['pFPCatPos'] ) ) ? $attributes['pFPCatPos'] : false;
            $enable_featured_cat = ( isset( $attributes['pOnFPFeaturedCat'] ) ) ? $attributes['pOnFPFeaturedCat'] : false;
            $output             .= "<article class='" . apply_filters( 'gutentor_post_module_article_class', gutentor_concat_space( 'gutentor-post', 'gutentor-post-featured','gutentor-post-item-' . $index ), $attributes ) . "'>";
            $output             .= '<div class="gutentor-post-featured-item">';
            if ( $enable_featured_image) {
                $enable_overlayImage = false;
                $overlayImage        = ( isset( $attributes['pFPFImgOColor'] ) ) ? $attributes['pFPFImgOColor'] : false;
                if ( $overlayImage ) {
                    $enable_overlayImage = ( isset( $attributes['pFPFImgOColor']['enable'] ) ) ? $attributes['pFPFImgOColor']['enable'] : false;
                }
                $url     = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , $attributes['pFPFImgSize'] );
                $default_url = WC()->plugin_url() . '/assets/images/placeholder.png';
                $overlay = $enable_overlayImage ? 'gutentor-overlay' : '';
                $output .= '<div class="' . gutentor_concat_space( 'gutentor-post-featured-height','gutentor-bg-image', $overlay ) . '" style="background-image:url(' . esc_url($url[0] ? $url[0] : $default_url) . ')">';
                if ( $enable_post_format && $this->featured_post_format_on_image_condition( $post_format_pos ) ) {
                    $output .= $this->p6_fp_new_badge_product( $post, $product );
                }
                if ( $enable_featured_cat && $this->featured_post_categories_on_image_condition( $cat_pos ) ) {
                    $output .= $this->p6_fp_get_woo_sales_text( $post,$product, $attributes );
                }
                $output .= '<div class="gutentor-post-content">';
                if ( $query_sorting ) :
                    foreach ( $query_sorting as $element ) :
                        if ( ! ( array_key_exists( 'itemValue', $element ) ) ) {
                            return $output;
                        }
                        switch ( $element['itemValue'] ) {
                            case 'title':
                                if ( $cat_pos === 'gutentor-fp-cat-pos-before-title' || $post_format_pos === 'gutentor-fp-pf-pos-before-title' ) {
                                    $output .= '<div class="gutentor-post-title-data-wrap">';
                                    if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-title' ) {

                                        $output .= $this->p6_fp_new_badge_product( $post, $product );

                                    }
                                    if ( $enable_featured_cat && $cat_pos === 'gutentor-fp-cat-pos-before-title' ) {

                                        $output .= $this->p6_fp_get_woo_sales_text( $post,$product, $attributes );

                                    }
                                    $output .= $this->get_featured_post_title( $post, $attributes );
                                    $output .= '</div>';
                                } else {

                                    $output .= $this->get_featured_post_title( $post, $attributes );
                                }
                                break;
                            case 'primary-entry-meta':
                                $output .= $this->get_featured_post_primary_meta( $post, $attributes );
                                break;
                            case 'secondary-entry-meta':
                                $output .= $this->get_featured_post_secondary_meta( $post, $attributes );
                                break;
                            case 'price':
                                if ( isset( $attributes['fpWooOnPrice'] ) && $attributes['fpWooOnPrice'] ) {
                                    if ( $product->get_price_html() ){
                                        $output .= '<div class="gutentor-fp-wc-price">';
                                        $output .= $product->get_price_html();
                                        $output .= '</div>';
                                    }
                                }
                                break;
                            case 'rating':
                                if ( isset( $attributes['fpWooOnRating'] ) && $attributes['fpWooOnRating'] ) {
                                    if($rating_html){
                                        $output .= '<div class="gutentor-fp-wc-rating">';
                                        $output .= $rating_html;
                                        $output .= '</div>';
                                    }
                                }
                                break;
                            case 'description':
                                if ( $cat_pos === 'gutentor-fp-cat-pos-before-ct-box' || $post_format_pos === 'gutentor-fp-pf-pos-before-ct-box' ) {
                                    $output .= '<div class="gutentor-post-desc-data-wrap">';
                                    if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-ct-box' ) {

                                        $output .= $this->p6_fp_new_badge_product( $post, $product );

                                    }
                                    if ( $enable_featured_cat && $cat_pos === 'gutentor-fp-cat-pos-before-ct-box' ) {

                                        $output .= $this->p6_fp_get_woo_sales_text( $post,$product, $attributes );

                                    }
                                    $output .= $this->get_featured_post_description( $post, $attributes );
                                    $output .= '</div>';
                                } else {

                                    $output .= $this->get_featured_post_description( $post, $attributes );
                                }
                                break;
                            case 'button':
                                if ( $cat_pos === 'gutentor-fp-cat-pos-before-button' || $post_format_pos === 'gutentor-fp-pf-pos-before-button' ) {
                                    $output .= '<div class="gutentor-post-desc-data-wrap">';
                                    if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-button' ) {

                                        $output .= $this->p6_fp_new_badge_product( $post, $product );

                                    }
                                    if ( $enable_featured_cat && $cat_pos === 'gutentor-fp-cat-pos-before-button' ) {

                                        $output .= $this->p6_fp_get_woo_sales_text( $post,$product, $attributes );

                                    }
                                    if ( isset( $attributes['pOnFPBtn'] ) && $attributes['pOnFPBtn'] ) {
                                        $output .= '<div class="gutentor-woo-add-to-cart wc-block-grid__product-add-to-cart">';
                                        ob_start();
                                        woocommerce_template_loop_add_to_cart(array('gutentor-attributes' => $attributes));
                                        $output .= ob_get_clean();
                                        $output .= '</div>';
                                    }
                                    $output .= '</div>';
                                } else {
                                    if ( isset( $attributes['pOnFPBtn'] ) && $attributes['pOnFPBtn'] ) {
                                        $output .= '<div class="gutentor-woo-add-to-cart wc-block-grid__product-add-to-cart">';
                                        ob_start();
                                        woocommerce_template_loop_add_to_cart(array('gutentor-attributes' => $attributes));
                                        $output .= ob_get_clean();
                                        $output .= '</div>';
                                    }
                                }
                                break;
                            default:
                                $output .= '';
                                break;
                        }
                    endforeach;
                endif;
                $output .= '</div>';/*.gutentor-post-content*/
                $output .= '</div>';/*.gutentor-bg-image*/
            }
            $output .= '</div>';/*.gutentor-post-featured-item*/
            $output .= '</article>';/*.article*/
            return $output;

        }

		/**
		 * Content On Image Template 1
		 *
		 * @param {string} $data
		 * @param {array}  $post
		 * @param {array}  $attributes
		 * @return {mix}
		 */
		public function template_data( $output, $the_query, $attributes ) {

			$template                = $attributes['p6Temp'] ? $attributes['p6Temp'] : '';
			$post_number                = $attributes['postsToShow'] ? $attributes['postsToShow'] : '';
            $post_type = ( isset( $attributes['pPostType'] ) ) ? $attributes['pPostType'] : 'post';

            if($template != 'gutentor_p6_template1'){
				return $output;
			}
			$index = 0;
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				if ( $index === 0 ) {
					$output .= "<div class='" . apply_filters( 'gutentor_post_module_grid_column_class', 'grid-lg-6 grid-md-6 grid-12', $attributes ) . "'>";
                    if($post_type === 'product'){
                        $output .= $this->p6_template1_featured_woo_single_article( get_post(), $attributes, $index );
                    }
                    else{
                        $output .= $this->p6_featured_single_article( get_post(), $attributes, $index );
                    }
					$output .= '</div>';
				}
				if ( $index === 1 ) {
					$output .= "<div class='" . apply_filters( 'gutentor_post_module_grid_column_class', 'grid-lg-6 grid-md-6 grid-12', $attributes ) . "'>";
				}
				if ( $index > 0 && $index < $post_number ) {
                    if($post_type === 'product'){
                        $output .= $this->p6_woo_single_article( get_post(), $attributes, $index );
                    }
                    else{
                        $output .= $this->p6_single_article( get_post(), $attributes, $index );
                    }

				}
				if ( $index + 1 === $post_number) {
					$output .= '</div>';

				}
				$index++;
			endwhile;
			return $output;
		}
	}
}
Gutentor_P1_Duplex_Template1::get_instance()->run();
