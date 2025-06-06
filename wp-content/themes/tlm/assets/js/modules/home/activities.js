document.addEventListener("DOMContentLoaded", () => {

  console.log("activities file loaded");

  // Récupère tous les éléments qui ont la classe ".activity" au sein du DOM.
  var activities = Array.from(
    document.querySelectorAll("#activities .activity")
  );

  const bigActivity = document.querySelector(
    "#activities .activity:first-of-type"
  );

  // Récupère l'endroit au sein duquel on va inserer le contenu de l'activité.
  var textContainer = bigActivity.querySelector(".textContainer");

  // On vérifie que la liste des activités n'est pas vide, et si elle n'est pas, on supprime la première activité de la liste (celle qui mesure 60% en CSS)
  if (activities.length > 0) {
    activities = activities.slice(1);
  }

  // On crée un compteur de chargement pour les images de la section activités
  let currentLoadId = 0;

  function changeActivityContent(activity) {
    currentLoadId++; // incrémente à chaque nouveau clic
    const thisLoadId = currentLoadId;

    // On récupère les datasets
    let name = activity.dataset.name;
    let description = activity.dataset.description;
    let link = activity.dataset.link;
    let btnContent = activity.dataset.btnContent;
    let imgLink = activity.dataset.imgLink;
    let imgAlt = activity.dataset.imgAlt;

    // Faire un fondu du texte et de l'image actuellement affiché

    // On supprime le contenu de l'activité
    //textContainer.innerHTML = "";

    // On injecte le contenu de l'activité
    textContainer.innerHTML = `
        <p>${description}</p>
        <a href="${link}" class="btn tertiary" >${btnContent}</a>
    `;

    // Remplacer l'image chargée par un pixel vide.
    bigActivity.querySelector("img").src =
      "data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
    bigActivity.querySelector("img").alt =
      "Nouvelle image en cours de chargement...";

    // On replace la valeur de l'attribut data-loaded par "false" sur le wrapper (car l'image est en cours de chargement)
    bigActivity.querySelector(".img-wrapper").dataset.loaded = "false";

    // On crée un élément image temporaire afin de charger la ressource dans l'attribut src.
    // Cette image ne sera pas injectée au sein du document (juste utile pour lancer le chargement du fichier spécifié en SRC)
    $tempImg = document.createElement("img");
    $tempImg.src = imgLink;
    $tempImg.alt = imgAlt;

    // Vérifie si l'image est compltement chargée
    $tempImg.addEventListener("load", () => {
      // Vérifie que c'est bien le dernier clic
      if (thisLoadId === currentLoadId) {
        let oldImg = bigActivity.querySelector("img");
        oldImg.src = imgLink;
        oldImg.alt = imgAlt;
        bigActivity.querySelector(".img-wrapper").dataset.loaded = "true";
      }
    });
  }

  // On parcourt la liste des activités
  activities.forEach((singleActivity) => {
    // Ecoute le click sur une des activités
    singleActivity.addEventListener("click", () => {
      changeActivityContent(singleActivity);
    });

    // Ecoute le focus sur une des activités
    singleActivity.addEventListener("focusin", () => {
      changeActivityContent(singleActivity);
    });
  });
});
