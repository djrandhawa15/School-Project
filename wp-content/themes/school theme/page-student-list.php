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

<main id="primary" class="site-main">
    <h1>Students</h1>

    <?php
    $args = array(
        'post_type'      => 'student',
        'orderby'        => 'title',
        'order'          => 'ASC',
        'posts_per_page' => -1,
    );
    $student_query = new WP_Query( $args );

    if ( $student_query->have_posts() ) :
        while ( $student_query->have_posts() ) : $student_query->the_post();
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail( array( 200, 300 ) ); ?>
                </div>
            <?php endif; ?>

            <div class="entry-summary">
                <?php
                $excerpt = wp_trim_words( get_the_excerpt(), 25, '... <a href="' . get_permalink() . '">Read More</a>' );
                echo $excerpt;
                ?>
            </div>
        </article>
    <?php
        endwhile;
        wp_reset_postdata(); // Reset post data query
    else :
        echo 'No students found.';
    endif;
    ?>
</main>

<?php
get_footer();
?>