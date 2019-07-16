$(document).ready(function() {
    $("#showMoreCommentsOffset").val(10); //on initialise au chargement de la page le compteur à 10 commentaires affichés pour gérer les clics sur "Voir plus"

    $('#showMoreComments').click(function () {
        $("#showMoreGif").css('display', 'flex');//on affiche le gif de chargement dans le bouton "voir plus"
        $("#showMoreComments").css('display', 'none');//on cache le bouton "voir plus"
        var offset = $('#showMoreCommentsOffset').val();
        var trickId = $('#tricksComments').data('trick_id');
        var url = $("#showMoreComments").data('path');
        $.ajax({
            method: "POST",
            url: url,
            data:  {"offset": offset, 'trickId' : trickId},
            dataType : 'json',
            success: function(data) {
                var nbreComments = data.length;
                //si on a moins de 10 commentaires (donc on arrive à la fin), on cache le bouton "voir plus"
                if (nbreComments < 10) { $("#divShowMoreComments").css('display', 'none'); }

                var html = "";
                var i = 0;
                $.each(data, function(key, val){

                    var username = val.author;
                    var content = val.content;
                    var date = val.date;
                    //on déterminé si on affiche l'image par défault ou si on affiche celle en bdd
                    html = html + " <div class=\"row justify-content-center\">";

                    html = html + " <div class=\"col col-sm-2 text-right\"><i title='" + username + "' class=\"far fa-user-circle fa-2x\"></i></div>\n" +
                        " <div class=\"col col-sm-6\">\n" +
                        " <blockquote>" +
                        " <p class=\"mb-0\">" + content + "</p>\n" +
                        " <footer class=\"blockquote-footer\">" + username + " le <cite>" + date + "</cite></footer>\n" +
                        " </blockquote>\n" +
                        " </div>\n" +
                        " </div>";
                    i = i+1;

                });
                $("#tricksComments").append(html);
                var newOffset = parseInt(offset) + parseInt(nbreComments);
                $("#showMoreCommentsOffset").val(newOffset);

                $("#showMoreGif").css('display', 'none');//on enlève le gif de chargement dans le bouton
                $("#showMoreComments").css('display', 'flex');//on affiche le bouton "voir plus"
            }
        });
    });
});