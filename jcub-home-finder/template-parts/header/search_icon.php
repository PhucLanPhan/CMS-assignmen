<?php
/**
 * Template part for displaying Search Icon
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

// Placeholder
$placeholder = get_theme_mod(
    'real_home_header_search_icon_placeholder',
    esc_html__( 'Search...', 'real-home' )
);
?>
<div class="header-search-icon-wrap header-search-section d-flex">
    <a href="javascript:void(0)" class="search-toggle">
        <i class="fa fa-search" aria-hidden="true"></i>
    </a>
    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
        <input type="search" class="search-field" name='s' placeholder="<?php echo esc_attr( $placeholder ); ?>"  value="<?php echo esc_attr( get_search_query() ); ?>">
        <input class="search-submit" value="Search" type="submit">
    </form>
</div><!-- .header-search-section -->
