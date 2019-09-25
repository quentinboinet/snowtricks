var $collectionHolder;
var $collectionHolderVideo;
var $newLinkLi = $('#trickPictures');
var $newLinkLiVideo = $('#trickVideos');
var regexYoutube = new RegExp("^(http(s)?:\\/\\/)?((w){3}.)?youtu(be|.be)?(\\.com)?\\/.+");
var regexDailymotion = new RegExp("^.+dailymotion.com\\/((video|hub)\\/([^_]+))?[^#]*(#video=([^_&]+))?/");
var regexVimeo = new RegExp("^(http(s)?:\\/\\/)?((w){3}.)?player.vimeo.com/video\\/.+");

$(document).ready(function() {
    // Get the ul that holds the collection of tags
    $collectionHolder = $('#trickPictures');

    $collectionHolderVideo = $('#trickVideos');

    $addTagButton = $('#addPictureUpload');
    $addTagButtonVideo = $('#addVideoUpload');

    $addTagButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });

    $addTagButtonVideo.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolderVideo, $newLinkLiVideo);
    });

    if (document.title != 'SnowTricks - Publier une figure') {
        var initialPicturesIndex = $('#trickMediaEditBlock').data('nbpictures');
        var initialVideosIndex = $('#trickMediaEditBlock').data('nbvideos');
    }
    else {
        var initialPicturesIndex = 0;
        var initialVideosIndex = 0;
    }

    if($('#trickPictures div').length == 0 && document.title == 'SnowTricks - Publier une figure')
    {
        addTagForm($collectionHolder, $newLinkLi);
    }

    if($('#trickVideos div').length == 0 && document.title == 'SnowTricks - Publier une figure')
    {
        addTagForm($collectionHolderVideo, $newLinkLiVideo);
    }

    function addTagForm($collectionHolder, $newLinkLi) {

        $('#trickPictures').data('index', initialPicturesIndex + $('#trickPictures').find(':input').length + $('#editDeleteLinks').find(':input').length);
        $('#trickVideos').data('index', initialVideosIndex + $('#trickVideos').find(':input').length);
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');
        // get the new index
        var index = $collectionHolder.data('index');

        var newForm = prototype;
        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index) + "<hr/>";

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('<div></div>').append(newForm);
        $newLinkLi.append($newFormLi);
        //addTagFormDeleteLink($newFormLi);
    }

    $(document).on('click', '.deletePicture, .deleteVideo', function(e) {
        $(this).parent().parent().remove();
    });

    $(document).on('change', '.videoAddInput', function () {
        var nbVideoFields = $('#trickVideos div input').length - 1 + initialVideosIndex;
        var nbNonValide = 0;

        for(i=0;i<=nbVideoFields;i++) {
            var url = $("#trick_add_form_videos_" + i + "_url").val();
            if (typeof url == "undefined") { url = $("#trick_edit_form_videos_" + i + "_url").val(); }
            if (url != "" && typeof url != "undefined") {
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
            $("#sumbitButtonAddTrick").attr('disabled', true);
        } else {
            $(".formErrorMessage").text("");
            $("#sumbitButtonAddTrick").attr('disabled', false);
        }
    });

});