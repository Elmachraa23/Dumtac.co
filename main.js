const header = document.querySelector("header");
const ArrowUpBtn = document.querySelector(".arrowBtn"); 

ArrowUpBtn.addEventListener('click', ()=>{
  window.scrollTo({
    top:0,
    left:0,
    behavior: "smooth"
  });
})

if(window != null) {
  window.addEventListener("scroll", ()=>{
    var header = this.document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);
  })
}


var content = document.getElementsByTagName("body")[0];
var darkMode = document.querySelector('.button_darkLight');
darkMode.addEventListener('click', ()=>{
  darkMode.classList.toggle('active');
  content.classList.toggle('night');
});

  
  const title_agency = document.querySelector(".agency .container h2"); 
  const strategie_left = document.querySelector(".st_L"); 
  const strategie_right = document.querySelector(".st_R"); 
  const factory_left = document.querySelector(".fc_L"); 
  const factory_right = document.querySelector(".fc_R"); 
  const social_left = document.querySelector(".sc_L"); 
  const social_right = document.querySelector(".sc_R"); 
  
  const title_studio = document.querySelector(".studio .container h2"); 
  const studio_left = document.querySelector(".studio .container .content .image");
  const studio_right = document.querySelector(".studio .container .content .text-box");


  const title_team = document.querySelector(".team .container h2"); 
  const team_cards = document.querySelector(".team .cards"); 
  const team_btn = document.querySelector(".team .button"); 
  
ScrollReveal(
{ 
    reset: true,
    distance: '60px',
    duration: 1500,
    delay: 400
});
/*Agency*/
ScrollReveal().reveal(title_agency, {delay: 700, origin: 'left'});
ScrollReveal().reveal(strategie_left, {delay: 800, origin: 'left'});
ScrollReveal().reveal(strategie_right, {delay: 800, origin: 'right'});
ScrollReveal().reveal(factory_left, {delay: 800, origin: 'top'});
ScrollReveal().reveal(factory_right, {delay: 800, origin: 'top'});
ScrollReveal().reveal(social_left, {delay: 800, origin: 'bottom'});
ScrollReveal().reveal(social_right, {delay: 800, origin: 'bottom'});

/*studio*/

ScrollReveal().reveal(title_studio, {delay: 700, origin: 'right'});
ScrollReveal().reveal(studio_left, {delay: 600, origin: 'right'});
ScrollReveal().reveal(studio_right, {delay: 600, origin: 'left'});

/*team*/
ScrollReveal().reveal(title_team, {delay: 700, origin: 'top'});
ScrollReveal().reveal(team_cards, {delay: 800, origin: 'bottom'});
ScrollReveal().reveal(team_btn, {delay: 800, origin: 'bottom'});


const hamburger = document.querySelector('.hamburger-menu');
const Tete = document.querySelector('header');

hamburger.addEventListener("click", () => {
    Tete.classList.toggle("active");
});