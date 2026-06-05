<?php
/**
 * The main template file — fallback for all content.
 *
 * @package ufi-daman
 */

get_header();
?>

<main>
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
endif;
?>
</main>

<?php get_footer(); ?>
