<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Gutentor_Post_Carousel_Hooks' ) ) {

	/**
	 * Block Specific Hooks Class For Gutentor
	 *
	 * @package Gutentor
	 * @since 2.0.0
	 */
	class Gutentor_Post_Carousel_Hooks {

		/**
		 * Prevent some functions to called many times
		 *
		 * @access private
		 * @since 2.0.0
		 * @var integer
		 */
		private static $counter = 0;

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
		 * Add Filter
		 *
		 * @access public
		 * @since 2.0.0
		 * @return void
		 */
		public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
			add_filter( $hook, array( $component, $callback ), $priority, $accepted_args );
		}

		/**
		 * Add Action
		 *
		 * @access public
		 * @since 2.0.0
		 * @return void
		 */
		public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
			add_action( $hook, array( $component, $callback ), $priority, $accepted_args );
		}

		/**
		 * Add Shape Array
		 *
		 * @access public
		 * @since 2.0.0
		 * @return array
		 */



		/**
		 * Run Block
		 *
		 * @access public
		 * @since 2.0.0
		 * @return void
		 */
		public function run() {
			/*Block Specific PHP hooks*/
			$this->add_filter( 'gutentor_post_module_main_wrap_class', $this, 'add_carousel_arrow_class', 15, 2 );
			$this->add_filter( 'gutentor_post_module_grid_row_class', $this, 'add_carousel_row', 15, 2 );
			$this->add_filter( 'gutentor_post_module_attr', $this, 'add_carousel_data', 15, 2 );
			$this->add_filter( 'gutentor_post_module_grid_column_class', $this, 'add_carousel_class', 15, 2 );
			$this->add_filter( 'gutentor_post_module_before_block_items', $this, 'add_carousel_arrow', 15, 2 );
		}

		/**
		 * Adding Carousel Class
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return {array}
		 */
		public function add_carousel_arrow_class( $output, $attributes ) {

			$gutentorBlockName = ( isset( $attributes['gName'] ) ) ? $attributes['gName'] : '';
			$block_list        = array( 'gutentor/p1' );
			if ( ! in_array( $gutentorBlockName, $block_list ) ) {
				return $output;
			}
			if ( ! isset( $attributes['p1CarouselOpt'] ) || ! $attributes['p1CarouselOpt']['enable'] ) {
				return $output;
			}
			if ( ! isset( $attributes['p1CarouselOpt']['arrowsPosition'] ) ) {
				return $output;
			}

			$arrow_postition       = $attributes['p1CarouselOpt']['arrowsPosition'];
			$enable_desktop_arrow  = (isset( $attributes['p1CarouselOpt']['arrows'] )) ? $attributes['p1CarouselOpt']['arrows']  : false;
			$enable_tablet_arrow  = (isset( $attributes['p1CarouselOpt']['arrowsT'] )) ? $attributes['p1CarouselOpt']['arrowsT']  : false;
			$enable_mobile_arrow  = (isset( $attributes['p1CarouselOpt']['arrowsM'] )) ? $attributes['p1CarouselOpt']['arrowsM']  : false;
			$arrow_desktop_desktop = array_key_exists( 'desktop', $arrow_postition ) ? $arrow_postition['desktop'] : false;
			if ( $enable_desktop_arrow && $arrow_desktop_desktop ) {
				$output = gutentor_concat_space( $output, $arrow_desktop_desktop . '-desktop' );

			}
			$arrow_tablet_tablet = array_key_exists( 'tablet', $arrow_postition ) ? $arrow_postition['tablet'] : false;
			if ( $enable_tablet_arrow && $arrow_tablet_tablet ) {
				$output = gutentor_concat_space( $output, $arrow_tablet_tablet . '-tablet' );

			}
			$arrow_tablet_mobile = array_key_exists( 'mobile', $arrow_postition ) ? $arrow_postition['mobile'] : false;
			if ( $enable_mobile_arrow && $arrow_tablet_mobile ) {
				$output = gutentor_concat_space( $output, $arrow_tablet_mobile . '-mobile' );

			}
			return $output;

		}

		/**
		 * Adding Container Remove Classes
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return string
		 */
		public function add_carousel_row( $output, $attributes ) {
			if ( ! isset( $attributes['p1CarouselOpt'] ) || ! $attributes['p1CarouselOpt']['enable'] ) {
				return $output;
			}

			$local_data = str_replace( 'grid-row', '', $output );
			if ( isset( $attributes['p1CarouselOpt']['carouselID'] ) ) {
				$local_data = gutentor_concat_space( $local_data, $attributes['p1CarouselOpt']['carouselID'] );
			}
			$local_data = gutentor_concat_space( $local_data, 'gutentor-module-carousel-row' );
			return $local_data;

		}

		/**
		 * Adding Carousel Data
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return {array}
		 */
		public function add_carousel_data( $output, $attributes ) {
			if ( ! isset( $attributes['p1CarouselOpt'] ) || ! $attributes['p1CarouselOpt']['enable'] ) {
				return $output;
			}
			$p1CarouselOpt = $attributes['p1CarouselOpt'];
			$local_data    = array();
			if ( isset( $p1CarouselOpt['dots'] ) ) {
				$local_data['data-dots'] = ( $p1CarouselOpt['dots'] ) ? 'true' : 'false';
			}
			if ( isset( $p1CarouselOpt['dotsT'] ) ) {
				$local_data['data-dotstablet'] = ( $p1CarouselOpt['dotsT'] ) ? 'true' : 'false';
			}
			if ( isset( $p1CarouselOpt['dotsM'] ) ) {
				$local_data['data-dotsmobile'] = ( $p1CarouselOpt['dotsM'] ) ? 'true' : 'false';
			}
			if ( isset( $p1CarouselOpt['arrows'] ) ) {
				$local_data['data-arrows'] = ( $p1CarouselOpt['arrows'] ) ? 'true' : 'false';
			}
			if ( isset( $p1CarouselOpt['arrowsT'] ) ) {
				$local_data['data-arrowstablet'] = ( $p1CarouselOpt['arrowsT'] ) ? 'true' : 'false';
			}
			if ( isset( $p1CarouselOpt['arrowsM'] ) ) {
				$local_data['data-arrowsmobile'] = ( $p1CarouselOpt['arrowsM'] ) ? 'true' : 'false';
			}
			if ( isset( $p1CarouselOpt['arrowsPosition']['desktop'] ) ) {
				$local_data['data-arrowsPositionDesktop'] = ( $p1CarouselOpt['arrowsPosition']['desktop'] . '-desktop' );
			}
			if ( isset( $p1CarouselOpt['arrowsPosition']['tablet'] ) ) {
				$local_data['data-arrowsPositionTablet'] = ( $p1CarouselOpt['arrowsPosition']['tablet'] . '-tablet' );
			}
			if ( isset( $p1CarouselOpt['arrowsPosition']['mobile'] ) ) {
				$local_data['data-arrowsPositionMobile'] = ( $p1CarouselOpt['arrowsPosition']['mobile'] . '-mobile' );
			}
			if ( isset( $p1CarouselOpt['infinite'] ) ) {
				$local_data['data-infinite'] = ( $p1CarouselOpt['infinite'] );
			}
            if ( isset( $p1CarouselOpt['speed'] ) ) {
                $local_data['data-speed'] = $p1CarouselOpt['speed'];
            }
			if ( isset( $p1CarouselOpt['autoplay'] ) ) {
				$local_data['data-autoplay'] = ( $p1CarouselOpt['autoplay'] );
                if ( isset( $p1CarouselOpt['autoplaySpeed'] ) ) {
                    $local_data['data-autoplayspeed'] = $p1CarouselOpt['autoplaySpeed'];
                }
			}
			if ( isset( $p1CarouselOpt['slideitem']['desktop'] ) ) {
				$local_data['data-slideitemdesktop'] = $p1CarouselOpt['slideitem']['desktop'];
			}
			if ( isset( $p1CarouselOpt['slideitem']['tablet'] ) ) {
				$local_data['data-slideitemtablet'] = $p1CarouselOpt['slideitem']['tablet'];
			}
			if ( isset( $p1CarouselOpt['slideitem']['mobile'] ) ) {
				$local_data['data-slideitemmobile'] = $p1CarouselOpt['slideitem']['mobile'];
			}
			if ( isset( $p1CarouselOpt['slidescroll']['desktop'] ) ) {
				$local_data['data-slidescroll-desktop'] = $p1CarouselOpt['slidescroll']['desktop'];
			}
			if ( isset( $p1CarouselOpt['slidescroll']['tablet'] ) ) {
				$local_data['data-slidescroll-tablet'] = $p1CarouselOpt['slidescroll']['tablet'];
			}
			if ( isset( $p1CarouselOpt['slidescroll']['mobile'] ) ) {
				$local_data['data-slidescroll-mobile'] = $p1CarouselOpt['slidescroll']['mobile'];
			}
            return $local_data;

		}

		/**
		 * Adding carousel class
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return {array}
		 */
		public function add_carousel_class( $output, $attributes ) {

			if ( ! isset( $attributes['p1CarouselOpt'] ) || ! $attributes['p1CarouselOpt']['enable'] ) {
				return $output;
			}
			return gutentor_concat_space( $output, 'gutentor-carousel-item' );
		}

		/**
		 * Adding carousel class
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return {array}
		 */
		public function add_carousel_arrow( $output, $attributes ) {

			$gutentorBlockName = ( isset( $attributes['gName'] ) ) ? $attributes['gName'] : '';
			$block_list        = array( 'gutentor/p1' );
			if ( ! in_array( $gutentorBlockName, $block_list ) ) {
				return $output;
			}
			if ( ! isset( $attributes['p1CarouselOpt'] ) || ! $attributes['p1CarouselOpt']['enable'] ) {
				return $output;
			}
			$p1CarouselOpt        = ( isset( $attributes['p1CarouselOpt'] ) && $attributes['p1CarouselOpt']['enable'] ) ? $attributes['p1CarouselOpt'] : false;
			$desktop_row_position = ( $p1CarouselOpt && $p1CarouselOpt['arrowsPosition']['desktop'] ) ? $p1CarouselOpt['arrowsPosition']['desktop'] . '-desktop' : false;
			if ( $desktop_row_position != 'gutentor-slick-a-default-desktop' ) {
				$output .= '<div class="gutentor-slick-arrows"></div>';
			}
			return $output;
		}
	}
}

/**
 * Return instance of  Gutentor_Post_Carousel_Hooks class
 *
 * @since    1.0.0
 */
if ( ! function_exists( 'gutentor_post_carousel_hooks' ) ) {

	function gutentor_post_carousel_hooks() {

		// return Gutentor_Post_Carousel_Hooks::get_instance();
		return Gutentor_Post_Carousel_Hooks::get_instance();
	}
}
gutentor_post_carousel_hooks()->run();
