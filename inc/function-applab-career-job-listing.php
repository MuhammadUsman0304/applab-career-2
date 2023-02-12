<?php

/**
 * job listing form
 * @package applab-career
 */

function applab_career_job_listing($post)
{

    $mypostid = $post->ID;

    $applab_job_type = stripslashes(get_post_meta($mypostid, 'applab_job_type', true));
    $applab_start_date = stripslashes(get_post_meta($mypostid, 'applab_start_date', true));
    $applab_end_date = stripslashes(get_post_meta($mypostid, 'applab_end_date', true));
    $applab_locations = stripslashes(get_post_meta($mypostid, 'applab_locations', true));
    $applab_comp_name = stripslashes(get_post_meta($mypostid, 'applab_comp_name', true));
    $applab_is_featured = get_post_meta($mypostid, 'applab_is_featured', true);

?>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_job_type"><?php _e('Type (Full time, Part time, Contract)', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_job_type" type="text" id="applab_job_type" value="<?php echo esc_html($applab_job_type); ?>" class="form-control" />
    </div>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_start_date"><?php _e('Start Date', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_start_date" type="date" id="applab_start_date" value="<?php echo esc_html($applab_start_date); ?>" class="form-control" />
    </div>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_end_date"><?php _e('Expiry Date', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_end_date" type="date" id="applab_end_date" value="<?php echo esc_html($applab_end_date); ?>" class="form-control" />
    </div>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_locations"><?php _e('Location', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_locations" type="text" id="applab_locations" value="<?php echo esc_html($applab_locations); ?>" class="form-control" />
    </div>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_comp_name"><?php _e('Company Name', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_comp_name" type="text" id="applab_comp_name" value="<?php echo esc_html($applab_comp_name); ?>" class="form-control" />
    </div>
    <br style="clear:both;" />
    <div class="AdmfrmLabel">
        <label for="applab_comp_name"><?php _e('if featured (yes)', 'applab-career'); ?></label>
    </div>
    <div class="AdmfrmFld">
        <input name="applab_is_featured" type="text" id="applab_is_featured" value="<?php echo $applab_is_featured; ?>" class="form-control" />
    </div>


    <br style="clear:both;" />
<?php
}

// saving post info

function applab_career_job_save($postID)
{
    global $wpdb;
    if ($parent_id = wp_is_post_revision($postID)) {
        $postID = $parent_id;
    }
    if (isset($_POST['applab_job_type'])) {
        update_post_meta($postID, 'applab_job_type', sanitize_text_field($_POST['applab_job_type']));
    }
    if (isset($_POST['applab_start_date'])) {
        update_post_meta($postID, 'applab_start_date', sanitize_email($_POST['applab_start_date']));
    }
    if (isset($_POST['applab_end_date'])) {
        update_post_meta($postID, 'applab_end_date', sanitize_text_field($_POST['applab_end_date']));
    }
    if (isset($_POST['applab_locations'])) {
        update_post_meta($postID, 'applab_locations', sanitize_text_field($_POST['applab_locations']));
    }
    if (isset($_POST['applab_comp_name'])) {
        update_post_meta($postID, 'applab_comp_name', sanitize_text_field($_POST['applab_comp_name']));
    }
    if (isset($_POST['applab_is_featured'])) {
        update_post_meta($postID, 'applab_is_featured', $_POST['applab_is_featured']);
    }
}
