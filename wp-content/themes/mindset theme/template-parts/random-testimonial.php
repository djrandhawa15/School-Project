<?php
$args = array(
    'post_type' => 'fwd-testimonial',
    'orderby'   => 'rand',
    'posts_per_page' => '1'
);

$query = new WP_Query($args);

if( $query -> have_posts()) {
    echo ' <h3> What They Say </h3>';
    while ( $query -> have_posts() ){
        $query -> the_post();
        ?>
        <article>
            <?php the_content(); ?>
        </article>
        <?php
    }
    wp_reset_postdata();
    }  
?>