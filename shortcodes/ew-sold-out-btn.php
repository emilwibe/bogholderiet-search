<?php
if (!defined('ABSPATH')) { exit; }

function ew_sold_out_btn() {
    $output = '';
    $ew_beer_ID = get_the_ID();

    $ew_field_sold_out = get_field('ew_sold_out');
    
    if( is_user_logged_in() ) {
        var_dump($ew_field_sold_out);
        if ($ew_field_sold_out == true) {
            $output .= '<span class="ew-beer-status soldout">Udsolgt</span>';
            $output .= '<a class="ew-beer-button" href="' . get_the_permalink() . '?set_in_stock=' . $ew_beer_ID . '">Meld på lager</a>';
        } else {
            $output .= '<span class="ew-beer-status instock">På lager</span>';
            $output .= '<a class="ew-beer-button" href="' . get_the_permalink() . '?set_sold_out=' . $ew_beer_ID . '">Meld udsolgt</a>';
        }

        if ( isset($_GET['set_sold_out']) ) {
            update_field('ew_sold_out', array("true"), $ew_beer_ID);

        } elseif ( isset($_GET['set_in_stock']) ) {
            update_field('ew_sold_out', array(null), $ew_beer_ID);
        }
    }

    return $output;
}

add_shortcode( 'ew_sell_out_btn', 'ew_sold_out_btn' );

/*
    $ew_qv_get_sold_out = 0;
    $ew_qv_get_in_stock = 0;

    if( isset($_GET['set_sold_out'] )) {
        $ew_qv_get_sold_out = $_GET['set_sold_out'];
    }

    if( isset($_GET['set_in_stock'] )) {
        $ew_qv_get_in_stock = $_GET['set_in_stock'];
    }

    if( is_user_logged_in() ) {
        if ( $ew_qv_get_sold_out ) {
            update_field( 'ew_sold_out', array("true"), $ew_beer_ID );

        } elseif ( $ew_qv_get_in_stock ) {
            update_field( 'ew_sold_out', array("false"), $ew_beer_ID );
        }
    }
*/

/*
if( count( $ew_field_sold_out ) == 0 || !isset($ew_qv_get_sold_out)) {
    $output = '<a style="background-color: lightgrey; color: #333; padding: 10px;" href="' . get_the_permalink() . '?set_sold_out=' . $ew_beer_ID . '" class="">Meld udsolgt</a>';
}
*/

/*
if( count( $ew_field_sold_out ) != 0 ) {
    $output .= '<span style="background-color: red; color: #fff; padding: 10px;">Udsolgt</span>';
}
*/

/*if( is_user_logged_in() ) {
    $output .= '<a class="btn-sold-out" href="?beer_sold_out=">Meld udsolgt</a>';
}*/