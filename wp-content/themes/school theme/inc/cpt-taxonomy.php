<?php
function fwd_register_custom_post_types() {
    
    // Register Works
    $labels = array(
        'name'                  => _x( 'Works', 'post type general name' ),
        'singular_name'         => _x( 'Work', 'post type singular name'),
        'menu_name'             => _x( 'Works', 'admin menu' ),
        'name_admin_bar'        => _x( 'Work', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'work' ),
        'add_new_item'          => __( 'Add New Work' ),
        'new_item'              => __( 'New Work' ),
        'edit_item'             => __( 'Edit Work' ),
        'view_item'             => __( 'View Work' ),
        'all_items'             => __( 'All Works' ),
        'search_items'          => __( 'Search Works' ),
        'parent_item_colon'     => __( 'Parent Works:' ),
        'not_found'             => __( 'No works found.' ),
        'not_found_in_trash'    => __( 'No works found in Trash.' ),
        'archives'              => __( 'Work Archives'),
        'insert_into_item'      => __( 'Insert into work'),
        'uploaded_to_this_item' => __( 'Uploaded to this work'),
        'filter_item_list'      => __( 'Filter works list'),
        'items_list_navigation' => __( 'Works list navigation'),
        'items_list'            => __( 'Works list'),
        'featured_image'        => __( 'Work featured image'),
        'set_featured_image'    => __( 'Set work featured image'),
        'remove_featured_image' => __( 'Remove work featured image'),
        'use_featured_image'    => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'works' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'thumbnail', 'editor' ),
    );

    register_post_type( 'fwd-work', $args );
}
add_action( 'init', 'fwd_register_custom_post_types' );



// register our custom taxonomies
function fwd_rewrite_flush(){
    fwd_register_custom_post_types();
    fwd_register_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'fwd_rewrite_flush');

function register_staff_cpt() {
    $labels = array(
        'name'                  => _x('Staff', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Staff', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Staff', 'text_domain'),
        'name_admin_bar'        => __('Staff', 'text_domain'),
        'add_new_item'          => __('Add New Staff', 'text_domain'),
        'new_item'              => __('New Staff', 'text_domain'),
        'edit_item'             => __('Edit Staff', 'text_domain'),
        'view_item'             => __('View Staff', 'text_domain'),
        'all_items'             => __('All Staff', 'text_domain'),
    );

    $args = array(
        'label'                 => __('Staff', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('staff', $args);
}
add_action('init', 'register_staff_cpt');


function register_staff_taxonomy() {
    $labels = array(
        'name'                       => _x('Staff Categories', 'taxonomy general name', 'text_domain'),
        'singular_name'              => _x('Staff Category', 'taxonomy singular name', 'text_domain'),
        'search_items'               => __('Search Staff Categories', 'text_domain'),
        'all_items'                  => __('All Staff Categories', 'text_domain'),
        'edit_item'                  => __('Edit Staff Category', 'text_domain'),
        'update_item'                => __('Update Staff Category', 'text_domain'),
        'add_new_item'               => __('Add New Staff Category', 'text_domain'),
        'new_item_name'              => __('New Staff Category Name', 'text_domain'),
        'menu_name'                  => __('Staff Category', 'text_domain'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

    register_taxonomy('staff_category', array('staff'), $args);
}
add_action('init', 'register_staff_taxonomy');

function register_student_cpt() {
    $labels = array(
        'name'               => _x('Students', 'post type general name', 'textdomain'),
        'singular_name'      => _x('Student', 'post type singular name', 'textdomain'),
        'menu_name'          => _x('Students', 'admin menu', 'textdomain'),
        'name_admin_bar'     => _x('Student', 'add new on admin bar', 'textdomain'),
        'add_new'            => _x('Add New', 'student', 'textdomain'),
        'add_new_item'       => __('Add New Student', 'textdomain'),
        'new_item'           => __('New Student', 'textdomain'),
        'edit_item'          => __('Edit Student', 'textdomain'),
        'view_item'          => __('View Student', 'textdomain'),
        'all_items'          => __('All Students', 'textdomain'),
        'search_items'       => __('Search Students', 'textdomain'),
        'parent_item_colon'  => __('Parent Students:', 'textdomain'),
        'not_found'          => __('No students found.', 'textdomain'),
        'not_found_in_trash' => __('No students found in Trash.', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'student'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
        'template'           => array(
            array('core/paragraph', array(
                'placeholder' => 'Add short biography...',
            )),
            array('core/button', array(
                'placeholder' => 'Add portfolio link...',
            )),
        ),
        'template_lock'      => 'all',
    );

    register_post_type('student', $args);
}
add_action('init', 'register_student_cpt');

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



?>