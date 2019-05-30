<?php
if ( !defined( 'ABSPATH' ) ) exit;
if ( !function_exists( 'boatdealer_cfg_parent_css' ) ):
    function boatdealer_cfg_parent_css() {
        wp_enqueue_style( 'boatdealer_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'genericons' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'boatdealer_cfg_parent_css', 10 );
