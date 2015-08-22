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

// Advanced Navigation
include(STYLESHEETPATH . '/inc/advanced-navigation.php');

//Submit Story
include(STYLESHEETPATH . '/inc/submit-story.php');

 // geocode box
include(STYLESHEETPATH . '/inc/geocode-box.php');

/*
 * Clears JEO default front-end styles and scripts
 */
function infocongo_scripts() {

	// deregister jeo styles
	wp_deregister_style('jeo-main');

  // deregister jeo site frontend infocongo_scripts 
  //wp_deregister_script('jeo-site');

  // Chosen
  wp_enqueue_script('chosen', get_stylesheet_directory_uri() . '/lib/chosen.jquery.min.js', array('jquery'));

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

	// Enqueue main CSS (with grid system dependency)
  wp_enqueue_style('infocongo-styles', get_stylesheet_directory_uri() . '/css/main.css', array('infocongo-skeleton'));

}
add_action('jeo_enqueue_scripts', 'infocongo_jeo_scripts', 20);

// Filter to change posts GeoJSON data (also changes the GeoJSON API output)
function infocongo_marker_data($data, $post) {

global $post;

  $permalink = $data['url'];

  if(function_exists('qtrans_getLanguage'))
   $permalink = add_query_arg(array('lang' => qtrans_getLanguage()), $permalink);

  $data['permalink'] = $permalink;
  $data['url'] = $permalink;
  $data['content'] = get_the_excerpt();
  if(get_post_meta($post->ID, 'geocode_zoom', true))
    $data['zoom'] = get_post_meta($post->ID, 'geocode_zoom', true);

  // source
  $publishers = get_the_terms($post->ID, 'publisher');
  if($publishers) {
    $publisher = array_shift($publishers);
    $data['source'] = apply_filters('single_cat_title', $publisher->name);
  }

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
  add_image_size( 'loop-list', 300, 200, array( 'center', 'top' ));
  add_image_size( 'home-slider', 540, 200, array( 'center', 'top' ));
  add_image_size( 'archive-list', 220, 220, array( 'center', 'top' ));

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

    $labels = array(
    'name'                       => _x( 'Authors', 'Taxonomy General Name', 'infocongo' ),
    'singular_name'              => _x( 'Author', 'Taxonomy Singular Name', 'infocongo' ),
    'menu_name'                  => __( 'Authors', 'infocongo' ),
    'all_items'                  => __( 'All Authors', 'infocongo' ),
    'parent_item'                => __( 'Parent Authors', 'infocongo' ),
    'parent_item_colon'          => __( 'Parent Author:', 'infocongo' ),
    'new_item_name'              => __( 'New Author Name', 'infocongo' ),
    'add_new_item'               => __( 'Add New Author', 'infocongo' ),
    'edit_item'                  => __( 'Edit Author', 'infocongo' ),
    'update_item'                => __( 'Update Author', 'infocongo' ),
    'view_item'                  => __( 'View Author', 'infocongo' ),
    'separate_items_with_commas' => __( 'Separate Author with commas', 'infocongo' ),
    'add_or_remove_items'        => __( 'Add or remove Author', 'infocongo' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'infocongo' ),
    'popular_items'              => __( 'Popular Authors', 'infocongo' ),
    'search_items'               => __( 'Search Authors', 'infocongo' ),
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
    'rewrite'                    => array('slug' => 'author', 'with_front' => false),
    'query_var'                  => 'author'
  );
  register_taxonomy( 'author', array( 'post' ), $args );

}
add_action( 'jeo_init', 'register_taxonomies' );


register_nav_menus( array(
  'footer_menu' => 'Footer Menu',
) );

add_filter("manage_posts_columns", "my_post_edit_columns" );
function my_post_edit_columns($columns){
    unset($columns['categories']);
    unset($columns['tags']);
    return $columns;
}

//limit excerpt length
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

//limit content length
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  } 
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

//limit title length
function title($limit) {
  $title = explode(' ', get_the_title(), $limit);
  if (count($title)>=$limit) {
    array_pop($title);
    $title = implode(" ",$title).'...';
  } else {
    $title = implode(" ",$title);
  } 
  $title = preg_replace('/\[.+\]/','', $title);
  $title = apply_filters('the_title', $title); 
  $title = str_replace(']]>', ']]&gt;', $title);
  return $title;
}


function infocongo_submit_story() {
  wp_register_script('submit-story', get_stylesheet_directory_uri() . '/js/submit-story.js', array('jquery'), '0.1.1');

  wp_enqueue_script('submit-story');

  wp_localize_script('submit-story', 'infoamazonia_submit', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'success_label' => __('Success! Thank you, your story will be reviewed by one of our editors and soon will be online.', 'infoamazonia'),
    'redirect_label' => __('You\'re being redirect to the home page in 4 seconds.', 'infoamazonia'),
    'home' => home_url('/'),
    'error_label' => __('Oops, please try again in a few minutes.', 'infoamazonia')
  ));
}
add_action('wp_enqueue_scripts', 'infocongo_submit_story', 100);

