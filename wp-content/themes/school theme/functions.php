<?php
/**
 * School Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function school_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on School Theme, use a find and replace
		* to change 'school-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'school-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'school-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'school_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	/**
	 * Add support for Block Editor features.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
	 */
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'full-width' );
}
add_action( 'after_setup_theme', 'school_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'school_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'school_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'school-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'school-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'school_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function school_theme_scripts() {
	wp_enqueue_style( 'school-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'school-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'school-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (get_post_type() === 'post') {
        // Enqueue your scripts and styles here for single posts of the 'post' type
        wp_enqueue_script('fwd-school-theme', get_template_directory_uri() . '/js/aos.js', array(), _S_VERSION, array(
            'strategy'  => 'defer'
        ));
        wp_enqueue_script('fwd-school-theme-init', get_template_directory_uri() . '/js/aos-init.js', array('fwd-school-theme'), _S_VERSION, array(
            'strategy'  => 'defer'
        ));
        wp_enqueue_style('fwd-school-theme-style', get_template_directory_uri() . '/css/aos.css', array(), _S_VERSION, 'all');
    }
}
add_action( 'wp_enqueue_scripts', 'school_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//change the excerpt length
function school_theme_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'school_theme_excerpt_length', 999 );

//change the excerpt more text
function school_theme_excerpt_more( $more ) {
    $more = ' <a class="read-more" href="' . esc_url( get_permalink() ) . '">'. __('Read more...').'</a>';
    return $more;
}
add_filter( 'excerpt_more', 'school_theme_excerpt_more' );

//Remove block editor from pages/posts and home
function school_theme_post_filter( $use_block_editor, $post ) {
    // Add IDs to the array
    $page_ids = array( 61, 12 );
    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'school_theme_post_filter', 10, 2 );


function change_staff_title_placeholder($title) {
    $screen = get_current_screen();
    if ('staff' == $screen->post_type) {
        $title = 'Add staff name';
    }
    return $title;
}
add_filter('enter_title_here', 'change_staff_title_placeholder');

function custom_student_title_placeholder($title) {
    $screen = get_current_screen();
    if ('student' == $screen->post_type) {
        $title = 'Add student name';
    }
    return $title;
}
add_filter('enter_title_here', 'custom_student_title_placeholder');


add_action('after_setup_theme', 'custom_image_sizes');
function custom_image_sizes() {
    add_image_size('student-thumbnail', 200, 300, true);
}


//add staff to school page custom post type
function create_staff_post_type() {
    register_post_type('staff',
        array(
            'labels'      => array(
                'name'          => __('Staff'),
                'singular_name' => __('Staff Member'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array('slug' => 'staff'),
            'supports'    => array('title', 'editor', 'custom-fields'),
        )
    );
}
add_action('init', 'create_staff_post_type');


//staff custom taxonomy
function create_staff_taxonomy() {
    register_taxonomy(
        'role',
        'staff',
        array(
            'label' => __('Role'),
            'rewrite' => array('slug' => 'role'),
            'hierarchical' => true,
        )
    );
}
add_action('init', 'create_staff_taxonomy');

function create_student_post_type() {
    register_post_type('student',
        array(
            'labels'      => array(
                'name'          => __('Students'),
                'singular_name' => __('Student'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array('slug' => 'students'),
            'supports'    => array('title', 'editor', 'custom-fields'),
        )
    );
}
add_action('init', 'create_student_post_type');

function register_student_taxonomy() {
    $labels = array(
        'name'              => _x('Student Categories', 'taxonomy general name', 'text_domain'),
        'singular_name'     => _x('Student Category', 'taxonomy singular name', 'text_domain'),
        'search_items'      => __('Search Student Categories', 'text_domain'),
        'all_items'         => __('All Student Categories', 'text_domain'),
        'edit_item'         => __('Edit Student Category', 'text_domain'),
        'update_item'       => __('Update Student Category', 'text_domain'),
        'add_new_item'      => __('Add New Student Category', 'text_domain'),
        'new_item_name'     => __('New Student Category Name', 'text_domain'),
        'menu_name'         => __('Student Category', 'text_domain'),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
    );

    register_taxonomy('student_category', array('student'), $args);

    // Add default terms
    if (!term_exists('Designer', 'student_category')) {
        wp_insert_term('Designer', 'student_category');
    }
    if (!term_exists('Developer', 'student_category')) {
        wp_insert_term('Developer', 'student_category');
    }
}
add_action('init', 'register_student_taxonomy');

