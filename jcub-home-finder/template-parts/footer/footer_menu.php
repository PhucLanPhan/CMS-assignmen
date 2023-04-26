<?php
/**
 * Template part for displaying footer menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */
?>
<div id="navbar" class="navbar footer-navbar">
    <!-- navbar starting from here -->
    <nav id="site-navigation" class="main-navigation">
        <div class="menu-content-wrapper">
			<?php
			wp_nav_menu( array(
				'theme_location'	=> 'footer-menu',
				'menu_class'        => 'menu-wrapper',
				'container_class'   => 'menu-top-menu-container',
				'items_wrap'        => '<ul id="footer-menu-list" class="%2$s">%3$s</ul>',
				'fallback_cb'       => 'real_home_menu_fallback',
				'depth'             => 1
			) );
			?>
        </div>
    </nav><!-- #site-navigation -->
</div><!-- #navbar -->
