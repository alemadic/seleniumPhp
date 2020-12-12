<?php

use Facebook\Webdriver;
use Facebook\WebDriver\WebDriverBy;

require_once __DIR__ . '/vendor/autoload.php';

$host = 'http://localhost:4444/wd/hub';

$driver = Facebook\WebDriver\Remote\RemoteWebDriver::create($host, Facebook\WebDriver\Remote\DesiredCapabilities::chrome());

$driver->get("http://www.google.com");

$driver->manage()->window()->maximize();

// search for inception
$driver->get("https://www.imdb.com/chart/top/");

// wait until page is fully loaded
$driver->manage()->timeouts()->implicitlywait(7);

// all elements
$allRatings = $driver->findElements(WebDriverBy::cssSelector("td.ratingColumn.imdbRating strong"));

for($i = 0; $i < count($allRatings); $i++) {
    $currRating = floatval($allRatings[$i]->getText());

    if($currRating < 8.5) {
        
    }
}

// close window
// $driver->quit();
