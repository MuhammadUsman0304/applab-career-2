<?php

/**
 * Template Name: Job Manager
 * 
 * @package applab-career
 */


get_header();
echo '<div class="conainter">
        <div class="row">
            <div class="col-lg-8 mx-auto">';
$posts = get_posts(array(
    'post_type' => 'job_manager',
    'post_status' => 'publish',
    'posts_per_page' => -1,
));

$jobs = array();

foreach ($posts as $post) :
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


?>

    <a href="<?php echo get_permalink($job_id) ?>" class="text-dark text-decoration-none">
        <div class="card border-0 my-4 p-3">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><?php echo $job_title ?></h4>
                    </div>
                    <div class="col-md-6">
                        <h6 class="float-end"><?php echo $job_comp_name ?></h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p><?php echo $job_title ?></p>
            </div>
            <div class="card-footer">
                <small>
                    <i class="dashicons dashicons-location"> </i> <?php echo $job_location ?> | <i class="dashicons dashicons-category"> </i> <?php echo $job_category ?> | <i class="dashicons dashicons-clock"> </i> <?php echo $job_end_date ?>
                </small>
            </div>
        </div>
    </a>



<?php
endforeach;
echo ' </div>
    </div>
    </div>';
?>




<?php get_footer(); ?>