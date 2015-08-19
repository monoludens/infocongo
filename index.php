<?php get_header(); ?>
<script>
	$.noConflict();
	jQuery( document ).ready(function( $ ) {

		var $topic_list = $('#topic-list li');
		var $topic_content = $('.topic-content li');
		var $topic_list_first = $('#topic-list li:first-child');
		var $topic_a = $topic_list_first.attr('id');

		$topic_list_first.addClass('active');
		$topic_content.each(function() {
			if ($(this).attr('id').indexOf($topic_a)) {
				$(this).addClass('active');
			}
		});

		$topic_list.click(function() {

			$topic_list.removeClass('active');
			$topic_content.removeClass('active');

			var $topic_b = $(this).attr('id');
			$(this).addClass('active');
			$topic_content.each(function() {
				if ($(this).attr('id').indexOf($topic_b)) {
					$(this).addClass('active');
				}
			});
		});

		var $country_list = $('#country-list li');
		var $country_content = $('.country-content li');
		var $country_list_first = $('#country-list li:first-child');
		var $country_a = $country_list_first.attr('id');

		$country_list_first.addClass('active');
		$country_content.each(function() {
			if ($(this).attr('id').indexOf($country_a)) {
				$(this).addClass('active');
			}
		});

		$country_list.click(function() {

			$country_list.removeClass('active');
			$country_content.removeClass('active');

			var $country_b = $(this).attr('id');
			$(this).addClass('active');
			$country_content.each(function() {
				if ($(this).attr('id').indexOf($country_b)) {
					$(this).addClass('active');
				}
			});
		});
	});
</script>


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

<!-- Featured -->
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
				<div id="home-featured" class="five columns offset-by-one column">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="featured-meta">
						<div class="meta-author"><span class="meta-icons icon_pencil"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'publisher', ' ', ', ' ); ?></p></span></div>
						<div class="meta-country"><span class="meta-icons icon_pin_alt"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></p></span></div>
						<div class="meta-topic"><span class="meta-icons icon_tag_alt"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'topic', ' ', ', ' ); ?></p></span></div>
					</div>
					<div class="excerpt"><?php the_excerpt(); ?></div>
					<a class="button read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'infocongo'); ?></a>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<!-- Topics -->
<?php $second_query = new WP_Query( array( 'taxonomy' => 'topic')); ?>
	<div class="list-content">
		<div class="container">
			<div class="three columns">
				<h2><?php _e( 'Topics', 'infocongo' ) ?></h2>
				<ul id="topic-list">
					<?php
					$terms = get_terms( 'topic' );
					 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					     foreach ( $terms as $term ) {
					       echo '<li id="' . $term->slug . '">' . $term->name . '</li>';
					     }
					 }
					 ?>
				</ul>
			</div>
			
				<div class="topic-content">
					<ul>
						<?php while($second_query->have_posts()) : $second_query->the_post(); ?>
							<?php $tax = 'topic'; ?>
								<?php $tax_post = wp_get_object_terms( $post->ID, $tax ); ?>
								<li id="<?php foreach($tax_post as $slug) { 
										echo $slug->slug . " ";	
									}?>" class="home-post-list">
									
										<?php if(has_post_thumbnail()) {                    
										    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-list' );
										     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
										} ?>
										<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
										<div class="post-list-country">
											<span class="icon_pin_alt"></span>
											<span><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></span>
										</div>
										</li>					
						<?php endwhile; ?>
					</ul>
					<!--<a href="<?php foreach($tax_post as $slug) { 
							echo $slug->slug . " ";	
						}?>" class="button"> <?php _e('See all stories about this topic', 'infocongo'); ?>
					</a>-->
				</div>
			
		</div>
	</div>
<?php wp_reset_postdata(); ?>
<!-- Country -->
<?php $third_query = new WP_Query( array( 'taxonomy' => 'country')); ?>
	<div class="list-content">
		<div class="container">
			<div class="three columns">
				<h2><?php _e( 'Countries', 'infocongo' ) ?></h2>
				<ul id="country-list">
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
				<div class="country-content">
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
										<div class="post-list-country">
											<span class="icon_pin_alt"></span>
											<span><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></span>
										</div>
									</li>					
						<?php endwhile; ?>
					</ul>
					<!--<a href="<?php foreach($tax_post as $slug) { 
							echo $slug->slug . " ";	
						}?>" class="button"> <?php _e('See all stories about this topic', 'infocongo'); ?>
					</a>-->
				</div>
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

<!-- Popular -->
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
