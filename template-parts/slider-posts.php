<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package islemag
 */

$colors        = array( 'red', 'orange', 'blue', 'green', 'purple', 'pink', 'light_red' );
$choosed_color = array_rand( $colors, 1 );
?>
<article class="entry entry-overlay entry-block <?php echo apply_filters( 'islemag_slider_posts_colors', $colors[ $choosed_color ] ); ?>">
	<?php islemag_top_slider_posts_trigger(); ?>
	<div class="entry-media">
		<figure>
				<?php
				echo '<a href="' . $slider_post->permalink . '" title="' . $slider_post->title . '">';

				if (!empty($slider_post->thumb_id) && !empty($slider_post->thumb_meta)) {
					if ($slider_post->thumb_meta['width'] / $slider_post->thumb_meta['height'] > 1) {
						$thumb = wp_get_attachment_image_src($slider_post->thumb_id, 'islemag_section4_big_thumbnail');
						$url   = $thumb['0'];
					} else {
						$thumb = wp_get_attachment_image_src( $slider_post->thumb_id, 'islemag_section4_big_thumbnail_no_crop' );
						$url   = $thumb['0'];
					}
					echo '<img class="owl-lazy" data-src="' . esc_url( $url ) . '" />';
				} else {
					echo '<div class="thumbnail-fallback"></div>';
				}
				echo '</a>';
				?>
		</figure>
	</div><!-- End .entry-media -->

	<div class="entry-overlay-meta">
		<?php 
		echo '<h2 class="entry-title"><a href="' . $slider_post->esc_permalink . '" rel="bookmark">' . $slider_post->title . '</a></h2>';
		if ($slider_post->start_date) {
			echo '<span class="entry-overlay-date"><i class="fa fa-calendar"></i>' . $slider_post->start_date . '</span>';
		} else if ($slider_post->author) {
			echo '<a href="' . $slider_post->author_link . '" class="entry-author"><i class="fa fa-user"></i>' . $slider_post->author . '</a>';
		} ?>
	</div><!-- End .entry-overlay-meta -->
	<?php islemag_bottom_slider_posts_trigger(); ?>
</article>
