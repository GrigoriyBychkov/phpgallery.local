<?php

function getImageExtensionById($id) {
    $db = new PDO('mysql:host=localhost:3306;dbname=test', 'root', '');
    $sql = "select * from `test`.`images` where `Id`='" . $id . "' ";
    $stmt = $db->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($result["extension"]);
    return $result["extension"];
}

function removeImage($id) {

    try {
        $extension = getImageExtensionById($id);

        $db = new PDO('mysql:host=localhost:3306;dbname=test', 'root', '');
        $sql = "delete from `test`.`images` where `Id`='" . $id . "' ";
        $db->query($sql);
        $filename = 'images/img_' . $id . '.' . $extension;
        unlink($filename);
        echo '<script>window.location = "/"</script>';
        return;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

if (isset($_GET["remove"])) {
    removeImage($_GET["remove"]);
}
