<?php

/**
 * all functions files includs
 * @package applab-career
 */

defined('ABSPATH') || die("I'm just a plugin, I don't do much by calling directly :) ");

define('APPLAB_CAREER_INC_DIR', plugin_dir_path(__FILE__) . 'inc/');


require_once  APPLAB_CAREER_INC_DIR . 'function-applab-db-tables.php';
require_once APPLAB_CAREER_INC_DIR . 'function-applab-reg-job-type.php';
require_once APPLAB_CAREER_INC_DIR . 'function-applab-job-categories.php';
require_once APPLAB_CAREER_INC_DIR . 'function-applab-job-listing.php';
