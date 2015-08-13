<?php get_header(); ?>


<?php if(have_posts()) : the_post(); ?>

	<div id="single-post-map" class="container">
		<div class="twelve columns">
			<?php get_template_part('stage', 'map'); ?>
		</div>
	</div>

	<div style="width:100%;height:500px;">
		<?php
		global $jeo;
		$jeo->get_map(false, false, true); 
		?>
	</div>

		
	<article id="single-post">
		<section id="content">	
			<div class="container">
				<div class="row post-header">
					<div class="twelve columns">
						<h1><?php the_title(); ?></h1>
						<p class="post-excerpt"><?php the_excerpt(); ?></p>
					</div>
				</div>
				<div class="row post-meta">
					<div class="four columns"><span class="icon_pencil"></span><span class=""><b><?php echo get_the_date(); ?> | <?php echo get_the_term_list( $post->ID, 'publisher', ' ', ', ' ); ?></b></span></div>
					<div class="four columns"><span class="icon_pin_alt"></span><span class=""><b><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></b></span></div>
					<div class="four columns"><span class="icon_tag_alt"></span><span class=""><b><?php echo get_the_term_list( $post->ID, 'topic', ' ', ', ' ); ?></b></span></div>
				</div>
				<div class="row post-content">
					<div class="ten offset-by-one columns">
						<?php the_content(); ?>
					</div>
					<script type="text/javascript">
						var embedUrl = jQuery('.embed-button').attr('href');
						var printUrl = jQuery('.print-button').attr('href');
						jeo.mapReady(function(map) {
							if(map.conf.postID) {
								jQuery('.print-button').attr('href', printUrl + '&map_id=' + map.conf.postID + '#print');
								jQuery('.embed-button').attr('href', embedUrl + '&map_id=' + map.conf.postID);
							}
						});
						jeo.groupReady(function(group) {
							jQuery('.print-button').attr('href', printUrl + '&map_id=' + group.currentMapID + '#print');
							jeo.groupChanged(function(group, prevMap) {
								jQuery('.print-button').attr('href', printUrl + '&map_id=' + group.currentMapID + '#print');
							});
						});
					</script>
				</div>
			</div>
		</section>
	</article>
<?php endif; ?>

<?php get_template_part('section', 'main-widget'); ?>

<?php get_footer(); ?>
