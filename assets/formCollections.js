jQuery(document).ready(function () {
    var $courseIngredientCollectionHolder = $('ul.courseIngredient');
    $courseIngredientCollectionHolder.data('index', $courseIngredientCollectionHolder.find('input').length);
    $courseIngredientCollectionHolder.find('li').each(function () {
        addCollectionIngredientFormDeleteLink($(this));
    });
    $('body').on('click', '.add_item_link', function (e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        addFormToCollection($collectionHolderClass);
    })
});

function addFormToCollection($collectionHolderClass) {
    var $collectionHolder = $('.' + $collectionHolderClass);
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');


    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $collectionHolder.append($newFormLi)
    addCollectionIngredientFormDeleteLink($newFormLi);

}

function addCollectionIngredientFormDeleteLink($courseIngredientFormLi) {
    var $removeFormButton = $('<button type="button" class="btn btn-danger">Delete this course ingredient</button>');
    $courseIngredientFormLi.append($removeFormButton);
    $removeFormButton.on('click', function (e) {
        $courseIngredientFormLi.remove();
    });
}