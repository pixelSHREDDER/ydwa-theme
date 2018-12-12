<?php
/**
 * Main functions file
 *
 * @package reviewzine
 */

/**
 * Enqueue fonts
 */
function reviewzine_fonts_url() {
	$fonts_url = '';

	/*
     Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
	$lato = _x( 'on', 'Lato font: on or off', 'reviewzine' );
	$hind = _x( 'on', 'Hind font: on or off', 'reviewzine' );

	if ( 'off' !== $lato || 'off' !== $hind ) {
		$font_families = array();
		if ( 'off' !== $lato ) {
			$font_families[] = 'Lato:400,500,600,700';
		}
		if ( 'off' !== $hind ) {
			$font_families[] = 'Hind:400,600,700';
		}
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue admin style
 */
function reviewzine_admin_add_editor_styles() {
	add_editor_style( 'css/editor_style.css' );
}
add_action( 'admin_init', 'reviewzine_admin_add_editor_styles' );

/**
 * Enqueue the fonts from the child theme
 */
function reviewzine_scripts_styles() {
	wp_dequeue_style( 'islemag-fonts' );
	wp_enqueue_style( 'reviewzine-fonts', reviewzine_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'reviewzine_scripts_styles', 12 );

/**
 * Enqueue the scripts and styles
 */
function reviewzine_scripts() {
	wp_enqueue_style( 'reviewzine-islemag-style', get_template_directory_uri() . '/style.css' );

	wp_enqueue_style( 'reviewzine-style', get_stylesheet_uri() );

	if ( 'page' == get_option( 'show_on_front' ) && is_front_page() ) {
		wp_enqueue_script( 'reviewzine-script-index', get_stylesheet_directory_uri() . '/js/functions.js', array( 'jquery', 'islemag-script-index' ), '1.0.0', true );
	}
}

add_action( 'wp_enqueue_scripts', 'reviewzine_scripts', 20 );

remove_action( 'wp_head', 'islemag_style', 100 );
add_action( 'wp_head', 'ydwa_style', 100 );

/**
 * Custom colors and styles function.
 */
function ydwa_style() {

	echo '<style type="text/css">';

	$ydwa_primary_color = esc_attr( get_theme_mod( 'ydwa_primary_color', apply_filters( 'ydwa_primary_color_default_filter', '#1982d1' ) ) );
	if ( ! empty( $ydwa_primary_color ) ) {
		echo 'h3.title-border span, .post .entry-title, .post h1, .post h2, .post h3, .post h4, .post h5, .post h6, .post h1 a, .post h2 a, .post h3 a,
		 .post h4 a, .post h5 a, .post h6 a, header.page-header h1, h3.blog-related-carousel-title, h3#reply-title, #comments .comments-title .post .entry-content,
		 .home.blog .islemag-content-left .entry-title a, .islemag-top-container .entry-block .entry-overlay-meta .entry-title a, 
		 .islemag-top-container .entry-overlay-meta .entry-overlay-date, 
		 .islemag-top-container .entry-overlay-meta .entry-separator, 
		 .islemag-top-container .entry-overlay-meta > a, 
		 .um-profile.um .um-profile-headericon > a { color: ' . $ydwa_primary_color . ' !important; }';
		echo 'hr { border-top-color: ' . $ydwa_primary_color . ' !important; }';
		echo '.widget_search button, table.eme-calendar-table { border-color: ' . $ydwa_primary_color . ' !important; }';
		echo 'button, input[type=button], input[type=submit], .comment-form input[type=submit].btn, table.eme-calendar-table .month_name,
		 table.eme-calendar-table .days-names > td, .um input[type=submit].um-button, .um input[type=submit].um-button:focus, .um a.um-button,
		 .um a.um-button.um-disabled:hover, .um a.um-button.um-disabled:focus, .um a.um-button.um-disabled:active, .pmpro_btn, .pmpro_btn:link, .pmpro_content_message a,
		 .pmpro_content_message a:link { background-color: ' . $ydwa_primary_color . ' !important; border-color: ' . $ydwa_primary_color . ' !important; }';
		echo '.navbar-top, .widget_search button, div#footer-inner { background-color: ' . $ydwa_primary_color . ' !important; }';
		echo '.um .um-field-group-head:hover, .picker__footer, .picker__header, .picker__day--infocus:hover, .picker__day--outfocus:hover, .picker__day--highlighted:hover,
		 .picker--focused .picker__day--highlighted, .picker__list-item:hover, .picker__list-item--highlighted:hover, .picker--focused .picker__list-item--highlighted,
		 .picker__list-item--selected, .picker__list-item--selected:hover, .picker--focused .picker__list-item--selected, .um .um-field-group-head, .um-modal-header,
		 .um-modal-btn, .um-modal-btn.disabled, .um-modal-btn.disabled:hover { background: ' . $ydwa_primary_color . ' !important; }';
	}

	$ydwa_secondary_color = esc_attr( get_theme_mod( 'ydwa_secondary_color', apply_filters( 'ydwa_secondary_color_default_filter', '#78c434' ) ) );
	if ( ! empty( $ydwa_secondary_color ) ) {
	    echo 'a, a:hover, ul > li:hover > a { color: ' . $ydwa_secondary_color . '; }';
		echo '.about-author .title-underblock a, .post .entry-title a, .post h1 a, .post h2 a, .post h3 a, .post h4 a, .post h5 a, .post h6 a, .blog-related-carousel .entry-title a,
	     table.eme-calendar-table td.eventful a, table.eme-calendar-table td.eventful-today a, div.eventful-today a, div.eventful a,
		 .um .um-field-date .picker__button--today:hover, .um .um-field-date .picker__button--today:focus, .um .um-field-date .picker__button--clear:hover,
	     .um .um-field-date .picker__button--clear:focus { color: ' . $ydwa_secondary_color . ' !important; }';
	    echo '.um .um-field-date .picker__nav--prev:hover::before { border-right-color: ' . $ydwa_secondary_color . ' !important; }';
	    echo '.um .um-field-date .picker__nav--next:hover::before { border-left-color: ' . $ydwa_secondary_color . ' !important; }';
	    echo '.um input[type=submit].um-button.um-alt, .um input[type=submit].um-button.um-alt:focus, .um a.um-button.um-alt, .um a.um-button.um-alt.um-disabled:hover,
	     .um a.um-button.um-alt.um-disabled:focus, .um a.um-button.um-alt.um-disabled:active { background-color: ' . $ydwa_secondary_color . ' !important; border-color: ' . $ydwa_secondary_color . ' !important; }';
	    echo '.entry-date > div, .footer-inverse #footer-bottom.no-bg { background-color: ' . $ydwa_secondary_color . ' !important; }';
	    echo '.owl-nav .owl-prev, .owl-nav .owl-next, .picker__box, .picker__nav--prev:hover, .picker__nav--next:hover, .um .um-members-pagi span.current,
	     .um .um-members-pagi span.current:hover, .upload { background: ' . $ydwa_secondary_color . ' !important; }';
	}

	$ydwa_tertiary_color = esc_attr( get_theme_mod( 'ydwa_tertiary_color', apply_filters( 'ydwa_tertiary_color_default_filter', '#ffa71c' ) ) );
	if ( ! empty( $ydwa_tertiary_color ) ) {
	    echo '.main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a,
	     .sidebar .widget li:hover > ul > li:hover a, #footer.footer-inverse a:hover, #footer.footer-inverse .widget .tweet_time a:hover,
	     .main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a,
	     .social-icons a:hover > i, .top-navigation ul > li:hover > a, .main-navigation ul > li:hover > a, .sidebar .widget li:hover > a,
	     #wp-calendar tbody td a, .entry-content ul > li:before, #review-statistics .review-wrap-up .cwpr-review-top .cwp-item-price,
	      .reply-link a, #footer-inner p, .um-profile.um .um-profile-headericon > a:hover, .um-profile.um .um-profile-headericon > a.active,
	     .um-dropdown .um-dropdown-b li a.real_url, .um-dropdown .um-dropdown-b li a.um-dropdown-hide { color: ' . $ydwa_tertiary_color . ' !important; }';
	    echo '.um-form div.um-account-side ul li a.current, .um-form div.um-account-side ul li a:hover, .um-form div.um-account-side ul li a.current:hover { color: ' . $ydwa_tertiary_color . ' !important; }';
	    echo '.category .page-header h1 span.category-name { color: ' . $ydwa_tertiary_color . ' !important; border-left-color: ' . $ydwa_tertiary_color . ' !important; }';
	    echo '.comment .children, blockquote { border-left-color: ' . $ydwa_tertiary_color . ' !important; }';
	    echo '.entry-date { border-bottom-color: ' . $ydwa_tertiary_color . ' !important; }';
	    echo 'button, input[type=button], input[type=reset] { border-color: ' . $ydwa_tertiary_color . ' !important; }';
	    echo '.widget_search button:hover, .comment-form input[type=submit].btn, .um .um-button.um-alt:hover, .um a.um-button.um-alt:hover { background-color: ' . $ydwa_tertiary_color . ' !important; border-color: ' . $ydwa_tertiary_color . ' !important; }';
	    echo 'button, input[type=button], input[type=reset], input[type=submit], .navbar-btn:hover, .entry-date > div, .entry-format, blockquote:after
	     #footer button, .pirate-forms-submit-button, #footer button, .pirate-forms-submit-button:hover, .owl-nav .owl-prev:hover, .owl-nav .owl-next:hover { background-color: ' . $ydwa_tertiary_color . ' !important; }';
	    echo '.main-navigation li:hover > a:before, .main-navigation li.current_page_item > a:before, .picker__nav--next:hover, .um .um-profile-nav-item.active a,
	     .um .um-profile-nav-item.active a:hover { background: ' . $ydwa_tertiary_color . ' !important; }';
	}

	$ydwa_lightgray_color = esc_attr( get_theme_mod( 'ydwa_lightgray_color', apply_filters( 'ydwa_lightgray_color_default_filter', '#eaeaea' ) ) );
	if ( ! empty( $ydwa_lightgray_color ) ) {
	    echo 'hr.tearaway, div.sharedaddy { border-top-color: ' . $ydwa_lightgray_color . ' !important; }';
	    echo '.blog-related-carousel .entry-media { border-color: ' . $ydwa_lightgray_color . ' !important; }';
	    echo 'input[type=reset]:hover, .um .um-profile-body .um-button.um-alt:hover, .um .um-profile-body a.um-button.um-alt:hover,
	     input[type=button].pmpro_btn.pmpro_btn-cancel:hover { background-color: ' . $ydwa_lightgray_color . ' !important; border-color: ' . $ydwa_lightgray_color . ' !important; }';
	}

	$ydwa_gray_color = esc_attr( get_theme_mod( 'ydwa_gray_color', apply_filters( 'ydwa_gray_color_default_filter', '#cccccc' ) ) );
	if ( ! empty( $ydwa_gray_color ) ) {
	    echo '.um-dropdown .um-dropdown-arr, #give-recurring-form .give-error, #give-recurring-form .give-required-indicator, form.give-form .give-error,
	     form.give-form .give-required-indicator, form[id*=give-form] .give-error, form[id*=give-form] .give-required-indicator { color: ' . $ydwa_gray_color . ' !important; }';
	    echo 'form[id*=give-form] .give-donation-amount .give-currency-symbol { border-top-color: ' . $ydwa_gray_color . ' !important; border-bottom-color: ' . $ydwa_gray_color . ' !important; }';
	    echo 'form[id*=give-form] .give-donation-amount .give-currency-symbol.give-currency-position-before { border-left-color: ' . $ydwa_gray_color . ' !important; }';
	    echo 'input[type=text], input[type=email], input[type=tel], input[type=date], input[type=url], input[type=password], input[type=search],
	     textarea, select, .main-navigation, .main-navigation ul ul, .entry-footer, .um-dropdown, .um-dropdown li:last-child a, .um-profile.um-viewing .um-field-label, #give-recurring-form .form-row input[type=text], #give-recurring-form .form-row input[type=email],
	     #give-recurring-form .form-row input[type=password], #give-recurring-form .form-row input[type=tel], #give-recurring-form .form-row input[type=url],
	     #give-recurring-form .form-row select, #give-recurring-form .form-row textarea, form.give-form .form-row input[type=text], form.give-form .form-row input[type=email],
	     form.give-form .form-row input[type=password], form.give-form .form-row input[type=tel], form.give-form .form-row input[type=url], form.give-form .form-row select,
	     form.give-form .form-row textarea, form[id*=give-form] .form-row input[type=text], form[id*=give-form] .form-row input[type=email], form[id*=give-form] .form-row input[type=password],
	     form[id*=give-form] .form-row input[type=tel], form[id*=give-form] .form-row input[type=url], form[id*=give-form] .form-row select, form[id*=give-form] .form-row textarea,
	     form[id*=give-form] .give-donation-amount #give-amount, form[id*=give-form] .give-donation-amount #give-amount-text, form[id*=give-form] #give-final-total-wrap .give-donation-total-label,
	     form[id*=give-form] #give-final-total-wrap .give-final-total-amount, form.pmpro_form hr { border-color: ' . $ydwa_gray_color . ' !important; }';
	    echo 'input[type=reset], .um .um-profile-body input[type=submit].um-button.um-alt, .um .um-profile-body input[type=submit].um-button.um-alt:focus,
	     .um .um-profile-body a.um-button.um-alt, .um .um-profile-body a.um-button.um-alt.um-disabled:hover, .um .um-profile-body a.um-button.um-alt.um-disabled:focus,
	     .um .um-profile-body a.um-button.um-alt.um-disabled:active, input[type=button].pmpro_btn.pmpro_btn-cancel { background-color: ' . $ydwa_gray_color . ' !important; border-color: ' . $ydwa_gray_color . ' !important; }';
	}

	$ydwa_darkgray_color = esc_attr( get_theme_mod( 'ydwa_darkgray_color', apply_filters( 'ydwa_darkgray_color_default_filter', '#1e3046' ) ) );
	if ( ! empty( $ydwa_darkgray_color ) ) {
	    echo 'input[type=reset], .post .entry-title, .post h1, .post h2, .post h3, .post h4, .post h5, .post h6, .um, .um .um-profile-body input[type=submit].um-button.um-alt,
	     .um .um-profile-body input[type=submit].um-button.um-alt:focus, .um .um-profile-body a.um-button.um-alt, .um .um-profile-body a.um-button.um-alt.um-disabled:hover,
	     .um .um-profile-body a.um-button.um-alt.um-disabled:focus, .um .um-profile-body a.um-button.um-alt.um-disabled:active, .um-member-tagline-description,
	     .um-dropdown .um-dropdown-b li a.real_url:hover, .um-dropdown .um-dropdown-b li a.um-dropdown-hide:hover, input[type=button].pmpro_btn.pmpro_btn-cancel { color: ' . $ydwa_darkgray_color . ' !important; }';
	    echo 'button:hover, input[type=button]:hover, input[type=submit]:hover, .comment-form input[type=submit].btn:hover, .um input[type=submit].um-button:hover,
	     .um a.um-button:hover, .pmpro_btn:hover, .pmpro_btn:link:hover, .pmpro_content_message a:hover, .pmpro_content_message a:link:hover { background-color: ' . $ydwa_darkgray_color . ' !important; border-color: ' . $ydwa_darkgray_color . ' !important; }';
	}

	echo '</style>';
}

/**
 * Filter the default primary color
 */
function ydwa_filter_the_default_primary_color() {
	return '#1982d1';
}

add_filter( 'ydwa_primary_color_default_filter', 'ydwa_filter_the_default_primary_color' );

/**
 * Filter the default secondary color
 */
function ydwa_filter_the_default_secondary_color() {
	return '#78c434';
}

add_filter( 'ydwa_secondary_color_default_filter', 'ydwa_filter_the_default_secondary_color' );

/**
 * Filter the default tertiary color
 */
function ydwa_filter_the_default_tertiary_color() {
	return '#ffa71c';
}

add_filter( 'ydwa_tertiary_color_default_filter', 'ydwa_filter_the_default_tertiary_color' );

/**
 * Filter the default light gray color
 */
function ydwa_filter_the_default_lightgray_color() {
	return '#eaeaea';
}

add_filter( 'ydwa_lightgray_color_default_filter', 'ydwa_filter_the_default_lightgray_color' );

/**
 * Filter the default gray color
 */
function ydwa_filter_the_default_gray_color() {
	return '#cccccc';
}

add_filter( 'ydwa_gray_color_default_filter', 'ydwa_filter_the_default_gray_color' );

/**
 * Filter the default dark gray color
 */
function ydwa_filter_the_default_darkgray_color() {
	return '#1e3046';
}

add_filter( 'ydwa_darkgray_color_default_filter', 'ydwa_filter_the_default_darkgray_color' );


/**
 *****************************
 ********** Sections & Panels ***********
 */

add_action('customize_register', 'ydwa_remove_sections_customize_register', 100);

function ydwa_remove_sections_customize_register($wp_customize){
	if (!current_user_can('manage_network')) {
		$wp_customize->remove_panel('nav_menus');
		$wp_customize->remove_panel('widgets');
		$wp_customize->remove_section('static_front_page');
	}
}

/**
 *****************************
 ********** Settings ***********
 */

add_action('customize_register', 'ydwa_settings_customize_register', 100);

function ydwa_settings_customize_register($wp_customize) {
	$wp_customize->remove_setting('islemag_footer_copyright');
	
	$wp_customize->remove_setting('islemag_title_color');
	$wp_customize->remove_setting('islemag_top_slider_post_title_color');
	$wp_customize->remove_setting('islemag_top_slider_post_text_color');
	$wp_customize->remove_setting('islemag_sections_post_title_color');
	$wp_customize->remove_setting('islemag_sections_post_text_color');
	
	$wp_customize->add_setting(
		'ydwa_primary_color', array(
			'default'           => apply_filters( 'ydwa_primary_color_default_filter', '#1982d1' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_setting(
		'ydwa_secondary_color', array(
			'default'           => apply_filters( 'ydwa_secondary_color_default_filter', '#78c434' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_setting(
		'ydwa_tertiary_color', array(
			'default'           => apply_filters( 'ydwa_tertiary_color_default_filter', '#ffa71c' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_setting(
		'ydwa_lightgray_color', array(
			'default'           => apply_filters( 'ydwa_lightgray_color_default_filter', '#eaeaea' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_setting(
		'ydwa_gray_color', array(
			'default'           => apply_filters( 'ydwa_gray_color_default_filter', '#cccccc' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_setting(
		'ydwa_darkgray_color', array(
			'default'           => apply_filters( 'ydwa_darkgray_color_default_filter', '#1e3046' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
}

/**
 *****************************
 ********** Controls ***********
 */

add_action('customize_register', 'ydwa_controls_customize_register', 100);

function ydwa_controls_customize_register($wp_customize) {
	$wp_customize->remove_control('islemag_keep_old_fp_template');
	$wp_customize->remove_control('islemag_sticky_menu');
	$wp_customize->remove_control('islemag_header_slider_category');
	$wp_customize->remove_control('islemag_header_slider_random');
	$wp_customize->remove_control('islemag_title_color');
	$wp_customize->remove_control('islemag_top_slider_post_title_color');
	$wp_customize->remove_control('islemag_top_slider_post_text_color');
	$wp_customize->remove_control('islemag_sections_post_title_color');
	$wp_customize->remove_control('islemag_sections_post_text_color');
	$wp_customize->remove_control('islemag_footer_copyright');
	$wp_customize->remove_control('islemag_footer_text');
	$wp_customize->remove_control('islemag_footer_socials_title');

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'ydwa_primary_color', array(
				'label'    => esc_html__( 'Primary color', 'islemag' ),
				'section'  => 'colors',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'ydwa_secondary_color', array(
				'label'    => esc_html__( 'Secondary color', 'islemag' ),
				'section'  => 'colors',
				'priority' => 3,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'ydwa_tertiary_color', array(
				'label'    => esc_html__( 'Tertiary color', 'islemag' ),
				'section'  => 'colors',
				'priority' => 4,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'ydwa_lightgray_color', array(
				'label'    => esc_html__( 'Light gray', 'islemag' ),
				'section'  => 'colors',
				'priority' => 5,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'ydwa_gray_color', array(
				'label'    => esc_html__( 'Gray', 'islemag' ),
				'section'  => 'colors',
				'priority' => 6,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'ydwa_darkgray_color', array(
				'label'    => esc_html__( 'Dark gray', 'islemag' ),
				'section'  => 'colors',
				'priority' => 7,
			)
		)
	);
}

require_once get_stylesheet_directory() . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'reviewzine_register_required_plugins' );

/**
 * Required plugins with TGMPA
 */
function reviewzine_register_required_plugins() {
	/*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
	$plugins = array(

		array(
			'name'      => __( 'WP Product Review','reviewzine' ),
			'slug'      => 'wp-product-review',
			'required'  => false,
		),

	);

	/*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
	$config = array(
		'id'           => 'reviewzine-tgmpa',       // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                       // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',  // Menu slug.
		'has_notices'  => true,                     // Show admin notices or not.
		'dismissable'  => true,                     // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                    // Automatically activate plugins after installation or not.
		'message'      => '',                       // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

/**
 * Change container row
 */
function reviewzine_container_row() {
	?>
	<div class="container">
		<div class="row">
	<?php

}

/**
 * Change container row - end
 */
function reviewzine_container_row_close() {
	?>
		</div>
	</div>
	<?php

}

add_action( 'islemag_navbar_top_head', 'reviewzine_container_row' );

add_action( 'islemag_navbar_top_bottom', 'reviewzine_container_row_close' );

add_action( 'islemag_header_content_head', 'reviewzine_container_row' );

add_action( 'islemag_header_content_bottom', 'reviewzine_container_row_close' );

add_action( 'islemag_footer_container_head', 'reviewzine_container_row' );

add_action( 'islemag_footer_container_bottom', 'reviewzine_container_row_close' );

/**
 * Filter the navbar top classes
 *
 * @param string $classes The already existing classes.
 *
 * @return array|string
 */
function reviewzine_navbar_top_classes( $classes ) {
	if ( is_array( $classes ) ) {
		return array_diff( $classes, array( 'container-fluid' ) );
	}
	return '';
}

add_filter( 'islemag_navbar_top_classes', 'reviewzine_navbar_top_classes' );

/**
 * Remove classes
 */
function reviewzine_no_class_filter() {
	return '';
}

add_filter( 'islemag_wrapper_class', 'reviewzine_no_class_filter' );
add_filter( 'islemag_content_ids', 'reviewzine_no_class_filter' );
add_filter( 'islemag_line_color', 'reviewzine_no_class_filter' );

/**
 * Add container
 */
function reviewzine_container() {
	?>
	<div class="container">
	<?php

}

/**
 * Close container
 */
function reviewzine_container_close() {
	?>
	</div>
	<?php

}

add_action( 'islemag_main_nav_before', 'reviewzine_container' );

add_action( 'islemag_main_nav_after', 'reviewzine_container_close' );

/**
 * Reorganize the footer content
 */
function ydwa_footer_content() {
	remove_action('islemag_footer_content', 'islemag_footer'); ?>
	<div class="col-md-4">
		<?php printf('Powered by <a href="http://wordpress.org/" rel="nofollow">Wordpress</a>'); ?>
	</div><!-- End .col-md-6 -->
	<div class="col-md-8">
		<?php

		$defaults = array(
			'theme_location'  => 'islemag-footer',
			'fallback_cb'     => false,
			'items_wrap'      => '<ul class="footer-menu" id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 1,
		);

		wp_nav_menu( $defaults ); ?>
	</div><!-- End .col-md-6 -->
	<?php

}

add_action( 'islemag_footer_content', 'ydwa_footer_content', 9 );

/**
 * Redo the navigation
 */
function reviewzine_the_post_navigation() {
	?>
	<div class="reviewzine-pagination">
		<?php
		the_posts_pagination( array(
			'prev_next' => false,
		) );
		?>
	</div>
	<?php

}

add_filter( 'islemag_post_navigation_filter', 'reviewzine_the_post_navigation' );

/**
 * Filter the classes on archive page
 *
 * @param string $classes The already existing classes.
 */
function reviewzine_archive_content_classes( $classes ) {
	if ( is_array( $classes ) ) {
		$classes[] = 'col-md-8';
		return array_diff( $classes, array( 'col-md-9' ) );
	}
	return '';
}
add_filter( 'islemag_archive_content_classes', 'reviewzine_archive_content_classes', 9 );

/**
 * Filter the classes on main content
 *
 * @param string $classes The already existing classes.
 */
function reviewzine_content_classes( $classes ) {
	if ( is_array( $classes ) ) {
		$classes[] = 'container';
		return $classes;
	}
	return '';
}
add_filter( 'islemag_content_classes', 'reviewzine_content_classes' );

/**
 * Change the title of the comments section
 */
function reviewzine_comments_title() {
	remove_action( 'islemag_comments_title', 'islemag_comments_heading' ); ?>
	<span><?php esc_html_e( 'Comments', 'reviewzine' ); ?></span>
	<?php

}
add_action( 'islemag_comments_title', 'reviewzine_comments_title', 9 );

/**
 * Change the content of the comments section
 *
 * @param array   $args The arguments.
 * @param string  $comment The comments.
 * @param integer $depth The depth of the comments.
 * @param string  $add_below are for the JavaScript addComment.moveForm() method parameters.
 */
function reviewzine_comment_content( $args, $comment, $depth, $add_below ) {
	remove_action( 'islemag_comment_content', 'islemag_comment_action' ); ?>
	<div class="media">
		<div class="media-left">
			<figure class="author-avatar">
				<?php
				if ( $args['avatar_size'] != 0 ) {
					echo get_avatar( $comment, 52, '', '', array(
						'class' => 'media-object',
					) );
				} ?>
			</figure>
		</div>
		<div class="media-body">
			<div class="comment-author vcard">
				<?php
				/* translators: %s - the comment authors link */
				printf( __( '<h4 class="media-heading">%s</h4>', 'reviewzine' ), get_comment_author_link() ); ?>
				<div class="reply pull-right reply-link"> <?php comment_reply_link( array_merge( $args, array(
					'add_below' => $add_below,
					'depth' => $depth,
					'max_depth' => $args['max_depth'],
				) ) ); ?> </div>
				<div class="comment-extra-info">
					<?php
					/* translators: 1 - the comment date, 2 - the comment title */
					printf( __( '<span class="comment-date">(%1$s - %2$s)</span>', 'reviewzine' ), get_comment_date(), get_comment_time() ); ?>
					<?php edit_comment_link( __( '(Edit)', 'reviewzine' ), '  ', '' ); ?>
				</div>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'reviewzine' ); ?></em>
				<br />
			<?php endif; ?>
			<div class="media-body">
				<?php comment_text(); ?>
			</div>
		</div>
	</div>
	<?php

}
add_action( 'islemag_comment_content', 'reviewzine_comment_content', 9, 5 );

/**
 * Filter the comments args title_reply_before and title_reply_after.
 *
 * @param array $args The arguments.
 */
function reviewzine_comments_args( $args ) {
	if ( is_array( $args ) ) {
		$args['title_reply_before'] = '<h3 id="reply-title" class="comment-reply-title"><span>';
		$args['title_reply_after'] = '</span></h3>';
		return $args;
	}
	return '';
}
add_filter( 'islemag_comments_args', 'reviewzine_comments_args' );

/**
 * Filter sidebar classes
 *
 * @param string $classes The already existing classses.
 */
function islemag_sidebar_classes( $classes ) {
	if ( is_array( $classes ) ) {
		$classes[] = 'col-md-4';
		return array_diff( $classes, array( 'col-md-3' ) );
	}
	return '';
}
add_filter( 'islemag_sidebar_classes', 'islemag_sidebar_classes' );

/**
 * Remove meta information for the categories, tags and comments from the parent theme
 */
function reviewzine_entry_footer() {
	remove_action( 'islemag_entry_footer', 'islemag_entry_footer' );
}
add_action( 'islemag_entry_footer', 'reviewzine_entry_footer', 9 );

/**
 * Filter the date format
 */
function reviewzine_date_format() {
	return _x( 'F','month date format','reviewzine' );
}
add_filter( 'islemag_date_format', 'reviewzine_date_format' );

/**
 * Change the date entry
 */
function reviewzine_entry_date() {
	remove_action( 'islemag_entry_date', 'islemag_post_entry_date' );
	$date_format = apply_filters( 'islemag_date_format', 'F' ); ?>
	<div class="entry-date"><div><?php echo get_the_date( 'd' ); ?><span><?php echo strtoupper( get_the_date( $date_format ) ); ?></span></div></div>
	<?php

}
add_action( 'islemag_entry_date', 'reviewzine_entry_date', 9 );

/**
 * Remove the colors from the slider posts
 */
function reviewzine_remove_colors_from_slider_posts() {
	return '';
}
add_filter( 'islemag_slider_posts_colors', 'reviewzine_remove_colors_from_slider_posts' );

/**
 * Wrap a div at the top of the slider posts - close
 */
function reviewzine_add_content_at_the_bottom_of_slider_posts() {
	?>
	</div>
	<div class="extra-info">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php
		if ( function_exists( 'cwppos_calc_overall_rating' ) ) {
			$rating = cwppos_calc_overall_rating( get_the_ID() );
			if ( ! empty( $rating['option1'] ) ) {
				?>
				<div class="star-ratings-css">
					<div class="star-ratings-css-top" style="width: <?php echo esc_attr( $rating['overall'] ); ?>%"><span><i class="fa fa-star"></i></span><span><i class="fa fa-star"></i></span><span><i class="fa fa-star"></i></span><span><i class="fa fa-star"></i></span><span><i class="fa fa-star"></i></span></div>
					<div class="star-ratings-css-bottom"><span><i class="fa fa-star-o"></i></span><span><i class="fa fa-star-o"></i></span><span><i class="fa fa-star-o"></i></span><span><i class="fa fa-star-o"></i></span><span><i class="fa fa-star-o"></i></span></div>
				</div>
			<?php
			}
		} ?>
	</div>
	<?php

}
add_action( 'islemag_bottom_slider_posts', 'reviewzine_add_content_at_the_bottom_of_slider_posts' );

/**
 * Wrap a div at the top of the slider posts
 */
function reviewzine_add_content_at_the_top_of_slider_posts() {
	?>
	<div class="entry-holder">
	<?php

}
add_action( 'islemag_top_slider_posts', 'reviewzine_add_content_at_the_top_of_slider_posts' );

/**
 * Hide the default title on the slider posts from the parent theme ( to move it in other place in the child theme )
 */
function reviewzine_hide_default_title_on_slider_posts() {
	return false;
}
add_filter( 'islemag_filter_article_title_on_slider_posts', 'reviewzine_hide_default_title_on_slider_posts' );

add_filter( 'get_the_archive_title', 'reviewzine_archive_title' );

/**
 * Filter the archive title
 */
function reviewzine_archive_title( $title ) {

	if ( is_category() ) {
		$title = single_cat_title( '', false );
		return __( 'Category', 'reviewzine' ) . '<span class="category-name">' . esc_html( $title ) . '</span>';
	}

	return $title;
};

/**
 * Change path to child theme for preview images
 */
function islemag_prevdem_home_filter_callback() {
	return get_stylesheet_directory() . '/ti-prevdem/img/';
}

/**
 * Change theme uri to child theme for preview images
 */
function islemag_prevdem_home_uri_filter_callback() {
	return get_stylesheet_directory_uri() . '/ti-prevdem/img/';
}

/**
 * Change default top banner
 */
function islemag_default_top_banner_callback() {
	return get_stylesheet_directory_uri() . '/images/728x90-reviewzine.jpg';
}

/**
 * Change default sidebar banners
 */
function islemag_default_sidebar_banner_callback() {
	return get_stylesheet_directory_uri() . '/images/125x125-reviewzine.jpg';
}

/**
 * After setup theme function
 */
function reviewzine_starter_content() {

	/* preview demo */
	add_filter( 'islemag_prevdem_home_filter', 'islemag_prevdem_home_filter_callback' );
	add_filter( 'islemag_prevdem_home_uri_filter', 'islemag_prevdem_home_uri_filter_callback' );

	/* change default banners */
	add_filter( 'islemag_default_top_banner_filter', 'islemag_default_top_banner_callback' );
	add_filter( 'islemag_default_sidebar_banner_filter', 'islemag_default_sidebar_banner_callback' );

	/*
	 * Starter Content Support
	 */
	add_theme_support( 'starter-content', array(

		'posts' => array(
			'home',
			'blog',
		),
		'nav_menus' => array(
			'primary'      => array(
				'name'  => __( 'Primary Menu', 'reviewzine' ),
				'items' => array(
					'page_home',
					'page_blog',
				),
			),
		),
		'options' => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
	) );
}
add_action( 'after_setup_theme', 'reviewzine_starter_content' );
