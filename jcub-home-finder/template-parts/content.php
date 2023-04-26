<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

$post_class = ['post'];
if ( ! has_post_thumbnail() ) {
    $post_class[] = 'no-featured-image';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>

    <?php
    /**
     * Functions hooked into real_home_posts_entry_content action
     *
     * @hooked real_home_get_post_thumbnail - 10
     * @hooked real_home_blog_post_content   - 15
     */
    do_action( 'real_home_posts_content' );

    ?>

</article><!-- #post-<?php the_ID(); ?> -->
