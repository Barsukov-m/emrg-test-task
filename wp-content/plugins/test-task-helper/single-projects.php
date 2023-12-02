<?php
/**
 * Template for displaying Projects CPT.
 */

tth_get_theme_header();
?>

	<main id="main" class="site-main projects-single">
		<div class="page-content">

			<?php
			while ( have_posts() ) :
				the_post();

				include 'parts/projects-content.php';

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</div>
	</main><!-- #main -->

<?php
tth_get_theme_footer();
