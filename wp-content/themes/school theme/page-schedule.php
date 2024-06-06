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

	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'page' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;	
	endwhile; // End of the loop.
	?>
	<?php
	// Check if the repeater field has rows of data
	if( have_rows('schedule') ): ?>
		<h4 class="caption">Weekly Course Schedule</h4>
		<table class="program-schedule">
			<thead>
				<tr>
					<th>Date</th>
					<th>Course</th>
					<th>Instructor</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			// Loop through the rows of data
			while ( have_rows('schedule') ) : the_row();
				// Get sub field values
				$date = get_sub_field('date');
				$course = get_sub_field('course');
				$instructor = get_sub_field('instructor');
			?>
				<tr>
					<td><?php echo esc_html($date); ?></td>
					<td><?php echo esc_html($course); ?></td>
					<td><?php echo esc_html($instructor); ?></td>
				</tr>
			<?php endwhile; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p>No schedule found.</p>
	<?php endif; ?>
</main><!-- #primary -->

<?php

// get_sidebar();

get_footer();

?>

