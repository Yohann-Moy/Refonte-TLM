// Récupère tous les éléments qui ont la classe ".activity" au sein du DOM.
var activities = Array.from(document.querySelectorAll('#activities .activity'));

// Récupère l'endroit au sein duquel on va inserer le contenu de l'activité.
var textContainer = document.querySelector('#activities .textContainer');

const bigActivity = document.querySelector('#activities .activity:first-of-type');

// On vérifie que la liste des activités n'est pas vide, et si elle n'est pas, on supprime la première activité de la liste (celle qui mesure 60% en CSS)
if (activities.length > 0) {
    activities = activities.slice(1);
}

function changeActivityContent(activity){
    // On récupère les datasets
    let name = activity.dataset.name;
    let description = activity.dataset.description;
    let link = activity.dataset.link;
    let btnContent = activity.dataset.btnContent;
    let imgLink = activity.dataset.imgLink;
    let imgAlt = activity.dataset.imgAlt;
    
    // On injecte le contenu de l'activité
    textContainer.innerHTML = `
        <p>${description}</p>
        <a href="${link}" class="btn tertiary" >${btnContent}</a>
    `;
    
    bigActivity.innerHTML = `
    <img src="${imgLink}" alt="${imgAlt}">`;
}

// On parcourt la liste des activités
activities.forEach((singleActivity) => {

    // Ecoute le click sur une des activités
    singleActivity.addEventListener('click', () => {
        changeActivityContent(singleActivity);
    });

    // Ecoute le focus sur une des activités
    singleActivity.addEventListener('focusin', () => {
        changeActivityContent(singleActivity);
    });

});

// Ne pas oublier qu'il faudra, au chargement de la page, initialiser les contenus de la première activité.
document.addEventListener('DOMContentLoaded', () => {
    changeActivityContent(bigActivity);
})


// TODO : Faire en sorte que l'image de l'activité puisse apparaitre avec une jolie transition, sans l'envers du décors
// En gros, tant que l'image n'est pas entièrement chargée, on ne remplace pas l'image par celle en relation avec l'activité cliquée.