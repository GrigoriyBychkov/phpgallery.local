<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.02.2018
 * Time: 21:23
 */
require('controllers/addTag.php');
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


if ($paths[1] == 'addTag.php') {
    echo TagController::addTagAction();
} else if ($paths[1] == 'delete.php') {
    echo deleteController();
} else if ($paths[1]=='deleteTag.php'){
    echo TagController::deleteTagAction();
} else if ($paths[1]=='upload'){
    echo uploadAction();
} else if ($paths[1]) {
    require('controllers/' . $paths[1]);
} else {
    require('views/index.php');
}




