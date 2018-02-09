<?php
require('models/db.php');
function addTagToImage($tag, $imageId) {
    try {
        $id = Tags::addTagToImage($tag, $imageId);
        if ($id) {
            $response = Array();
            $response['result'] = true;
            $response['id']= $id;
            echo json_encode($response);
        } else {
            $response['result'] = false;
        }
    } catch(PDOException $e) {
        $response = Array();
        $response['result'] = false;
        $response['error'] = $e->getMessage();

        echo json_encode($response);    }
}

if (isset($_POST["tag"]) && isset($_POST["imageId"])) {
    addTagToImage($_POST["tag"], $_POST["imageId"]);
}
