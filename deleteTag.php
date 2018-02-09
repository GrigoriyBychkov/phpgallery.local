<?php
require('models/db.php');
function removeTag($id) {
    try {
        Tags::removeTag($id);
        echo '{ "result": true }';//json encode
        return;
    } catch(PDOException $e) {
        echo '{ "result": false, "error": ' . $e->getMessage() . ' }';
    }
}
if (isset($_GET["remove"])) {
    removeTag($_GET["remove"]);
}
