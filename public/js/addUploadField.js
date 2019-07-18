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
        var html = "<input type=\"text\" id=\"video" + newNbVideoFields + "\" name=\"video" + newNbVideoFields + "\" class=\"form-control\" placeholder=\"Lien vers la vidéo " + newNbVideoFields + "\">";
        $("#videoUploads").append(html);
        $("#videoNb").val(newNbVideoFields);

        $('#video' + newNbVideoFields).change(function () {
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
                $("#sumbitButtonAddTrick").attr('disabled', true);
            } else {
                $("#videoErrorMessage").text("");
                $("#sumbitButtonAddTrick").attr('disabled', false);
            }
        });
    });

    $('#videoUploads input').change(function () {
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
            $("#sumbitButtonAddTrick").attr('disabled', true);
        } else {
            $("#videoErrorMessage").text("");
            $("#sumbitButtonAddTrick").attr('disabled', false);
        }
    });
});