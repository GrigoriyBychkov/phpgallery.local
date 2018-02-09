<?php
class Tags {
    static function findTags($tag) {
        $db = DB::getPdo();
        $query = "SELECT * FROM tags WHERE tag = '" . $tag . "'";
        $stmt = $db->query($query);
        return $stmt->fetchAll();
    }

    static function removeTag($id) {
        $db = DB::getPdo();
        $sth = $db->prepare("delete from `test`.`tags` where `Id`= :tagId ");
        $sth->bindValue(':tagId', $id, PDO::PARAM_INT);

        return $sth->execute();
    }

    static function getImageTagsByImageId($id) {
        $db = DB::getPdo();
        $stmt = $db->query('select * from `test`.`tags` where imageId = ' . $id);

        return $stmt->fetchAll();
    }

    static function addTagToImage($tag, $imageId) {
        $db = DB::getPdo();
        $sth = $db->prepare("insert into `test`.`tags` ( `tag`, `imageId`) values ( :tag, :imageId)");
        $sth->bindValue(':tag', $tag ,PDO::PARAM_STR);
        $sth->bindValue(':imageId', $imageId ,PDO::PARAM_INT);
        $sth->execute();

        return $db->lastInsertId();
    }
}
