console.log('main init');

function reloadImages(page) {
    var page = page || window.currentImagesPage;
    var tag = window.currentTag || undefined;
    $.get('getImages', {page: page, tag: tag}, function (response) {
        $('#content').html(response);
    });
}

$('#refresh').on('click', function () {
    reloadImages();
});

$('#content').on('click', '.page-link', function (event) {
    var page = $(event.currentTarget).attr('data-page');
    reloadImages(page);
});

$('#content').on('click', '.deleteTag', function(event) {
    var prompt = confirm('Are you sure?');
    if (!prompt) return;

    var tagId = $(event.currentTarget).attr('data-tag-id');
    $.get('tag_delete?remove=' + tagId, function (response) {
        var responseJson = JSON.parse(response);
        if (responseJson.result === true) {
            reloadImages();
        } else {
            alert('Error');
        }
    });
});

$('#content').on('click', '.deleteImg', function(event) {
    var imgId = $(event.currentTarget).attr('data-img-id');
    $.get('image_delete?remove=' + imgId, function (response) {
        var responseJson = JSON.parse(response);
        if (responseJson.result === true) {
            reloadImages();
        } else {
            alert('Error');
        }
    });
});

$('#content').on('click', '.addTagButton', function(event) {
    var imageId = $(event.currentTarget).attr('data-image-id');
    var addTagForm = $(event.currentTarget).parents('.addTagForm');
    var input = $(addTagForm).find('.addTagText');
    var tagText = $.trim($(input).val());
    $(input).val("");
    if (tagText.length == 0){
        return false;
    }
    $.post( "tag_add", { tag: tagText, imageId: imageId }, function( response ) {
        var responseJson = JSON.parse(response);
        if (responseJson.result === true) {
            reloadImages();
        } else {
            alert(responseJson.error || 'Error');
        }
    });
});