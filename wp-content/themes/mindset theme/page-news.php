<?php
/**
 * The template for displaying news
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header(); ?>

<main id="primary" class="site-main">

    <?php
    // Define custom query parameters
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 10, // Adjust the number of posts to display
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1
    );

    // Get current page and append to custom query parameters array
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args['paged'] = $paged;

    // Instantiate custom query
    $custom_query = new WP_Query($args);

    // Pagination fix
    $temp_query = $wp_query;
    $wp_query = NULL;
    $wp_query = $custom_query;

    // Output custom query loop
    if ($custom_query->have_posts()) :
        while ($custom_query->have_posts()) :
            $custom_query->the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php
                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    ?>
                </header>

                <div class="entry-meta">
                    <span class="posted-on"><?php the_time('F j, Y'); ?></span>
                    <span class="byline"> by <?php the_author_posts_link(); ?></span>
                </div>

                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('full');
                }
                ?>

                <div class="entry-content">
                    <?php
                    the_excerpt();
                    ?>
                </div>

                <div class="entry-footer">
                    <span class="cat-links"><?php _e('Posted in: '); ?><?php the_category(', '); ?></span>
                    <span class="tags-links"><?php the_tags(__('Tagged: '), ', '); ?></span>
                </div>

                <div class="entry-comments">
                    <?php
                    // If comments are open or there's at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                </div>
            </article>

        <?php
        endwhile;

        // Display pagination
        the_posts_pagination(array(
            'prev_text' => __('Previous'),
            'next_text' => __('Next'),
        ));

    else :
        get_template_part('template-parts/content', 'none');
    endif;

    // Reset postdata
    wp_reset_postdata();

    // Reset main query object
    $wp_query = NULL;
    $wp_query = $temp_query;
    ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
