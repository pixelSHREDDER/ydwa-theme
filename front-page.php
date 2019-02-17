<?php
/**
 * Frontpage
 *
 * @package WordPress
 * @subpackage Islemag.
 */

get_header();

$islemag_header_slider_category  = esc_attr( get_theme_mod( 'islemag_header_slider_category', 'all' ) );
$islemag_header_slider_max_posts = esc_attr( get_theme_mod( 'islemag_header_slider_max_posts', '6' ) );
$islemag_section1_fullwidth      = get_theme_mod( 'islemag_section1_fullwidth', false );
$islemag_section2_fullwidth      = get_theme_mod( 'islemag_section2_fullwidth', false );
$islemag_section3_fullwidth      = get_theme_mod( 'islemag_section3_fullwidth', false );
$islemag_section4_fullwidth      = get_theme_mod( 'islemag_section4_fullwidth', false );
$islemag_section5_fullwidth      = get_theme_mod( 'islemag_section5_fullwidth', false );
$islemag_header_slider_disable   = (bool) get_theme_mod( 'islemag_header_slider_disable', false );
$islemag_header_slider_random    = (bool) get_theme_mod( 'islemag_header_slider_random', false );
$islemag_section1_disable        = (bool) get_theme_mod( 'islemag_section1_disable', false );
$islemag_section2_disable        = (bool) get_theme_mod( 'islemag_section2_disable', false );
$islemag_section3_disable        = (bool) get_theme_mod( 'islemag_section3_disable', false );
$islemag_section4_disable        = (bool) get_theme_mod( 'islemag_section4_disable', false );
$islemag_section5_disable        = (bool) get_theme_mod( 'islemag_section5_disable', false );
$slider_posts = array();
$now = strtotime(date('c', time()));

$events_table = $wpdb->prefix . 'eme_events';

foreach($wpdb->get_results("SELECT event_id, event_name, event_image_id, event_image_url, event_start_date, event_slug FROM " . $events_table . " WHERE event_start_date >= CURRENT_DATE() ORDER BY event_start_date ASC LIMIT " . $islemag_header_slider_max_posts * 2) as $key => $wpdbq) {
	$permalink = get_site_url() . '/events/' . $wpdbq->event_id . '/' . $wpdbq->event_slug;
	$array = array(
		'permalink' => $permalink,
		'esc_permalink' => esc_url($permalink),
		'title' => $wpdbq->event_name,
		'start_date' => date('l, M jS', strtotime($wpdbq->event_start_date)),
		'fulldate' => date('c', strtotime($wpdbq->event_start_date))
	);
	if ($wpdbq->event_image_url) {
		list($width, $height, $type, $attr) = @getimagesize($wpdbq->event_image_url);
		$array['thumb_id'] = $wpdbq->event_image_id;
		$array['thumb_meta'] = array(
			'width' => $width,
			'height' => $height
		);
	}
	$wpdb_slider_post = (object) $array;
	array_push($slider_posts, $wpdb_slider_post);
}

$wp_query = new WP_Query(
	array(
		'posts_per_page' => $islemag_header_slider_max_posts * 2,
		'orderby'        => ( (bool) $islemag_header_slider_random == false ? 'date' : 'rand' ),
		'order'          => 'DESC',
		'post_status'    => 'publish',
		'category_name'  => ( ! empty( $islemag_header_slider_category ) && $islemag_header_slider_category != 'all' ? $islemag_header_slider_category : '' ),
	)
);

while ($wp_query->have_posts()) :
	$wp_query->the_post();
	$full_date = get_the_date('c');
	if ((strtotime($full_date) > strtotime('2 months ago')) || (sizeof($slider_posts) < 3)) {
		$thumb_id = get_post_thumbnail_id($wp_query->ID);
		$array = array(
			'permalink' => get_permalink(),
			'esc_permalink' => esc_url(get_permalink()),
			'title' => get_the_title(),
			'thumb_id' => $thumb_id,
			'thumb_meta' => wp_get_attachment_metadata($thumb_id),
			'full_date' => $full_date,
			'author' => get_the_author(),
			'author_link' => esc_url(get_author_posts_url(get_the_author_meta('ID')))
		);
		$wp_query_slider_post = (object) $array;
		array_push($slider_posts, $wp_query_slider_post);
	}
endwhile;

usort($slider_posts, function($a, $b) {
    return ($now - strtotime($b->fulldate)) - ($now - strtotime($a->fulldate));
});
array_slice($slider_posts, 0, $islemag_header_slider_max_posts);

if ( (bool) $islemag_header_slider_disable !== true ) {
	if ($slider_posts.length) { ?>

		<div class="islemag-top-container">
			<div class="owl-carousel islemag-top-carousel rect-dots">
				<?php
				foreach($slider_posts as $slider_post) {
					include(locate_template('template-parts/slider-posts.php'));
				}
				?>
			</div><!-- End .islemag-top-carousel -->
		</div><!-- End .islemag-top-container -->

		<?php
	} else {
		get_template_part( 'template-parts/content', 'none' );
	}
	wp_reset_postdata();
}
?>

	<div class="container">
		<div class="row">

			<?php
			$archive_content_classes = apply_filters( 'islemag_archive_content_classes', array( 'islemag-content-left', 'col-md-9' ) );
			?>
			<div 
			<?php
			if ( ! empty( $archive_content_classes ) ) {
				echo 'class="' . implode( ' ', $archive_content_classes ) . '"'; }
?>
>
				<?php

				/* ---------Section 1--------- */
				if ( ! $islemag_section1_fullwidth && ! $islemag_section1_disable ) {
					islemag_display_section( 1 );
				}

				/* ---------Section 2--------- */
				if ( ! $islemag_section2_fullwidth && ! $islemag_section2_disable ) {
					islemag_display_section( 2 );
				}

				/* ---------Section 3--------- */
				if ( ! $islemag_section3_fullwidth && ! $islemag_section3_disable ) {
					islemag_display_section( 3 );
				}

				/* ---------Section 4--------- */
				if ( ! $islemag_section4_fullwidth && ! $islemag_section4_disable ) {
					islemag_display_section( 4 );
				}

				/* ---------Section 5--------- */
				if ( ! $islemag_section5_fullwidth && ! $islemag_section5_disable ) {
					islemag_display_section( 5 );
				}
				?>

			</div><!-- End .islemag-content-left -->

			<?php
			get_sidebar();
			?>


			<?php
			if ( $islemag_section1_fullwidth == true ||
				$islemag_section2_fullwidth == true ||
				$islemag_section3_fullwidth == true ||
				$islemag_section4_fullwidth == true ||
				$islemag_section5_fullwidth == true ) {
				?>


				<div class="col-md-12 islemag-fullwidth">
					<?php
					/* ---------Section 1--------- */
					if ( $islemag_section1_fullwidth && ! $islemag_section1_disable ) {
						islemag_display_section( 1 );
					}

					/* ---------Section 2--------- */
					if ( $islemag_section2_fullwidth && ! $islemag_section2_disable ) {
						islemag_display_section( 2 );
					}

					/* ---------Section 3--------- */
					if ( $islemag_section3_fullwidth && ! $islemag_section3_disable ) {
						islemag_display_section( 3 );
					}

					/* ---------Section 4--------- */
					if ( $islemag_section4_fullwidth && ! $islemag_section4_disable ) {
						islemag_display_section( 4 );
					}

					/* ---------Section 5--------- */
					if ( $islemag_section5_fullwidth && ! $islemag_section5_disable ) {
						islemag_display_section( 5 );
					}
					?>
				</div>
				<?php
			} else {
				if ( is_customize_preview() ) {
					echo '<div class="col-md-12 islemag-fullwidth"></div>';
				}
			}// End if().
	?>
		</div><!-- End .row -->
	</div><!-- End .container -->
<?php
get_footer();
