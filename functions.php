<?php
/*
update_option('siteurl','http://localhost/topcat');
update_option('home','http://localhost/topcat');
*/

/**
 * topcat functions and definitions
 *
 * @package topcat
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}

if ( ! function_exists( 'topcat_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function topcat_setup()
    {

        /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on topcat, use a find and replace
        * to change 'topcat' to the name of your theme in all the template files
        */
        load_theme_textdomain( 'topcat', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        */
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'large-thumbnail', 600, 200, true );
        add_image_size( 'small-thumbnail', 300, 100, true );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary' => __( 'Primary Menu', 'topcat' ),
            )
        );

        /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
        add_theme_support(
            'html5', array(
                'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
            )
        );

        /*
        * Enable support for Post Formats.
        * See http://codex.wordpress.org/Post_Formats
        */
        add_theme_support(
            'post-formats', array(
                'aside', 'image', 'video', 'quote', 'link',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background', apply_filters(
                'topcat_custom_background_args', array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

    }
endif; // topcat_setup
add_action( 'after_setup_theme', 'topcat_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function topcat_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __( 'Sidebar', 'topcat' ),
            'id'            => 'sidebar-1',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Footer Sidebar', 'topcat' ),
            'id'            => 'sidebar-footer',
            'description'   => 'Footer widgets go here',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        )
    );
}
add_action( 'widgets_init', 'topcat_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function topcat_scripts()
{
   wp_enqueue_style( 'topcat-style', get_stylesheet_uri() );

    if ( is_page_template( 'front-page.php' ) ) {
        wp_enqueue_style( 'topcat-layout-css', get_template_directory_uri() . '/layouts/content.css' );
    }
    else
    {
        wp_enqueue_style( 'topcat-layout-css', get_template_directory_uri() . '/layouts/content-sidebar.css' );
    }

        //font for the headings

        wp_register_style( 'topcat-headings-font',  get_template_directory_uri() . '/css/open-sans.css' );
        wp_enqueue_style( 'topcat-headings-font' );
    /* */
           //font for the content
           wp_enqueue_style( 'topcat-content-font', get_template_directory_uri() . '/css/ubuntu.css' );
           wp_enqueue_style( 'topcat-description-font', get_template_directory_uri() .'/css/oleo-script.css' );

               //font awesome icons
               wp_enqueue_style( 'topcat-fontawesome', get_template_directory_uri() .'/css/font-awesome.css' );

               wp_enqueue_script( 'topcat-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
               wp_enqueue_script( 'topcat-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), '20141123', true );

               wp_enqueue_script( 'topcat-global', get_template_directory_uri() . '/js/global.js', array('topcat-superfish'), '20141123', true );
               wp_enqueue_script( 'topcat-hoverIntent', get_template_directory_uri() . '/js/hoverIntent.js', array('topcat-global'), '20141123', true );
               wp_enqueue_script( 'topcat-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

              // wp_enqueue_script( 'topcat-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), false, false );
               wp_enqueue_script( 'topcat-respond', get_template_directory_uri() . '/js/respond.js', array(), false, false );

               wp_enqueue_script( 'topcat-masonry', get_template_directory_uri() .'/js/masonry_custom.js', array('masonry'), false, false );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'topcat_scripts' );

function topcat_add_editor_styles()
{
    add_editor_style( array( 'custom-editor-style.css',  get_template_directory_uri() . '/css/open-sans.css' ) );
}
add_action( 'after_setup_theme', 'topcat_add_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

