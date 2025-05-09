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
    
  
    
        <h1><?php echo get_the_title(); ?></h1>
        
        <div class="content">
        <?php echo get_the_content(); ?> 
          <form action="<?php echo get_template_directory_uri(); ?>/templates/traitement-contact.php" method="post">
          <div>
          
            <input type="text" name="nom" placeholder="Votre nom *" id="nom"required>
          
            <input type="text" name="prenom" placeholder="Votre prénom *" id="prenom"required> 
        </div>
       
       
     
            <input type="email" name="email" placeholder="Votre email *" id="email"required>
       
      
            <select name="objet" id="objet" required> 
            <option value="no-option"> Sélectionnez une option * </option>
            <option value="objet0">Demande de documents: actes de naissance, acte de décès, acte de mariage, autres</option>
            <option value="objet1">Prendre un RDV</option>
            <option value="objet2">Ajouter votre Entreprise</option>
            <option value="objet3">Ajouter votre Association</option>
            <option value="objet4">Autres demandes</option>

          </select>
       
        
            <textarea name="message" placeholder="Décrivez votre demande en quelques lignes *"></textarea>
      
        <div> 
               <p class="obligation"> * Les champs obligatoires sont marqués d’un astérisque. </p>

                <input type="checkbox" name="cgu" id="cgu" required>
                <label for="cgu">En soumettant ce formulaire, j'admets être en accord avec les mentions légales. </label>

            </div>
        <input type="submit" value="Envoyer">
 

          </form>
        </div>
     

</main>

<?php

get_footer(); 
?>
