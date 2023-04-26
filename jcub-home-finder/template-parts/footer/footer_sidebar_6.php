<?php
/**
 * Template part for displaying footer sidebar 6
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */


if ( is_active_sidebar( 'footer-sidebar-6' ) ) : ?>
    <div class="footer-sidebar-wrap footer-sidebar-6">
        <?php dynamic_sidebar( 'footer-sidebar-6' ); ?>
    </div><!-- .footer-sidebar-wrap -->
<?php endif; ?>
