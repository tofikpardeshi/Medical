<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Medical Circle
 */
$no_blog_image = '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('init-animate'); ?>>
	<div class="content-wrapper">
        <div class="image-wrap">
	        <?php
	        $sidebar_layout = medical_circle_sidebar_selection();
	        if( has_post_thumbnail() ):
		        $thumbnail = 'full';
		        echo '<figure class="post-thumb">';
		        the_post_thumbnail( $thumbnail );
		        echo "</figure>";
	        else:
		        $no_blog_image = 'no-image';
	        endif;
	        ?>
            <header class="entry-header <?php echo $no_blog_image; ?>">
                <div class="entry-meta">
				<span class="day-month">
					<span class="day">
						<?php echo esc_html( get_the_date('j') ); ?>
					</span>
					<span class="month">
						<?php echo esc_html( get_the_date('M') ); ?>
					</span>
				</span>
                    <span class="year">
					<?php echo esc_html( get_the_date('Y') )?>
				</span>

                </div><!-- .entry-meta -->
            </header><!-- .entry-header -->
        </div>
		<div class="entry-content <?php echo $no_blog_image?>">
			<footer class="entry-footer">
				<?php medical_circle_entry_footer(); ?>
			</footer><!-- .entry-footer -->
			<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'medical-circle' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->