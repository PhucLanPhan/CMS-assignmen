<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Real_Home
 */

?>

</div><!-- #content -->

<?php
/**
 * Functions hooked into real_home_footer_before action
 *
 */
do_action( 'real_home_footer_before' );
?>

<footer id="colophon" class="site-footer">

    <?php
    /**
     * Functions hooked into real_home_footer_before action
     *
     */
    do_action( 'real_home_footer_top' );
    ?>

    <?php
    /**
     * Functions hooked into real_home_footer action
     *
     * @hooked real_home_footer_site_info - 10
     */
    do_action( 'real_home_footer' );
    ?>

    <?php
    /**
     * Functions hooked into real_home_footer_before action
     *
     */
    do_action( 'real_home_footer_bottom' );
    ?>

</footer><!-- #colophon -->

<?php
/**
 * Functions hooked into real_home_footer_after action
 *
 * @hooked real_home_footer_back_to_top - 10
 */
do_action( 'real_home_footer_after' );
?>

</div><!-- #page -->


<?php
/**
 * Functions hooked into real_home_body_bottom action
 *
 */
do_action( 'real_home_body_bottom' );
?>

<?php wp_footer(); ?>

</body>
</html>
