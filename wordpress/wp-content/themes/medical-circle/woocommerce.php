<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 */
get_header();
global $medical_circle_customizer_all_values;
?>
    <div class="wrapper inner-main-title">
        <div class="container">
            <header class="entry-header init-animate">
                <h1 class="entry-title">
                    <?php _e('Store','medical-circle')?>
                </h1>
                <?php
                if( 1 == $medical_circle_customizer_all_values['medical-circle-show-breadcrumb'] ){
                    medical_circle_breadcrumbs();
                }
                ?>
            </header><!-- .entry-header -->
        </div>
    </div>
    <div id="content" class="site-content container clearfix">
	    <?php
	    $sidebar_layout = medical_circle_sidebar_selection(get_the_ID());
	    if( 'both-sidebar' == $sidebar_layout ) {
		    echo '<div id="primary-wrap" class="clearfix">';
	    }
	    ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main init-animate" role="main">
                <?php if ( have_posts() ) :
                    woocommerce_content();
                endif;
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar( 'left' );
        get_sidebar();
        if( 'both-sidebar' == $sidebar_layout ) {
	        echo '</div>';
        }
        ?>
    </div><!-- #content -->
<?php get_footer();