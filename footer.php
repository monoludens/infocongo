
	</div><!-- .site-content -->

	<footer id="site-footer">
	<div class="main-footer container">
		<div class="six columns block">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-footer.png" alt="">
			<div class="row">
				<div class="one-half column">
					<p class="footer-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
				</div>
				<div class="one-half column">
					<?php wp_nav_menu( array( 'theme_location' => 'footer_menu' ) ); ?>
				</div>
			</div>
		</div>
		<div class="six columns supports">
			<div class="twelve columns">
				<div class="row">
					<h4><?php _e( 'A project by' ) ?></h4>
					<a href="http://internews.org" class="logos internews"></a>
					<a href="http://internews.org" class="logos earth"></a>	
				</div>
				<div class="row">
					<h4><?php _e( 'Supported by' ) ?></h4>
					<a href="http://internews.org" class="logos carpe"></a>	
					<a href="http://internews.org" class="logos usaid"></a>	
				</div>
			</div>
		</div>
	</div>
	<div id="site-info">
		<div class="container">
			<div class="one-half columns">
				<p class="colophon">site by<span></span><span class="cardume-logo"></span>code by<span class="oniricca-logo"></span></p>
			</div>
			<div class="one-half columns">
				<p class="footer-social-icons"></p>
			</div>
		</div>
	</div><!-- .site-info -->
	</footer><!-- .site-footer -->
</div> <!-- .container -->
<?php wp_footer(); ?>

</body>
</html>
