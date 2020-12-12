<?php 

// define("ABSOLUTE_PATH", $_SERVER['DOCUMENT_ROOT']);
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT']. "/selenium/");

define("ENV_FILE", ROOT_DIR . "app/config/.env");
// // define("CONNECTION", ABSOLUTE_PATH . "/config/connection.php");
// define("USER_SLIKE", ABSOLUTE_PATH . "/assets/img");
// define("SLIKE_FOLDER", "assets/img/");
// define("LOG_FAJL", ABSOLUTE_PATH . "/data/log.txt");
// define("GRESKE", ABSOLUTE_PATH . "/data/errors.txt");
// define("ULOGOVANIKOR", ABSOLUTE_PATH . "/data/loggedUsers.txt");
// define("SEPARATOR", "\t");

define("SERVER", getFromEnv("SERVER"));
define("DBNAME", getFromEnv("DBNAME"));
define("USERNAME", getFromEnv("USERNAME"));
define("PASSWORD", getFromEnv("PASSWORD"));

function getFromEnv($attrName) {
    $data = file(ENV_FILE);
    $propValue = "";
    foreach ($data as $key => $value) {
        $row = explode("=", $value);
        if($row[0] == $attrName) {
            $propValue = trim($row[1]);
        }
    }

    return $propValue;
}