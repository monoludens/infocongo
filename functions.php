<?php

/*
 * InfoCongo resources
 */

// Template functions
include(STYLESHEETPATH . '/inc/template-functions.php');

// Countries
include(STYLESHEETPATH . '/inc/countries.php');

// Topics
include(STYLESHEETPATH . '/inc/topics.php');

// Datasets
include(STYLESHEETPATH . '/inc/datasets.php');

/*
 * Clears JEO default front-end styles and scripts
 */
function infocongo_scripts() {

	// deregister jeo styles
	wp_deregister_style('jeo-main');

  // deregister jeo site frontend scripts
  wp_deregister_script('jeo-site');


	// register normalize and grid system
	wp_register_style('infocongo-normalize', get_stylesheet_directory_uri() . '/css/normalize.css', array(), '2.0.4');
	wp_register_style('infocongo-skeleton', get_stylesheet_directory_uri() . '/css/skeleton.css', array('infocongo-normalize'), '2.0.4');

}
add_action('wp_enqueue_scripts', 'infocongo_scripts', 10);

/*
 * JEO Hooks examples
 * Most common hooks
 */

// Action right after JEO functionality inits
function infocongo_init() {
  // Action goes here
}
add_action('jeo_init', 'infocongo_init');

// Hook scripts after JEO scripts has been initialized
function infocongo_jeo_scripts() {

  // Register and enqueue scripts here

	// Enqueue child theme JEO related scripts
  wp_enqueue_script('infocongo-jeo-scripts', get_stylesheet_directory_uri() . '/js/jeo-scripts.js', array('jquery') , '0.0.1');

	// Enqueue main CSS (with grid system dependency)
  wp_enqueue_style('infocongo-styles', get_stylesheet_directory_uri() . '/css/main.css', array('infocongo-skeleton'));

}
add_action('jeo_enqueue_scripts', 'infocongo_jeo_scripts', 20);

// Hook scripts after JEO Marker scripts has been initialized
function infocongo_markers_scripts() {

  // Register and enqueue scripts here
  wp_enqueue_script('infocongo-jeo-markers-scripts', get_stylesheet_directory_uri() . '/js/jeo-markers-scripts.js', array('jquery') , '0.0.1');

}
add_action('jeo_markers_enqueue_scripts', 'infocongo_markers_scripts', 20);

// Filter to change posts GeoJSON data (also changes the GeoJSON API output)
function infocongo_marker_data($data, $post) {

  // Change $data here

  return $data;
}
add_filter('jeo_marker_data', 'infocongo_marker_data', 10, 2);

// Filter to change GeoJSON response
function infocongo_markers_data($data, $query) {

  // Change $data here

  return $data;
}
add_filter('jeo_markers_data', 'infocongo_markers_data', 10, 2);

// Filter to programatically change map data
function infocongo_map_data($data, $map) {

  // Change $data here

  return $data;
}
add_filter('jeo_map_data', 'infocongo_map_data', 10, 2);

// image sizes
add_action( 'after_setup_theme', 'images_theme_setup' );
function images_theme_setup() {
  add_image_size( 'featured', 500, 464, array( 'center', 'top' ));
  add_image_size( 'home-list', 300, 200, array( 'center', 'top' ));
  add_image_size( 'home-slider', 540, 200, array( 'center', 'top' ));
}


// Register Custom Taxonomy
function custom_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Topics', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Topic', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Topics', 'text_domain' ),
    'all_items'                  => __( 'All Topics', 'text_domain' ),
    'parent_item'                => __( 'Parent Topics', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Topic:', 'text_domain' ),
    'new_item_name'              => __( 'New Topic Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Topic', 'text_domain' ),
    'edit_item'                  => __( 'Edit Topic', 'text_domain' ),
    'update_item'                => __( 'Update Topic', 'text_domain' ),
    'view_item'                  => __( 'View Topic', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate Topic with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove Topic', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Topics', 'text_domain' ),
    'search_items'               => __( 'Search Topics', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'Topic', array( 'post' ), $args );

  $labels = array(
    'name'                       => _x( 'Countries', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Country', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Countries', 'text_domain' ),
    'all_items'                  => __( 'All Countries', 'text_domain' ),
    'parent_item'                => __( 'Parent Countries', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Country:', 'text_domain' ),
    'new_item_name'              => __( 'New Country Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Country', 'text_domain' ),
    'edit_item'                  => __( 'Edit Country', 'text_domain' ),
    'update_item'                => __( 'Update Country', 'text_domain' ),
    'view_item'                  => __( 'View Country', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate Country with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove Country', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Countries', 'text_domain' ),
    'search_items'               => __( 'Search Countries', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'Country', array( 'post' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );