<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package topcat
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site topcat_page">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'topcat' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
                <div class="logo-container">
                    <?php if ( get_header_image() ) : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt=""></a>
                    <?php endif; // End header image check. ?>
                </div>
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
           <!-- <div class="social-menu">Social menu here</div> -->
		</div>
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <h1 class="menu-toggle"><?php _e( 'Menu', 'topcat' ); ?></h1>
            <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'topcat' ); ?></a>
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav><!-- #site-navigation -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">


