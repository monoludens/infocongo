<?php get_header(); ?>


<div id="intro" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/examples/intro-header.png)">
	<div class="container">
		<div class="row">
			<div class="three columns spacer"></div>
			<div class="six columns slider-logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-intro.png" alt=""></div>
			<div class="three columns spacer"></div>
		</div>
		<div class="row">
			<div class="three columns spacer"></div>
			<div class="six columns slider-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod </div>
			<div class="three columns spacer"></div>
		</div>
	</div>
</div>

<div id="featured-content">
	<div class="container">
		<div class="row">
			<div class="six columns"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/examples/featured.png" alt=""></div>
			<div class="one column spacer"></div>
			<div class="five columns">
				<h2>story title</h2>
				<div><span class="icon author-icon"></span><p class=""><b>author:</b></p></div>
				<div><span class="icon place-icon"></span><p class=""><b>place:</b></p></div>
				<div><span class="icon topic-icon"></span><p class=""><b>topics:</b></p></div>
				<p class="excerpt"></p>
				<button></button>
			</div>
		</div>
	</div>
</div>
<div id="list-content">
	<div class="container">
		<div class="three columns">
			<h2>Topics:</h2>
			<ul>
				<li></li>
			</ul>
		</div>
		<div class="nine columns">
			<ul>
				<li>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/examples/topics.png" alt="">
					<h6>Understanding the DRC deforestation Conundrum</h6>
					<span class="icon place-icon"></span>
				</li>
			</ul>
		</div>
	</div>
</div>

<?php get_footer(); ?>
