<?php
/**
 * boatdealer functions and definitions
 *
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since boatdealer 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}
/**
 * boatdealer only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}
//////////// Begin New Functions
if( !function_exists('get_parent_theme_file_path'))
{
    function get_parent_theme_file_path( $file = '' ) {
    	$file = ltrim( $file, '/' );
    	if ( empty( $file ) ) {
    		$path = get_template_directory();
    	} else {
    		$path = get_template_directory() . '/' . $file;
    	}
    	return apply_filters( 'parent_theme_file_path', $path, $file );
    }
}
if( !function_exists('get_parent_theme_file_uri'))
{
    function get_parent_theme_file_uri( $file = '' ) {
    	$file = ltrim( $file, '/' );
    	if ( empty( $file ) ) {
    		$url = get_template_directory_uri();
    	} else {
    		$url = get_template_directory_uri() . '/' . $file;
    	}
    	return apply_filters( 'parent_theme_file_uri', $url, $file );
    }
}
if( !function_exists('get_theme_file_uri'))
{
    function get_theme_file_uri( $file = '' ) {
    	$file = ltrim( $file, '/' );
    	if ( empty( $file ) ) {
    		$url = get_stylesheet_directory_uri();
    	} elseif ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
    		$url = get_stylesheet_directory_uri() . '/' . $file;
    	} else {
    		$url = get_template_directory_uri() . '/' . $file;
    	}
    	return apply_filters( 'theme_file_uri', $url, $file );
    }
}
if( !function_exists('get_theme_file_path'))
{
    function get_theme_file_path( $file = '' ) {
        $file = ltrim( $file, '/' );
        if ( empty( $file ) ) {
            $path = get_stylesheet_directory();
        } elseif ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
            $path = get_stylesheet_directory() . '/' . $file;
        } else {
            $path = get_template_directory() . '/' . $file;
        }
        return apply_filters( 'theme_file_path', $path, $file );
    }
}   
/////////////// end new functions
define('BOATDEALERURL', get_theme_file_uri() );
define('BOATDEALERPATH', get_template_directory() );
$theme = wp_get_theme( );
define('BOATDEALERVERSION', $theme->version );
define('SITEURL', get_site_url() );
if ( ! function_exists( 'boatdealer_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since boatdealer 1.0
 */
function boatdealer_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on boatdealer, use a find and replace
	 * to change 'boatdealer' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'boatdealer', get_template_directory() . '/languages' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );
	/*
	 * Enable support for custom logo.
	 *
	 * @since boatdealer 1.0
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 300,
		'width'       => 300,
		'flex-height' => true,
	) );
	$color_scheme  = boatdealer_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );
	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'boatdealer_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css') );
}
endif; // boatdealer_setup
add_action( 'after_setup_theme', 'boatdealer_setup' );
/**
  *
 * @since boatdealer 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since boatdealer 1.1
 */
function boatdealer_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'boatdealer_javascript_detection', 0 );
/**
 * Enqueue scripts and styles.
 *
 * @since boatdealer 1.0
 */
function boatdealer_scripts() {
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );
	// Load our main stylesheet.
	wp_enqueue_style( 'boatdealer-style', get_stylesheet_uri() );
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'boatdealer-ie', get_template_directory_uri() . '/css/ie.css', array( 'boatdealer-style' ), '20141010' );
	wp_style_add_data( 'boatdealer-ie', 'conditional', 'lt IE 9' );
	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'boatdealer-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'boatdealer-style' ), '20141010' );
	wp_style_add_data( 'boatdealer-ie7', 'conditional', 'lt IE 8' );
    wp_enqueue_style('bootstrap1', get_template_directory_uri() . '/css/custom-bootstrap.css');  
	wp_enqueue_script( 'boatdealer-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'boatdealer-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}
	wp_enqueue_script( 'boatdealer-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'boatdealer-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'boatdealer' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'boatdealer' ) . '</span>',
	) );
    wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/slick/css/slicknav.css' );
    wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/slick/css/default.css' );
    wp_enqueue_script ( 'slickjs' , get_template_directory_uri() . '/slick/js/jquery.slicknav.js', array( 'jquery' ), '1.0.4', false );
    wp_enqueue_script('jquery-effects-core', '', '', array('jquery'));
$boatdealer_blog_style = trim(get_theme_mod('boatdealer_blog_style','3'));
$boatdealer_blog_style = esc_attr($boatdealer_blog_style);
   if ($boatdealer_blog_style == '3')  
     wp_enqueue_script( 'boatdealer-masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ), '20160816', true );
}
add_action( 'wp_enqueue_scripts', 'boatdealer_scripts' );
/**
 * Add featured image as background image to post navigation elements.
 *
 * @since boatdealer 1.0
 *
 * @see wp_add_inline_style()
 */
function boatdealer_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';
	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}
	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}
	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}
	wp_add_inline_style( 'boatdealer-style', $css );
}
add_action( 'wp_enqueue_scripts', 'boatdealer_post_nav_background' );
/**
 * Navigation
 *
 * @since boatdealer 1.0
 *
 */
// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array(
 		'top-menu' => __( 'Top Menu',      'boatdealer' ),
		'primary' => __( 'Primary Menu',      'boatdealer' ),
		'social'  => __( 'Social Links Menu', 'boatdealer' ),
	) );
/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since boatdealer 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function boatdealer_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'boatdealer_search_form_modify' );
/**
 * Implement the Custom Header feature.
 *
 * @since boatdealer 1.0
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 *
 * @since boatdealer 1.0
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Customizer additions.
 *
 * @since boatdealer 1.0
 */
/**
 * Suggest plugins.
 *
 * @since boatdealer 1.0
 */
require_once get_template_directory() . '/inc/pinstaller.php';
require get_template_directory() . '/inc/customizer.php';
/**
 * Widgets
 *
 * @since boatdealer 1.0
 *
 */
function boatdealer_widget_init()
    {
    	register_sidebar( array(
    		'name'          => __( 'Sidebar Widget Area', 'boatdealer' ),
    		'id'            => 'sidebar-1',
    		'description'   => __( 'Add widgets here to appear in your sidebar.', 'boatdealer' ),
    		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</aside>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>',
	    ) );
        register_sidebar(array(
      		'name'          => __( 'First Footer Widget', 'boatdealer' ),
            'id' => '1-footer',
      		'description'   => __( 'Add widgets here to appear in your left footer.', 'boatdealer' ),
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
            ));
        register_sidebar(array(
      		'name'          => __( 'Second Footer Widget', 'boatdealer' ),
            'id' => '2-footer',
      		'description'   => __( 'Add widgets here to appear in your center footer.', 'boatdealer' ),
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
            ));
            register_sidebar(array(
      		'name'          => __( 'Third Footer Widget', 'boatdealer' ),
            'id' => '3-footer',
      		'description'   => __( 'Add widgets here to appear in your right.', 'boatdealer' ),
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
            ));
    }
    add_action('widgets_init', 'boatdealer_widget_init');
/**
 * Tiny MCE Extra Buttons
 *
 * @since boatdealer 1.0
 *
 */
if ( ! function_exists( 'boatdealer_wp_mce_buttons' ) ) {
    function boatdealer_wp_mce_buttons( $buttons ) {
        array_unshift( $buttons, 'fontselect' ); // Add Font Select
        array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
       	array_unshift( $buttons, 6,0, 'backcolor' ); 
        return $buttons;
    }
}
add_filter( 'mce_buttons_2', 'boatdealer_wp_mce_buttons' );
/**
 * Add support to WooCommerce
 *
 * @since boatdealer 1.0
 *
 */
add_action( 'after_setup_theme', 'boatdealer_woocommerce_support' );
function boatdealer_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
function boat_sanitizehtml( $str ) {
    $allowed_html = array(
		'a' => array(
			'href' => true,
			'title' => true,
		),
		'abbr' => array(
			'title' => true,
		),
		'acronym' => array(
			'title' => true,
		),
		'b' => array(),
		'blockquote' => array(
			'cite' => true,
		),
		'cite' => array(),
		'code' => array(),
		'del' => array(
			'datetime' => true,
		),
		'em' => array(),
		'i' => array(),
		'q' => array(
			'cite' => true,
		),
		'strike' => array(),
		'strong' => array(),
	);
        wp_kses($str, $allowed_html); 
        return $str ;
    } 
if ( ! function_exists( 'boatdealer_import_files' ) ) :
 function boatdealer_import_files() {
    $important_notice = 'Important Notes:
    <br>
    We recommend to run the Demo Import on a clean WordPress installation.
    <br>
    To reset your installation (if the import fails) we recommend <a href="https://wordpress.org/plugins/wordpress-reset/" target="_blank">Wordpress Reset Plugin</a>.
    <br>
    Do not run the Demo Import multiple times, it will result in duplicated content.
    <br>
    After you import this demo, you will have to setup the slider separately.';
    return array(
        array(
            'import_file_name'           => 'Demo Import 1',
            'import_file_url'            => 'http://www.boatdealerthemes.com/demo/demo-content.xml',
            'import_widget_file_url'     => 'http://www.boatdealerthemes.com/demo/widgets.json',
            'import_customizer_file_url' => 'http://www.boatdealerthemes.com/demo/customizer.dat',
            'import_notice'              => $important_notice,
        ),
    );
}
endif;
add_filter( 'pt-ocdi/import_files', 'boatdealer_import_files' );
if ( ! function_exists( 'boatdealer_after_import' ) ) :
function boatdealer_after_import( $selected_import ) {
         //Set Menu
         $social_menu = get_term_by('name', 'social menu', 'nav_menu');
         $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
        set_theme_mod( 'nav_menu_locations' , array( 
              'primary' => $main_menu->term_id,
              'top-menu' => $main_menu->term_id,  
              'social' => $social_menu->term_id 
             ) 
        );
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Home' );
        $blog_page_id  = get_page_by_title( 'Blog' );
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'boatdealer_after_import' );
endif;
require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/class-customize.php' );
function boatdealer_admin_notice() {
                echo '<div class="updated"><p>';
                echo '<br />';
                echo '<img src="'.get_template_directory_uri().'/images/infox350.png" />';
                $bd_msg = '<h2>Welcome.  BoatDealer Theme was activated! </h2>';
                $bd_msg .= '<h3>For details and help, take a look at our Help Page at your left menu Appearance => BoatDealer Help';
                $bd_url = '  <a class="button button-primary" href="'.SITEURL.'/wp-admin/themes.php?page=boat_dealer"> or click here</a>';
                $bd_msg .= '<br />';
                $bd_msg .=  $bd_url;
                echo $bd_msg;
                echo "</p>";
                echo "</h3></div>";
}
function boatdealer_theme_was_activated() {
        add_action('admin_notices', 'boatdealer_admin_notice');
        $bill_installed = trim(get_option( 'bill_installed',''));
        if(empty($bill_installed)){
            add_option( 'bill_installed', time() );
            update_option( 'bill_installed', time() );
     } 
    }
if(is_admin())
{
    add_action("after_switch_theme", "boatdealer_theme_was_activated");
    require_once (BOATDEALERPATH . '/inc/activated-manager.php');
    

    
    // 2019
    $bill_boat_last_feedback = trim(sanitize_text_field(get_option( 'bill_boat_last_feedback','')));     
    if ($bill_boat_last_feedback != '1')   
       require_once (BOATDEALERPATH . "/inc/feedback-last.php");

	require_once (BOATDEALERPATH . '/inc/health.php');
   // end 2019    
    
    
    
    
    if(memory_status())   
       require_once(BOATDEALERPATH . '/inc/feedback.php');
    require_once BOATDEALERPATH . '/inc/help.php';
   function boatdealer_custom_dashboard_help() {
                echo '<img src="'.get_template_directory_uri().'/images/infox350.png" style="text-align:center; width:100%; margin: 0px 0 auto;"  />';
                echo '<a target="blank" href="http://boatdealerthemes.com">';
                echo '<img src="'.get_template_directory_uri().'/images/logo-horizontal.png" style="text-align:center; width:100%; margin: 0px 0 auto;"  />';
                echo '</a>';
                $bd_msg = '<h3>For details and help, take a look at our Help Page at your left menu';
                $bd_msg .= '<br />';
                $bd_msg .= 'Appearance => BoatDealer Theme Help';
                $bd_msg .= '<br /><br />'; 
                $bd_msg .= '  <a <a class="button button-primary" target="blank" href="'.SITEURL.'/wp-admin/themes.php?page=boat_dealer"> Help Page</a>';
                $bd_msg .= '&nbsp;&nbsp;&nbsp;';
                $bd_url = '  <a class="button button-primary" target="blank" href="http://boatdealerthemes.com">Visit Our Site</a>';
                $bd_msg .=  $bd_url;
                $bd_msg .= '&nbsp;&nbsp;&nbsp;';
                $bd_url = '<a class="button button-primary" target="blank" href="http://boatdealerthemes.com/help/index.html">OnLine Guide</a>';
                $bd_msg .=  $bd_url;       
                // $bd_msg .= ', Support, Demo Video and more.';
                echo $bd_msg;
                echo "</p>";
                echo "</h3>";
   }
   function boatdealer_add_dashboard_widgets() 
    {
      add_meta_box('boatdealer-dashboard', 'Boat Dealer Theme Help and Support', 'boatdealer_custom_dashboard_help', 'dashboard', 'normal', 'high');
    }
  add_action("wp_dashboard_setup", "boatdealer_add_dashboard_widgets");
   function boatdealer_memory_notice() {
        if(isset($_GET["tab"]))
        {
            if (strip_tags($_GET["tab"]) == 'memory')
                return;
        }
                    echo '<div class="update-nag"><p>';
                    echo '<img width="100px" src="'.get_template_directory_uri().'/images/lock.png" />';
                    $bd_msg = '<h1>Boat Dealer Theme running  in save memory mode.</h1>';
                    $bd_msg .= '<h3>To release all theme power, please, increase the WordPress memory limit.';
                    $bd_msg .= ' For details and help, take a look at our Help Page (memory tab) at your left menu Appearance => Boat Dealer Help';
                    $bd_url = '  <a class="button button-primary" target="blank" href="'.SITEURL.'/wp-admin/themes.php?page=boat_dealer&tab=memory"> or click here</a>';
                    $bd_msg .= '<br />';
                    $bd_msg .=  $bd_url;
                    echo $bd_msg;
                    echo "</p>";
                    echo "</h3></div>";
    }
    if(! memory_status())
      add_action( 'admin_notices', 'boatdealer_memory_notice' );
}
if (get_site_option('boatdealer_update_theme', '0') == '1')
  add_filter( 'auto_update_theme', '__return_true' );
  function memory_status()
  {
	  global $lixo;
	  $r = true;
	  if(defined("WP_MEMORY_LIMIT"))
	  {
		$memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 0) : 0;
		if (!is_numeric($memory['usage'])) {
			return $r;
		}
		if ($memory['usage'] < 1) {
			return $r;
		}
		$mb = 'MB';
		if (defined("WP_MEMORY_LIMIT")) {
			$memory['wp_limit'] = trim(WP_MEMORY_LIMIT);
			$wplimit = $memory['wp_limit'];
			$wplimit = substr($wplimit, 0, strlen($wplimit) - 1);
			$memory['wp_limit'] = $wplimit;
		} else {
			$memory['wp_limit'] = 'Not defined!';
			$mb = '';
		}
		$perc = $memory['usage'] / $memory['wp_limit'];
		if ($perc > .7)
		   $r = false;
	  }
	  return $r; 
  } 
  
/**
 * Enqueue editor styles for Gutenberg
 */
function boatdealer_gutenberg_colors() {
    /* Background */
	$color_scheme          = boatdealer_get_color_scheme();
	$default_color         = $color_scheme[2]; /* 1 */
    $css = boatdealer_page_background_color_css2();
    $page_background_color = $default_color;
    $page_background_color = get_theme_mod( 'page_background_color', $default_color );
    return  wp_strip_all_tags(sprintf( $css, $page_background_color));
    /* End Background */
}
function boatdealer_gutenberg_colors2() {
    /* Foreground */
	$color_scheme          = boatdealer_get_color_scheme();
	$default_color         = $color_scheme[3];
	$main_text_color = get_theme_mod( 'main_text_color', $color_scheme[3] );
	$color_textcolor_rgb = boatdealer_hex2rgb( $main_text_color );
	// If the rgba values are empty return early.
	if ( empty( $color_textcolor_rgb ) ) {
	 	return;
	}
	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'      => $color_scheme[0],
		'page_background_color' => $color_scheme[1],
		'link_color'            => $color_scheme[2],
		'main_text_color'       => $main_text_color, //$color_scheme[3],
		'secondary_text_color'  => $color_scheme[4],
		'footer_color'          => $color_scheme[5],
    	'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),
	);
	$color_scheme_css = boatdealer_get_color_scheme_css2( $colors );
    return wp_strip_all_tags($color_scheme_css);
    /* End Foreground */
}
function boatdealer_gutenberg_editor_styles() {
	wp_enqueue_style( 'boatdealer_gutenberg-editor-style', get_template_directory_uri() . '/css/gutenberg-editor-style.css' );
	// Add custom colors to Gutenberg.
	wp_add_inline_style( 'boatdealer_gutenberg-editor-style', boatdealer_gutenberg_colors() );
	wp_add_inline_style( 'boatdealer_gutenberg-editor-style', boatdealer_gutenberg_colors2() );
}
add_action( 'enqueue_block_editor_assets', 'boatdealer_gutenberg_editor_styles' );
function boatdealer_page_background_color_css2() {
    /* Custom Page Background Color */
	$css = '
     .edit-post-layout__content .edit-post-visual-editor
        {
			background-color: %1$s;
		}
 		.site, .edit-post-layout__content
        {
			background-color: %1$s;
		}
		mark,
		ins,
		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination .prev,
		.pagination .next,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.pagination .nav-links:before,
		.pagination .nav-links:after,
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus,
		.page-links a,
		.page-links a:hover,
		.page-links a:focus 
        {
			color: %1$s;
		}
		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul li {
				background-color: %1$s;
			}
			.main-navigation ul ul:after {
				border-top-color: %1$s;
				border-bottom-color: %1$s;
			}
		}
	';
    return $css;
}
function boatdealer_get_color_scheme_css2( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'            => '',
		'header_background_color'     => '',
		'box_background_color'        => '',
		'textcolor'                   => '',
		'secondary_textcolor'         => '',
		'border_color'                => '',
		'border_focus_color'          => '',
		'sidebar_textcolor'           => '',
		'sidebar_border_color'        => '',
		'sidebar_border_focus_color'  => '',
		'secondary_sidebar_textcolor' => '',
		'meta_box_background_color'   => '',
        'menu_textcolor' => '',
	) );
    $colors['textcolor'] = $colors['main_text_color'];
	return <<<CSS
	/* Color Scheme */
    .site, .edit-post-layout__content
        {
          background:  {$colors['background_color']} !important; 
		}
    #wrapper,
    .sidebar,
    #sidebar
    {
      background-color: {$colors['header_background_color']} !important;  
    }
    #wrapper
    {
      background:  {$colors['background_color']} !important; 
	}
	/* Box Background Color */
	.post-navigation,
	.pagination,
	.secondary,
	.site-footer,
    .footer-container,
    #colophon,
	.hentry,
	.page-header,
	.page-content,
	.comments-area,
	.widecolumn {
		background-color: {$colors['box_background_color']};
	}
	/* Box Background Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	input[type="file"],
	.pagination .prev,
	.pagination .next,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus,
	.sticky-post {
		color: {$colors['box_background_color']};
	}
	/* Main Text Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	input[type="file"],
	.pagination .prev,
	.pagination .next,
	.widget_calendar tbody a,
	.page-links a,
	.sticky-post {
		color:  {$colors['textcolor']}; 
	}
	/* Main Text Color */
     edit-post-layout__content,
    .editor-block-list__layout .editor-block-list__block,
    .editor-post-title__block .editor-post-title__input, .editor-styles-wrapper,
    .footer-container,
	body,
	blockquote cite,
	blockquote small,
	a,
	.dropdown-toggle:after,
	.image-navigation a:hover,
	.image-navigation a:focus,
	.comment-navigation a:hover,
	.comment-navigation a:focus,
	.widget-title,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .edit-link a:hover,
	.pingback .edit-link a:focus,
	.comment-list .reply a:hover,
	.comment-list .reply a:focus,
	.site-info a:hover,
	.site-info a:focus {
	   color: {$colors['textcolor']}; 
	}
	/* Main Text Color */
	.entry-content a,
	.entry-summary a,
	.page-content a,
	.comment-content a,
	.pingback .comment-body > a,
	.author-description a,
	.taxonomy-description a,
	.textwidget a,
	.entry-footer a:hover,
	.comment-metadata a:hover,
	.pingback .edit-link a:hover,
	.comment-list .reply a:hover,
	.site-info a:hover {
	   	border-color: {$colors['textcolor']}; 
	}
	/* Secondary Text Color */
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['secondary_textcolor']};
	}
	/* Secondary Text Color */
	blockquote,
	a:hover,
	a:focus,
	.main-navigation .menu-item-description,
	.post-navigation .meta-nav,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.image-navigation,
	.image-navigation a,
	.comment-navigation,
	.comment-navigation a,
	.widget,
	.author-heading,
	.entry-footer,
	.entry-footer a,
	.taxonomy-description,
	.page-links > .page-links-title,
	.entry-caption,
	.comment-author,
	.comment-metadata,
	.comment-metadata a,
	.pingback .edit-link,
	.pingback .edit-link a,
	.post-password-form label,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.no-comments,
	.site-info,
	.site-info a,
	.wp-caption-text,
	.gallery-caption,
	.comment-list .reply a,
	.widecolumn label,
	.widecolumn .mu_register label {
		color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		color: {$colors['secondary_textcolor']};
	}
	/* Secondary Text Color */
	blockquote,
	.logged-in-as a:hover,
	.comment-author a:hover {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['secondary_textcolor']};
	}
	/* Border Color */
	hr, 
	.dropdown-toggle:hover,
	.dropdown-toggle:focus {
		background-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}
	/* Border Color */
	pre,
	abbr[title],
	table,
	th,
	td,
	input,
	textarea,
	.main-navigation ul,
	.main-navigation li,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.comment-navigation,
	.widget li,
	.widget_categories .children,
	.widget_nav_menu .sub-menu,
	.widget_pages .children,
	.site-header,
	.site-footer,
	.hentry + .hentry,
	.author-info,
	.entry-content .page-links a,
	.page-links > span,
	.page-header,
	.comments-area,
	.comment-list + .comment-respond,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-list .reply a,
	.no-comments {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']};
	}
	/* Border Focus Color */
	a:focus,
	button:focus,
	input:focus {
		outline-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		outline-color: {$colors['border_focus_color']};
	}
	input:focus,
	textarea:focus {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_focus_color']};
	}
	/* Sidebar Link Color */
	.secondary-toggle:before {
		color: {$colors['sidebar_textcolor']};
	}
	.site-title a,
	.site-description {
		color: {$colors['sidebar_textcolor']};
	}
	/* Sidebar Text Color */
	.site-title a:hover,
	.site-title a:focus {
		color: {$colors['secondary_sidebar_textcolor']};
	}
	/* Sidebar Border Color */
	.secondary-toggle {
		border-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['sidebar_border_color']};
	}
	/* Sidebar Border Focus Color */
	.secondary-toggle:hover,
	.secondary-toggle:focus {
		border-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['sidebar_border_focus_color']};
	}
	.site-title a {
		outline-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
	}
	/* Meta Background Color */
	.entry-footer {
		background-color: {$colors['meta_box_background_color']};
	}
	@media screen and (min-width: 38.75em) {
		/* Main Text Color */
		.page-header {
			border-color: {$colors['textcolor']};
		}
	}
	@media screen and (min-width: 15em) {
		/* Make sure its transparent on desktop */
          	button,
        	input[type="button"],
        	input[type="reset"],
        	input[type="submit"],
        	input[type="file"],    
        	.pagination .prev,
        	.pagination .next,
        	.widget_calendar tbody a,
        	.page-links a,
        	.sticky-post {
        		background-color:  {$colors['header_background_color']} ;
                color: {$colors['sidebar_textcolor']};
                border: solid 0px #DAD9D9 !important; /* {$colors['sidebar_textcolor']}  */
        	}        
	        .site-header,
		    .secondary {
			background-color: transparent;
		}
		/* Sidebar Background Color */
		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			color:  {$colors['header_background_color']};
		}
		/* Sidebar Link Color */
		.secondary a,
		.dropdown-toggle:after,
		.widget-title,
		.widget blockquote cite,
		.widget blockquote small {
			color: {$colors['sidebar_textcolor']};
		}
		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a {
			background-color: {$colors['sidebar_textcolor']};
		}
		.textwidget a {
			border-color:  {$colors['sidebar_textcolor']};
		}
		/* Sidebar Text Color */
		.secondary a:hover,
		.secondary a:focus,
		.main-navigation .menu-item-description,
		.widget,
		.widget blockquote,
		.widget .wp-caption-text,
		.widget .gallery-caption {
			color: {$colors['secondary_sidebar_textcolor']};
		}
		.widget button:hover,
		.widget button:focus,
		.widget input[type="button"]:hover,
		.widget input[type="button"]:focus,
		.widget input[type="reset"]:hover,
		.widget input[type="reset"]:focus,
		.widget input[type="submit"]:hover,
		.widget input[type="submit"]:focus,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: {$colors['secondary_sidebar_textcolor']};
		}
		.widget blockquote {
			border-color: {$colors['secondary_sidebar_textcolor']};
		}
		/* Sidebar Border Color */
		.main-navigation ul,
		.main-navigation li,
		.widget input,
		.widget textarea,
		.widget table,
		.widget th,
		.widget td,
		.widget pre,
		.widget li,
		.widget_categories .children,
		.widget_nav_menu .sub-menu,
		.widget_pages .children,
		.widget abbr[title] {
			border-color: {$colors['sidebar_border_color']};
		}
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.widget hr {
			background-color: {$colors['sidebar_border_color']};
		}
		.widget input:focus,
		.widget textarea:focus {
			border-color: {$colors['sidebar_border_focus_color']};
		}
		.sidebar a:focus,
		.dropdown-toggle:focus {
			outline-color: {$colors['sidebar_border_focus_color']};
		}
 }
         .menu-main-menu-container a
        {
        	color: {$colors['menu_textcolor']};
           /*   color: {$colors['background_color']}; */
        }
        .menu-item a
        {
        	color: {$colors['menu_textcolor']};
          /*   color: {$colors['background_color']};  */
        }
CSS;
}?>
