<?php
require('models/db.php');
function removeImage($id) {
    try {
        $extension = Images::getImageExtensionById($id);
        Images::deleteImage($id);
        $filename = 'images/img_' . $id . '.' . $extension;
        unlink($filename);
        $response = Array();
        $response['result'] = true;

        echo json_encode($response);
    } catch (PDOException $e) {
        $response = Array();
        $response['result'] = false;
        $response['error'] = $e->getMessage();

        echo json_encode($response);
    }
}
if (isset($_GET["remove"])) {
    removeImage($_GET["remove"]);
}