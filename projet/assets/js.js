//==================================================================================================================================
// Code JS pour l'icon menu se trouvant au fond a droite mais qui est reserver au format d'ecran PC

document.addEventListener('DOMContentLoaded', function () {
  const iconMenuSurPc = document.querySelector('#icone-menu');
  const banderoleMenu = document.querySelector('.banderole-menu');

  iconMenuSurPc.addEventListener('click', function () {
      banderoleMenu.classList.toggle('banderole-menu-open');
  }); 
});

//==================================================================================================================================
// Code JS pour l'icon menuTelephone qui s'affiche seulement au format d'ecran des Telephone

document.addEventListener('DOMContentLoaded', function () {
    const iconMenuSurPc = document.querySelector('#icone-menuTelephone');
    const ulMenu = document.querySelector('.ul-global');
  
    iconMenuSurPc.addEventListener('click', function () {
        ulMenu.classList.toggle('banderole-listeMenuTelephone-open');
    }); 
  });

//==================================================================================================================================
// Code JS pour l'icon menu qui s'affiche pour le format d'ecran des telephones

document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.getElementById("menu-toggle");
  const menuList = document.querySelector(".BanniereSuperieur ul");

  menuToggle.addEventListener("click", function () {
      menuList.classList.toggle("active");
  });
});

//==================================================================================================================================
// Code JS pour l'animation des images a la page accueil 

let slideIndex = 0;
function showSlides() {
    let slides = document.getElementsByClassName("mySlides_fade");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 3500); // Change l'image toutes les 3 secondes
}
showSlides();
//==================================================================================================================================