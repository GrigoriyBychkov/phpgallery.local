<?php
class TagController {

    static function addTagToImage($tag, $imageId) {
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

    static function addTagAction() {
        if (isset($_POST["tag"]) && isset($_POST["imageId"])) {
            return addTagToImage($_POST["tag"], $_POST["imageId"]);
        }
    }
    static function deleteTagAction()
    {
        if (isset($_GET["remove"])) {
            $id = $_GET["remove"];
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
    }
}