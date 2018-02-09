<?php
require('models/db.php');
function removeImage($id) {
    try {
        $extension = Images::getImageExtensionById($id);
        Images::deleteImage($id);
        $filename = 'images/img_' . $id . '.' . $extension;
        unlink($filename);
        echo '<script>window.location = "/PhpGallery/"</script>';
        return;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
if (isset($_GET["remove"])) {
    removeImage($_GET["remove"]);
}