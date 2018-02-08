<?php

function getImagesByIds($ids) {
    $db = new PDO('mysql:host=localhost:3306;dbname=test', 'root', '');
    $idsString = implode(', ', $ids);
    $query = "SELECT * FROM images WHERE Id in (" . $idsString . ")";
    $stmt = $db->query($query);
    return $stmt->fetchAll();
}

function findTags($tag) {
    $db = new PDO('mysql:host=localhost:3306;dbname=test', 'root', '');
    $query = "SELECT * FROM tags WHERE tag = '" . $tag . "'";
    $stmt = $db->query($query);
    return $stmt->fetchAll();
}

function getImages() {
    $db = new PDO('mysql:host=localhost:3306;dbname=test', 'root', '');

    if (isset($_GET["tag"])) {
        $tags = findTags($_GET["tag"]);
        $imagesIds = Array();
        foreach ($tags as $tag) {
            $imagesIds[] = $tag["imageId"];
        }
        return getImagesByIds($imagesIds);
    }
    if (isset($_GET["desc"])) {
        $descs = findTags($_GET["desc"]);
        $imagesIds = Array();
        foreach ($descs as $desc) {
            $imagesIds[] = $desc["imageId"];
        }
        return getImagesByIds($imagesIds);
    } else {
        $stmt = $db->query('SELECT * FROM images');
    }

    return $stmt->fetchAll();
}

function getImageTagsByImageId($id) {
    $db = new PDO('mysql:host=localhost:3306;dbname=test', 'root', '');
    $stmt = $db->query('select * from `test`.`tags` where imageId = ' . $id);
    return $stmt->fetchAll();
}
function getImageDescByImageId($id) {
    $db = new PDO('mysql:host=localhost:3306;dbname=test', 'root', '');
    $stmt = $db->query('select * from `test`.`desc` where imageId = ' . $id);
    if ($stmt) {
        return $stmt->fetchAll();
    } else {
        return Array();
    }

}
