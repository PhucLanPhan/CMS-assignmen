<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    /**
     * Functions hooked into real_home_page_entry_header action
     * @hooked real_home_singular_post_thumbnail - 10
     * @hooked real_home_post_header    - 15
     */
    do_action( 'real_home_page_entry_header' );
    ?>

    <?php
    /**
     * Functions hooked into real_home_page_entry_content action
     *
     * @hooked real_home_page_content - 10
     */
    do_action( 'real_home_page_entry_content' );
    ?>

    <?php
    /**
     * Functions hooked into real_home_page_entry_footer action
     *
     * @hooked real_home_page_footer - 10
     */
    do_action( 'real_home_page_entry_footer' );
    ?>

</article><!-- #post-<?php the_ID(); ?> -->
