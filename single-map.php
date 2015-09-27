<?php get_header(); ?>

<section id="stage">
<?php get_template_part('stage', 'map'); ?>
	<div class="container">
		<div class="twelve columns">			
		</div>
	</div>
</section>


	<?php
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$query = array(
		'paged' => $paged,
		's' => isset($_GET['s']) ? $_GET['s'] : null
	);
	query_posts($query);
	if(have_posts()) : ?>

    <div class="container">
		<div class="row">
			<div class="twelve columns">
				<div class="section-title">
				<h1>Stories on &ldquo;<?php echo the_title(); ?>&ldquo;</h1>
					<div class="query-actions">
						<?php
						global $wp_query;
						$args = $wp_query->query;
						$args = array_merge($args, $_GET);
						$geojson = jeo_get_api_url($args);
						$download = jeo_get_api_download_url($args);
						$rss = add_query_arg(array('feed' => 'rss'));
						?>
						<a class="rss" href="<?php echo $rss; ?>"><?php _e('RSS Feed', 'infocongo'); ?></a>
						<a class="geojson" href="<?php echo $geojson; ?>"><?php _e('Get GeoJSON', 'infocongo'); ?></a>
						<a class="download" href="<?php echo $download; ?>"><?php _e('Download', 'infocongo'); ?></a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve-coluns">
					<?php get_template_part('loop'); ?>
				</div>
			</div>
		</div>
	</div>
    <div class="container">
        <?php get_template_part('loop'); ?>
    </div>
</section>

	<?php
	endif;
	wp_reset_query(); ?>

	<?php get_template_part('section', 'submit-call'); ?>
<ul class="share">
				<li class="facebook">
					<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="verdana" data-action="recommend"></div>
				</li>
				<li class="twitter">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="infoamazonia" data-lang="<?php if(function_exists('qtrans_getLanguage')) echo qtrans_getLanguage(); ?>">Tweet</a>
				</li>
				<li class="share">
					<a class="button share-button" href="<?php echo jeo_get_share_url(array('map_id' => $post->ID)); ?>"><?php _e('Embed this map', 'infoamazonia'); ?></a>
				</li>
			</ul>


<?php get_footer(); ?>
