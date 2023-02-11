<?php

/**
 * job listing form
 * @package applab-career
 */

function applab_job_listing($post)
{

    $mypostid = $post->ID;
    $applab_job_type = stripslashes(get_post_meta($mypostid, 'applab_job_type', true));
    $applab_start_date = stripslashes(get_post_meta($mypostid, 'applab_start_date', true));
    $applab_end_date = stripslashes(get_post_meta($mypostid, 'applab_end_date', true));
    $applab_locations = stripslashes(get_post_meta($mypostid, 'applab_locations', true));
    $applab_salary = stripslashes(get_post_meta($mypostid, 'applab_salary', true));

?>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_job_type"><?php _e('Type (Full time, Part time, Contract)', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_job_type" type="text" id="applab_job_type" value="<?php echo esc_html($applab_job_type); ?>" />
    </div>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_start_date"><?php _e('Start Date', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_start_date" type="date" id="applab_start_date" value="<?php echo esc_html($applab_start_date); ?>" />
    </div>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_end_date"><?php _e('Expiry Date', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_end_date" type="date" id="applab_end_date" value="<?php echo esc_html($applab_end_date); ?>" />
    </div>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_locations"><?php _e('Location', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_locations" type="text" id="applab_locations" value="<?php echo esc_html($applab_locations); ?>" />
    </div>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_salary"><?php _e('Salary', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_salary" type="text" id="applab_salary" value="<?php echo esc_html($applab_salary); ?>" />
    </div>


    <br style="clear:both;" />
<?php
}
