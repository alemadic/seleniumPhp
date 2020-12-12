<?php 

// define("ABSOLUTE_PATH", $_SERVER['DOCUMENT_ROOT']);
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT']. "/selenium/");

// define("ENV_FILE", ROOT_DIR . "app/models/.env");

define("SERVER", getFromEnv("SERVER"));
define("DBNAME", getFromEnv("DBNAME"));
define("USERNAME", getFromEnv("USERNAME"));
define("PASSWORD", getFromEnv("PASSWORD"));

function getFromEnv($attrName) {
    $data = file(".env");
    $propValue = "";
    foreach ($data as $key => $value) {
        $row = explode("=", $value);
        if($row[0] == $attrName) {
            $propValue = trim($row[1]);
        }
    }

    return $propValue;
}