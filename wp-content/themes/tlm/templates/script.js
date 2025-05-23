
/**
 * Template Name: Traitement Contact
 *
 * @package TLM
 * @author Lynda El Kolli
 */

// S'assure que le DOM est parsé avant de lancer le script
// (que l'HTML est entièrement chargé)
 document.addEventListener("DOMContentLoaded", function () {

  // Récupérez le formulaire de la page et le stockez au sein d'une constante.
    const form = document.getElementById("contactForm");
  
    // Ecoutez la soumission du formulaire.
    form.addEventListener("submit", async function (e) {

      // Empêchez le navigateur de soumettre le formulaire de façon normale
      // (quand on clique sur le bouton d'envoi ça ne recharge plus la page)
      e.preventDefault();

      // Vide l'élément qui a pour classe ".submit-results";
      document.querySelector(".submit-results").innerHTML = "";

      // Videz toutes les erreurs
      document.querySelectorAll(".error").forEach(el => el.innerText = "");
      document.getElementById("resultat").innerText = "";
      
      // Créez un FormData qui contient les données du formulaire
      const formData = new FormData(form);
      
      // Créez un objet vide qui a pour objectif de contenir les erreurs
      const erreurs = {};

      // L'idée c'est d'envoyer les données à PHP via fetch puis de récupérer ce que PHP nous renvoie (succès ou erreurs)
     
      try {

        console.log(traitementUrl);

        // Envoie à PHP les données du formulaire via fetch
        const response = await fetch(traitementUrl, {
          method: "POST",
          body: formData
        });
  
        // Récupérez le contenu de la response (ce que le fichier PHP a transmis)
        const result = await response.json();

        // C'est que l'envoi s'est bien passé
        if(result.success === true) {
          // Afficher un message de succès sur la pge
          document.querySelector(".submit-results").innerHTML += `<p>Votre message nous a été transmis avec succès.</p>`;
        }
        // Une ou plusieurs erreurs ont eu lieu (c'est que result.success === false)
        else{


          // Ajouter une condition qui permet de vérifier si il y a des erreurs.
          // (pour Yohann)

          // Afficher chaque erreur indépendament
          Object.values(result.erreurs).forEach(error => {
            // Injecter chaque erreur sous forme de liste à puce au sein d'un élément HTML.
            document.querySelector(".submit-results").innerHTML += `<li class="error">${error}</li>`;
          })
        }

        // form.reset permet de vider le formulaire et le données précédemment saisies.
        // form.reset();

      } catch (error) {
        document.getElementById("resultat").innerHTML = "Erreur lors de l'envoi.";
      }
    });
  });
  

