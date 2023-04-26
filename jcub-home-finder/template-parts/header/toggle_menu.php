<?php
/**
 * Template part for displaying Toggle Menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */
?>

<div class="header-toggle-menu-wrap d-flex">
    <div id="navbar" class="navbar mobile-navbar">
        <!-- navbar starting from here -->
        <nav id="site-navigation" class="main-navigation">
            <div class="menu-content-wrapper">
				<?php
				wp_nav_menu( array(
					'theme_location'	=> 'mobile-menu',
					'menu_class'        => 'menu-wrapper',
					'container_class'   => 'menu-top-menu-container',
					'items_wrap'        => '<ul id="mobile-menu-list" class="%2$s">%3$s</ul>',
					'fallback_cb'       => 'real_home_menu_fallback'
				) );
				?>
            </div>
        </nav><!-- #site-navigation -->
    </div><!-- #navbar -->
</div><!-- .header-toggle-menu-wrap -->
