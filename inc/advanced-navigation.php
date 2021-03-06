<?php

/*
 * infoamazonia
 * Advanced navigation
 */


class infoamazonia_AdvancedNav {

	var $prefix = 'infoamazonia_filter_';
	var $slug = 'explore';

	function __construct() {

		add_filter('query_vars', array($this, 'query_vars'));
		add_filter('body_class', array($this, 'body_class'));
		add_action('pre_get_posts', array($this, 'pre_get_posts'));
		add_action('generate_rewrite_rules', array($this, 'generate_rewrite_rules'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 110);

	}

	function query_vars($vars) {
		$vars[] = 'infoamazonia_advanced_nav';
		return $vars;
	}

	function body_class($class) {
		if(get_query_var('infoamazonia_advanced_nav'))
			$class[] = 'advanced-nav';
		return $class;
	}

	function generate_rewrite_rules($wp_rewrite) {
		$widgets_rule = array(
			$this->slug . '$' => 'index.php?infoamazonia_advanced_nav=1'
		);
		$wp_rewrite->rules = $widgets_rule + $wp_rewrite->rules;
	}

	function pre_get_posts($query) {

		if($query->is_main_query()) {

			if($query->get('infoamazonia_advanced_nav')) {
				$query->is_home = false;
				$query->set('posts_per_page', 30);
				$query->set('ignore_sticky_posts', true);
			}

			if(isset($_GET[$this->prefix . 's'])) {

				$query->set('s', $_GET[$this->prefix . 's']);

			}

			if(isset($_GET[$this->prefix . 'category'])) {

				$query->set('category__in', $_GET[$this->prefix . 'category']);

			}

			if(isset($_GET[$this->prefix . 'date_start'])) {

				$after = $_GET[$this->prefix . 'date_start'];
				$before = $_GET[$this->prefix . 'date_end'];

				if($after) {

					if(!$before)
						$before = date('Y-m-d H:i:s');

					$query->set('date_query', array(
						array(
							'after' => date('Y-m-d H:i:s', strtotime($after)),
							'before' => date('Y-m-d H:i:s', strtotime($before)),
							'inclusive' => true
						)
					));
				}

			}

		}

	}

	function enqueue_scripts() {

		wp_enqueue_script('chosen');
		wp_enqueue_script('moment-js');
		wp_enqueue_style('chosen', get_stylesheet_directory_uri() . '/css/chosen.css');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-ui-smoothness', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');

	}

	function form() {

		?>
		<div class="container">
			<form class="advanced-nav-filters <?php if($_GET[$this->prefix]) echo 'active'; ?>">
				<div class="four columns">
					<input type="hidden" name="<?php echo $this->prefix; ?>" value="1" />
					<div class="search-input adv-nav-input">
						<!--
						<p class="label"><label for="<?php echo $this->prefix; ?>s"><?php _e('Text search', 'infoamazonia'); ?></label></p>
						-->
						<input type="text" id="<?php echo $this->prefix; ?>s" name="<?php echo $this->prefix; ?>s" placeholder="<?php _e('Type your search here', 'infoamazonia'); ?>" value="<?php echo (isset($_GET[$this->prefix . 's'])) ? $_GET[$this->prefix . 's'] : ''; ?>" />
					</div>
				</div>
				<div class="date-from-container three columns">
					<label class="sublabel" for="<?php echo $this->prefix; ?>date_start"><?php _e('From', 'infoamazonia'); ?></label>
					<input type="text" class="date-from" id="<?php echo $this->prefix; ?>date_start" name="<?php echo $this->prefix; ?>date_start" value="<?php echo (isset($_GET[$this->prefix . 'date_start'])) ? $_GET[$this->prefix . 'date_start'] : ''; ?>" />
				</div>
				<div class="date-to-container three columns">
					<label class="sublabel" for="<?php echo $this->prefix; ?>date_end"><?php _e('To', 'infoamazonia'); ?></label>
					<input type="text" class="date-to" id="<?php echo $this->prefix; ?>date_end" name="<?php echo $this->prefix; ?>date_end" value="<?php echo (isset($_GET[$this->prefix . 'date_end'])) ? $_GET[$this->prefix . 'date_end'] : ''; ?>" />
				</div>
				<div class="two columns filter-button">
					<input type="submit" class="button" value="<?php _e('Filter', 'infoamazonia'); ?>" />
				</div>
			</form>
		</div>
		<script type="text/javascript">
			(function($) {

				$(document).ready(function() {

					var advNav = $('.advanced-nav-filters');

					if(advNav.hasClass('active')) {
						$('.toggle-more-filters a').text('<?php _e('Cancel filters', 'infoamazonia'); ?>');
					}

					$('.toggle-more-filters a').click(function() {

						if(advNav.hasClass('active')) {
							$(advNav).removeClass('active');
							window.location = '<?php echo remove_query_arg(array($this->prefix, $this->prefix . 's', $this->prefix . 'category', $this->prefix . 'date_start', $this->prefix . 'date_end')); ?>';
							$(this).text('<?php _e('More filters', 'infoamazonia'); ?>');
						} else {
							$(advNav).addClass('active');
							$(this).text('<?php _e('Cancel filters', 'infoamazonia'); ?>');
						}

						return false;

					});

					$('.category-input select').chosen();

					var min = null;
					var max = null;
					<?php if($before && $after) : ?>
						min = moment('<?= $before; ?>').toDate();
						max = moment('<?= $after; ?>').toDate();
					<?php endif; ?>

					$('.date-from').datepicker({
						defaultDate: min,
						changeMonth: true,
						changeYear: true,
						numberOfMonths: 1,
						maxDate: max,
						minDate: min
					});

					$('.date-to').datepicker({
						defaultDate: max,
						changeMonth: true,
						changeYear: true,
						numberOfMonths: 1,
						maxDate: max,
						minDate: min
					});

				});

			})(jQuery);
		</script>
		<?php

	}

}

$GLOBALS['infoamazonia_adv_nav'] = new infoamazonia_AdvancedNav();

function infoamazonia_adv_nav_filters() {
	return $GLOBALS['infoamazonia_adv_nav']->form();
}

?>
