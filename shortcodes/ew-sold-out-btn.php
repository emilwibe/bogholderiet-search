<?php
if (!defined('ABSPATH')) { exit; }

function ew_sold_out_btn() {

    $output = '';
    $ew_beer_ID = get_the_ID();
    $ew_qv_get_sold_out = 0;
    if(isset($_GET['set_sold_out'])) {
        $ew_qv_get_sold_out = $_GET['set_sold_out'];
    }

    if( is_user_logged_in() && $ew_qv_get_sold_out ) {
        update_field( 'ew_sold_out', array("true"), $ew_beer_ID );
    }

    //var_dump($ew_qv_get_sold_out);

    $ew_field_sold_out = get_field('ew_sold_out');

    //var_dump($ew_field_sold_out);
    
    if( is_user_logged_in() ) {


        if( count( $ew_field_sold_out ) == 0 || !isset($ew_qv_get_sold_out)) {
            $output = '<a style="background-color: lightgrey; color: #333; padding: 10px;" href="' . get_the_permalink() . '?set_sold_out=' . $ew_beer_ID . '" class="">Meld udsolgt</a>';
        }
    }

    if( count( $ew_field_sold_out ) != 0 ) {
        $output .= '<span style="background-color: red; color: #fff; padding: 10px;">Udsolgt</span>';
    }

    /*if( is_user_logged_in() ) {
        $output .= '<a class="btn-sold-out" href="?beer_sold_out=">Meld udsolgt</a>';
    }*/

    return $output;
}

add_shortcode( 'ew_sell_out_btn', 'ew_sold_out_btn' );