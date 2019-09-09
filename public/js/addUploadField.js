var $collectionHolder;
var $newLinkLi = $('#trickPictures');

$(document).ready(function() {
    // Get the ul that holds the collection of tags
    $collectionHolder = $('#trickPictures');

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTagButton = $('#addPictureUpload');
    $addTagButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });

    if($('#trickPictures div').length == 0)
    {
        addTagForm($collectionHolder, $newLinkLi);
    }

    function addTagForm($collectionHolder, $newLinkLi) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        var newForm = prototype;
        // You need this only if you didn't set 'label' => false in your tags field in TaskType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items we have
        // newForm = newForm.replace(/__name__label__/g, index);

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('<div></div>').append(newForm);
        $newLinkLi.append($newFormLi);
        //addTagFormDeleteLink($newFormLi);
    }

    function addTagFormDeleteLink($tagFormLi) {
        var $removeFormButton = $('<a href="" title="Supprimer l\'image"><i class="fas fa-trash-alt"></i></a>');
        $tagFormLi.append($removeFormButton);

        $removeFormButton.on('click', function(e) {
            // remove the li for the tag form
            $tagFormLi.remove();
        });
    }

    $(document).on('click', '.deletePicture', function(e) {
        // remove the li for the tag form
        $(this).parent().remove();
    });

});