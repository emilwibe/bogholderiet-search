<?php
if (!defined('ABSPATH')) { die; }

function ew_sold_out_btn() {
    $output = '';
    $ew_beer_ID = get_the_ID();

    if ( is_user_logged_in() ) {
        if ( isset($_GET['set_sold_out']) ) {
            update_field('ew_sold_out', [true], $ew_beer_ID);

        } elseif ( isset($_GET['set_in_stock']) ) {
            update_field('ew_sold_out', [], $ew_beer_ID);
        }

        if ( get_field('ew_sold_out') ) {
            $output .= '<span class="ew-beer-status soldout">Udsolgt</span>';
            $output .= '<a class="ew-beer-button" href="' . get_the_permalink() . '?set_in_stock=' . $ew_beer_ID . '">Meld på lager</a>';
        } else {
            $output .= '<span class="ew-beer-status instock">På lager</span>';
            $output .= '<a class="ew-beer-button" href="' . get_the_permalink() . '?set_sold_out=' . $ew_beer_ID . '">Meld udsolgt</a>';
        }
    }

    return $output;
}

add_shortcode( 'ew_sell_out_btn', 'ew_sold_out_btn' );