<?php
if (!defined('ABSPATH')) { exit; }
/**
 * Plugin Name: EW Beer Search
 * Author: Emil Wibe - EW Web
 * Author URI: https://ew.dk
 * Description: Adds search functionality to Bogholderiet.bar
 */

// LIST BEER SHORTCODE
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/ew-show-beers.php' );

// SHOW TAX
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/ew-show-data.php' );

// DASHBOARD WIDGET
require_once( plugin_dir_path( __FILE__ ) . 'dashboard-widget-beers.php' );

// SOLD OUT BTN
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes/ew-sold-out-btn.php' );

//ENQUEUE PLUGIN STYLES
add_action( 'wp_enqueue_scripts', function(){
    if( is_user_logged_in() ) {
        wp_enqueue_style( 'ew-add-search', plugin_dir_url( __FILE__ ) . 'style.css', [], time() );
        wp_enqueue_script( 'ew-add-search', plugin_dir_url( __FILE__ ) . 'ew-scripts.js', [], time(), true );
    } else {
        wp_enqueue_style( 'ew-add-search', plugin_dir_url( __FILE__ ) . 'style.css', [], );
    wp_enqueue_script( 'ew-add-search', plugin_dir_url( __FILE__ ) . 'ew-scripts.js', [], true );
    }
});

add_filter( 'wp_get_attachment_image_attributes', function($attr) {
    $attr['class'] .= ' zoooom preset-color';

    return $attr;
});