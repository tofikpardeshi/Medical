<?php
/**
 * Template part for displaying recent posts from widgets.
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 */
global  $medical_circle_read_more_text;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('init-animate'); ?>>
    <div class="content-wrapper">
        <div class="image-wrap">
	        <?php
	        $no_blog_image ='';
	        if ( has_post_thumbnail() ) {
		        ?>
                <!--post thumbnal options-->
                <div class="post-thumb">
                    <a href="<?php the_permalink(); ?>">
				        <?php the_post_thumbnail( 'large' ); ?>
                    </a>
                </div><!-- .post-thumb-->
		        <?php
	        }
	        else{
		        $no_blog_image = 'no-image';
	        }
	        ?>
            <header class="entry-header <?php echo $no_blog_image; ?>">
                <div class="entry-meta">
                    <a href="<?php the_permalink(); ?>">
                    <span class="day-month">
                        <span class="day">
                            <?php echo esc_html( get_the_date('j') ); ?>
                        </span>
                    </span>
                        <span class="year"><!--editing code? don't be confused it is actually month-->
					        <?php echo esc_html( get_the_date('M') ); ?>
                    </span>
                    </a>
                </div><!-- .entry-meta -->
            </header><!-- .entry-header -->
        </div>
        <div class="entry-content <?php echo $no_blog_image?>">
            <div class="entry-header-title">
                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            </div>
            <?php
            the_excerpt();
            if( !empty( $medical_circle_read_more_text ) ){
                ?>
                <a class="btn btn-primary" href="<?php the_permalink(); ?> ">
                    <?php echo esc_html( $medical_circle_read_more_text ); ?>
                </a>
                <?php
            }
            ?>
        </div><!-- .entry-content -->
    </div>
</article><!-- #post-## -->