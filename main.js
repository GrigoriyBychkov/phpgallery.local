console.log('main init');

function reloadImages() {
    $.get('getImages', function (response) {
        $('#content').html(response);
    });
}

$('#refresh').on('click', function () {
    reloadImages();
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
            alert('ok');
            reloadImages();
        } else {
            alert('Error');
        }
    });
});

$('#content').on('click', '.addTagButton', function(event) {
    var imageId = $(event.currentTarget).attr('data-image-id');
    var addTagForm = $(event.currentTarget).parents('.addTagForm');
    var tagText = $(addTagForm).find('.addTagText').val();
    $.post( "tag_add", { tag: tagText, imageId: imageId }, function( response ) {
        var responseJson = JSON.parse(response);
        if (responseJson.result === true) {
            alert('ok');
            reloadImages();
        } else {
            alert('Error');
        }
    });
});