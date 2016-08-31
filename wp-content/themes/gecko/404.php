<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @since   1.0.0
 * @package Gecko
 */
get_header(); ?>

<div id="jas-content">
	<div class="jas-container">
		<section class="error-404 not-found">
			<div id="content-wrapper">
				<h1>404</h1>
				<h3 class="page-title"><?php esc_html_e( 'Sorry! Page you are looking can&rsquo;t be found.', 'gecko' ); ?></h3>
				<p><?php esc_html_e('Go back to the ','gecko'); ?><a href="<?php echo esc_url( home_url( '/' ) ) ;?>" rel="home"><?php esc_html_e('homepage' ,'gecko' ); ?></a></p>
			</div>
		</section><!-- .error-404 -->
	</div><!-- #jas-container -->
</div><!-- #jas-content -->


<?php get_footer(); ?>