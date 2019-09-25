$('div.alert.alert-info').delay(5000).slideUp(300);
$('div.alert.alert-danger').delay(20000).slideUp(300);
$('div.alert.alert-warning').delay(5000).slideUp(300);

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<a href="" title="Supprimer"><i class="fas fa-trash-alt"></i></a>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}

$(document).on('change', '.custom-file-input', function(event) {
    var inputFile = event.currentTarget;
    $(inputFile).parent()
        .find('.custom-file-label')
        .html(inputFile.files[0].name);
});

$(document).ready(function() {

    //fonction pour afficher les images/vidéos d'une figure lors du clic sur le bouton "Médias"
    $('#showMediasLink').click(function () {
        $("#showMediasLink").css('display', 'none');
        $("#hideMediasLink").css('display', 'flex');
        if ($(this).data("from") === "edit") {
            $("#trickMediaEditBlock").css('display', 'block');
        } else {
            $("#trickMediasMobileBlock").css('display', 'flex');
        }
    });

    $('#hideMediasLink').click(function () {
        $("#showMediasLink").css('display', 'flex');
        $("#hideMediasLink").css('display', 'none');
        if ($(this).data("from") === "edit") {
            $("#trickMediaEditBlock").css('display', 'none');
        } else {
            $("#trickMediasMobileBlock").css('display', 'none');
        }
    });

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var mediaURL = button.data('media'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-body img').attr('src', mediaURL);
    });

    $('#exampleModalVideo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var mediaURL = button.data('media'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-body embed').attr('src', mediaURL);
    });

    $('#deleteConfirmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var deleteURL = button.data('deletepath'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-footer .deleteLink').attr('href', deleteURL);
    });

    $('#deleteCommentModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var deleteURL = button.data('deletecommenturl'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-footer .deleteCommentLink').attr('href', deleteURL);
    });

});