<?php 

// universal post type
function create_post_type_custom()
{
    register_post_type('custom', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Custom Posts', 'custom'), // Rename these to suit
            'singular_name' => __('Custom Post', 'custom'),
            'add_new' => __('Add New Block', 'custom'),
            'add_new_item' => __('Add New Custom Posts', 'custom'),
            'edit' => __('Edit', 'custom'),
            'edit_item' => __('Edit Custom Post', 'custom'),
            'new_item' => __('New Custom Post', 'custom'),
            'view' => __('View Custom Posts', 'custom'),
            'view_item' => __('View Custom Post', 'custom'),
            'search_items' => __('Search Custom Posts', 'custom'),
            'not_found' => __('No Custom Posts found', 'custom'),
            'not_found_in_trash' => __('No Custom Posts found in Trash', 'custom')
        ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'show_in_rest' => true, // Add gutenberg
        'menu_icon'           => 'dashicons-welcome-widgets-menus',
    ));
}
//add_action('init', 'create_post_type_custom');
