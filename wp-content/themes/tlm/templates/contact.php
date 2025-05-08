<?php

/**
 * Template Name: Contact
 *
 * @package TLM
 * @author Lynda El Kolli
 */


 ?>
<?php

get_header(); 
?>

<main>
    
  <?php
 
 
  ?>
      <article>
        <h1><?php echo get_the_title(); ?></h1>
        
        <div class="content">
        <?php echo get_the_content(); ?> 
          <form action="" method="post">
          <div>
            <input type="text" name="lastname" placeholder="Votre nom *" required>
            <input type="text" name="firstname" placeholder="Votre prénom *" required> 
        </div>
       
        <div>
            <input type="email" name="usermail" placeholder="Votre email *" required>
        </div>
        <div>
            <select name="objet" id="objet" required> 
            <option value=""> Sélectionnez un option * </option>
            <option value="objet0">Demande de documents: actes de naissance, acte de décès, acte de mariage, autres</option>
            <option value="objet1">Prendre un RDV</option>
            <option value="objet2">Ajouter votre Entreprise</option>
            <option value="objet3">Ajouter votre Association</option>
            <option value="objet4">Autres demandes</option>

          </select>
        </div>
        <div>
            <textarea name="message" placeholder="Décrivez votre demande en quelques lignes *"></textarea>
        </div>
        <div> 
               <p class="obligation"> * Les champs obligatoires sont marqués d’un astérisque. </p>

                <input type="checkbox" name="accept" id="accepte" required>
                <label for="accepte">En soumettant ce formulaire, j'admets être en accord avec les mentions légales. </label>

            </div>
        <input type="submit" value="Envoyer">
 








          </form>
        </div>
      </article>

  <?php
   // endwhile;
  //endif;
  ?>
</main>

<?php

get_footer(); 
?>
