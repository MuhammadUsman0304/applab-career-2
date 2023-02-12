<?php

/**
 * job listing form
 * @package applab-career
 * 
 * http://localhost/applab/wp-json/applab-career/myjobs => get
 * http://localhost/applab/wp-json/applab-career/apply => post
 */


function my_job_listing_api_route()
{
    register_rest_route('applab-career/', '/myjobs', array(
        'methods' => 'GET',
        'callback' => 'applab_career_jobs_get_callback',
        'args' => array(
            'featured' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return in_array($param, array('applab_is_featured'));
                },
                'description' => __('Sort jobs by expiry date or featured status'),
                'default' => 'applab_is_featured'
            )
        ),
    ));



    // registering apply api route
    register_rest_route('applab-career/', '/apply', array(
        'methods' => 'POST',
        'callback' => 'applab_career_job_post_callback',
        'args' => array(
            'app_name' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return !empty($param);
                },
                'required' => true
            ),
            'app_job_id' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return !empty($param);
                },
                'required' => true
            ),
            'app_email' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return !empty($param);
                },
                'required' => true
            ),
            'app_msg' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return !empty($param);
                },
                'required' => true
            ),
            'app_cv' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return !empty($param);
                },
                'required' => true
            )
        )
    ));
}


// Callback function to fetch the job posts and return the response
function applab_career_jobs_get_callback($request)
{
    $posts = get_posts(array(
        'post_type' => 'job_manager',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ));

    $jobs = array();

    foreach ($posts as $post) {
        $job_id = $post->ID;
        $job_title = $post->post_title;
        $job_desc = $post->post_content;
        $job_type = get_post_meta($job_id, 'applab_job_type', true);
        $job_start_date = get_post_meta($job_id, 'applab_start_date', true);
        $job_end_date = get_post_meta($job_id, 'applab_end_date', true);
        $job_location = get_post_meta($job_id, 'applab_locations', true);
        $job_comp_name = get_post_meta($job_id, 'applab_comp_name', true);
        $job_logo = get_the_post_thumbnail_url($job_id, 'thumbnail');
        $job_is_featured = get_post_meta($job_id, 'applab_is_featured', true);
        $job_cate = get_the_terms($job_id, 'job_category');
        $job_category = $job_cate[0]->name;

        $jobs[] = array(
            'job_id' => $job_id,
            'job_title' => $job_title,
            'job_desc' => $job_desc,
            'job_type' => $job_type,
            'job_start_date' => $job_start_date,
            'job_end_date' => $job_end_date,
            'job_location' => $job_location,
            'job_comp_name' => $job_comp_name,
            'job_logo_url' => $job_logo,
            'job_is_featured' => $job_is_featured,
            'job_category' => $job_category,
        );
    }

    return $jobs;
}




// applying to jobs through api

function applab_career_job_post_callback($request)
{
    global $wpdb;
    $params = $request->get_params();
    $applab_app_table = $wpdb->prefix . 'applab_career_app';
    $name = sanitize_text_field($params['app_name']);
    $job_id = intval($params['app_job_id']);
    $email = sanitize_text_field($params['app_email']);
    $message = sanitize_text_field($params['app_msg']);
    $resume = sanitize_text_field($params['app_cv']);
    if (empty($name) || empty($job_id) || empty($email) || empty($message) || empty($resume)) {
        return new WP_Error('field_error', 'All fields are required', array('status' => 400));
    } else {
        $apply_data =  $wpdb->insert("$applab_app_table", array(
            'app_name' => $name,
            'app_job_id' => $job_id,
            'app_email' => $email,
            'app_msg' => $message,
            'app_cv' => $resume
        ));
        // return $apply_data;
        return array('success' => true);
    }
}
