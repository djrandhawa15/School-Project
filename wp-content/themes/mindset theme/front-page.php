<?php
/**
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
            ?>
            <section class="home-intro">
                <h1><?php the_title(); ?></h1>
                <?php the_post_thumbnail( 'large' ); ?>
                <?php
                if ( function_exists( 'get_field' ) ) {
                    if ( get_field( 'top_section' ) ) {
                        the_field( 'top_section' );
                    }
                }
                ?>
            </section>

            <?php       
            $args = array(
                'post_type' => 'fwd-work',
                'posts_per_page' => 4
            );
            //while loop will run through all Work posts
            $query = new WP_Query($args);
            if($query->have_posts()); ?>
                    
            <section class="home-work">
            <h2>Featured Works</h2>
            <?php
            while($query -> have_posts()){
                $query -> the_post();
                ?>
                <article>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                        <h3><?php the_title();?></h3>
                    </a>
                </article>
                <?php
            }
            wp_reset_postdata();
    
                ?>
            </section>
		
            <section class="home-work">
            <h2>Featured Works (Relationship Field)</h2>
            <?php
            $args = array(
                'post-type' => 'fwd-work',
                'posts_per_page' => 4,
                'tax_query'      => 
                    array(
                        'taxonomy' => 'fwd-featured',
                        'field'    => 'slug',
                        'terms'    => 'front-page'
                )
            );
            if ( function_exists( 'get_field' ) ) : 
                $featured_works = get_field('relationship');
                if ($featured_works) :
                    foreach($featured_works as $post) :
                        setup_postdata($post);
                        ?>
                        <article class="front-portfolio">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                                <h3><?php the_title(); ?></h3>
                            </a>
                        </article>
                        <?php 
                    endforeach;
                    wp_reset_postdata();
                endif;
            endif;
            ?>
            </section>

            <section class="home-left">
            <?php
            if ( function_exists( 'get_field' ) ) {
                if ( $left_section_heading = get_field( 'left_section_heading' ) ) {
                    echo '<h2>' . esc_html( $left_section_heading ) . '</h2>';
                }
                if ( $left_section_content = get_field( 'left_section_content' ) ) {
                    echo '<p>' . esc_html( $left_section_content ) . '</p>';
                }
            }
            
            ?>
            </section>

            <section class="home-right">
            <?php
            if ( function_exists( 'get_field' ) ) {
                if ( $right_section_heading = get_field( 'right_section_heading' ) ) {
                    echo '<h2>' . esc_html( $right_section_heading ) . '</h2>';
                }
                if ( $right_section_content = get_field( 'right_section_content' ) ) {
                    echo '<p>' . esc_html( $right_section_content ) . '</p>';
                }
            }
            ?>
            </section>

            <section class="home-slider">
            <h2>Testimonials</h2>
            <?php
            $args = array(
                'post_type'      => 'fwd-testimonial',
                'posts_per_page' => -1
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) : ?>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <div class="swiper-slide">
                                <?php the_content(); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <?php
                wp_reset_postdata();
            endif;
            ?>
            </section>

            <section class="home-blog">
                <h2><?php esc_html_e( 'Latest Blog Posts', 'fwd' ) ?></h2>
                <?php
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' =>  4
                );
                $blog_query = new WP_Query( $args );
                if( $blog_query -> have_posts()) {
                    while( $blog_query -> have_posts()){
                        $blog_query -> the_post();
                        ?>
                        <article>
                            <?php
                            if( has_post_thumbnail()){
                                the_post_thumbnail( 'featured-images');
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>">
                            <h3><?php the_title(); ?></h3>
                            <h6><?php echo get_the_date(); ?></h6>
                            </a>
                        </article>
                        <?php
                    }
                    wp_reset_postdata();
                }
                ?>
            </section>
            <?php
        endwhile; // End of the loop.
        ?>
    </main><!-- #primary -->
<?php

get_footer();
