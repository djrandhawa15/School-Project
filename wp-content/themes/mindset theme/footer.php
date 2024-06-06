<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FWD_Starter_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-contact">
			
		</div><!-- .footer-contact -->
		<div class="footer-menus">
		<nav id="footer-navigation" class="footer-navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'footer-left' ) ); ?>
        </nav>
		<nav id="footer-navigation" class="footer-navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'footer-right' ) ); ?>
        </nav>
				
		
		</div><!-- .footer-menus -->
		<div class="site-info">
		<?php

		if (!is_page('contact'))
		{

		if ( function_exists( 'get_field' ) ) {

                if ( get_field( 'physical_address', 7 ) ) {
                    echo '<h2>';
					get_template_part('images/location');
                    the_field( 'physical_address', 7 );
                    echo '</h2>';
                }
                if ( get_field( 'email_address', 7 ) ) {
                    echo '<p>';
                    the_field( 'email_address', 7 );
                    echo '</p>';
                }

            }

		}
			?>
		<?php
		if ( function_exists( 'the_privacy_policy_link' ) ) {
			the_privacy_policy_link( '<div class="privacy-policy-link-wrapper">', '</div>' );
		}
		?>
			<?php esc_html_e( 'Created by ', 'fwd' ); ?><a href="<?php echo esc_url( __( 'https://wp.bcitwebdeveloper.ca/', 'fwd' ) ); ?>"><?php esc_html_e( 'Jonathon Leathers', 'fwd' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php get_template_part('images/custom-slider') ?>
<?php wp_footer(); ?>

</body>
</html>
