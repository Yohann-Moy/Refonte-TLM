<?php

/**
 * Template Name: Contact
 *
 * @package TLM
 * @author Lynda El Kolli
 */

get_header();
?>
<script>
  const traitementUrl = "<?php echo esc_url( get_template_directory_uri() . '/templates/traitement-contact.php' ); ?>";
</script>
<main>

  <div class="mxw">
  <h1 class= "title-icon"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/icone/icon-mail.svg' ); ?>" alt="Icone contact" class="icon-title" />
    <?php echo get_the_title(); ?></h1>

  <div class="content">
    <?php echo get_the_content(); ?> 

    <form id="contactForm" method="POST" action="<?php echo esc_url( get_template_directory_uri() . '/templates/traitement-contact.php' ); ?>">
      <div class="ligne-champs">
        <input type="text" name="nom" id="nom" class ="input-champ champ-50" placeholder="Votre nom *" required>
        <input type="text" name="prenom" id="prenom" class ="input-champ champ-50" placeholder="Votre prénom *" required>
      </div>

        <input type="email" name="email" id="email" class ="input-champ" placeholder="Votre email *" required>

        <select name="objet" id="objet" required>
          <option value="">Sélectionnez une option *</option>
          <option value="Documents">Demande de documents</option>
          <option value="RDV">Prendre un RDV</option>
          <option value="Entreprise">Ajouter votre entreprise</option>
          <option value="Association">Ajouter votre association</option>
          <option value="Autre">Autres demandes</option>
        </select>

        <textarea name="message" id="message" placeholder="Décrivez votre demande en quelques lignes *" required></textarea>

        <p class="info-obligatoire">* Les champs marqués d’un astérisque sont obligatoires.</p>
        <div class="form-group">
          <input type="checkbox" name="cgu" id="cgu" required>
          <label for="cgu">En soumettant ce formulaire, j'admets être en accord avec  les mentions légales.</label>
        </div>
  
      <button  type="submit" class="btn-submit" alt="Icone flèche" class="icon-arrow">
        <span>Envoyer</span>
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/icone/plane-icon.svg' ); ?>">
      </button>
    </form>

    <div class="submit-results"></div>

  </div>

  </div><!-- .mxw -->
</main>

<?php

get_footer(); 
?>
