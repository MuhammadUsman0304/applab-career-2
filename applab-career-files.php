<?php

/**
 * all functions files includs
 * @package applab-career
 */

defined('ABSPATH') || die("I'm just a plugin, I don't do much by calling directly :) ");

define('APPLAB_CAREER_INC_DIR', plugin_dir_path(__FILE__) . 'inc/');


require_once  APPLAB_CAREER_INC_DIR . 'function-applab-career-db-tables.php';
require_once APPLAB_CAREER_INC_DIR . 'function-applab-career-reg-job-type.php';
require_once APPLAB_CAREER_INC_DIR . 'function-applab-career-job-categories.php';
require_once APPLAB_CAREER_INC_DIR . 'function-applab-career-job-listing.php';
require_once APPLAB_CAREER_INC_DIR . 'function-applab-career-api.php';
