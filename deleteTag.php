<?php

function removeTag($id) {
    try {
        $db = new PDO('mysql:host=localhost:3306;dbname=test', 'root', '');
        $sql = "delete from `test`.`tags` where `Id`='" . $id . "' ";
        $db->query($sql);
        echo '<script>window.location = "/PhpGallery/"</script>';
        return;
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

if (isset($_GET["remove"])) {
    removeTag($_GET["remove"]);
}
