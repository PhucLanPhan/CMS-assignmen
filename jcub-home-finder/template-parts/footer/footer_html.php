<?php
/**
 * Template part for displaying footer HTML
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */


$content = get_theme_mod(
    'real_home_footer_html_text',
    ''
);
?>

<div class="footer-html-wrap">
    <?php echo wp_kses_post( $content ); ?>
</div><!-- .footer-html-wrap -->