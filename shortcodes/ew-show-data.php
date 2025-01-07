<?php
if (!defined('ABSPATH')) { exit; }

// BREWERY SHORTCODE
function ew_show_brewery () {
    $ew_brewery_string = "";
    $ew_brewery_terms = get_the_terms(get_the_ID(), 'beer_brewery');

    if( isset( $ew_brewery_terms ) ) {
        foreach ( $ew_brewery_terms as $brewery ) {
            $ew_brewery_string .= $brewery->name;
        }
    }

    return "Bryggeri: " . $ew_brewery_string;
}

add_shortcode( 'single_show_brewery', 'ew_show_brewery' );

// COUNTRY SHORTCODE
function ew_show_country () {
    $ew_country_string = "";
    $ew_country_terms = get_the_terms(get_the_ID(), 'beer_country');

    if( isset( $ew_country_terms ) ) {
        foreach ( $ew_country_terms as $country ) {
            $ew_country_string .= $country->name;
        }
    }

    return "Land: " . $ew_country_string;
}

add_shortcode( 'single_show_country', 'ew_show_country' );

// TYPE SHORTCODE
function ew_show_type () {
    $ew_type_string = "";
    $ew_type_terms = get_the_terms(get_the_ID(), 'category');

    if( isset( $ew_type_terms[1] ) && $ew_type_terms[1]->parent != 0 ) {
        $ew_type_string = $ew_type_terms[1]->name;
    } else {
        $ew_type_string = $ew_type_terms[0]->name;
    }

    return "Type: " . $ew_type_string;
}

add_shortcode( 'single_show_type', 'ew_show_type' );