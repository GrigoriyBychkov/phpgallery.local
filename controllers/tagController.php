<?php
class TagController {
    static function addTagAction() {
        if (isset($_POST["tag"]) && isset($_POST["imageId"])) {
            $trim = trim($_POST["tag"]);
            if(strlen($trim) == 0){
                $response = Array();
                $response['result'] = false;

                return json_encode($response);
            }
            $imageId = $_POST["imageId"];
            $tag = $_POST["tag"];

            if (Tags::getTagsCountByImageId($tag, $imageId) > 0){
                $response = Array ();
                $response['result'] = false;
                $response['error'] = 'Tag exists';

                return json_encode($response);
            }

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

                return json_encode($response);
            }
        }
    }

    static function deleteTagAction() {
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