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

global $post;

  $permalink = $data['url'];

  if(function_exists('qtrans_getLanguage'))
    $permalink = add_query_arg(array('lang' => qtrans_getLanguage()), $permalink);

  $data['permalink'] = $permalink;
  $data['url'] = $permalink;
  $data['content'] = get_the_excerpt();
  $data['slideshow'] = infoamazonia_get_content_media();
  if(get_post_meta($post->ID, 'geocode_zoom', true))
    $data['zoom'] = get_post_meta($post->ID, 'geocode_zoom', true);

  // source
  $publishers = get_the_terms($post->ID, 'publisher');
  if($publishers) {
    $publisher = array_shift($publishers);
    $data['source'] = apply_filters('single_cat_title', $publisher->name);
  }
  // thumbnail
  $data['thumbnail'] = infoamazonia_get_thumbnail();

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
function register_taxonomies() {

  $labels = array(
    'name'                       => _x( 'Topics', 'Taxonomy General Name', 'infocongo' ),
    'singular_name'              => _x( 'Topic', 'Taxonomy Singular Name', 'infocongo' ),
    'menu_name'                  => __( 'Topics', 'infocongo' ),
    'all_items'                  => __( 'All Topics', 'infocongo' ),
    'parent_item'                => __( 'Parent Topics', 'infocongo' ),
    'parent_item_colon'          => __( 'Parent Topic:', 'infocongo' ),
    'new_item_name'              => __( 'New Topic Name', 'infocongo' ),
    'add_new_item'               => __( 'Add New Topic', 'infocongo' ),
    'edit_item'                  => __( 'Edit Topic', 'infocongo' ),
    'update_item'                => __( 'Update Topic', 'infocongo' ),
    'view_item'                  => __( 'View Topic', 'infocongo' ),
    'separate_items_with_commas' => __( 'Separate Topic with commas', 'infocongo' ),
    'add_or_remove_items'        => __( 'Add or remove Topic', 'infocongo' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'infocongo' ),
    'popular_items'              => __( 'Popular Topics', 'infocongo' ),
    'search_items'               => __( 'Search Topics', 'infocongo' ),
    'not_found'                  => __( 'Not Found', 'infocongo' ),
  );
  $args = array( 
    'labels'                     => $labels,
    'public'                     => true,
    'show_in_nav_menus'          => true,
    'show_ui'                    => true,
    'show_tagcloud'              => true,
    'hierarchical'               => true,
    'show_admin_column'          => true,
    'capability_type'            => 'post',
    'rewrite'                    => array('slug' => 'topic', 'with_front' => false),
    'query_var'                  => 'topic'
  );
  register_taxonomy( 'topic', array( 'post' ), $args );

  $labels = array(
    'name'                       => _x( 'Countries', 'Taxonomy General Name', 'infocongo' ),
    'singular_name'              => _x( 'Country', 'Taxonomy Singular Name', 'infocongo' ),
    'menu_name'                  => __( 'Countries', 'infocongo' ),
    'all_items'                  => __( 'All Countries', 'infocongo' ),
    'parent_item'                => __( 'Parent Countries', 'infocongo' ),
    'parent_item_colon'          => __( 'Parent Country:', 'infocongo' ),
    'new_item_name'              => __( 'New Country Name', 'infocongo' ),
    'add_new_item'               => __( 'Add New Country', 'infocongo' ),
    'edit_item'                  => __( 'Edit Country', 'infocongo' ),
    'update_item'                => __( 'Update Country', 'infocongo' ),
    'view_item'                  => __( 'View Country', 'infocongo' ),
    'separate_items_with_commas' => __( 'Separate Country with commas', 'infocongo' ),
    'add_or_remove_items'        => __( 'Add or remove Country', 'infocongo' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'infocongo' ),
    'popular_items'              => __( 'Popular Countries', 'infocongo' ),
    'search_items'               => __( 'Search Countries', 'infocongo' ),
    'not_found'                  => __( 'Not Found', 'infocongo' ),
  );
  $args = array( 
    'labels'                     => $labels,
    'public'                     => true,
    'show_in_nav_menus'          => true,
    'show_ui'                    => true,
    'show_tagcloud'              => true,
    'hierarchical'               => true,
    'show_admin_column'          => true,
    'capability_type'            => 'post',
    'rewrite'                    => array('slug' => 'country', 'with_front' => false),
    'query_var'                  => 'country'
  );
  register_taxonomy( 'country', array( 'post' ), $args );


  $labels = array( 
    'name'                       => __('Publishers', 'Taxonomy General Name', 'infocongo'),
    'singular_name'              => __('Publisher', 'Taxonomy Singular Name', 'infocongo'),
    'search_items'               => __('Search publishers', 'infocongo'),
    'popular_items'              => __('Popular publishers', 'infocongo'),
    'all_items'                  => __('All publishers', 'infocongo'),
    'parent_item'                => __('Parent publisher', 'infocongo'),
    'parent_item_colon'          => __('Parent publisher:', 'infocongo'),
    'edit_item'                  => __('Edit publisher', 'infocongo'),
    'update_item'                => __('Update publisher', 'infocongo'),
    'add_new_item'               => __('Add new publisher', 'infocongo'),
    'new_item_name'              => __('New publisher name', 'infocongo'),
    'separate_items_with_commas' => __('Separate publishers with commas', 'infocongo'),
    'add_or_remove_items'        => __('Add or remove publishers', 'infocongo'),
    'choose_from_most_used'      => __('Choose from most used publishers', 'infocongo'),
    'menu_name'                  => __('Publishers', 'infocongo')
  );

  $args = array( 
    'labels'                     => $labels,
    'public'                     => true,
    'show_in_nav_menus'          => true,
    'show_ui'                    => true,
    'show_tagcloud'              => true,
    'hierarchical'               => true,
    'show_admin_column'          => true,
    'capability_type'            => 'post',
    'rewrite'                    => array('slug' => 'publisher', 'with_front' => false),
    'query_var'                  => 'publisher'
  );

  register_taxonomy('publisher', array('post'), $args);

}
add_action( 'jeo_init', 'register_taxonomies' );


// post views
function ic_set_post_views($postID) {
    $count_key = 'ic_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// add post views tracker on wp_head
function ic_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    ic_set_post_views($post_id);
}
add_action( 'wp_head', 'ic_track_post_views');

register_nav_menus( array(
  'footer_menu' => 'Footer Menu',
) );

add_filter("manage_posts_columns", "my_post_edit_columns" );
function my_post_edit_columns($columns){
    unset($columns['categories']);
    unset($columns['tags']);
    return $columns;
}