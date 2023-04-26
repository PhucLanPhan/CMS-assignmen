<?php
/**
 * Template part for displaying front page latest news section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */
global $post;
$featured_cats = get_theme_mod(
	'real_home_front_page_news_blog_posts_by_cat',
	''
);
$posts_limit = get_theme_mod(
	'real_home_front_page_news_blog_posts_limit',
	['desktop' => 3 ]
);
// Arguments
$args = [
	'post_type'             => 'post',
	'posts_per_page'        => absint($posts_limit['desktop']),
	'no_found_rows'         => true,
	'ignore_sticky_posts'   => true
];
if ( $featured_cats ) {
	$args['category__in'] = absint($featured_cats);
}
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :

	$section_heading = get_theme_mod(
		'real_home_front_page_news_blog_section_heading',
		esc_html__( 'latest news and blog', 'real-home' )
	);
	$col_per_row = [
		'desktop'           => '3',
		'tablet'            => '2',
		'mobile'            => '1'
	];
	$posts_elements = get_theme_mod(
		'real_home_front_page_news_blog_post_elements',
		['post-meta','post-title','post-excerpt']
	);
	?>
	<section class="latest-news-section">
		<!-- featured properties starting from here -->
		<div class="container">

			<?php if ( $section_heading ) : ?>
				<header class="entry-header heading">
					<h2 class="entry-title"><?php echo esc_html( $section_heading ); ?></h2>
				</header>
			<?php endif; ?>

			<div class="row columns"<?php Real_Home_Helper::get_data_columns( $col_per_row );?>>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="column">

						<div class="post">

							<?php real_home_post_thumbnail( 'medium_large', '16x9' ); ?>

							<?php if ( ! empty( $posts_elements ) ) : ?>
								<div class="post-detail-wrap d-flex flex-column text-left">

									<?php real_home_posted_on(); ?>

									<?php foreach ( $posts_elements as $post_element ) :

										switch ( $post_element ) :

											case 'post-title' :
												?>
												<header class="entry-header">
													<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
												</header><!-- .entry-header -->
												<?php
												break;

											case 'post-excerpt' :
												?>
												<div class="entry-content">
													<?php Real_Home_Helper::post_excerpt(); ?>
												</div><!-- .entry-content -->
												<?php
												break;

											case 'post-meta' :
												?>
												<div class="entry-meta">
													<?php real_home_posted_cats(); ?>
													<?php real_home_posted_by(); ?>
												</div><!-- .entry-meta -->
												<?php
												break;

										endswitch;

									endforeach;?>

								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endwhile; ?>
			</div>

		</div>
	</section>
<?php endif;
