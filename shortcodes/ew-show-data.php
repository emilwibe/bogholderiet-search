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

// CUSTOM FIELD ALCHOL STRENGTH
function ew_cf_strength () {
    $ew_strength = "";

    if( get_field( 'alkohol' ) ) {
        $ew_strength = get_field( 'alkohol' );
    }

    return "Alkoholstyrke: " . $ew_strength . "%";
}

add_shortcode( 'ew_single_strength', 'ew_cf_strength' ); 

// CUSTOM FIELD SIZE
function ew_cf_size () {
    $ew_size = "";

    if( get_field( 'storrelse' ) ) {
        $ew_size = get_field( 'storrelse' );
    }

    return "Størrelse: " . $ew_size . "cl";
}

add_shortcode( 'ew_single_size', 'ew_cf_size' );

// CUSTOM FIELD PRICE
function ew_cf_price () {
    $ew_price = "";

    if( get_field( 'pris' ) ) {
        $ew_size = get_field( 'pris' );
    }

    return "Pris: <strong>" . $ew_size . " kr.</strong>";
}

add_shortcode( 'ew_single_price', 'ew_cf_price' );


// CUSTOM INVENTORY
function ew_cf_inv () {
    $ew_inv = "";

    if( get_field( 'inventory_placement' ) ) {
        $ew_inv = get_field( 'inventory_placement' );
    }

    return $ew_inv;
}

add_shortcode( 'ew_single_inv', 'ew_cf_inv' );
