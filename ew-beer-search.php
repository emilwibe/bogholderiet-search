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

//ENQUEUE PLUGIN STYLES
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'ew-add-search', plugin_dir_url( __FILE__ ) . 'style.css', [], time() );
    wp_enqueue_script( 'ew-add-search', plugin_dir_url( __FILE__ ) . 'ew-scripts.js', [], time(), true );
});