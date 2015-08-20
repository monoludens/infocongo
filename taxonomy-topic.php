<?php get_header(); ?>
	<div id="map-archive" class="gray-page archive-page">
		<section id="maps" class="map-loop-section archive-list">
			<header class="map-header">
			<?php infocongo_taxonomy_filter('Choose a topic', 'topic'); ?>
			</header>
			<div class="taxonomy-map">
				<?php
					global $jeo;
					$jeo->get_map(false, false, true); 
				?>
			</div>
			<div class="container">
				<div class="twelve columns">
					<?php get_template_part('loop'); ?>
				</div>
			</div>
		</section>
	</div>
<?php get_footer(); ?>