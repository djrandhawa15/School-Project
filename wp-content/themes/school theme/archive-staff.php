<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <div class="staff-page">

        <h1>Staff</h1>

        <p>Our dedicated staff is here to help our students succeed. You will find the faculty and administrative staff listed below. Please contact the appropriate individual with any questions.Vestibulum pretium neque leo, nec euismod ex interdum vitae. Etiam viverra, lorem sed lobortis mattis, lectus enim eleifend nisi, non dapibus nulla purus malesuada risus. Donec consectetur neque turpis, vitae varius lectus commodo vel.</p>



        <?php

        // Query for Administrative staff

        $args = array(

            'post_type' => 'staff',

            'tax_query' => array(

                array(

                    'taxonomy' => 'role',

                    'field'    => 'slug',

                    'terms'    => 'administrative',

					

                ),

            ),

			'orderby'    => 'title',

			'order'      => 'DESC',

        );

        $admin_query = new WP_Query($args);



        if ($admin_query->have_posts()) : ?>

			<section class="staff-wrapper">

				<h2>Administrative</h2>

					<?php while ($admin_query->have_posts()) : $admin_query->the_post(); ?>

						<article class="staff-item">

							<h3><?php the_title(); ?></h3>

							<p><?php the_field('short_bio'); ?></p>

						</article>

					<?php endwhile; ?>

			</section>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>



        <?php

        // Query for Faculty staff

        $args = array(

            'post_type' => 'staff',

            'tax_query' => array(

                array(

                    'taxonomy' => 'role',

                    'field'    => 'slug',

                    'terms'    => 'faculty',

                ),

            ),

        );

        $faculty_query = new WP_Query($args);



        if ($faculty_query->have_posts()) : ?>

		<section class="staff-wrapper">

            <h2>Faculty</h2>

                <?php while ($faculty_query->have_posts()) : $faculty_query->the_post(); ?>

                    <article class="staff-item">

                        <h3><?php the_title(); ?></h3>

                        <p><?php the_field('short_bio'); ?></p>

                        <p>Courses: <?php the_field('courses'); ?></p>

                        <p><a href="<?php the_field('instructor_website'); ?>">Instructor Website</a></p>

                    </article>

                <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

    </div>

</main>

<?php get_footer();

