<?php
if (!defined('ABSPATH')) { exit; }

function ew_show_beers() {
    
    global $post;
    $output = '';

    $ew_type_tax = get_terms( array(
        'taxonomy' => 'category',
        'hide_empty' => true
    ) );

    $ew_brewery_tax = get_terms( array(
        'taxonomy' => 'beer_brewery',
        'hide_empty' => true
    ) );

    $ew_country_tax = get_terms( array(
        'taxonomy' => 'beer_country',
        'hide_empty' => true
    ) );

    $ew_type_arr = array("all" => "Alle");
    $ew_brewery_arr = array("all" => "Alle");
    $ew_country_arr = array("all" => "Alle");

    foreach ( $ew_type_tax as $beer_cat ) {
        if( $beer_cat->parent == 0 ) {
            $ew_type_arr[$beer_cat->term_id] = $beer_cat->name;
        }
    }

    foreach ( $ew_brewery_tax as $beer_brew ) {
        if( $beer_brew->parent == 0 ) {
            $ew_brewery_arr[$beer_brew->term_id] = $beer_brew->name;
        }
    }

    foreach ( $ew_country_tax as $beer_brew ) {
        if( $beer_brew->parent == 0 ) {
            $ew_country_arr[$beer_brew->term_id] = $beer_brew->name;
        }
    }

    // OUTPUT FORM
    $output .= '<form action="#ew-filter-type" method="get" class="ew-beer-filter">';

        $output .= '<select name="beer-type" id="ew-filter-type" onchange="this.form.submit()">';

        $output .= '<option value="" disabled selected>Øltype</option>';
        

        foreach ($ew_type_arr as $key => $val) {

            $output .= '<option value="' . $key . '" >' . $val . '</option>';
            
        }

        $output .= '</select>';

        $output .= '<select name="brewery" id="ew-filter-type-brewery" onchange="this.form.submit()">';

        $output .= '<option value="" disabled selected>Bryggeri</option>';

        foreach ($ew_brewery_arr as $key => $val) {

            $output .= '<option value="' . $key . '" >' . $val . '</option>';

        }

        $output .= '</select>';

        $output .= '<select name="beer-country" id="ew-filter-type-country" onchange="this.form.submit()">';

        $output .= '<option value="" disabled selected>Land</option>';

        foreach ($ew_country_arr as $key => $val) {

            $output .= '<option value="' . $key . '" >' . $val . '</option>';

        }

        $output .= '</select>';

        $output .= '</form>';

    $args = array(
        'post_type' => 'oel',
        'order' =>  'ASC',
		'posts_per_page'    =>  -1,
        'tax_query' => array(
            'relation' => 'AND'
        ),
        'meta_key' => 'ew_sold_out',
        'meta_value' => false
    );

    // FILTER BEER TYPE IN WP_QUERY
    if( isset( $_GET['beer-type'] ) && $_GET['beer-type'] != 'all' ) {

        $beer_type_param = $_GET['beer-type'];

        array_push( $args['tax_query'], array(
            'taxonomy' => 'category',
            'terms' => $beer_type_param
        ));
    }

    // FILTER BREWERY IN WP_QUERY
    if( isset( $_GET['brewery'] )  && $_GET['brewery'] != 'all' ) {

        $beer_brew_param = $_GET['brewery'];

        array_push( $args['tax_query'], array(
            'taxonomy' => 'beer_brewery',
            'terms' => $beer_brew_param
        ));
    }

    // FILTER COUNTRY IN WP_QUERY
    if( isset( $_GET['beer-country'] )  && $_GET['beer-country'] != 'all' ) {

        $beer_country_param = $_GET['beer-country'];

        array_push( $args['tax_query'], array(
            'taxonomy' => 'beer_country',
            'terms' => $beer_country_param
        ));
    }   

    $the_query = new WP_Query( $args );

    if( $the_query->have_posts() ) {

        $output .= '<section class="ew-beer-gallery">';

        while( $the_query->have_posts()) {
            $the_query->the_post();

            $output .= '<article class="ew-beer">';

            $output .= '<a href="' . get_the_permalink() . '">';

            if ( has_post_thumbnail( ) ) {
                $output .= get_the_post_thumbnail( $post, 'small');
            } else {
                $output .= '<img src="' . plugin_dir_url( __FILE__ ) . '../assets/bogholderiet-placeholder-beer.png?new2" class="ew-no-img">';
            }

            $output .= '</a>';

            $output .= '<h3 class="ew-beer-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';

            // OUTPUT COUNTRY
            $beer_country = get_the_terms(get_the_ID(), 'beer_country');
            
            if( isset( $beer_country ) ) {
                $output .= '<p>Land: ' . $beer_country[0]->name . '<br>';
            }
            

            // OUTPUT BEER TYPE FROM CAT
            $beer_type = get_the_terms(get_the_ID(), 'category');
            $beer_type_string = "";

            if( isset( $beer_type[1] ) && $beer_type[1]->parent != 0 ) {
                $beer_type_string = $beer_type[1]->name;
                
            } elseif ( isset( $beer_type[0]->name ) ) {
                $beer_type_string = $beer_type[0]->name;
            }

            $output .= 'Type: ' . $beer_type_string . '<br>';

            $output .= 'Alkoholstyrke: ' . get_field( 'alkohol' ) . '&percnt;<br>';

            $output .= 'Størrelse: ' . get_field( 'storrelse' ) . 'cl<br>';

            $output .= 'Pris: ' . get_field( 'pris' ) . ' kr.</p>';

            $output .= '<a href="' . get_the_permalink() . '">Læs mere...</a>';

            $output .= '</article><!--/.ew-beer-->';

            //print_r(get_the_terms(get_the_ID(), 'category'));

        }

        $output .= '</section><!--/.ew-beer-gallery-->';

    } else {
        $output .= '<h2 style="max-width: 768px; margin: 10px auto; text-align: center;">Vi har desværre ingen øl i den søgte kategori</h2>';
    }

    wp_reset_postdata();

    return $output;
}

add_shortcode( 'show_all_beers', 'ew_show_beers' );