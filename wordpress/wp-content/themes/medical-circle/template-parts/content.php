<?php
/**
 * Template part for displaying posts and search results.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 */
global $medical_circle_customizer_all_values;
$no_blog_image = '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-wrapper">
        <div class="image-wrap">
            <?php
            if ( $medical_circle_customizer_all_values['medical-circle-blog-archive-layout'] == 'left-image' &&
                has_post_thumbnail() ) {
                $sidebar_layout = medical_circle_sidebar_selection();
                $thumbnail = 'full';
                ?>
                <!--post thumbnal options-->
                <div class="post-thumb">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( $thumbnail ); ?>
                    </a>
                </div><!-- .post-thumb-->
                <?php
            }
            else{
                $no_blog_image = 'no-image';
            }
            ?>
            <?php
            if ( 'post' === get_post_type() ) : ?>
                <header class="entry-header <?php echo $no_blog_image; ?>">
                    <div class="entry-meta">
                        <a href="<?php the_permalink()?>">
                            <span class="day-month">
                            <span class="day">
                                <?php echo esc_html( get_the_date('j') ); ?>
                            </span>
                            <span class="month">
                                <?php echo esc_html( get_the_date('M') ); ?>
                            </span>
                        </span>
                            <span class="year"><?php echo esc_html( get_the_date('Y') )?></span>
                        </a>

                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->
                <?php
            endif; ?>
        </div>
		<div class="entry-content <?php echo $no_blog_image?>">
			<div class="entry-header-title">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</div>
			<footer class="entry-footer">
				<?php medical_circle_entry_footer(); ?>
			</footer><!-- .entry-footer -->
			<?php
			the_excerpt();
			$medical_circle_blog_archive_read_more = medical_circle_blog_archive_more_text();
			if( !empty( $medical_circle_blog_archive_read_more )){
				?>
				<a class="btn btn-primary" href="<?php the_permalink(); ?> ">
					<?php echo $medical_circle_blog_archive_read_more; ?>
				</a>
				<?php
			}
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->