<?php

/**
 * create table 
 * @package applab-career
 */

// creating table for jobs

function applab_create_jobs_tbl()
{
    global $wpdb;
    $tbl = $wpdb->prefix;
    $table_name = $tbl . "applab_jobs";

    $tbl_jobs = "CREATE TABLE IF NOT EXISTS `$table_name` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(100) NOT NULL,
  `job_desc` text NOT NULL,
  `job_type` varchar(55) NOT NULL,
  `job_category` varchar(55) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `startDate` date,
  `endDate` date,
  `is_featured` int(11) default 0,
  `is_taken` int(11) default 0,
  PRIMARY KEY (`job_id`)
);";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($tbl_jobs);
}


// creating table for application

function applab_create_app_tbl()
{
    global $wpdb;
    $tbl = $wpdb->prefix;
    $table_name = $tbl . "applab_applications";

    $tbl_app = "CREATE TABLE IF NOT EXISTS `$table_name` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(130) NOT NULL,
  `app_job_id` int(11) NOT NULL,
  `app_email` varchar(130) NOT NULL,
  `app_phone` varchar(130) NOT NULL,
  `app_cv` text NOT NULL,
  PRIMARY KEY (`app_id`)
);";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($tbl_app);
}
