<?php /**
 * The template for displaying archive pages for staff
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header(); ?>
<main id="primary" class="site-main">

		<header class="page-header">
            <h1 class="page-title">The Class</h1>

<div class="students">
    <?php
    $args = array(
        'post_type' => 'student',
        'orderby' => 'title',
        'order' => 'ASC',
        'posts_per_page' => -1,
    );
    $student_query = new WP_Query($args);

    if ($student_query->have_posts()) :
        while ($student_query->have_posts()) : $student_query->the_post(); ?>
            <article class="student-item">
            <h2 class="student-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="student-thumbnail">
                        <?php the_post_thumbnail('medium', 200, 300, true); ?>
                    </div>
                <?php endif; ?>
                
                <div class="student-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt(), 25, ' <br><a href="' . get_permalink() . '">Read More about the Student</a>'); ?>
                </div>

                <div class="student-taxonomy">
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'student_category');
                    if ($terms && !is_wp_error($terms)) :
                        foreach ($terms as $term) :
                            echo 'Speciality:' . '<a href="' . get_term_link($term) . '">' . $term->name . '</a> ';
                        endforeach;
                    endif;
                    ?>
                </div>
            </article>
        <?php endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No students found</p>';
    endif;
    ?>
</div>

</main>

<?php get_footer(); ?>
