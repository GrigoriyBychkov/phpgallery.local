console.log('main init');

$('.image').on('click', '.deleteTag', function(event) {
    var tagId = $(event.currentTarget).attr('data-tag-id');
    $.get('deleteTag.php?remove=' + tagId, function (response) {
        var responseJson = JSON.parse(response);
        if (responseJson.result === true) {
            $(event.currentTarget).parent('.tag-body').remove();
            alert('ok');
        } else {
             alert('Error');
        }
    });
});

$('.image').on('click', '.deleteImg', function(event) {
    var imgId = $(event.currentTarget).attr('data-img-id');
    $.get('delete.php?remove=' + imgId, function (response) {
        var responseJson = JSON.parse(response);
        if (responseJson.result === true) {
            $(event.currentTarget).parent('.image').remove();
            alert('ok');
        } else {
             alert('Error');
        }
    });
});

$('.image').on('click', '.addTagButton', function(event) {
    var imageId = $(event.currentTarget).attr('data-image-id');
    var addTagForm = $(event.currentTarget).parent('.addTagForm');
    var tagText = $(addTagForm).find('.addTagText').val();

    $.post( "addTag.php", { tag: tagText, imageId: imageId }, function( response ) {
        console.log('response', response);
        var responseJson = JSON.parse(response);
        if (responseJson.result === true) {
            $(event.currentTarget).parent('.tag-body').remove();
            alert('ok');
            var tpl = $('#tagTemplate').clone();
            tpl.find('.tagText').text(tagText);
            tpl.find('.deleteTag').attr('data-image-id', imageId);
            tpl.show();
            tpl.appendTo('#image-tags-' + imageId);
        } else {
            alert('Error');
        }
    });
});