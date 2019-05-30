<?php
/**
 * The template for displaying search results pages.
 *
 * @package boatdealer
 * 
 * @since boatdealer 1.0
 */
get_header(); ?>

	<section id="primary_404" class="content-area">
		<main id="main" class="site-main" role="main">
<?php 
// Bill
query_posts($query_string . '&showposts=10'); 
?>
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
           	<div style="text-align:center;" >
				<img src="<?php echo get_template_directory_uri().'/images/found.jpg'?>" alt="Not Found" />
			</div>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'boatdealer' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
			// End the loop.
			endwhile;
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'boatdealer' ),
				'next_text'          => __( 'Next page', 'boatdealer' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'boatdealer' ) . ' </span>',
			) );
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );
		endif;
		?>
		</main><!-- .site-main -->
	</section><!-- .content-area -->
<?php get_footer(); ?>