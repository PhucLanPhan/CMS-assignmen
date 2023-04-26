<?php
/**
 * Template part for displaying front page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */


$sortable_default = Real_Home_Helper::crucial_real_state_plugin()
    ? ['slider','featured','why-us','location','property-types','blog','clients']
    : ['why-us','blog','clients'];
$sortable_elements = get_theme_mod(
  'real_home_front_page_elements',
    $sortable_default
);

if ( $sortable_elements ) {

    foreach ( $sortable_elements as $element ) :

        switch ( $element ) :

            case 'slider' :
                get_template_part( 'template-parts/front-page/content', 'banner' );
                break;

            case 'blog' :
                get_template_part( 'template-parts/front-page/content', 'news' );
                break;

            case 'search' :
                get_template_part( 'template-parts/front-page/content', 'search' );
                break;

            case 'featured' :
                get_template_part( 'template-parts/front-page/content', 'featured' );
                break;

            case 'why-us' :
                get_template_part( 'template-parts/front-page/content', 'why-us' );
                break;

            case 'location' :
                get_template_part( 'template-parts/front-page/content-property', 'location' );
                break;

            case 'property-types' :
                get_template_part( 'template-parts/front-page/content-property', 'types' );
                break;

            case 'clients' :
                get_template_part( 'template-parts/front-page/content', 'clients' );
                break;

        endswitch;

    endforeach;
}
