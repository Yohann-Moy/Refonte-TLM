<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Tracy-le-Mont
 */

?>

	<footer>
		<div class="top-container">
			<div class="logo-container">
				<?php the_custom_logo(); ?>
			</div>
			<div class="hours-container">
				<p class="title">Horaires&nbsp;:</p>
				<?php 
					$infosPageID = 197;
					echo get_field("open_hours", $infosPageID);
				?>
			</div><!-- .hours-container -->

			<div class="contact-container">
				<p class="title">Contact rapide&nbsp;:</p>
				<?php $address = get_field("contact_infos", $infosPageID); ?>
				<?php $methods = get_field("contact_methods", $infosPageID);?>
				<ul>
					<li class="element">
						<span class="icon location"></span>
						<span class="text-content">
							<ul class="top-on-each-other">
								<li><?= $address["address"]; ?></li>
								<li><?= $address["postal_code"]." ".$address["city"]; ?></li>
							</ul>
						</span><!-- .text-content -->
					</li>

					<li class="element">
						<span class="icon phone"></span>
						<span class="text-content">
							<ul>
								<li>
									<a href="tel:<?= $methods["phone"]; ?>" target="_blank" title="En cliquant sur ce lien, vous téléphonerez directement à la mairie de Tracy-le-Mont." aria-label="En cliquant sur ce lien, vous téléphonerez directement à la mairie de Tracy-le-Mont.">
										<?= $methods["phone"]; ?>
									</a>
								</li>
							</ul>
						</span><!-- .text-content -->
					</li>

					<li class="element">
						<span class="icon mail"></span>
						<span class="text-content">
							<ul>
								<!-- Insérer le lien, le title et l'aria-label -->
								<li>
									<a href="mailto:<?= $methods["mail"]; ?>" title="En cliquant sur ce lien, cela ouvrira votre logiciel de messagerie afin d'envoyer un mail directement adressé à la mairie de Tracy-le-Mont." aria-label="En cliquant sur ce lien, cela ouvrira votre logiciel de messagerie afin d'envoyer un mail directement adressé à la mairie de Tracy-le-Mont." target="_blank">
										<?= $methods["mail"]; ?>
									</a>
								</li>
							</ul>
						</span><!-- .text-content -->
					</li>
				</ul>
			</div><!-- .contact-container -->

			<div class="partners-container">
				<p class="title">Nos partenaires&nbsp;:</p>
				<!-- lien, title et aria-label à définir -->
				<a href="https://ccloise.com/" title="En cliquant sur ce lien, vous serez redirigé vers le site web de la communauté de communes des lisières de l'Oise, partenaire majeur de la commune de Tracy-le-Mont." aria-label="En cliquant sur ce lien, vous serez redirigé vers le site web de la communauté de communes des lisières de l'Oise, partenaire majeur de la commune de Tracy-le-Mont." target="_blank" class="icon cclo"></a>
				<a href="https://www.oise.fr/" title="En cliquant sur ce lien, vous serez redirigé vers le site web du département de l'Oise, partenaire de la commune de Tracy-le-Mont." aria-label="En cliquant sur ce lien, vous serez redirigé vers le site web du département de l'Oise, partenaire de la commune de Tracy-le-Mont." class="icon oise"></a>
			</div><!-- .partners-container -->

		</div><!-- .top-container -->
	</footer>

<?php wp_footer(); ?>

</body>
</html>
