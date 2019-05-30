<?php /**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package boatdealer
 * 
 * @since boatdealer 1.0
 */ ?>

	<footer id="colophon" class="site-footer"> <!-- role="contentinfo"> -->
   <div class="footer-container">
   <div class="footer-column column-one">
       	<?php if (is_active_sidebar('1-footer')): ?>
			<div id="widget-area1" class="widget-area" role="complementary">
				<?php dynamic_sidebar('1-footer'); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
   </div>
   <div class="footer-column column-two">
      	<?php if (is_active_sidebar('2-footer')): ?>
			<div id="widget-area2" class="widget-area" role="complementary">
				<?php dynamic_sidebar('2-footer'); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
   </div>
   <div class="footer-column column-three">
      	<?php if (is_active_sidebar('3-footer')): ?>
			<div id="widget-area3" class="widget-area" role="complementary">
				<?php dynamic_sidebar('3-footer'); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
   </div>
   </div>   
	</footer><!-- .site-footer -->
	   <div class="site-info">
			<?php /**
 * Fires before the boatdealer footer text for footer customization.
 *
 * @since boatdealer 1.0
 */
$boatdealer_footer_copyright = trim(get_theme_mod('boatdealer_footer_copyright'));
if (!empty($boatdealer_footer_copyright)) {
    echo  boat_sanitizehtml($boatdealer_footer_copyright);
} else {
    echo esc_html('Powered by boatdealerthemes.com');
} ?>
        	</div><!-- .site-info -->  
       	</div><!-- .site-content --> 
</div><!-- .site -->
</div> <!-- wrapper -->
<?php wp_footer(); ?> 

<div class="back-to-top-row">       
<a href="#" class="back-to-top">Back to Top</a>
</div> 

<?php
 $boatdealer_analytics = boat_sanitizehtml(trim(get_theme_mod('boatdealer_analytics')));
 if(! empty( $boatdealer_analytics))
 {
    ?>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        
          ga('create', '<?php echo esc_attr($boatdealer_analytics);?>', 'auto');
          ga('send', 'pageview');
        
        </script>
        
 <?php } ?>
</body>
</html>
