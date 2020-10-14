<?php
if ( !function_exists('medical_circle_excerpt_more') ) :
	/**
	 * Add ... for more view
	 *
	 * @since Medical Circle 1.0.0
	 *
	 * @param null
	 * @return string
	 *
	 */
    function medical_circle_excerpt_more($more) {
		if( is_admin() ){
			return $more;
		}
        return '&hellip;';
    }
endif;
add_filter('excerpt_more', 'medical_circle_excerpt_more');