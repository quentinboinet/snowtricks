$(function (keyframes, options) {
    $('#linkScroll').on('click', function(e) {
        e.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
            scrollTop: $(this.hash).offset().top
        }, 1000, function () {
            window.location.hash = hash;
        });
    });
});

$(document).ready(function(){
    // au clic sur un lien
    $('a.arrowHome').on('click', function(evt){
        // bloquer le comportement par défaut: on ne rechargera pas la page
        evt.preventDefault();
        // enregistre la valeur de l'attribut  href dans la variable target
        var target = $(this).attr('href');
        //on extrait juste l'ancre du lien
        var placeduHashtag = target.lastIndexOf("#");
        target = target.substring(placeduHashtag, target.length);
        /* le sélecteur $(html, body) permet de corriger un bug sur chrome
        et safari (webkit) */
        $('html, body')
        // on arrête toutes les animations en cours
            .stop()
            /* on fait maintenant l'animation vers le haut (scrollTop) vers
             notre ancre target */
            .animate({scrollTop: $(target).offset().top}, 1000 );
    });
});