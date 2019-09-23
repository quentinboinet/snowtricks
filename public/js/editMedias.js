$(document).ready(function() {
    $("#pictureNb").val(0);
    $("#videoNb").val(0);
    $('#pictureAddNb').val(0);
    $('#videoAddNb').val(0);
    $("#picturesToDelete").val('');
    $("#videosToDelete").val('');
    $("#picturesToEdit").val('');
    $("#videosToEdit").val('');

    var regexYoutube = new RegExp("^(http(s)?:\\/\\/)?((w){3}.)?youtu(be|.be)?(\\.com)?\\/.+");
    var regexDailymotion = new RegExp("^.+dailymotion.com\\/((video|hub)\\/([^_]+))?[^#]*(#video=([^_&]+))?/");
    var regexVimeo = new RegExp("^(http(s)?:\\/\\/)?((w){3}.)?player.vimeo.com/video\\/.+");

    function testMobileOrNot(id, champURLS) {
        if (id == "trickMediasMobile") //si le clic provient du site en affichage mobile
        {
            $('.trickMediaEditBlockMobile').append(champURLS);
        }
        else {
            $('.trickMediaEditBlock').append(champURLS);
        }
    }

    $('.trickPictureAdd').click(function () {
        //on ajoute la div qui contiendra les champs pour entrer les nouvelles images
        if ($('.picturesToAdd').length == 0) {//si on a pas encore ajouté le bloc
            //var champURLS = "<hr><div class=\"row text-center justify-content-center picturesToAdd\">\n" + "</div>";
            var champURLS = "<hr><div class=\"form-group row picturesToAdd\">\n" +
                "                                <label for=\"pictureToAdd\" class=\"col-sm-4 col-form-label\">Images à ajouter :<br />\n" +
                "                                </label>\n" +
                "                                <div class=\"col-sm-8\" id=\"pictureUploads\">\n" +
                "                                </div>\n" +
                "                            </div>";

            testMobileOrNot($(this).parent().parent().attr('id'), champURLS);
            //if ($(this).parent().parent().attr('id') == "trickMediasMobile") //si le clic provient du site en affichage mobile
            //{
            //    $('.trickMediaEditBlockMobile').append(champURLS);
            //}
            //else {
             //   $('.trickMediaEditBlock').append(champURLS);
           // }

        }

        var nbPicturesToAdd = $('#pictureAddNb').val();
        var newVal =  parseInt(nbPicturesToAdd) + 1;
        $('#pictureAddNb').val(newVal);

        var champ = "<input type=\"file\" name=\"pictureAdd" + newVal + "\" class=\"form-control-file\">";
        $('#pictureUploads').append(champ);

    });


    $('.trickPictureEdit').click(function () {
        var html = $(this).parent().data('input');//on récupère le champ input à insérer en bas dans le bloc
        var value = $(this).parent().data('alt');
        html =html.replace('input type="text"', 'input type="text" value="' + value + '"');
        html = html.replace(/Image au format .jpg, .jpeg, .gif, .png/g, 'Image de remplacement');
        var $newFormLi = $('<div></div>').append(html);
        $('#trickPictures').append($newFormLi);

        $(this).parent().parent().remove();
    });

    $('.trickVideoEdit').click(function () {
        var html = $(this).parent().data('input');//on récupère le champ input à rajouter
        var $newFormLi = $('<div></div>').append(html);
        $('#trickVideos').append($newFormLi);

        $(this).parent().parent().remove();
    });

    $('.trickPictureDelete').click(function () {
        var html = $(this).parent().data('input');//on récupère le champ input à insérer en bas dans le bloc
        var id = $(this).parent().data('idtodelete');
        html =html.replace('<div class=\'row align-items-center\'>', '<div class="row align-items-center" style="display:none;">');
        html =html.replace('input type="text"', 'input type="text" value="#TO_DELETE#' + id + '"');
        html = html.replace(/Image au format .jpg, .jpeg, .gif, .png/g, '#TO_DELETE#' + id);
        var $newFormLi = $('<div></div>').append(html);
        $('#trickPictures').append($newFormLi);

        $(this).parent().parent().css('display', 'none');
        $('#pictureDeletedModal').modal('show');

    });

    $('.trickVideoDelete').click(function () {
        var html = $(this).parent().data('input');//on récupère le champ input à insérer en bas dans le bloc
        var id = $(this).parent().data('videoid');
        html =html.replace('<div class=\'row align-items-center\'>', '<div class="row align-items-center" style="display:none;">');
        html =html.replace('input type="text"', 'input type="text" value="#TO_DELETE#' + id + '"');
        html = html.replace(/Image au format .jpg, .jpeg, .gif, .png/g, '#TO_DELETE#' + id);
        var $newFormLi = $('<div></div>').append(html);
        $('#trickVideos').append($newFormLi);

        $(this).parent().parent().css('display', 'none');
        $('#videoDeletedModal').modal('show');


    });


    $('#coverTrickEdit').click(function () {
        var html = $(this).parent().data('input');//on récupère le champ input à insérer en bas dans le bloc
        var value = $(this).parent().data('alt');
        html =html.replace('input type="text"', 'input type="text" value="' + value + '"');
        html = html.replace(/Image au format .jpg, .jpeg, .gif, .png/g, 'Image de remplacement');
        var $newFormLi = $('<div class=\'align-items-center justify-content-center text-center bg-white\'></div>').append(html);
        $(this).parent().parent().html($newFormLi);
    });

    $('#coverTrickDelete').click(function () {
        var html = $(this).parent().data('input');//on récupère le champ input à insérer en bas dans le bloc
        var id = $(this).parent().data('idtodelete');
        html =html.replace('input type="text"', 'input type="text" value="#TO_DELETE#' + id + '"');
        html = html.replace(/Image au format .jpg, .jpeg, .gif, .png/g, '#TO_DELETE#' + id);

        var champ = "<div class='align-items-center justify-content-center text-center bg-white'><b>Image de couverture supprimée !<br />Si aucune autre image n'est associée à cette figure, l'image affichée actuellement sera utilisée.</b></div>" + html;
        $('.card-img-top-trickCover').attr('src', $('#trickDetails').data('defaultcover'));
        champ = champ.replace('<div class=\'row align-items-center justify-content-center\'>', '<div class="row align-items-center justify-content-center" style="display:none;">');
        $(this).parent().parent().html(champ);
    });

    $(document).on('change', 'input.form-control-file', function () {
        //seulement si c'est une image dans une carte
        if($(this).parent().attr('class') != "col-sm-8") {
            $(this).parent().append($(this).val());//on affiche le nom du fichier choisi en dessous des champs de type input pour les nouvelles images
        }
    });

    $(document).on('change', 'input.videoInput', function () {
        var nbVideoFields = $('#videoNb').val();
        var i = 1;
        var nbNonValide = 0;
        for(i=1;i<=nbVideoFields;i++) {
            var url = $("#video" + i).val();
            if (url != "") {
                var valideYoutube = regexYoutube.test(url);
                var valideDailymotion = regexDailymotion.test(url);
                var valideVimeo = regexVimeo.test(url);
                if (!valideYoutube && !valideDailymotion && !valideVimeo) {
                    nbNonValide = nbNonValide + 1;
                }
            }
        }
        if (nbNonValide > 0) {

            $(".formErrorMessage").text("Une URL de vidéo entrée n'est pas valide ! Nous acceptons les vidéos provenant de Youtube, Dailymotion et Viméo.");
            $("#sumbitButtonEditTrick").attr('disabled', true);
        } else {
            $(".formErrorMessage").text("");
            $("#sumbitButtonEditTrick").attr('disabled', false);
        }
    });

    $(document).on('change', 'input.videoInputAdd', function () {
        var nbVideoFields = $('#videoAddNb').val();
        var i = 1;
        var nbNonValide = 0;
        for(i=1;i<=nbVideoFields;i++) {
            var url = $("#videoAdd" + i).val();
            if (url != "") {
                var valideYoutube = regexYoutube.test(url);
                var valideDailymotion = regexDailymotion.test(url);
                var valideVimeo = regexVimeo.test(url);
                if (!valideYoutube && !valideDailymotion && !valideVimeo) {
                    nbNonValide = nbNonValide + 1;
                }
            }
        }
        if (nbNonValide > 0) {

            $(".formAddErrorMessage").text("Une URL de vidéo entrée n'est pas valide ! Nous acceptons les vidéos provenant de Youtube, Dailymotion et Viméo.");
            $("#sumbitButtonEditTrick").attr('disabled', true);
        } else {
            $(".formAddErrorMessage").text("");
            $("#sumbitButtonEditTrick").attr('disabled', false);
        }
    });
});