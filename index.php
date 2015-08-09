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
					<div><span class="icon_pencil"></span><span class=""><b><?php echo get_the_term_list( $post->ID, 'publisher', ' ', ', ' ); ?></b></span></div>
					<div><span class="icon_pin_alt"></span><span class=""><b><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></b></span></div>
					<div><span class="icon_tag_alt"></span><span class=""><b><?php echo get_the_term_list( $post->ID, 'topic', ' ', ', ' ); ?></b></span></div>
					<p class="excerpt"><?php the_excerpt(); ?></p>
					<a class="button read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'infocongo'); ?></a>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<?php $second_query = new WP_Query( array( 'taxonomy' => 'Topic', 'term' => 'Deforestation', 'posts_per_page' => 4)); ?>
<div class="list-content">
	<div class="container">
		<div class="three columns">
			<h2><?php echo __( 'Topics' ) ?></h2>
			<?php 
			    $args = array(
				'show_option_all'    => '',
				'orderby'            => 'name',
				'order'              => 'ASC',
				'style'              => 'list',
				'hide_empty'         => 1,
				'use_desc_for_title' => 1,
				'title_li'           => __( '' ),
				'number'             => null,
				'echo'               => 1,
				'depth'              => 0,
				'current_category'   => 1,
				'pad_counts'         => 0,
				'taxonomy'           => 'Topic',
				'walker'             => null
			    );
			    wp_list_categories( $args ); 
			?>
					</div>
		<div class="nine columns">
			<ul>
			<?php while($second_query->have_posts()) : $second_query->the_post(); ?>
				<li class="home-post-list">
					<?php if(has_post_thumbnail()) {                    
					    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-list' );
					     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
					} ?>
					<h6> <a href=" <?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
					<span class="icon_pin_alt"><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></span>
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
			<h2><?php echo __( 'Countries' ) ?></h2>
			<?php 
			    $args = array(
				'show_option_all'    => '',
				'orderby'            => 'name',
				'order'              => 'ASC',
				'style'              => 'list',
				'hide_empty'         => 1,
				'use_desc_for_title' => 1,
				'title_li'           => __( '' ),
				'number'             => null,
				'echo'               => 1,
				'depth'              => 0,
				'current_category'   => 1,
				'pad_counts'         => 0,
				'taxonomy'           => 'Country',
				'walker'             => null
			    );
			    wp_list_categories( $args ); 
			?>
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
					<span class="icon_pin_alt"></span><span><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></span>
				</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
