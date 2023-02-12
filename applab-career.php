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

define('APPLAB_WP_PLUGIN_URL', plugin_dir_url(__FILE__) . 'assets/');

define('APPLAB_WP_PLUGIN_DIR', plugin_dir_path(__FILE__) . 'assets/');

require_once  plugin_dir_path(__FILE__) . 'applab-career-files.php';
$applab_job_uploads = wp_upload_dir();
$applab_job_plugin_name = "applab_career";


function applab_job_wp_enqueue_styles()
{
  // register style
  wp_register_style('applab_job_wp_register_bootstrap', APPLAB_WP_PLUGIN_URL . 'css/bootstrap.min.css');
  wp_register_style('applab_wp_register_bootstrap', APPLAB_WP_PLUGIN_URL . 'css/bootstrap.min.css');
  // enueing styles
  wp_enqueue_style('applab_job_wp_register_bootstrap');
  wp_enqueue_style('applab_wp_register_bootstrap');
}
add_action('wp_enqueue_scripts', 'applab_job_wp_enqueue_styles');

add_action('admin_enqueue_scripts', 'applab_job_wp_enqueue_styles');

function applab_job_wp_enqueue_scripts()
{
  // register  bs/js 
  wp_register_script('applab_job_wp_register_script', APPLAB_WP_PLUGIN_URL . 'js/bootstrap.bundle.min.js', 'jquery', false, true);
  wp_register_script('applab_wp_register_script', APPLAB_WP_PLUGIN_URL . 'js/bootstrap.bundle.min.js', 'jquery', false, true);

  // enueque scipts
  wp_enqueue_script('applab_job_wp_register_script');
  wp_enqueue_script('applab_wp_register_script');
}
add_action('admin_enqueue_scripts', 'applab_job_wp_enqueue_scripts');
add_action('wp_enqueue_scripts', 'applab_job_wp_enqueue_scripts');

// bootstraping the plugin
function applab_job_plugin_activation()
{

  applab_career_create_app_tbl();
  applab_career_job_listing_pg();
  applab_career_job_detail_pg();
  flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'applab_job_plugin_activation');

add_action('init', 'applab_register_job_post_type');
add_action('init', 'applab_job_categories', 0);
add_action('add_meta_boxes', 'applab_job_listing_form');
// job listing 
function applab_job_listing_form()
{
  add_meta_box(
    'applab_jobs_meta_box',
    'Job Information',
    'applab_career_job_listing',
    'job_manager',
    'normal',
    'high'
  );
}
add_action('save_post', 'applab_career_job_save');
add_action('rest_api_init', 'my_job_listing_api_route');
add_action('admin_menu', function () {
  global $applab_job_plugin_name;
  add_submenu_page("edit.php?post_type=job_manager", "Job Applications", "Job Applications", 'edit_themes', $applab_job_plugin_name . "_applications", 'applab_career_applications');
});
function applab_career_applications()
{
  global $wpdb;
  $applab_app_table = $wpdb->prefix . 'applab_career_app';
  if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $job_id = $_GET['job_id'];
    $wpdb->delete('myjobs', array('id' => $job_id));
  }

  $applications = $wpdb->get_results("SELECT * FROM $applab_app_table ");
?>
  <div class="wrap">
    <h1 class="wp-heading-inline">My Jobs</h1>
    <table class="wp-list-table widefat fixed striped posts">
      <thead>
        <tr>
          <th scope="col" class="manage-column">Applicant Name</th>
          <th scope="col" class="manage-column">Applicant Email</th>
          <th scope="col" class="manage-column">Job</th>
          <th scope="col" class="manage-column">Resume</th>
          <th scope="col" class="manage-column">Message</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($applications as $application) :

        ?>
          <tr>
            <td><?php echo $application->app_name; ?></td>
            <td><?php echo $application->app_email; ?></td>
            <td><?php echo get_the_title($application->job_title); ?></td>
            <td><a download href="<?php echo $application->app_cv ?>">Download</a></td>
            <td><?php echo $application->app_msg; ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>


<?php
}
add_filter('template_include', 'applab_career_joblisting');
function applab_career_joblisting($template)
{
  // Check if we're on a specific page or post
  if (is_page('job_manager')) {
    // Look for a template file in the plugin directory
    $new_template = plugin_dir_path(__FILE__) . 'templates/tempalte-applab-career-job-manager.php';
    if (file_exists($new_template)) {
      return $new_template;
    }
  }
  return $template;
}

add_filter('template_include', 'applab_career_job_detail');
function applab_career_job_detail($template)
{
  // Check if we're on a specific page or post
  if (is_page('job-detail') || is_singular('Job Manager') || "job_manager" === get_post_type() || is_page('job-manager')) {
    // Look for a template file in the plugin directory
    $new_template = plugin_dir_path(__FILE__) . 'templates/template-applab-career-job-detail.php';
    if (file_exists($new_template)) {
      return $new_template;
    }
  }
  return $template;
}
