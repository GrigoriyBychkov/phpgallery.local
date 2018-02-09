<?php
require('models/db.php');
function addTagToImage($tag, $imageId) {
    try {
        $id = Tags::addTagToImage($tag, $imageId);
        if ($id) {
            echo '{ "result": true, "id": ' . $id . ' }';
        } else {
            echo '{ "result": false }';
        }
    } catch(PDOException $e) {
        echo '{ "result": false, "error": "' . $e->getMessage() . '" }';
    }
    return ;
}

if (isset($_POST["tag"]) && isset($_POST["imageId"])) {
    addTagToImage($_POST["tag"], $_POST["imageId"]);
}
