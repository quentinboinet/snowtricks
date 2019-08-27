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

    $('.trickVideoAdd').click(function () {
        //on ajoute la div qui contiendra les champs pour entrer les nouvelles images
        if ($('.videosToAdd').length == 0) {//si on a pas encore ajouté le bloc
            //var champURLS = "<hr><div class=\"row text-center justify-content-center picturesToAdd\">\n" + "</div>";
            var champURLS = "<hr><div class=\"form-group row videosToAdd\">\n" +
                "                                <label for=\"videosToAdd\" class=\"col-sm-4 col-form-label\">Vidéos à ajouter :<br />\n" +
                "                                </label>\n" +
                "                                <div class=\"col-sm-8\" id=\"videoUploads\">\n" +
                "                                </div>\n" +
                "                            </div>";
            champURLS = champURLS + "<br />\n" + "<div class=\"row text-center justify-content-center formAddErrorMessage\">\n" + "</div>";

            testMobileOrNot($(this).parent().parent().attr('id'), champURLS);

            //if ($(this).parent().parent().attr('id') == "trickMediasMobile") //si le clic provient du site en affichage mobile
            //{
            //    $('.trickMediaEditBlockMobile').append(champURLS);
            //}
            //else {
             //   $('.trickMediaEditBlock').append(champURLS);
           // }

        }

        var nbVideosToAdd = $('#videoAddNb').val();
        var newVal =  parseInt(nbVideosToAdd) + 1;
        $('#videoAddNb').val(newVal);

        var champ = "<input type=\"text\" id=\"videoAdd" + newVal + "\" name=\"videoAdd" + newVal + "\" class=\"form-control videoInputAdd\" placeholder=\"Lien vers la vidéo " + newVal + "\">";
        $('#videoUploads').append(champ);

    });

    $('.trickPictureEdit').click(function () {
        var id = $(this).attr('id');//on récupère l'id du média à modifier
        var champ = "Nouvelle image :<br /><input type=\"file\" name=\"picture" + id + "\" class=\"form-control-file\">";
        $(this).parent().parent().html(champ);

        var picturesToEdit = $('#picturesToEdit').val();
        var newVal = picturesToEdit + "" + id + "-";
        $('#picturesToEdit').val(newVal);//on l'ajoute à la liste de ceux à supprimer (champ input de type hidden

        var nbPictureFields = $('#pictureNb').val();
        var newNbPictureFields = parseInt(nbPictureFields) + 1;
        $("#pictureNb").val(newNbPictureFields);
    });

    $('.trickPictureDelete').click(function () {
        $(this).parent().parent().css('display', 'none');
        $('#pictureDeletedModal').modal('show');

        var id = $(this).data('pictureid');//on récupère l'id du média à supprimer
        var picturesToDelete = $('#picturesToDelete').val();
        var newVal = picturesToDelete + "" + id + "-";
        $('#picturesToDelete').val(newVal);//on l'ajoute à la liste de ceux à supprimer (champ input de type hidden
    });

    $('#coverTrickEdit').click(function () {
        var id = $('#editDeleteLinks').data('pictureid');//on récupère l'id du média à modifier
        var champ = "<div class='align-items-center justify-content-center text-center bg-white'><b>Veuillez sélectionner une nouvelle image de couverture.<br />A défaut, l'image affichée actuellement sera conservée.</b><br /><br /><input type=\"file\" name=\"picture" + id + "\" class=\"form-control-file text-center\"></div>";
        $(this).parent().parent().html(champ);

        var picturesToEdit = $('#picturesToEdit').val();
        var newVal = picturesToEdit + "" + id + "-";
        $('#picturesToEdit').val(newVal);//on l'ajoute à la liste de ceux à supprimer (champ input de type hidden

        var nbPictureFields = $('#pictureNb').val();
        var newNbPictureFields = parseInt(nbPictureFields) + 1;
        $("#pictureNb").val(newNbPictureFields);
    });

    $('#coverTrickDelete').click(function () {
        var champ = "<div class='align-items-center justify-content-center text-center bg-white'><b>Image de couverture supprimée !<br />Si aucune autre image n'est associée à cette figure, l'image affichée actuellement sera utilisée.</b></div>";
        $('.card-img-top-trickCover').attr('src', $('#trickDetails').data('defaultcover'));
        $(this).parent().parent().html(champ);

        var id = $('#editDeleteLinks').data('pictureid');//on récupère l'id du média à supprimer
        var picturesToDelete = $('#picturesToDelete').val();
        var newVal = picturesToDelete + "" + id + "-";
        $('#picturesToDelete').val(newVal);//on l'ajoute à la liste de ceux à supprimer (champ input de type hidden
    });

    $('.trickVideoDelete').click(function () {
        $(this).parent().parent().css('display', 'none');
        $('#videoDeletedModal').modal('show');

        var id = $(this).data('videoid');//on récupère l'id du média à supprimer
        var videosToDelete = $('#videosToDelete').val();
        var newVal = videosToDelete + "" + id + "-";
        $('#videosToDelete').val(newVal);//on l'ajoute à la liste de ceux à supprimer (champ input de type hidden
    });

    $('.trickVideoEdit').click(function () {
        var id = $(this).attr('id');//on récupère l'id du média à modifier
        var videoUrl = $(this).data('videourl');

        var nbVideoFields = $('#videoNb').val();
        var newNbVideoFields = parseInt(nbVideoFields) + 1;
        $("#videoNb").val(newNbVideoFields);

        //on ajoute la div qui contiendra les champs pour entrer les nouvelles URL
        if ($('.newVideosEdit').length == 0) {//si on a pas encore ajouté le bloc
            var champURLS = "<hr><div class=\"row text-center justify-content-center newVideosEdit\">\n" + "</div>";
            champURLS = champURLS + "<br />\n" + "<div class=\"row text-center justify-content-center formErrorMessage\">\n" + "</div>";

            testMobileOrNot($(this).parent().parent().attr('id'), champURLS);

            //if ($(this).parent().parent().attr('id') == "trickMediasMobile") //si le clic provient du site en affichage mobile
            //{
            //    $('.trickMediaEditBlockMobile').append(champURLS);
            //}
            //else {
            //    $('.trickMediaEditBlock').append(champURLS);
            //}

        }

        var champ = "<label for=\"video" + newNbVideoFields + "\" class=\"col-sm-4 col-form-label\">Lien vers la nouvelle vidéo : </label><input type=\"text\" id=\"video" + newNbVideoFields + "\" name=\"video" + newNbVideoFields + "\" class=\"form-control videoInput col-sm-6\" value=\"" + videoUrl + "\" placeholder='Lien vers votre nouvelle vidéo'>";
        $(this).parent().parent().css('display', 'none');
        $('.newVideosEdit').append(champ);

        var videosToEdit = $('#videosToEdit').val();
        var newVal = videosToEdit + "" + id + "-";
        $('#videosToEdit').val(newVal);//on l'ajoute à la liste de ceux à supprimer (champ input de type hidden

        var nbPictureFields = $('#pictureNb').val();
        var newNbPictureFields = parseInt(nbPictureFields) + 1;
        $("#pictureNb").val(newNbPictureFields);
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