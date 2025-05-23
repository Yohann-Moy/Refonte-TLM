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