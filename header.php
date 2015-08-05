<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
<title><?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo('description', 'display');
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . __('Page', 'infoamazonia') . max($paged, $page);

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/icons.css" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.ico" type="image/x-icon" />
<?php wp_head(); ?>
<script>
$(document).ready( function(){
		var $et_top_menu = $( 'ul.nav' ),
			$search_icon = $( '.search-icon' );

		$search_icon.click( function() {
			var $this_el = $(this),
				$form = $this_el.siblings( '.search-form' );

			if ( $form.hasClass( 'hidden' ) ) {
				$form.css( { 'display' : 'block', 'opacity' : 0 } ).animate( { opacity : 1 }, 500 );
			} else {
				$form.animate( { opacity : 0 }, 500 );
			}

			$form.toggleClass( 'hidden' );
		} );
	})
	</script>
</head>
<body <?php body_class(); ?>>
	<div id="site-wrapper">
		<header id="main-header">
			<div class="container">
				<div class="row">
					<div class="four columns">
						<span class="site-logo">
							<a href="<?php echo home_url('/' . $lang); ?>" title="<?php echo bloginfo('name'); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-mini.png" class="logo" />
							</a>
						</span>
					</div>
					<div class="eight columns">
						<section id="main-nav">
							<div id="top-search">
								<span class="icon search-icon"></span>
								<form role="search" method="get" class="search-form hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php
									printf( '<input type="search" class="search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
										esc_attr_x( 'Search &hellip;', 'placeholder', '' ),
										get_search_query(),
										esc_attr_x( 'Search for:', 'label', '' )
									);
								?>
								</form>
							</div>
							<nav>
								<?php wp_nav_menu(); ?>
							</nav>
						</section>
					</div>
				</div>
			</div>
		</header>
		<div id="content" class="site-content">