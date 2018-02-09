<?php
require('models/db.php');
function removeTag($id) {
    try {
        Tags::removeTag($id);
        $response = Array();
        $response['result'] = true;
        echo json_encode($response);
    } catch(PDOException $e) {
        $response = Array();
        $response['result'] = false;
        $response['error'] = $e->getMessage();

        echo json_encode($response);
    }
}
if (isset($_GET["remove"])) {
    removeTag($_GET["remove"]);
}
