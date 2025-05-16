<?php

/**
 * Template Name: Contact
 *
 * @package TLM
 * @author Lynda El Kolli
 */

get_header(); 
?>

<main>
    
  
    
<h1><?php echo get_the_title(); ?></h1>
  <div class="content">
    <?php echo get_the_content(); ?> 

    <div id="resultat"></div>

    <form id="contactForm" method="POST" action="<?php echo esc_url( get_template_directory_uri() . '/templates/traitement-contact.php' ); ?>"
      <div>
        <input type="text" name="nom" id="nom" placeholder="Votre nom *" required>
        <span class="error" id="error-nom"></span>

        <input type="text" name="prenom" id="prenom" placeholder="Votre prénom *" required>
        <span class="error" id="error-prenom"></span>
      </div>

      <div>
        <input type="email" name="email" id="email" placeholder="Votre email *" required>
        <span class="error" id="error-email"></span>
      </div>

      <div>
        <select name="objet" id="objet" required>
          <option value="">Sélectionnez une option *</option>
          <option value="Documents">Demande de documents</option>
          <option value="RDV">Prendre un RDV</option>
          <option value="Entreprise">Ajouter votre Entreprise</option>
          <option value="Association">Ajouter votre Association</option>
          <option value="Autre">Autres demandes</option>
        </select>
        <span class="error" id="error-objet"></span>
      </div>

      <div>
        <textarea name="message" id="message" placeholder="Décrivez votre demande *" required></textarea>
        <span class="error" id="error-message"></span>
      </div>

      <div>
        <input type="checkbox" name="cgu" id="cgu" required>
        <label for="cgu">J'accepte les mentions légales *</label>
        <span class="error" id="error-cgu"></span>
      </div>

      <input type="submit" value="Envoyer">
    </form>
  </div>
</main>
     

</main>
<script src="<?php echo get_template_directory_uri(); ?>/templates/mon-script-contact.js"></script>
<?php

get_footer(); 
?>
