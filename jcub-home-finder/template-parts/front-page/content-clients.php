<?php
/**
 * Template part for displaying front page clients Logo section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

$clients_logo = get_theme_mod( 'real_home_front_page_clients_logo_lists', '' );
if ( $clients_logo ) :
	$section_heading = get_theme_mod(
		'real_home_front_page_clients_logo_section_heading',
		esc_html__( 'our partners', 'real-home' )
	);
	?>
	<section class="partner-section">
		<div class="container">
			<?php if ( $section_heading ) : ?>
				<header class="entry-header heading">
					<h2 class="entry-title"><?php echo esc_html( $section_heading ); ?></h2>
				</header>
			<?php endif; ?>
			<div class="partner-item-wrapper">
				<?php
				foreach ( $clients_logo as $logo ) :
					if ( !empty( $logo['client_logo'] ) ) :
						$img_url = wp_get_attachment_image_src( absint($logo['client_logo']), 'full' );
						if ( $img_url ) {
							$img_url = $img_url[0];
							?>
							<div class="partner-item">
								<figure class="client-logo">
									<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php esc_attr_e( 'Clients Logo', 'real-home' ); ?>">
								</figure>
							</div>
							<?php
						}
					endif;
				endforeach; ?>
			</div>
		</div>
	</section><!-- .why-choose-us-section -->
<?php endif;
