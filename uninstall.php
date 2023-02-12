<?php

/**
 * all functions files includs
 * @package applab-career
 */

// Check if plugin is being deleted
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die();
}

global $wpdb;
$applab_table_1 = $wpdb->prefix . 'applab_career_app';
// Delete database tables
$wpdb->query("DROP TABLE IF EXISTS $applab_table_1");

// Delete pages
$page1_id = get_page_by_title('Job Detail');
$page2_id = get_page_by_title('Job Manager');
wp_delete_post($page1_id, true);
wp_delete_post($page2_id, true);
