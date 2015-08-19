<?php while(have_posts()) : the_post(); ?>
	<div id="main-map" <?php post_class('stage-map'); ?>>
		<?php jeo_map(); ?>
		<div class="query-actions">
			<?php
			global $wp_query;
			$args = $wp_query->query;
			$args = array_merge($args, $_GET);
			$geojson = jeo_get_api_url($args);
			$download = jeo_get_api_download_url($args);
			$rss = add_query_arg(array('feed' => 'rss'));
			?>
			<a class="rss" href="<?php echo $rss; ?>"><?php _e('RSS Feed', 'infoamazonia'); ?></a>
			<a class="geojson" href="<?php echo $geojson; ?>"><?php _e('Get GeoJSON', 'infoamazonia'); ?></a>
			<a class="download" href="<?php echo $download; ?>"><?php _e('Download', 'infoamazonia'); ?></a>
		</div>
	</div>
<?php endwhile; ?>