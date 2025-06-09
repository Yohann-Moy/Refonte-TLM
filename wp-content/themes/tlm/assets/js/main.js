// Suite au chargement du Document Object Model (DOM) : lorsque l'HTML est totalement chargé
document.addEventListener("DOMContentLoaded", () => {

    console.log("lazyload file loaded");

    // Création d'un observer qui va surveiller chaque wrapper indépendament afin de voir si ils sont "intersectés" dans le viewport
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach((entry) => {

            // Si le wrapper (ici stocké au sein de la variable temporaire entry) est intersecté dans le viewport.
            if (entry.isIntersecting) {

                // Execute la fonction customLazyload sur le wrapper
                customLazyload(entry.target);

                // Ensuite, pour des raisons évidentes de performances, on arrête d'observer le wrapper (puisque le processus de chargement de l'image est lancé, il n'a pas besoin d'être encore lancé)
                obs.unobserve(entry.target);
            }
        });
    },{ rootMargin: "100px" });

    // Parcours l'ensemble des wrappers afin d'observer chaque wrapper et lancer le chargement de l'image au moment opportun
    document.querySelectorAll(".img-wrapper[data-loading='lazy']").forEach((wrapper) => {
        observer.observe(wrapper);
    });
});

// Fonction customLazyload prends en paramètre une image (element)
// L'image fournie en paramètre se verra chargée de facon asynchrone (via lazyload)
function customLazyload(element) {

  // Si le wrapper (element) n'a pas encore chargé l'image
  if (element.dataset.loaded !== "true") {
    // Récupère le src de l'image stocké au sein de l'attribut data-src
    let src = element.dataset.src;

    // Crée un élément image afin de charger la ressource en arrière plan.
    // Cet élément n'est en aucun cas affiché sur la page : il permet juste de lancer la requête HTTP permettant de charger l'image.
    let tempImg = document.createElement("img");
    tempImg.src = src;

    // Vérifie si le fichier défini en tant que SRC de l'image temporaire est compltement chargée
    tempImg.addEventListener("load", () => {
      // Dans ce cas, on remplace le src de l'image contenue au sein du wrapper (element) par le src de la ressource chargée.
      element.querySelector("img").src = src;

      // On place le wrapper (element) dans un été transitoire de manière à cloturer l'animation proprement
      element.dataset.loaded = "true";
    });
  }
}
// 1 - Récupérer l'élément qui a l'id burger-toggler
const menuToggler = document.querySelector('#burger-toggler');

// 2 - Au clic sur le bouton, il va falloir afficher le menu
menuToggler.addEventListener('click', () => {
    document.querySelector('header').classList.toggle("active");
})

document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM ready");
    console.log("Par rapport au haut du doc : ", window.scrollY);

    setTimeout(()=>{
        document.querySelector('header').classList.remove('on-init');
    }, 300);

    if(window.scrollY > 150) {
        document.querySelector('header').classList.add('coloured');
    }
    else{
        document.querySelector('header').classList.remove('coloured');
    }

});

// On doit écouter le scroll.
window.addEventListener('scroll', () => {
    // Si on a scrollé plus de 250px par rapport au haut du document
    if(window.scrollY > 150) {
        if(!document.querySelector("header").classList.contains('coloured')){
            document.querySelector('header').classList.add('coloured');
        }
    }
    else {
        document.querySelector('header').classList.remove('coloured');
    }
})
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

document.addEventListener("DOMContentLoaded", () => {
    console.log("increment file loaded");

    /**
     * Lance l'incrémentation de la valeur numérique de la statistique fournie en paramètre.
     */
    function startIncrement(statistic) {
        // Récupération de la valeur contenue dans l'attribut data-value de l'element. (au format entier base 10 : syst. de comptage humain)
        const finalValue = parseInt(statistic.dataset.value, 10);
        // Reset de la valeur contenue dans l'élements (span) 
        let startValue = 0;
        statistic.textContent = startValue;

        // Définition de la vitesse de l'incrémentation
        let speed = 25; // Par défaut, l'incrémentation est hyper rapide
        let incrementValue = 5; // Par défaut l'incrémentation s'effectue 4 par 4.

        if(finalValue <= 50){
            speed = 60;
            incrementValue = 1;
        }
        else if (finalValue <= 100){
            speed = 30;
            incrementValue = 2;
        }
    
        const interval = setInterval(() => {

            startValue = startValue + incrementValue;
            statistic.textContent = startValue;
    
            if (startValue >= finalValue) {
                clearInterval(interval);
            }
        }, speed); // incrémente toutes les XXX ms
    }

    // Crée un observer qui déclenche l'animation au moment où l'élément entre dans le viewport
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach((entry) => {
        if (entry.isIntersecting) {
            startIncrement(entry.target);
            obs.unobserve(entry.target); // Stoppe l'observation après lancement
        }
        });
    }, {
        threshold: 0.5, // Déclenche quand 50% de l'élément est visible
    });

    // Récupère tous les éléments qui contiennent les valeurs numériques des statistiques au sein du DOM.
    const statistics = document.querySelectorAll("#statistics .roundedBox span.value");

    // Pour chaque statistique (stockée temportairement à chaque tour de boucle au sein de "statistics")
    statistics.forEach((statistic) => {
        // On observe la statistique
        observer.observe(statistic);
    });
});
