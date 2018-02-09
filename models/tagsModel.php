<?php
class Tags {
    static function findTags($tag) {
        $db = DB::getPdo();
        $sth = $db->prepare("SELECT * FROM tags WHERE tag = :tag");
        $sth->bindValue(':tag', $tag, PDO::PARAM_STR);
        $sth->execute();

        return $sth->fetchAll();
    }

    static function removeTag($id) {
        $db = DB::getPdo();
        $sth = $db->prepare("delete from `test`.`tags` where `id` = :tagId");
        $sth->bindValue(':tagId', $id, PDO::PARAM_INT);

        return $sth->execute();
    }
    static function deleteTagsByImageId($imageId) {
        $db = DB::getPdo();
        $sth = $db->prepare("delete from `test`.`tags` where `imageId` = :imageId");
        $sth->bindValue(':imageId', $imageId, PDO::PARAM_INT);

        return $sth->execute();
    }

    static function getImageTagsByImageId($id) {
        $db = DB::getPdo();
        $sth = $db->prepare("select * from `test`.`tags` where imageId = :imageId");
        $sth->bindValue(':imageId', $id, PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll();
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
