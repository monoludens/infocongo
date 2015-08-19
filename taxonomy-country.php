<?php get_header(); ?>
	<section id="content">
		<div id="map-archive" class="gray-page archive-page">
			<div class="container">
				<section id="maps" class="map-loop-section archive-list">
					<div class="twelve columns">
						<header class="page-header">
						<?php infocongo_taxonomy_filter('Choose a country', 'country'); ?>
								<div style="width:100%;height:500px;">
									<?php
										global $jeo;
										$jeo->get_map(false, false, true); 
									?>
								</div>


						</header>
					</div>
					<?php get_template_part('loop'); ?>
				</section>
			</div>
		</div>
	</section>
<?php get_footer(); ?>