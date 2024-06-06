<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

 get_header();
?>

<div class="single-student">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <h1 class="student-name"><?php the_title(); ?></h1>
            <div class="student-content"><?php the_content(); ?></div>
            <?php if (has_post_thumbnail()) : ?>
                <div class="student-thumbnail"><?php the_post_thumbnail(); ?></div>
            <?php endif; ?>

            <div class="related-students">
                <h2>Other Students in <?php echo get_the_term_list(get_the_ID(), 'student_category', '', ', '); ?></h2>
                <?php
                $terms = wp_get_post_terms(get_the_ID(), 'student_category');
                if ($terms) {
                    $term_ids = wp_list_pluck($terms, 'term_id');

                    $related_args = array(
                        'post_type' => 'student',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'student_category',
                                'field'    => 'term_id',
                                'terms'    => $term_ids,
                                'operator' => 'IN',
                            ),
                        ),
                        'post__not_in' => array(get_the_ID()),
                        'posts_per_page' => 5,
                    );

                    $related_query = new WP_Query($related_args);

                    if ($related_query->have_posts()) :
                        echo '<ul>';
                        while ($related_query->have_posts()) : $related_query->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile;
                        echo '</ul>';
                        wp_reset_postdata();
                    else :
                        echo '<p>No other students found.</p>';
                    endif;
                }
                ?>
            </div>
        <?php endwhile;
    endif;
    ?>
</div>

<?php get_footer(); ?>
