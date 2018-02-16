<?php
class Images {
    static function getImagesByIds($ids) {
        $db = DB::getPdo();
        $idsString = implode(', ', $ids);
        $query = "SELECT * FROM images WHERE Id in (" . $idsString . ")";
        $sth = $db->prepare($query);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    static function getImages($offset, $page) {
        $db = DB::getPdo();
        $findByTags = isset($_GET["tag"]) && strlen(trim($_GET["tag"])) > 0;

        if ($findByTags) {
            $tags = Tags::findTags($_GET["tag"]);

            $tags = array_chunk($tags, 6);

            $tags = $tags[$page];
            if (count($tags) == 0) {
                return array();
            }

            $imagesIds = Array();
            foreach ($tags as $tag) {
                $imagesIds[] = $tag["imageId"];
            }
            return Images::getImagesByIds($imagesIds);
        } else {
            $query = "SELECT * FROM `images` ORDER BY `images`.`Id` ASC LIMIT 6 offset " . $offset;
            $sth = $db->prepare($query);

            $sth->bindValue(':offset', $offset ,PDO::PARAM_INT);

            $stmt = $db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    static function saveImageToDataBase($name, $extension) {
        $db = DB::getPdo();
        $sth = $db->prepare("insert into `images` ( `extension`, `Name`) values ( :extension, :name)");
        $sth->bindValue(':extension', $extension ,PDO::PARAM_STR);
        $sth->bindValue(':name', $name ,PDO::PARAM_INT);
        $sth->execute();

        return $db->lastInsertId();
    }
    static function getImageExtensionById($id) {
        $db = DB::getPdo();
        $sth = $db->prepare("select * from `images` where `Id`= :id");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['extension'];

    }
    static function deleteImage($id) {
        $db = DB::getPdo();
        $sth = $db->prepare("delete from `images` where `Id`= :id");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        return $sth->execute();
    }


    static function getImagesCount() {
        $db = DB::getPdo();
        $sth = $db->prepare("SELECT count(Id) as total FROM `images`");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result[0]['total'];
    }
}