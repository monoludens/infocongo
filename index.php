<?php get_header(); ?>


<div id="intro" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/examples/intro-header.png)">
	<div class="container">
		<div class="row">
			<div class="six columns offset-by-three column intro-logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-intro.png" alt=""></div>
		</div>
		<div class="row">
			<div class="six columns offset-by-three column intro-text"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p></div>
		</div>
	</div>
</div>
<?php $first_query = new WP_Query('cat=3&posts_per_page=1');
	while($first_query->have_posts()) : $first_query->the_post();
?>
	<div id="featured-content">
		<div class="container">
			<div class="row">
				<div class="six columns">
					<?php if(has_post_thumbnail()) {                    
					    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured' );
					     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
					} ?>
				</div>
				<div class="one column spacer"></div>
				<div class="five columns offset-by-one column">
					<h2><?php the_title(); ?></h2>
					<div><span class="icon_pencil"></span><span class=""><b>author:</b></span></div>
					<div><span class="icon_pin_alt"></span><span class=""><b>place:</b></span></div>
					<div><span class="icon_tag_alt"></span><span class=""><b>topics:</b></span></div>
					<p class="excerpt"></p>
					<button>Read More</button>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<?php $second_query = new WP_Query('cat=-3&posts_per_page=4'); ?>
<div class="list-content">
	<div class="container">
		<div class="three columns">
			<h2>Topics:</h2>
			<ul>
				<li></li>
			</ul>
		</div>
		<div class="nine columns">
			<ul>
			<?php while($second_query->have_posts()) : $second_query->the_post(); ?>
				<li class="home-post-list">
					<?php if(has_post_thumbnail()) {                    
					    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-list' );
					     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
					} ?>
					<h6><?php the_title(); ?></h6>
					<span class="icon_pin_alt"></span>
				</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>

<?php $third_query = new WP_Query('cat=-3&posts_per_page=4'); ?>
<div class="list-content">
	<div class="container">
		<div class="three columns">
			<h2>Countries:</h2>
			<ul>
				<li></li>
			</ul>
		</div>
		<div class="nine columns">
			<ul>
			<?php while($third_query->have_posts()) : $third_query->the_post(); ?>
				<li class="home-post-list">
					<?php if(has_post_thumbnail()) {                    
					    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-list' );
					     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
					} ?>
					<h6><?php the_title(); ?></h6>
					<span class="icon_pin_alt"></span>
				</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
