$(document).ready(function() {
    $("#pictureNb").val(0);
    $("#videoNb").val(0);
    $("#picturesToDelete").val('');
    $("#videosToDelete").val('');
    $("#picturesToEdit").val('');
    $("#videosToEdit").val('');

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
        var champ = "<div class='align-items-center justify-content-center text-center bg-white'><b>Image de couverture supprimée !<br />Si aucune autre image n'est associés à cette figure, l'image affichée actuellement sera utilisée.</b></div>";
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

        var champ = "<label for=\"video" + newNbVideoFields + "\" class=\"col-sm-4 col-form-label\">Lien vers la nouvelle vidéo : </label><input type=\"text\" id=\"video" + newNbVideoFields + "\" name=\"video" + newNbVideoFields + "\" class=\"form-control videoInput col-sm-6\" value=\"" + videoUrl + "\" placeholder='Lien vers votre nouvelle vidéo'>";
        $(this).parent().parent().css('display', 'none');
        $('#newVideosEdit').append(champ);

        var videosToEdit = $('#videosToEdit').val();
        var newVal = videosToEdit + "" + id + "-";
        $('#videosToEdit').val(newVal);//on l'ajoute à la liste de ceux à supprimer (champ input de type hidden

        var nbPictureFields = $('#pictureNb').val();
        var newNbPictureFields = parseInt(nbPictureFields) + 1;
        $("#pictureNb").val(newNbPictureFields);
    });

    $(document).on('change', 'input.form-control-file', function () {
        $(this).parent().append($(this).val());//on affiche le nom du fichier choisi en dessous des champs de type input pour les nouvelles images
    });

    $(document).on('change', 'input.videoInput', function () {
        var nbVideoFields = $('#videoNb').val();
        var regexYoutube = new RegExp("^(http(s)?:\\/\\/)?((w){3}.)?youtu(be|.be)?(\\.com)?\\/.+");
        var regexDailymotion = new RegExp("^.+dailymotion.com\\/((video|hub)\\/([^_]+))?[^#]*(#video=([^_&]+))?/");
        var regexVimeo = new RegExp("^(http(s)?:\\/\\/)?((w){3}.)?player.vimeo.com/video\\/.+");
        var i = 1;
        var nbNonValide = 0
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
            $("#videoErrorMessage").text("Une URL de vidéo entrée n'est pas valide ! Nous acceptons les vidéos provenant de Youtube, Dailymotion et Viméo.");
            $("#sumbitButtonEditTrick").attr('disabled', true);
        } else {
            $("#videoErrorMessage").text("");
            $("#sumbitButtonEditTrick").attr('disabled', false);
        }
    });
});