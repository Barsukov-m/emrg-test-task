<?php
/**
 * Projects CPT content.
 */
?>

<?php the_post_thumbnail(); ?>
<h1><?php echo get_the_title(); ?></h1>
<p><b>Author:</b> <?php the_author(); ?></p>
<?php the_content(); ?>