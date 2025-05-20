
/**
 * Template Name: Traitement Contact
 *
 * @package TLM
 * @author Lynda El Kolli
 */

 document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
  
    form.addEventListener("submit", async function (e) {
      e.preventDefault();
  
      
      document.querySelectorAll(".error").forEach(el => el.innerText = "");
      document.getElementById("resultat").innerText = "";
  
      
      const formData = new FormData(form);
  
      const erreurs = {};
  
      if (!formData.get("nom").trim()) erreurs.nom = "Le nom est requis.";
      if (!formData.get("prenom").trim()) erreurs.prenom = "Le prénom est requis.";
      if (!formData.get("email").trim()) erreurs.email = "L’email est requis.";
      if (!formData.get("objet")) erreurs.objet = "L’objet est requis.";
      if (!formData.get("message").trim()) erreurs.message = "Le message est requis.";
      if (!formData.get("cgu")) erreurs.cgu = "Vous devez accepter les conditions.";
  
     
      for (let champ in erreurs) {
        document.getElementById("error-" + champ).innerText = erreurs[champ];
      }
  
      if (Object.keys(erreurs).length > 0) return;
  
     
      try {
        const response = await fetch(traitementUrl, {
          method: "POST",
          body: formData
        });
  
        const result = await response.json();
        document.getElementById("resultat").innerHTML = result;
        form.reset();

        
  
      } catch (error) {
        document.getElementById("resultat").innerHTML = "Erreur lors de l'envoi.";
      }
    });
  });
  

