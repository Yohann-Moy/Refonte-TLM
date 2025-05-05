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
 
  if ( have_posts() ) :
    while ( have_posts() ) : the_post(); 
  ?>
      <article>
        <h1><?php the_title(); ?></h1>
        
        <div class="content">
          <?php the_content(); ?> 
          <form action="" method="post">
          <div>
            <input type="text" name="lastname" placeholder="Votre nom">
            <input type="text" name="firstname" placeholder="Votre prénom"> ">
        </div>
        <div>
            <select name="option" id=""></select>
          
        </div>
        <div>
            <input type="email" name="usermail" placeholder="Votre email">
        </div>
        <div>
            <textarea name="message" placeholder="Décrivez votre demande en quelques lignes"></textarea>
        </div>
        <div>
                <input type="checkbox" name="accept" id="accepte" required>
                <label for="accepte">En soumettant ce formulaire,j'admets être en accord avec les mentions légales </label>

            </div>
        <input type="submit" value="Envoyer">





          </form>
        </div>
      </article>

  <?php
    endwhile;
  endif;
  ?>
</main>

<?php

get_footer(); 
?>
