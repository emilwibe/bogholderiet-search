<?php
if (!defined('ABSPATH')) { exit; }
// DASHBOARD SHOW NUMBER OF BEERS
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
    echo '<em>Viser ikke øl, der er udsolgt</em>';
    echo '<ul>';

    echo "<li>Antal øl: $the_query->found_posts</li>";

    echo "<li>Antal fadøl: 22</li>";
    
    //var_dump($the_query->found_posts);
    
    $ew_found_posts = $the_query->found_posts;
    
    $total_beer = 0;
    
    $total_beer = $ew_found_posts + 22;
    
    echo "<li><strong>Total: ";
    
    echo $total_beer;
    
    echo "</strong></li>";
    
    
    //var_dump($total_beer);

    //echo "<li><strong>Total:" . $the_query->found_posts + 22 . "</strong></li>";

    echo '</ul>';


    // TÆT PÅ SIDSTE SALGSDATO
    $date_in_two_months = date('Y-m-d', strtotime('+2 months'));

    $args = array(
        'post_type' => 'oel',
        'posts_per_page' => -1,
        'meta_key' => 'ew_sold_out',
        'meta_value' => false,
        'meta_query' => array(
            'key' => 'ew_expiration_date',
            'compare' => '<',
            'value' => $date_in_two_months,
            'type' => 'DATETIME'
        )
    );
    
    echo '<h3 style="font-weight: 700;">Mindre end 2 måneder til sidste salgsdato:</h3>';

    $ex_query = new WP_Query($args);

    if($ex_query->have_posts()) {
        echo '<ul>';
        while($ex_query->have_posts()) {
            $ex_query->the_post();

            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a> - Udløbsdato: ' . get_field('ew_expiration_date') . ' </li>';
        }
        wp_reset_postdata();

        echo '</ul>';
    }
}