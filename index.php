<?php /**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package boatdealer
 * 
 * @since boatdealer 1.0
 */
$boatdealer_blog_style = trim(get_theme_mod('boatdealer_blog_style', '3'));
$boatdealer_blog_style = esc_attr($boatdealer_blog_style);


get_header(); ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php if ($boatdealer_blog_style == '2')
    echo '<div class="boatdealer_list_view">';


if (have_posts()): ?>
 
	<?php if (is_home() && !is_front_page()): ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
	<?php endif;


    if ($boatdealer_blog_style == '3')
        echo '<div class="row boatdealer_blog_grid">';
    // Start the loop.
    while (have_posts()):
        the_post();
        /*
        * Include the Post-Format-specific template for the content.
        * If you want to override this in a child theme, then include a file
        * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        */
        if ($boatdealer_blog_style == '3')
            get_template_part('content-masonry', get_post_format());
        elseif ($boatdealer_blog_style == '2')
            get_template_part('content-list', get_post_format());
        else
            get_template_part('content', get_post_format());
        // End the loop.
    endwhile;


    if ($boatdealer_blog_style == '3' or $boatdealer_blog_style == '2')
        echo '</div>';


    // Previous/next page navigation.
    the_posts_pagination(array(
        'prev_text' => __('Previous page', 'boatdealer'),
        'next_text' => __('Next page', 'boatdealer'),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page',
            'boatdealer') . ' </span>',
        ));


    // If no content, include the "No posts found" template.
else:
   get_template_part('content', 'none');
endif;


    echo '</main><!-- .site-main -->';

    echo '</div><!-- .content-area -->';


    get_footer();


    function get_the_content_with_formatting()
    {
        $content = get_the_content();
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }
    function excerpt($limit)
    {
        $excerpt = wp_trim_words(get_the_excerpt(), $limit);
        $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
        return '<p>' . $excerpt . '</p>';
    } ?>