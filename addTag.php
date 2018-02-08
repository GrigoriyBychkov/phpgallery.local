<?php

function addTagToImage($tag, $imageId) {
    try {
        $db = new PDO('mysql:host=localhost:3306;dbname=test', 'root', '');

        $sql = "insert into `test`.`tags` ( `tag`, `imageId`) values ( '" . $tag . "', '" .  $imageId . "')";
        $db->query($sql);
        echo '<script>window.location = "/"</script>';
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    return $db->lastInsertId();
}

if (isset($_POST["tag"]) && isset($_POST["imageId"])) {
    addTagToImage($_POST["tag"], $_POST["imageId"]);

}

