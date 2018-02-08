<?php

function addDescToImage($desc, $imageId) {
    try {
        $db = new PDO('mysql:host=localhost:3306;dbname=test', 'root', '');

        $sql = "insert into `test`.`desc` ( `desc`, `imageId`) values ( '" . $desc . "', '" .  $imageId . "')";
        $db->query($sql);
        echo '<script>window.location = "/"</script>';
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    return $db->lastInsertId();
}

if (isset($_POST["desc"]) && isset($_POST["imageId"])) {
    addDescToImage($_POST["desc"], $_POST["imageId"]);
}

