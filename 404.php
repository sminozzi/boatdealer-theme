<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package boatdealer
 * 
 * @since boatdealer 1.0
 */
?>
<?php get_header(); 
?>

	<div id="primary_404" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found">
				<header class="page-header">
   			<div style="text-align:center;" >
				<img src="<?php echo get_template_directory_uri().'/images/404.png'?>" alt="Not Found" />
			</div>
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'boatdealer' ); ?></h1>
				</header><!-- .page-header -->
				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'boatdealer' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>