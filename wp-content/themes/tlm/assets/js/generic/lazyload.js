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