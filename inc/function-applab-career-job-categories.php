<?php

/**
 * register job categories
 * @package applab-career
 */


function applab_job_categories()
{
    $labels = array(
        'name' => _x('Job Categories', 'Taxonomy General Name', 'applab-career'),
        'singular_name' => _x('Job Category', 'Taxonomy Singular Name', 'applab-career'),
        'menu_name' => __('Job Categories', 'applab-career'),
        'all_items' => __('All Categories', 'applab-career'),
        'new_item_name' => __('New Category Name', 'applab-career'),
        'add_new_item' => __('Add New Category', 'applab-career'),
        'edit_item' => __('Edit Category', 'applab-career'),
        'update_item' => __('Update Category', 'applab-career'),
        'search_items' => __('Search Category', 'applab-career'),
        'add_or_remove_items' => __('Add or remove Categories', 'applab-career')
    );
    $rewrite = array(
        'slug' => 'job_category',
        'with_front' => true,
        'hierarchical' => true,
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => $rewrite,
    );
    register_taxonomy('job_category', 'job_manager', $args);
}
