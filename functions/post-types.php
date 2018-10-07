<?php
/*
 * Produtos
 */
function post_product_generate() {

	$labels = array(
		'name'                  => 'Produtos',
		'singular_name'         => 'Produto',
		'menu_name'             => 'Produtos',
		'name_admin_bar'        => 'Produtos',
		'archives'              => 'Produtos',
		'attributes'            => 'Atributos do produto',
		'parent_item_colon'     => 'Produto principal:',
		'all_items'             => 'Todos os produtos',
		'add_new_item'          => 'Adicionar novo produto',
		'add_new'               => 'Adicionar novo',
		'new_item'              => 'Novo produto',
		'edit_item'             => 'Editar produto',
		'update_item'           => 'Atualizar produto',
		'view_item'             => 'Ver produto',
		'view_items'            => 'Ver produtos',
		'search_items'          => 'Procurar produto',
		'not_found'             => 'Não encontrado',
		'not_found_in_trash'    => 'Não encontrado na lixeira',
	);
	$rewrite = array(
		'slug'                  => 'produto',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => false,
	);
	$capabilities = array(
		'edit_post'             => 'edit_products',
		'read_post'             => 'read_products',
		'delete_post'           => 'delete_product',
		'edit_posts'            => 'edit_products',
		'edit_others_posts'     => 'edit_others_products',
		'publish_posts'         => 'publish_products',
		'read_private_posts'    => 'read_private_products',
	);
	$args = array(
		'label'                 => 'Produto',
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions' ),
		'taxonomies'            => array( 'tax_product' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-images-alt2',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capabilities'          => $capabilities,
	);
	register_post_type('post_product', $args);

}
add_action('init', 'post_product_generate', 0);

/*
 * Tax Produtos
 */
function tax_product_generate() {

	$labels = array(
		'name'                       => 'Categorias',
		'singular_name'              => 'Categoria',
		'menu_name'                  => 'Categorias',
	);
	$capabilities = array(
		'manage_terms'               => 'manage_products_categories',
		'edit_terms'                 => 'manage_products_categories',
		'delete_terms'               => 'manage_products_categories',
		'assign_terms'               => 'edit_products_categories',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'capabilities'               => $capabilities,
	);
	register_taxonomy( 'tax_product', array( 'post_product' ), $args );

}
add_action( 'init', 'tax_product_generate', 0 );

/*
 * Listas
 */
function post_list_generate() {

	$labels = array(
		'name'                  => 'Listas',
		'singular_name'         => 'Lista',
		'menu_name'             => 'Listas',
		'name_admin_bar'        => 'Listas',
	);
	$rewrite = array(
		'slug'                  => 'lista',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => false,
	);
	$capabilities = array(
		'edit_post'             => 'edit_lists',
		'read_post'             => 'read_lists',
		'delete_post'           => 'delete_list',
		'edit_posts'            => 'edit_lists',
		'edit_others_posts'     => 'edit_others_lists',
		'publish_posts'         => 'publish_lists',
		'read_private_posts'    => 'read_private_lists',
	);
	$args = array(
		'label'                 => 'Listas',
		'labels'                => $labels,
		'supports'              => array('title', 'author'),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-menu',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capabilities'          => $capabilities,
	);
	register_post_type( 'post_list', $args );

}
add_action( 'init', 'post_list_generate', 0 );

