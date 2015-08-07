<?php get_header(); ?>

<div class="container">
	<div class="ten offset-by-one columns">
		<h1>	</h1>
		<p></p>
		<div class="meta-icons">
			<span class="icon"></span>
			<span></span>
			<span></span>
		</div>
		<div class="meta-icons">
			<span class="icon"></span>
			<span></span>
			<span></span>
		</div>
		<div class="meta-icons">
			<span class="icon"></span>
			<span></span>
			<span></span>
		</div>
	</div>
</div>	

<div class="map-container">
	<div id="map_<?php echo jeo_get_map_id(); ?>" class="map">
		<?php get_template_part('stage', 'map'); ?>
	</div>
</div>

<?php get_footer(); ?>