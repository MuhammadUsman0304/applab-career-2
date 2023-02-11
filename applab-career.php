<?php

/*
  Plugin Name: Applab Career 
  Plugin URI: https://github.com/MuhammadUsman0304/job-manager
  Description: Post jobs on your WordPress site. User can apply and attach resume for the jobs, user can display jobs on other websites with the help of api
  Author: Muhammad Usman
  Version: 1.0.0
  Author URI: https://www.linkedin.com/in/muhammad-usman-b3439218b/
  Text Domain: applab-career
  Domain Path: /languages
 */

define('APPLAB_CAREER_PLUGIN_URL', plugin_dir_url(__FILE__) . 'assets');
define('APPLAB_CAREER_PLUGIN_DIR', plugin_dir_path(__FILE__) . 'assets/');

require_once  plugin_dir_path(__FILE__) . 'applab-files.php';
$applab_uploads = wp_upload_dir();
$applab_plugin_name = "applab_career";


function applab_wp_enqueue_styles()
{
  // register style
  wp_register_style('applab_wp_register_bootstrap', APPLAB_CAREER_PLUGIN_URL . '/css/bootstrap.min.css');

  // enueing styles
  wp_enqueue_style('applab_wp_register_bootstrap');
}

add_action('wp_enqueue_scripts', 'applab_wp_enqueue_styles');

function applab_wp_enqueue_scripts()
{
  // register  bs/js 
  wp_register_script('applab_wp_register_script', APPLAB_CAREER_PLUGIN_URL . '/js/bootstrap.bundle.min.js', 'jquery', false, true);

  // enueque scipts
  wp_enqueue_script('applab_wp_register_script');
}
add_action('wp_enqueue_scripts', 'applab_wp_enqueue_scripts');

// bootstraping the plugin
function applab_plugin_activation()
{

  applab_create_jobs_tbl();
  applab_create_app_tbl();

  flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'applab_plugin_activation');

add_action('init', 'applab_register_job_post_type');
add_action('init', 'applab_job_categories', 0);
add_action('add_meta_boxes', 'applab_job_listing_form');
// job listing 
function applab_job_listing_form()
{
  add_meta_box(
    'applab_jobs_meta_box',
    'Job Information',
    'applab_job_listing',
    'job_manager',
    'normal',
    'high'
  );
}
