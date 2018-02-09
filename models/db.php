<?php
class DB {
    public static $host = 'localhost:3306';
    public static $dbname = 'test';
    public static $username = 'root';
    public static $password = '';
    static function getPdo() {
        $conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname, self::$username, self::$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}
require('imagesModel.php');
require('tagsModel.php');