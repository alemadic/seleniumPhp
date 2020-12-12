<?php 

    defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

    // define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT']);
    define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT']. "/selenium");
    
    define("MODELS", SITE_ROOT . "/app/models");

    require_once "functions.php";

    require_once "database.php";
    require_once "dbObject.php";
    require_once "session.php";
    // require_once MODELS . "/user.php";
    // require_once MODELS . "/photo.php";
    // require_once MODELS . "/comment.php";

?>