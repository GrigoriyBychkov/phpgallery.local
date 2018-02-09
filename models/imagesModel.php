<?php
class Images {
    static function getImagesByIds($ids) {
        $db = DB::getPdo();
        $idsString = implode(', ', $ids);
        $query = "SELECT * FROM images WHERE Id in (" . $idsString . ")";
        $stmt = $db->query($query);
        return $stmt->fetchAll();
    }
    static function getImages() {
        $db = DB::getPdo();
        if (isset($_GET["tag"])) {
            $tags = Tags::findTags($_GET["tag"]);
            $imagesIds = Array();
            foreach ($tags as $tag) {
                $imagesIds[] = $tag["imageId"];
            }
            return Images::getImagesByIds($imagesIds);
        } else {
            $stmt = $db->query('SELECT * FROM images');
        }
        return $stmt->fetchAll();
    }
    static function saveImageToDataBase($name, $extension) {
        try {
            $db = DB::getPdo();
            $sql = "insert into `images` ( `extension`, `Name`) values ( '" . $extension . "', '" . $name . "')";
            $db->query($sql);
            var_dump($sql);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $db->lastInsertId();
    }
    static function getImageExtensionById($id) {
        $db = DB::getPdo();
        $sql = "select * from `test`.`images` where `Id`='" . $id . "' ";
        $stmt = $db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($result["extension"]);
        return $result["extension"];
    }
    static function deleteImage($id) {
        $db = DB::getPdo();
        $sql = "delete from `test`.`images` where `Id`='" . $id . "' ";
        $db->query($sql);
    }}