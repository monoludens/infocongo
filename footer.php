
	</div><!-- .site-content -->

	<footer id="site-footer">
	<div class="container">
		<div class="six columns">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-footer.png" alt="">
			<div class="one-half colun">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
			</div>
			<div class="one-half column">
				<?php wp_nav_menu( array( 'theme_location' => 'footer_menu' ) ); ?>
			</div>
		</div>
		<div class="three columns">
			<h4><?php _e( 'Topics' ) ?></h4>
			<?php 
			    $args = array(
				'show_option_all'    => '',
				'orderby'            => 'name',
				'order'              => 'ASC',
				'style'              => 'list',
				'hide_empty'         => 1,
				'use_desc_for_title' => 1,
				'title_li'           => __( '' ),
				'number'             => null,
				'echo'               => 1,
				'depth'              => 0,
				'current_category'   => 1,
				'pad_counts'         => 0,
				'taxonomy'           => 'topic',
				'walker'             => null
			    );
			    wp_list_categories( $args ); 
			?>
		</div>
		<div class="three columns">
			<h4><?php _e( 'Countries' ) ?></h4>
			<?php 
			    $args = array(
				'show_option_all'    => '',
				'orderby'            => 'name',
				'order'              => 'ASC',
				'style'              => 'list',
				'hide_empty'         => 1,
				'use_desc_for_title' => 1,
				'title_li'           => __( '' ),
				'number'             => null,
				'echo'               => 1,
				'depth'              => 0,
				'current_category'   => 1,
				'pad_counts'         => 0,
				'taxonomy'           => 'country',
				'walker'             => null
			    );
			    wp_list_categories( $args ); 
			?>
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
