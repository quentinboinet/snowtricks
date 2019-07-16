$(document).ready(function() {
    $("#pictureNb").val(3);
    $("#videoNb").val(3);

    $('#addPictureUpload').click(function () {
        var nbPictureFields = $('#pictureNb').val();
        var newNbPictureFields = parseInt(nbPictureFields) + 1;
        var html = "<input type=\"file\" name=\"picture" + newNbPictureFields + "\" class=\"form-control-file\">";
        $("#pictureUploads").append(html);
        $("#pictureNb").val(newNbPictureFields);
    });

    $('#addVideoUpload').click(function () {
        var nbVideoFields = $('#videoNb').val();
        var newNbVideoFields = parseInt(nbVideoFields) + 1;
        var html = "<input type=\"text\" name=\"video" + newNbVideoFields + "\" class=\"form-control\" placeholder=\"Lien vers la vidéo " + newNbVideoFields + "\">";
        $("#videoUploads").append(html);
        $("#videoNb").val(newNbVideoFields);
    });
});