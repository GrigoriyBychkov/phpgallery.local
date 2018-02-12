<?php


//["REDIRECT_URL"]=> "/asdf/asdf"
//["REDIRECT_QUERY_STRING"]=> "fff=gggg&fgh=fff"
//["REQUEST_METHOD"]=> "GET"
//["QUERY_STRING"]=> "fff=gggg&fgh=fff"


$str = $_SERVER["QUERY_STRING"];

// Рекомендуемый подход
parse_str($str, $params);



$paths = explode("/", $_SERVER['REDIRECT_URL']);

require('models/db.php');
require('controllers/tagController.php');
require('controllers/imageController.php');
require('views/indexView.php');

if ($paths[1] == 'tag_add') {
    echo TagController::addTagAction();

} else if ($paths[1] == 'image_delete') {
    echo ImageController::deleteAction();

} else if ($paths[1]=='tag_delete'){
    echo TagController::deleteTagAction();

} else if ($paths[1]=='upload'){
    echo ImageController::uploadAction();

} else if ($paths[1]=='getImages'){
    echo ImageController::getImagesAction();

} else {
    echo ImageController::indexAction();
}




