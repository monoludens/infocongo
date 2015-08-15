<div class="sub-header clearfix">

	<?php if(is_tax('country')) : ?>
		<div class="choose-filter">
			<?php
			$countrys = get_terms('country');
			$title = '<span class="title">' . __('Choose a country', 'infoamazonia') . '</span>';
			$current_country = false;
			if(is_tax('country')) {
				$current_country = get_query_var('country');
				$current_country = get_term_by('slug', $country, 'country');
				$title = '<h1 class="title">' . $current_country->name . '</h1>';
			}
			if($countrys) : ?>
				<div class="box clearfix">
						<span class="arrow"></span>
						<?php echo $title; ?>
				</div>
				<ul>
					<?php if($current_country) : ?>
						<li class="filter"><a href="<?php echo home_url('/'); ?>" title="<?php _e('All stories', 'infoamazonia'); ?>"><?php _e('All stories', 'infoamazonia'); ?></a></li>
					<?php endif; ?>
					<?php foreach($countrys as $country) : ?>
						<?php if($current_country && $country->slug == $current_country->slug) continue; ?>
						<li class="filter"><a href="<?php echo get_term_link($country); ?>" title="<?php echo $country->name; ?>"><?php echo $country->name; ?></a></li>
					<?php endforeach; ?>
				</ul>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('#stage .choose-filter .box').toggle(function() {
							$(this).parent().addClass('active');
						}, function() {
							$(this).parent().removeClass('active');
						});
					});
				</script>
			<?php endif; ?>
		</div>
		<div class="toggle-more-filters">
			<a href="javascript:void(0);"><?php _e('More filters', 'infoamazonia'); ?></a>
		</div>
		<div class="clearfix"></div>
		<div class="more-filters">
			<div class="more-filters-content">
				<?php infoamazonia_adv_nav_filters(); ?>
			</div>			
		</div>
		<?php endif; ?>
</div>