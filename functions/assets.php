<?php

/*
 * Arquivos css e js
 */
function header_css_js() {
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		wp_enqueue_style('style', get_template_directory_uri() . '/build/css/main.css', '0.1');
		wp_enqueue_style('googleFonts', 'https://fonts.googleapis.com/css?family=Titillium+Web:300,400,400i,600,700');
	}
}
add_action('wp_enqueue_scripts', 'header_css_js');

function footer_css_js() {
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		wp_enqueue_script('libs', get_template_directory_uri() . '/build/js/libs.js', array(), '1.0');
		wp_enqueue_script('main', get_template_directory_uri() . '/build/js/main.js', array(), '1.0');
	}
}
add_action('wp_footer', 'footer_css_js');


/*
 * Favicons
 */
function favicons() {
    ?>

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri() . '/build/images/favicon/apple-touch-icon.png'; ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri() . '/build/images/favicon/favicon-32x32.png'; ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri() . '/build/images/favicon/favicon-16x16.png'; ?>">
	<link rel="manifest" href="<?php echo get_stylesheet_directory_uri() . '/build/images/favicon/site.webmanifest'; ?>">
	<link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri() . '/build/images/favicon/safari-pinned-tab.svg'; ?>" color="#707070">
	<meta name="msapplication-TileColor" content="#707070">
	<meta name="theme-color" content="#eaeaea">

    <?php
}
add_action('wp_head', 'favicons');
add_action('admin_head', 'favicons');
add_action('login_head', 'favicons');