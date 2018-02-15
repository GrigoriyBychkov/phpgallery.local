<?php

require('config.php');

class DB {
    static function getPdo() {
        $host = Config::$host;
        $dbname = Config::$dbname;
        $username = Config::$username;
        $password = Config::$password;

        $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}
require('imagesModel.php');
require('tagsModel.php');