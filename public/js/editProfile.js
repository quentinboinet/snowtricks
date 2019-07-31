$(document).ready(function() {

    $('#profilePictureEdit').click(function () {
        var id = $('#editDeleteLinks').data('pictureid');//on récupère l'id du média à modifier
        var champ = "<div class='align-items-center justify-content-center text-center bg-white'><b>Veuillez sélectionner une nouvelle image de profil.<br />A défaut, l'image affichée actuellement sera conservée.</b><br /><br /><input type=\"file\" name=\"profilePicture\" class=\"form-control-file text-center\"></div>";
        $(this).parent().html(champ);

        var picturesToEdit = $('#picturesToEdit').val();
        var newVal = picturesToEdit + "" + id + "-";
        $('#picturesToEdit').val(newVal);//on l'ajoute à la liste de ceux à supprimer (champ input de type hidden
    });

    $('#profilePictureDelete').click(function () {
        var champ = "<div class='align-items-center justify-content-center text-center bg-white'><b>Image de profil supprimée !<br />L'image affichée actuellement sera utilisée.</b></div>";
        $('.profilePictureClass').attr('src', $('#profileSection').data('defaultpicture'));
        $(this).parent().html(champ);

        var id = $('#editDeleteLinks').data('pictureid');//on récupère l'id du média à supprimer
        var picturesToDelete = $('#picturesToDelete').val();
        var newVal = picturesToDelete + "" + id + "-";
        $('#picturesToDelete').val(newVal);//on l'ajoute à la liste de ceux à supprimer (champ input de type hidden
    });

});