<?php

/**
 * Sets up theme defaults and registers the various WordPress features that
 * this theme supports
 */
function umfwnc_setup() {
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Registers primary navigation menu
	register_nav_menu( 'primary', __( 'Main Menu', 'umfwnc' ) );

	// Registers mobile navigation menu
	register_nav_menu( 'mobile', __( 'Mobile Menu', 'umfwnc' ) );
}
add_action( 'after_setup_theme', 'umfwnc_setup' );


/**
 * Enqueues scripts and styles for front-end.
 */
if ( ! function_exists( 'umfwnc_scripts_styles' )) {
  function umfwnc_scripts_styles() {
	  $versioning = "1.0005";
	  global $wp_styles;

	  // Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
	  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		 wp_enqueue_script( 'comment-reply' );
	 }
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Martel:400,700,900|Roboto:400,400i,700,700i,900&display=swap', array());

	  // Loads AOS JS & CSS
	 $js  = '/js/vendor/aos.min.js';
	 $css = '/stylesheets/vendor/aos.min.css';
	 wp_enqueue_script( 'aos-script', get_template_directory_uri() . $js, array('jquery'), filemtime( get_template_directory() . $js ) );
	  wp_enqueue_style( 'aos-style', get_stylesheet_directory_uri() . $css, array(), filemtime( get_template_directory() . $css ) );

	  // Loads Slick JS & CSS
	 $js  = '/js/vendor/slick.min.js';
	 $css = '/stylesheets/vendor/slick.css';
	 wp_enqueue_script( 'slick-script', get_template_directory_uri() . $js, array('jquery'), filemtime( get_template_directory() . $js ) );
	  wp_enqueue_style( 'slick-style', get_stylesheet_directory_uri() . $css, array(), filemtime( get_template_directory() . $css ) );

	 // Loads Scroll Intent JS
	 $js  = '/js/vendor/scroll-intent.min.js';
	 wp_enqueue_script( 'scroll-intent', get_template_directory_uri() . $js, array('jquery'), filemtime( get_template_directory() . $js ) );

	  // Loads Parllax Scrolling Library
	 $js  = '/js/vendor/rellax.min.js';
	 wp_enqueue_script( 'rellax-script', get_template_directory_uri() . $js, array('jquery'), filemtime( get_template_directory() . $js ) );

	 // Loads our Global JS file
	 $file = '/js/global.js';
	 wp_enqueue_script( 'global-script', get_template_directory_uri() . $file, array('jquery'), filemtime( get_template_directory() . $file ) );

	 // Loads our Global JS file
	 $update_file = '/js/updates.js';
	 wp_enqueue_script('update-global-script', get_template_directory_uri() . $update_file, array('jquery'), $versioning, true);

	 // Loads our Global JS file
	 $update_file_2 = '/dist/js/scripts.js';
	 wp_enqueue_script('update-global-script-2', get_template_directory_uri() . $update_file_2, array('jquery'), $versioning, true);

	 // Loads Typekit Fonts
	 wp_enqueue_style('typekit-fonts', 'https://use.typekit.net/pcr5bhx.css');

	  // Loads the Master stylesheet
	  $file = '/stylesheets/compiled/master.css';
	  wp_enqueue_style( 'master-style', get_stylesheet_directory_uri() . $file, array(), filemtime( get_template_directory() . $file ) );
	  $update_file = '/stylesheets/compiled/updates.css';
	  wp_enqueue_style( 'update-master-style', get_stylesheet_directory_uri() . $update_file, null, $versioning);
	  $update_file_2 = '/dist/updated-styles.css';
	  wp_enqueue_style( 'update-master-style-2', get_stylesheet_directory_uri() . $update_file_2, null, $versioning);
  }
}
add_action( 'wp_enqueue_scripts', 'umfwnc_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 */
function umfwnc_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'umfwnc' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'umfwnc_wp_title', 10, 2 );


/**
* Add ACF Options page
*/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
	));
}



// Move Yoast to bottom
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


/**
* Enable Featured Images
*/
add_theme_support( 'post-thumbnails' );
