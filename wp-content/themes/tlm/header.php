<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Tracy-le-Mont
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
	<header class="on-init">

		<nav>
			<div class="logo-container">
				<?php the_custom_logo(); ?>
				<button id="burger-toggler">
					<span></span>
				</button>
			</div>

			<?php
				// Tableau d'arguments permettant d'aller chercher le menu adéquat
				$args = [
					"menu_class" => "primary-menu", // Pour ajouter une classe sur l'élément UL du menu
					"name"=> "Main Menu", // Le nom du menu que l'on souhaite afficher
					"container_class" => "main-navigation",
				];

				// Va chercher le menu selon les arguments passés en paramètre et affiche le menu par la même occasion.
				wp_nav_menu($args);
			?>
		</nav>
	</header><!-- #masthead -->
