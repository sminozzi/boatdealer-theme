<?php /**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package boatdealer
 * 
 * @since boatdealer 1.0
 */ ?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content',
'boatdealer'); ?></a>
	<div id="sidebar" class="sidebar">
		<header id="masthead" class="site-header"> <!-- role="banner"> -->
			<div class="site-branding">
              <div class="site-logo"> 
                  <?php boatdealer_the_custom_logo(); ?>
              </div>
                    <?php
 					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;
					$description = get_bloginfo( 'description', 'display' ); ?>
						<p class="site-description"><?php echo esc_html($description); ?></p>
<div style="display:none;">
         <form method="get" id="searchform" action="<?php echo esc_url(home_url
()); ?>/">
            <div>
              <input type="text" size="150" name="s" id="s" value="<?php esc_attr_e('Write your search and hit Enter',
'boatdealer'); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
            </div>
         </form>
</div>
				<button class="secondary-toggle"><?php _e('Menu and widgets', 'boatdealer'); ?></button>
			</div><!-- .site-branding -->
		</header><!-- .site-header -->
		<?php get_sidebar(); ?>
	</div><!-- .sidebar -->
	<div id="content" class="site-content">
         	<div id="display_loading" >
				<img src="<?php echo get_template_directory_uri() .
'/images/ajax-loader.gif' ?>" alt="loading icon" />
			</div>
   <div id="top_header" >
            <div id="header_top_left" >
            <?php 
              $boatdealer_icon_color = trim(get_theme_mod('boatdealer_topinfo_color','gray'));
              $boatdealer_topinfo_color = boat_sanitizehtml($boatdealer_icon_color);
              $boatdealer_topinfo_email = trim(get_theme_mod('boatdealer_topinfo_email',''));
              $boatdealer_topinfo_email = boat_sanitizehtml($boatdealer_topinfo_email);
              $boatdealer_topinfo_phone = trim(get_theme_mod('boatdealer_topinfo_phone',''));
              $boatdealer_topinfo_phone = boat_sanitizehtml($boatdealer_topinfo_phone);
              $boatdealer_topinfo_hours = trim(get_theme_mod('boatdealer_topinfo_hours',''));
              $boatdealer_topinfo_hours = boat_sanitizehtml($boatdealer_topinfo_hours);
              if(!empty($boatdealer_topinfo_phone))
                {
                   echo '<img id="boatdealer_iconphone" alt="my phone" src="'.get_template_directory_uri().'/images/phone-icon_'.$boatdealer_icon_color.'.png"  />'; 
                   echo '<div id="boatdealer_topinfo_text">'.esc_attr($boatdealer_topinfo_phone).'</div>';
             
                }
             if(!empty($boatdealer_topinfo_email))
                {
                    echo '<img id="boatdealer_iconemail" alt="my email" src="'.get_template_directory_uri().'/images/email-icon_'.$boatdealer_icon_color.'.png"  />'; 
                    echo '<div id="boatdealer_topinfo_text">';
                    
                    if (!isset($boatdealer_topinfo_email_link))
                       $boatdealer_topinfo_email_link = '';
                       
                          
                    if($boatdealer_topinfo_email_link <> '')
                      {
                         echo '<a href="'.$boatdealer_topinfo_email_link;
                      }
                    else
                    {
                         echo '<a href="mailto:';
                         echo $boatdealer_topinfo_email;
                         
                    }  
                       
                    echo '">';
                    echo $boatdealer_topinfo_email;
                    echo '</a>';
                    echo '</div>';
                
                }
                
             if(!empty($boatdealer_topinfo_hours))
                {
                     echo '<img id="boatdealer_iconhours" alt="my hours" src="'.get_template_directory_uri().'/images/clock-icon_'.$boatdealer_icon_color.'.png"  />'; 
                     echo '<div id="boatdealer_topinfo_text">'.esc_attr($boatdealer_topinfo_hours).'</div>';
                }
              ?>
            </div>
            <div id="header_top_right" >

<?php 
global $woocommerce;
if (isset($woocommerce)) {

    echo '<div class="boatdealer_my_shopping_cart">';
    
    // get cart quantity
    $qty = $woocommerce->cart->get_cart_contents_count();
    // get cart total
    $total = $woocommerce->cart->get_cart_total();
    // get cart url
    $cart_url = esc_url($woocommerce->cart->get_cart_url());
    if ($qty > 0)
        echo '<a href="' . $cart_url . '"><img src="' . get_template_directory_uri() .
            '/images/cart.png" alt="Cart" width="32" height="32" /></a>';
    // if multiple products in cart
    if ($qty > 1)
        echo '<a href="' . $cart_url . '">' . ' ' . $qty . ' products | ' . $total .
            '</a>';
    // if single product in cart
    if ($qty == 1)
        echo '<a href="' . $cart_url . '"> 1 product | ' . $total . '</a>';

echo '</div> <!-- #boatdealer_shopping_cart -->';

}
else
{ ?>
 
               <!-- #mysearchicon --> 
               <div id="boatdealer_search_icon">
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                     <input id="boatdealer_search_submit" class="search-submit" type="button" onclick="changeClass('boatdealer_m_search')" style="border:none;" value="1" />
                     <input id="boatdealer_m_search" class="boatdealer_m_search" name="s" type="text" placeholder="<?php esc_attr_e('Type and hit enter...', 'boatdealer'); ?> "  onkeydown="if (event.keyCode == 13) {
                     this.form.submit();
                     return false;
                     }"/>
                 </form>
               </div>
    
 <?php   
}
 ?> 
 
       </div>  <!-- top_header_widgets right -->
      </div>  <!-- top_header -->
    <div id="wrap_top_menu">
            <!--  Menu -->
            <?php if (has_nav_menu('top-menu')) { ?>
            <div id="boatdealer_navbar"> <!-- class="top-boatdealer_navbar"> -->
				<nav id="site-top-navigation" class="navigation primary-navigation">  <!-- role="navigation"> -->							
					<?php     
                    wp_nav_menu(array(
                    'theme_location' => 'top-menu', 
                    'menu_class' =>'top-nav-menu')); ?>					
				</nav><!-- #site-navigation -->
            </div><!-- #boatdealer_navbar -->
           <?php } ?>          
          <!--  Fim Menu -->
  </div> <!-- wrap_top_menu -->