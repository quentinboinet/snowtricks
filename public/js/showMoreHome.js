$(document).ready(function() {
    $("#showMoreOffset").val(15); //on initialise au chargement de la page le compteur à 15 tricks affichés pour gérer les clics sur "Voir plus"

    $('#showMore').click(function () {
        $("#showMoreGif").css('display', 'flex');//on affiche le gif de chargement dans le bouton "voir plus"
        $("#showMore").css('display', 'none');//on cache le bouton "voir plus"
        $("#showMoreError").css('display', 'none');//on cache le message d'erreur
        var offset = $('#showMoreOffset').val();
        var url = $("#showMore").data('path');
        var defaultCover = $("#tricksList").data('defaultcover');
        var loggedin = $("#tricksList").data('loggedin');
        $.ajax({
            method: "POST",
            url: url,
            data: {offset: offset},
            error: function() {
                $("#showMoreError").css('display', 'flex');//on affiche le message d'erreur
                $("#showMoreGif").css('display', 'none');//on enlève le gif de chargement dans le bouton
                $("#showMore").css('display', 'none');//on affiche le bouton "voir plus"
            },
            success: function(data) {
                var nbreTricks = data.length;
                //si on a moins de 15 figures (donc on arrive à la fin), on cache le bouton "voir plus"
                if (nbreTricks < 15) { $("#divShowMore").css('display', 'none'); }

                var html = "";
                var i = 0;
                $.each(data, function(key, val){

                    var urlViewTrick = "/tricks/" + val.id + "/view";
                    var urlEditTrick = "/tricks/" + val.id + "/edit";
                    var urlDeleteTrick = "/tricks/" + val.id + "/delete";
                    //on déterminé si on affiche l'image par défault ou si on affiche celle en bdd

                    if (val.pictures.length != "") { defaultCover = val.pictures; }
                    if ((i % 5) == 0) { html = html + " <div class=\"row justify-content-around\">"; }

                    html = html + "            <div class=\"col-lg-2 card h-100 rounded\">\n" +
                        "                <img src=\""+ defaultCover + "\" class=\"card-img-top border-bottom border-dark\" alt=\"...\">\n" +
                        "                <div class=\"card-body\">\n" +
                        "                    <div class=\"row\">\n" +
                        "                        <div class=\"col col-xs-8 col-sm-12 col-md-7\"><a href='" + urlViewTrick + "' title='Voir la figure'>" + val.name + "</a></div>\n";
                    if (loggedin === true) { html = html + "<div class=\"col col-xs-4 col-sm-12 col-md-5 text-right\"><a href='" + urlEditTrick + "' title='Modifier la figure'><i class=\"fas fa-pen-fancy\"></i></a> <a data-deletepath='" + urlDeleteTrick + "' data-toggle=\"modal\" data-target=\"#deleteConfirmModal\" title='Supprimer la figure' href=''><i class=\"fas fa-trash-alt\"></i></a></div>\n"; }
                    html = html + "                    </div>\n" +
                        "                </div>\n" +
                        "            </div>";
                    if (((i+1) % 5) == 0) { html = html + "</div>"; }
                    if ((i+1) == nbreTricks) { html = html + "</div>"; }
                    i = i+1;

                });
                $("#tricksList").append(html);
                var newOffset = parseInt(offset) + parseInt(nbreTricks);
                $("#showMoreOffset").val(newOffset);

                //on affiche la flèche pour remonter en haut des figures si le nombre de figures affichées est supérieure à 15
                if ($('.card').length > 15) { $('#divArrowUp').css('display', 'flex'); }

                $("#showMoreGif").css('display', 'none');//on enlève le gif de chargement dans le bouton
                $("#showMore").css('display', 'flex');//on affiche le bouton "voir plus"
                $("#showMoreError").css('display', 'none');//on cache le message d'erreur
            }
        });
    });
});