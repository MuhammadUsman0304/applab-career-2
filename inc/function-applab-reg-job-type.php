<?php

/**
 * register post type 
 * @package applab-career
 */

function applab_register_job_post_type()
{
    $labels = array(
        'name' => 'Jobs Manager',
        'singular_name' => 'Job Manager',
        'add_new' => __('Add New Job', 'applab-career'),
        'add_new_item' => __('Add New Job', 'applab-career'),
        'edit_item' => __('Edit Job', 'applab-career'),
        'new_item' => __('New Job', 'applab-career'),
        'all_items' => __('All Jobs', 'applab-career'),
        'view_item' => __('View Job', 'applab-career'),
        'search_items' => __('Search Jobs', 'applab-career'),
        'not_found' => __('No jobs found', 'applab-career'),
        'not_found_in_trash' => __('No jobs found in Trash', 'applab-career'),
        'parent_item_colon' => '',
        'menu_name' => 'Job Manager'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'job-manager'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'author', 'thumbnail')
    );
    register_post_type('job_manager', $args);
    add_role('Applicant', 'Applicant');
}
