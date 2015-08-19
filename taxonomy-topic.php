	<?php get_header(); ?>

	<section id="content">
		<div id="map-archive" class="gray-page archive-page">
			<div class="container">
			<?php $topics = new WP_Query( array( 'taxonomy' => 'topic')); ?>

							<?php while($topics->have_posts()) : $topic->the_post(); ?>

						<section id="maps" class="map-loop-section archive-list">
								<div class="twelve columns">
							<header class="page-header">
									<h1><?php _e('Maps', 'infocongo'); ?></h1>
							</header>
								</div>
							<?php get_template_part('loop', 'maps'); ?>
						</section>

					<?php while; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</section>

	<?php get_footer(); ?>