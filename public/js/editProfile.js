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

    $('#newPassword1').change(function () {
       if($('#newPassword1').val().length < 5) {
           if ($('#passwordErrorMessage').length == 0) {
               var html = "<div id='passwordErrorMessage' class='justify-content-center formErrorMessage'>Votre mot de passe doit contenir au moins 5 caractères.</div>";
               $('#userInfos').append(html);
           }
           else {
               $('#passwordErrorMessage').text('Votre mot de passe doit contenir au moins 5 caractères.');
           }
       }
       else {
           if ($('#newPassword1').val() != $('#newPassword2').val()) {
               if ($('#passwordErrorMessage').length == 0) {
                   var html = "<div id='passwordErrorMessage' class='justify-content-center formErrorMessage'>Le mot de passe entré dans la confirmation n'est pas identique au premier.</div>";
                   $('#userInfos').append(html);
               }
               else {
                   $('#passwordErrorMessage').text('Le mot de passe entré dans la confirmation n\'est pas identique au premier.');
               }
           }
           else {
               $('#passwordErrorMessage').remove();
           }
       }
    });

    $('#newPassword2').change(function () {
        if($('#newPassword2').val().length < 5) {
            if ($('#passwordErrorMessage').length == 0) {
                var html = "<div id='passwordErrorMessage' class='justify-content-center formErrorMessage'>Votre mot de passe doit contenir au moins 5 caractères.</div>";
                $('#userInfos').append(html);
            }
            else {
                $('#passwordErrorMessage').text('Votre mot de passe doit contenir au moins 5 caractères.');
            }
        }
        else {
            if ($('#newPassword1').val() != $('#newPassword2').val()) {
                if ($('#passwordErrorMessage').length == 0) {
                    var html = "<div id='passwordErrorMessage' class='justify-content-center formErrorMessage'>Le mot de passe entré dans la confirmation n'est pas identique au premier.</div>";
                    $('#userInfos').append(html);
                }
                else {
                    $('#passwordErrorMessage').text('Le mot de passe entré dans la confirmation n\'est pas identique au premier.');
                }
            }
            else {
                $('#passwordErrorMessage').remove();
            }
        }
    });

});