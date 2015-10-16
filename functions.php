<?php
/* ------------------- CUSTOM POST TYPE ----------------------- */
/**
* Setup for Custom Post Type.
* 
*/
function products_init(){
	$args = array(
		'public'            => true,
		'has_archive'       => true,
		'show_ui'           => true,
		'capability_type'   => 'post',
		'hierarchical'      => false,
		'rewrite'           => array('slug' => 'product'),
		'query_var'         => true,
		'menu_icon'         => 'dashicons-cart',
		'label'             => 'Product',
		'supports'          => array(
								'title',
								'editor',
								'excerpt',
								'custom-fields',
								'thumbnail',
								'page-attributes',)
		);
	register_post_type('product', $args);
}
add_action('init', 'products_init');

/* ------------------- TAXONOMY CATEGORY ----------------------- */

//Creates Taxonomy for Portfolio-projects

function gender_taxonomy(){
	$labels = array(
		'name'              => 'Gender', 
		'singular name'     => 'Gender',
		'search_items'      => 'Search gender',
		'parent_item'       => 'Parent gender',
		'edit_item'         => 'Edit gender',
		'update_item'       => 'Update Gender',
		'add_new_item'      => 'Add New Gender',
		'new_item_name'     => 'New Gender',
		'menu_name'         => 'Gender'
		);
		
	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		);

	register_taxonomy('gender_category', 'product', $args);
}
add_action('init', 'gender_taxonomy', 0);

/* ----------------------- IMAGES ---------------------------- */

/**
* Enable support for Post Thumbnails on CPT.
*/
add_theme_support( 'post-thumbnails' );
add_image_size( 'clothes-thumb', 80 );

/* ----------------------- SCRIPT ----------------------------- */

/**
* Enqueue scripts for the front end.
*
*/
function load_wp_media_files() {
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );

/**
* Enqueue script for the front end from jQuery library version 2.1.4.
*
*/

function modify_jquery() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', '2.1.4' );
	wp_enqueue_script( 'jquery' );
}
add_action( 'init', 'modify_jquery' );

/**
* Enqueue script for the front end from jQuery UI library version 1.11.4.
*
*/
function my_scripts_jquery_ui() {
	wp_enqueue_script( 'jquery_ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', array( 'jquery' ), '1.11.4');
}
add_action( 'wp_enqueue_scripts', 'my_scripts_jquery_ui' );

/**
* Enqueue script for the front end from file main.js.
*
*/
function my_scripts_method() {
	wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery', 'jquery_ui' ));
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );


/*******************************/
// function load_ajax() {
// 	wp_enqueue_script( 'ajax-pagination',  get_stylesheet_directory_uri() . '/js/ajax-pagination.js', array( 'jquery' ), '1.0', true );
// 	global $wp_query;
// 	wp_localize_script( 'ajax-pagination', 'ajaxpagination', array(
// 	'ajaxurl' => admin_url( 'admin-ajax.php' ),
// 	'query_vars' => json_encode( $wp_query->query )
// 	));
// }
// add_action( 'wp_enqueue_scripts', 'load_ajax' );

// function my_ajax_pagination() {
//     $query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );

//     $query_vars['paged'] = $_POST['page'];


//     $posts = new WP_Query( $query_vars );
//     $GLOBALS['wp_query'] = $posts;

//     add_filter( 'editor_max_image_size', 'my_image_size_override' );

 
//     while ( $posts->have_posts() ) { 
//         $posts->the_post();
//         get_template_part( 'content' );
//     }

//     remove_filter( 'editor_max_image_size', 'my_image_size_override' );

//     the_posts_pagination( array(
//         'prev_text'          => __( 'Previous page', 'outfitmaker' ),
//         'next_text'          => __( 'Next page', 'outfitmaker' ),
//         'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'outfitmaker' ) . ' </span>',
//     ) );

//     die();
// }
// add_action( 'wp_ajax_nopriv_ajax_pagination', 'my_ajax_pagination' );
// add_action( 'wp_ajax_ajax_pagination', 'my_ajax_pagination' );

// function my_image_size_override() {
//     return array( 825, 510 );
// }