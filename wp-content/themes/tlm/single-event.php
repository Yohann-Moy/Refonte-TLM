<?php
/**
 * The template for displaying all single events
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Tracy-le-Mont
 * @author Karl Clémence
 */

get_header();
?>
	<main id="primary" class="site-main">
		<?php 
			$monEvent = get_field('events');
			
			$date = $monEvent["date"];
			// A vous de continuer ...

			// Pour m'assurer que les champs sont est bien récupérés :
			var_dump($date);
		?>
	</main><!-- #main -->
<?php 
get_footer();
