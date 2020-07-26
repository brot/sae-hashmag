window.addEventListener('load', function(){

    // --------------- ANIMATION: Card vergrößern ---------------

    // alle cards in var deklarieren
    var mag = document.querySelectorAll('.magazin_cover');
    console.log(mag)

    // mittel Schleife alle cards durchgehen 
    for (var i = 0; i < mag.length; i++) {

        // jeder card mouseenter hinzufügen
        mag[i].addEventListener('mouseenter', function (_e) {

            // aktuelle card auf der sich cursor befindet, in var deklarieren
            var current_card = _e.target;
            console.log(current_card)

            // Animation auf currend card hinzufügen
            gsap.to(current_card, {
                scale: 1.03, 
                ease: "power1.inOut",
                // from: "center",
            });

        });

        // jeder card mouseleave hinzufügen
        mag[i].addEventListener('mouseleave', function (_e) {

            // aktuelle card auf der sich cursor befindet, in var deklarieren
            var current_card = _e.target;
            console.log(current_card)

            // Animation auf currend card hinzufügen
            gsap.to(current_card, {
                scale: 1, 
                ease: "power1.inOut",
                // from: "center",
            });

        });

    };

});

// --------------- ANIMATION: Headline animieren  ---------------

var heading_animate = document.querySelector('.h1_animate')
var heading_animate_second_word = document.querySelector('.h1_animate_second_word')
var heading_animate_third_word = document.querySelector('.h1_animate_third_word')
var heading_animate_fourth_word = document.querySelector('.h1_animate_fourth_word')

console.log(heading_animate)

// TODO Kommentare schreiben
TweenLite.set(heading_animate, {y:'105%'})
TweenLite.set(heading_animate_second_word, {y:'105%', display: 'none'})
TweenLite.set(heading_animate_third_word, {y:'105%', display: 'none'})
TweenLite.set(heading_animate_fourth_word, {y:'105%', display: 'none'})

// TODO Kommentare schreiben
gsap.to(heading_animate, {duration: 0.8, ease:'power4.out', y:'0', delay: 1, autoAlpha: 1})
gsap.to(heading_animate, {autoAlpha: 0, delay: 4})

gsap.to(heading_animate_second_word, {duration: 0.8, ease:'power4.out', y:'-130%', delay: 4, display: 'block'})
gsap.to(heading_animate_second_word, {autoAlpha: 0, delay: 7})

gsap.to(heading_animate_third_word, {duration: 0.8, ease:'power4.out', y:'-230%', delay: 7, display: 'block'})
gsap.to(heading_animate_third_word, {autoAlpha: 0, delay: 10})

gsap.to(heading_animate_fourth_word, {duration: 0.8, ease:'power4.out', y:'-330%', delay: 10, display: 'block'})



// ####################################### STICKY NAVIGATION ####################################### 

// Wenn gescrollt wird, soll function aufgerufen werden
window.onscroll = function() {stickyNav()};

// navbar in Variable deklarieren
var navbar = document.querySelector('.js_navbar');

// offset position der navbar bekommen
var sticky = navbar.offsetTop;

// function aufrufen, und die classe sticky (in CSS angesprochen) hinzufügen, und wenn man nicht gescrollt hat, dann soll sticky wieder entfernt werden
function stickyNav() {

  // mittels if abfragen, ob pageYOffset größer gleich sticky ist (damit weiß browser, ob gescrollt worden ist)
  if (window.pageYOffset >= sticky) {

    // weil gescrollt worden ist, sticky hinzufügen
    navbar.classList.add("sticky");

  } else {

    // Gegeteil: wenn nicht gescrollt wurde, sticky wieder removen
    navbar.classList.remove("sticky");
  }
}
