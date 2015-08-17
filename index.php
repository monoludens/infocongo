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
<?php $first_query = new WP_Query('cat=Featured&posts_per_page=1');
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
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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

<?php $second_query = new WP_Query( array( 'taxonomy' => 'topic', 'term' => 'Deforestation', 'posts_per_page' => 4)); ?>
<div class="list-content">
	<div class="container">
		<div class="three columns">
			<h2><?php _e( 'Topics' ) ?></h2>
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
				'taxonomy'           => 'topic',
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
					<h6> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
					<div class="post-list-icon">
						<span class="icon_pin_alt"></span><span><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></span>
					</div>
				</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>








<?php $third_query = new WP_Query( array( 'taxonomy' => 'country')); ?>
<div class="list-content">
	<div class="container">
		<div class="three columns">
			<h2><?php _e( 'Countries', 'infocongo' ) ?></h2>
			<ul id="topic-list">
				<?php
				$terms = get_terms( 'country' );
				 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
				     foreach ( $terms as $term ) {
				       echo '<li id="' . $term->slug . '">' . $term->name . '</li>';
				     }
				 }
				 ?>
			</ul>
		</div>
		<div class="nine columns">
			<div class="topic-content">
				<ul>
				<?php while($third_query->have_posts()) : $third_query->the_post(); ?>
					<?php $tax = 'country'; ?>
						<?php $tax_post = wp_get_object_terms( $post->ID, $tax ); ?>
						<li id="<?php foreach($tax_post as $slug) { 
								echo $slug->slug . " ";	
							}?>" class="home-post-list">
							
								<?php if(has_post_thumbnail()) {                    
								    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-list' );
								     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
								} ?>
								<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
								<span class="icon_pin_alt"></span><span><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></span>
							</li>					
				<?php endwhile; ?>
				</ul>
				<a href="<?php foreach($tax_post as $slug) { 
								echo $slug->slug . " ";	
							}?>" class="button"> <?php _e('See all stories about this topic', 'infocongo'); ?></a>
			</div>
					
				<script>
	
					  $(document).ready(function() {

					  var $list = $('#topic-list li');
					  var $content = $('.topic-content li');

					  $list.click(function() {

					      $list.removeClass('active');
					      $content.removeClass('active');

					      var $c = $(this).attr('id');
					      $(this).addClass('active');
					      $content.each(function() {
					          if ($(this).attr('id').indexOf($c)) {
					              $(this).addClass('active');
					          }
					      });

					  });
					});
				</script>
		</div>
	</div>
</div>

<?php wp_reset_postdata(); ?>
<?php
	$args = array(
	    //'meta_key' => 'post_views_count',
	    //'orderby' => 'meta_value_num',
	    'order' => 'ASC'
	);
	$fourth_query = new WP_Query($args); 
?>

<div class="popular-content">
	<div class="container">
		<div class="three columns">
			<h2>Popular posts</h2>
			<p>lorem ipsum dolor sit amet</p>
			<a href="" class="button">Submit a story</a>
		</div>
		<div class="one column spacer"></div>
		<div class="slider">
		<?php while( $fourth_query->have_posts() ) : $fourth_query->the_post(); ?>
			<div id="home-slider">
					<div class="popular-thumb">
					<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-slider' );
					    echo '<img src="' . $image_src[0]  . '" width="100%"  />';
				    ?>
				</div>
				<div class="slider-content">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="excerpt"><?php the_excerpt(); ?></div>
				</div>
				<div class="slider-meta">
					<div class="meta-author"><span class="meta-icons icon_pencil"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'publisher', ' ', ', ' ); ?></p></span></div>
					<div class="meta-country"><span class="meta-icons icon_pin_alt"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></p></span></div>
					<div class="meta-topic"><span class="meta-icons icon_tag_alt"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'topic', ' ', ', ' ); ?></p></span></div>
				</div>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
</div>
<?php wp_reset_postdata(); ?>


<?php get_footer(); ?>
