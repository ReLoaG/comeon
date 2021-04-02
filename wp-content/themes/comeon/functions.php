<?php

/**
 * Theme setup
 */
add_action('after_setup_theme', 'comeon_setup');
function comeon_setup()
{
    add_theme_support('custom-logo', array(
        'flex-height' => true,
        'flex-width' => true,
    ));

    /**
     * Enable plugins to manage the document title
     * http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
     */
    add_theme_support('title-tag');

    /**
     * Register wp_nav_menu() menus
     * http://codex.wordpress.org/Function_Reference/register_nav_menus
     */
    register_nav_menus([
        'primary_navigation' => 'Primary Navigation',
        'footer_navigation' => 'Footer Navigation',
    ]);

    /**
     * Enable post thumbnails
     * http://codex.wordpress.org/Post_Thumbnails
     * http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
     * http://codex.wordpress.org/Function_Reference/add_image_size
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form'
    ]);
}

/**
 * Enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', 'comeon_scripts');
function comeon_scripts()
{
    $path = get_template_directory_uri() . '/build/';
    // Theme stylesheet
    wp_enqueue_style('comeon-bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css',
        array(), false, 'all');
    wp_enqueue_style('comeon-style', $path . 'css/style.min.css', array('comeon-bootstrap-css'), '1.0.0', 'all');

    // Theme js
    wp_enqueue_script('comeon-jquery-js', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), false, true);
//    wp_enqueue_script('comeon-bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
//        'comeon-jquery-js', false, true);

    wp_enqueue_script('comeon-theme-js', $path . 'js/main.min.js', array('comeon-jquery-js'), '1.0.0', true);
    wp_localize_script('comeon-theme-js', 'ajax_object', array(
        'ajax_url' => admin_url('/admin-ajax.php'),
        'home_url' => get_home_url(),
    ));
}


/**
 * I decided to make campaigns as a CPt, but later I changed my opinion and made it via simple custom template
 */
//add_action( 'init', 'comeon_register_cpt' );
//function comeon_register_cpt()
//{
//    // Add Catamarans Post type
//    register_post_type('campaign', [
//        'labels' => [
//            'name' => __('Campaigns', 'campaigns'),
//            'singular_name' => __('Campaign', 'campaigns'),
//            'add_new' => __('Add new', 'campaigns'),
//            'add_new_item' => __('Add new campaign', 'campaigns'),
//            'edit_item' => __('Edit campaign', 'campaigns'),
//            'new_item' => __('New campaign', 'campaigns'),
//            'view_item' => __('View campaign', 'campaigns'),
//            'search_items' => __('Find campaign', 'campaigns'),
//            'not_found' => __('No campaigns found', 'campaigns'),
//            'not_found_in_trash' => __('No campaigns found in trash', 'campaigns'),
//            'parent_item_colon' => '',
//            'menu_name' => __('Campaigns', 'campaigns')
//        ],
//        'public' => true,
//        'publicly_queryable' => true,
//        'show_ui' => true,
//        'show_in_menu' => true,
//        'query_var' => true,
//        'rewrite' => true,
//        'capability_type' => 'post',
//        'has_archive' => true,
//        'hierarchical' => false,
//        'menu_position' => null,
//        'menu_icon' => 'dashicons-networking',
//        'supports' => array(
//            'title',
//            'thumbnail',
//            'editor'
//        )
//    ]);
//}

function getLinkDependingOnUserRole()
{
    if (!is_user_logged_in()) {
        $userRole = 'VIP';
    } else {
        $currentUser = wp_get_current_user();
        $userRole = getUserRole($currentUser->user_email);
    }

    return get_field('campaign_cta_link_' . strtolower($userRole));
}

function getUserRole($email)
{
    $queryParams = [
        'email' => $email
    ];

    $queryResult = wp_remote_post('https://promocje.pzbuk.pl/comeon-work-assignment', [
        'body' => $queryParams,
    ]);

    $resultBody = json_decode(wp_remote_retrieve_body($queryResult));

    return $resultBody->result->value ? $resultBody->result->value : 'VIP';
}