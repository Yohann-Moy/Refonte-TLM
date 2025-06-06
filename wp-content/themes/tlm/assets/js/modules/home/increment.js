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