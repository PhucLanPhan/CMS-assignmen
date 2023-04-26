<?php
/**
 * Template part for displaying property location listing in page-templates/location.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked into real_home_page_entry_content action
	 *
	 * @hooked real_home_page_content - 10
	 */
	do_action( 'real_home_page_entry_content' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php

get_template_part( 'template-parts/front-page/content-property', 'location' );
