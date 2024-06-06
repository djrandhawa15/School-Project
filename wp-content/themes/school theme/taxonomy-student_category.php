<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package School_Theme
 */

get_header();
?>



<div class="taxonomy-term">

    <h1><?php single_term_title(); ?></h1>

    <?php

    $term = get_queried_object();

    $args = array(

        'post_type' => 'student',

        'tax_query' => array(

            array(

                'taxonomy' => 'student_category',

                'field'    => 'slug',

                'terms'    => $term->slug,

            ),

        ),

    );

    $student_query = new WP_Query($args);



    if ($student_query->have_posts()) :

        while ($student_query->have_posts()) : $student_query->the_post(); ?>

            <div class="student-item">

                <h2 class="student-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                <div class="student-content">

                    <?php the_content(); ?>

                </div>

                <?php if (has_post_thumbnail()) : ?>

                    <div class="student-thumbnail">

                        <?php the_post_thumbnail(array(200, 300)); ?>

                    </div>

                <?php endif; ?>

            </div>

        <?php endwhile;

        wp_reset_postdata();

    else :

        echo '<p>No students found in this category</p>';

    endif;

    ?>

</div>



<?php get_footer(); ?>

