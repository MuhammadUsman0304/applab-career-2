<?php

/**
 * Template Name:  Job Detail
 * 
 * 
 * @package applab-career
 */


get_header();
$post_id = get_the_ID();

// form processing 
if (isset($_POST['apply_btn'])) {
    require_once(str_replace('//', '/', dirname(__FILE__) . '/') . '../../../../wp-config.php');

    $job_id = $_POST['applab_job_id'];
    $name = sanitize_text_field($_POST['applab_applicant_name']);
    $email = sanitize_text_field($_POST['applab_applicant_email']);
    $message = sanitize_text_field($_POST['applab_applicant_msg']);

    $supported_types = array('pdf', 'doc', 'docx');
    $app_cv = $_FILES['applab_applicant_cv']['name'];
    $ext = pathinfo($app_cv, PATHINFO_EXTENSION);

    if (!in_array($ext, $supported_types)) {
        echo "supported files types are 'pdf', 'doc', 'docx'";
        return;
    }
    // Table name
    global $wpdb;
    $table_name = $wpdb->prefix . 'applab_career_app';
    // checking if user arlready applied for the job 
    $chk_qry = "SELECT * FROM $table_name WHERE `app_email` = '$email' AND `app_job_id` = $post_id";
    $chk_qry_fire = $wpdb->get_results($chk_qry);
    $result_count = count($chk_qry_fire);
    if ($result_count > 0) {
        echo "you have already applied for this job";
        return;
    } else {


        if (!function_exists('wp_handle_upload')) {

            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        $app_resume = $_FILES['applab_applicant_cv'];
        $uploads = array('test_form' => false);
        $movefile = wp_handle_upload($app_resume, $uploads);
        if ($movefile && !isset($movefile['error'])) {
            $wp_filetype = $movefile['type'];
            $filename = $movefile['file'];
            $wp_upload_dir = wp_upload_dir();
            $attachment = array(
                'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
                'post_mime_type' => $wp_filetype,
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                'post_content' => ''
            );
            $attach_id = wp_insert_attachment($attachment, $filename);
        } else {
            // Error uploading the image
            echo "Error uploading image";
            echo $movefile['error'];
        }



        // Insert the data into the table
        $save_app =  $wpdb->insert(
            $table_name,
            array(
                'app_name' => $name,
                'app_job_id' => $job_id,
                'app_email' => $email,
                'app_cv' => $wp_upload_dir['url'] . '/' . basename($filename),
                'app_msg' => $message,
            ),
            array(
                '%s',
                '%d',
                '%s',
                '%s',
                '%s'
            )
        );

        if ($save_app) {
            echo "application submited";
        } else {
            echo "not submited";
        }
    }
}


$job_cate = get_the_terms($post_id, 'job_category');

if ($post_id) :
?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card p-4 border-0">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo get_the_title($post_id) ?></h4>
                        <small><i class="dashicons dashicons-location"></i> <?php echo get_post_meta($post_id, 'applab_locations') ?> |<i class="dashicons dashicons-clock"></i> <?php echo get_post_meta($post_id, 'applab_job_type')  ?> |<i class="dashicons dashicons-category"></i> <?php echo $job_cate[0]->name ?> </small>
                    </div>
                    <div class="card-body">
                        <p><?php echo get_the_content($post_id) ?></p>
                        <div class="form my-5">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="apply_job">
                                <input type="hidden" name="applab_job_id" value="<?php echo $post_id ?>">
                                <div class="form-group">
                                    <label for="applab_applicant_name">Applicant Name </label>
                                    <input type="text" name="applab_applicant_name" id="applab_applicant_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="applab_applicant_email">Applicant Email </label>
                                    <input type="email" name="applab_applicant_email" id="applab_applicant_email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="applab_applicant_cv">Applicant CV </label>
                                    <input type="file" name="applab_applicant_cv" id="applab_applicant_cv" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="applab_applicant_msg">Message </label>
                                    <textarea name="applab_applicant_msg" id="applab_applicant_msg" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <input type="submit" value="Submit Application" class="btn btn-info" name="apply_btn">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row d-flex">
                    <div class="col-md-4"><img src="<?php echo get_the_post_thumbnail_url($post_id, 'thumbnail') ?>" alt="" width="80px" height="80px"></div>
                    <div class="col-md-8">
                        <h4 class="company-name"><?php echo get_post_meta($post_id, 'applab_comp_name') ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
endif;
?>




<?php get_footer();  ?>