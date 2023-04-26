<?php
/**
 * Template part for displaying site tagline
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

$enable_site_title = get_theme_mod(
        'real_home_header_site_title_enable',
    ['desktop'=> 'true']
);
$enable_site_tagline = get_theme_mod(
    'real_home_header_site_tagline_enable',
    ['desktop'=> 'true']
);
$site_title_class = ( $enable_site_title && array_key_exists( 'desktop', $enable_site_title ) ) ? 'site-title' : 'site-title screen-reader-text';
?>
<div class="site-branding d-flex flex-row align-items-center">

    <?php if ( has_custom_logo() ) : ?>
        <div class="site-logo">
            <?php the_custom_logo(); ?>
        </div><!-- .site-logo -->
    <?php endif; ?>

    <div class="site-title-wrap d-flex flex-column">
        <?php
        if ( is_front_page() && is_home() ) :
            ?>
            <h1 class="<?php echo esc_attr( $site_title_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php
        else :
            ?>
            <p class="<?php echo esc_attr( $site_title_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php
        endif;
        $real_home_description = get_bloginfo( 'description', 'display' );
        if ( ( $real_home_description || is_customize_preview() ) && ( $enable_site_tagline && array_key_exists( 'desktop', $enable_site_tagline ) ) ) :
            ?>
            <p class="site-description"><?php echo esc_html($real_home_description); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
        <?php endif; ?>
    </div><!-- .site-title-wrap -->

</div><!-- .site-branding -->
