<?php

class ImageController
{
    static function indexAction(){
        $view = new View('views/index.phtml');
        $data = Array();
        $data['content'] = self::getImages();

        return $view->render($data);
    }

    static function getImagesAction(){
        return self::getImages();
    }

    static function getImages(){
        $view = new View('views/images.phtml');
        $data = Array();
        $shift = 0;
        $page = 0;
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            $shift = $_GET["page"] * 6;
        }
        $data['images'] = Images::getImages($shift, $page);

        if (isset($_GET["tag"])) {
            $trim = trim($_GET["tag"]);
            if (strlen($trim) > 0) {
                $tags = Tags::findTags($_GET["tag"]);
                $data['count'] = count($tags);
                $data['currentTag'] = $_GET["tag"];
            }
        } else {
            $data['count'] = Images::getImagesCount();
            $data['currentTag'] = '';
        }

        $data['current'] = $page;

        if (isset($_GET["format"]) && $_GET["format"] === 'json') {
            $images = Array();
            foreach ($data['images'] as $img) {
                $img['tags'] = Tags::getImageTagsByImageId($img['Id']);
                $images[] = $img;
            }
            $response = Array();
            $response['result'] = true;
            $response['total'] = 0 + $data['count'];
            $response['values'] = $images;

            return json_encode($response);
        }
        return $view->render($data);
    }

    static function uploadAction()
    {
        $target_dir = "images/";
        $uploadOk = 1;
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "jpe"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            $newId = Images::saveImageToDataBase($fileName, $imageFileType);
            $target_file = $target_dir . "img_" . $newId . "." . $imageFileType;
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo '<script>window.location = "/"</script>';
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    static function deleteAction() {
        if (isset($_GET["remove"])) {
            $id = $_GET["remove"];
            try {
                $extension = Images::getImageExtensionById($id);
                Images::deleteImage($id);
                Tags::deleteTagsByImageId($id);
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
    }
}