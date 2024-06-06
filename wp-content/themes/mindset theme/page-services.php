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
 * @package FWD_Starter_Theme
 */
get_header();
?>
    <main id="primary" class="site-main">
    <?php
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', 'page' );
//passing the ID to the links of services and redirect the services to the specific one by the ID's
        $args = array(
            'post_type'      => 'fwd-services',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC'
        );
        $query = new WP_Query( $args );
        if( $query -> have_posts() ) {
            while ( $query -> have_posts() ) {
                $query -> the_post();
                $service_id = esc_attr(get_the_ID());
                ?>
                <nav class="service-links">
                <article>
                <?php $service_id = get_the_ID();?>
                <a href="#service-<?php echo $service_id; ?>"><?php esc_html(the_title()); ?></a>
                    </a>
                </article>
                </nav>
                <?php
            }
            wp_reset_postdata();
        }
// display all services in ascending order
    $terms = get_terms(
        array(
            'taxonomy' => 'fwd-service-category',
        //    'tax_query' =>  $term->slug
        )
    );
    if ( $terms && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            $args = array(
                'post_type'      => 'fwd-services',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'fwd-service-category',
                        'field'    => 'slug',
                        'terms' => $term->slug
                    )
                )
            );
            $query = new WP_Query( $args );
            if( $query -> have_posts() ) {
                echo'<section class= "work-section"><h2>' . esc_html__($term->name) . '</h2>';
                while ( $query -> have_posts() ) {
                    $query -> the_post();
                    $service_id = esc_attr(get_the_ID());
                    ?>
                    <article>
                            <h2 id="service-<?php echo $service_id; ?>"><?php esc_html(the_title()); ?></h2>
                            <?php
                            if ( function_exists( 'get_field' ) ) {
                                if ( get_field( 'services') ) {
                                    the_field( 'services' );
                                }
                                }
                                ?>
                </article>
                    <?php
                }
                wp_reset_postdata();
                echo'</section>';
            }
        }
    }
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        endwhile; // End of the loop.
        ?>
    </main><!-- #primary -->
<?php
get_sidebar();
get_footer();