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

<div class="title-page">
  <h1><?php echo get_the_title(); ?></h1>
</div>

  <div class="content">
    <?php echo get_the_content(); ?> 

    <div id="resultat"></div>

    <form id="contactForm" method="POST" action="<?php echo esc_url( get_template_directory_uri() . '/templates/traitement-contact.php' ); ?>">
      <div class="ligne-champs">
        <input type="text" name="nom" id="nom" class ="input-champ champ-50" placeholder="Votre nom *" required>
        <span class="error" id="error-nom"></span>

        <input type="text" name="prenom" id="prenom" class ="input-champ champ-50" placeholder="Votre prénom *" required>
        <span class="error" id="error-prenom"></span>
      </div>

      <div class="form-group">
        <input type="email" name="email" id="email" class ="input-champ" placeholder="Votre email *" required>
        <span class="error" id="error-email"></span>
      </div>

      <div class="form-group">
        <select name="objet" id="objet" required>
          <option value="">Sélectionnez une option *</option>
          <option value="Documents">Demande de documents</option>
          <option value="RDV">Prendre un RDV</option>
          <option value="Entreprise">Ajouter votre entreprise</option>
          <option value="Association">Ajouter votre association</option>
          <option value="Autre">Autres demandes</option>
        </select>
        <span class="error" id="error-objet"></span>
      </div>

      <div class="form-group">
        <textarea name="message" id="message" placeholder="Décrivez votre demande en quelques lignes *" required></textarea>
        <span class="error" id="error-message"></span>
      </div>

      <div class="form-group">
      
        <p class="info-obligatoire">* Les champs marqués d’un astérisque sont obligatoires.</p>
        <input type="checkbox" name="cgu" id="cgu" required>
        <label for="cgu">En soumettant ce formulaire, j'admets être en accord avec  les mentions légales.</label>
        <span class="error" id="error-cgu"></span>
      </div>
  
      <input type="submit" value="Envoyer">
    </form>

    <div class="submit-results"></div>

  </div>
</main>
     

</main>

<?php

get_footer(); 
?>
