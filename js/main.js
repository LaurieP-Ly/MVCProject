window.addEventListener("DOMContentLoaded",chargement);

function chargement() {
    console.log('Bien chargé');
    let ouverture= document.getElementById('ouverture_menu');
    ouverture.addEventListener('click', ouvrirMenu);
    ouverture.addEventListener('click', finAnimation)
    let fermeture = document.getElementById('fermeture_menu');
    fermeture.addEventListener('click', fermerMenu);
    fermeture.addEventListener('click', animation);
   
}


function agrandir(id) {
    
    document.getElementById(id).className = "imgAgrandie";
    document.getElementById(id).style.transitionDuration="0.5s"
    
    
}
function reduire(id) {
    
    document.getElementById(id).className = "imgIndex";
}



function ouvrirMenu() {
    document.getElementById('menu').classList.add('ouvert');
}

function fermerMenu() {
    document.getElementById('menu').classList.remove('ouvert');
    
}

function animation() {
    document.getElementById('fermeture_menu').classList.add('animation');
}

function finAnimation(){
    document.getElementById('fermeture_menu').classList.remove('animation');
}
