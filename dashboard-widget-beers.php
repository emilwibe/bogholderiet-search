<?php
if (!defined('ABSPATH')) { exit; }

//hooks up your code to dashboard setup
add_action('wp_dashboard_setup', 'ew_dw_beers');
function ew_dw_beers() {
    global $wp_meta_boxes;
 
    // Register your custom WordPress admin dashboard widget
    wp_add_dashboard_widget('ew_beers', 'Bogholderiets Øl', 'ew_dashboard_beer_info');
}
  
function ew_dashboard_beer_info() {
    $args = array(
        'post_type' => 'oel',
        'posts_per_page' => -1,
        'meta_key' => 'ew_sold_out',
        'meta_value' => false
    );

    $the_query = new WP_Query( $args );

    // print_r($the_query);
    echo '<ul>';

    echo "<li>Antal øl: $the_query->found_posts</li>";

    echo "<li>Antal fadøl: 22</li>";

    echo "<li><strong>Total:" . $the_query->found_posts + 22 . "</strong></li>";

    echo '</ul>';
}