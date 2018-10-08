<?php

/**
 * Ativa as features do tema
 */
function set_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('html5');
}
add_action('after_setup_theme', 'set_theme_support');

/**
 * Registra os menus
 */
function register_menus() {
    register_nav_menus(
		array('filter-sidebar' => 'Filtros na Sidebar')
	);
}
add_action('after_setup_theme', 'register_menus');

/**
 * Imagens
 */
$center = array('center', 'center');

add_image_size('profile', 30, 30, $center);
add_image_size('profile_large', 300, 300, $center);

add_image_size('product_grid', 335, 335, $center);
add_image_size('product_grid_small', 120, 120, $center);
add_image_size('product_grid_large', 835, 475, $center);

add_image_size('product_single_large', 1000, 625, $center);
add_image_size('product_single_thumbnail', 170, 144, $center);
add_image_size('product_related', 288, 190, $center);

add_image_size('product_email', 380, 240, $center);

/*
 * Remove os links do admin
 */
function remove_menus(){ 
	// remove_menu_page('edit.php');
	// remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_menus');

/**
 * Remove os links da barra de admin
 */
function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-content');
}
add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');

/**
 * Remove os itens do dashboard
 */
function remove_wordpress_dashboard_blocks() {
	remove_meta_box('dashboard_right_now',   'dashboard', 'normal');
	remove_meta_box('dashboard_activity',    'dashboard', 'normal');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box('dashboard_primary',     'dashboard', 'side');
}
add_action('admin_init', 'remove_wordpress_dashboard_blocks');
remove_action('welcome_panel', 'wp_welcome_panel');

/**
 * remove os scripts padrões do wordpress
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles'    , 'print_emoji_styles');
remove_action('admin_print_styles' , 'print_emoji_styles');

// remove os scripts que carregam com o wp_head
function disable_scripts() { 
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		wp_deregister_script('l10n');
		wp_deregister_script('jquery');
		wp_deregister_script('wp-embed');
	}
}
add_action('wp_enqueue_scripts', 'disable_scripts');

// remove barra de admin
add_filter("show_admin_bar", '__return_false');