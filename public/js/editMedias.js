$(document).ready(function() {
    $("#pictureNb").val(0);
    $("#videoNb").val(0);

    $('.trickPictureEdit').click(function () {
        var id = $(this).attr('id');//on récupère l'id du média à modifier
        var champ = "Nouvelle image :<br /><input type=\"file\" name=\"picture" + id + "\" class=\"form-control-file\">";
        $(this).parent().parent().html(champ);
    });

    $('.trickPictureDelete').click(function () {
        $(this).parent().parent().css('display', 'none');
        $('#pictureDeletedModal').modal('show');
    });

    $('.trickVideoDelete').click(function () {
        $(this).parent().parent().css('display', 'none');
        $('#videoDeletedModal').modal('show');
    });

    $('.trickVideoEdit').click(function () {
        var id = $(this).attr('id');//on récupère l'id du média à modifier
        var videoUrl = $(this).data('videourl');

        var nbVideoFields = $('#videoNb').val();
        var newNbVideoFields = parseInt(nbVideoFields) + 1;
        $("#videoNb").val(newNbVideoFields);

        var champ = "<label for=\"video" + newNbVideoFields + "\" class=\"col-sm-4 col-form-label\">Lien vers la nouvelle vidéo : </label><input type=\"text\" id=\"video" + newNbVideoFields + "\" name=\"video" + newNbVideoFields + "\" class=\"form-control col-sm-6\" value=\"" + videoUrl + "\" placeholder='Lien vers votre nouvelle vidéo'>";
        $(this).parent().parent().css('display', 'none');
        $('#newVideosEdit').append(champ);
    });

    $(document).on('change', 'input.form-control-file', function () {
        $(this).parent().append($(this).val());//on affiche le nom du fichier choisi en dessous des champs de type input pour les nouvelles images
    });
});