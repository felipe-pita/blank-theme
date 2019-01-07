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