<?php
function addTagToImage($tag, $imageId) {
    try {
        $id = Tags::addTagToImage($tag, $imageId);
        if ($id) {
            $response = Array();
            $response['result'] = true;
            $response['id']= $id;
            return json_encode($response);
        } else {
            $response['result'] = false;
        }
    } catch(PDOException $e) {
        $response = Array();
        $response['result'] = false;
        $response['error'] = $e->getMessage();

        return json_encode($response);    }
}

function addTagController() {
    if (isset($_POST["tag"]) && isset($_POST["imageId"])) {
        return addTagToImage($_POST["tag"], $_POST["imageId"]);
    }
}

