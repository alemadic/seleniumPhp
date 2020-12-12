<?php

use Facebook\Webdriver;
use Facebook\WebDriver\WebDriverBy;

require_once __DIR__ . '/vendor/autoload.php';

$host = 'http://localhost:4444/wd/hub';

$driver = Facebook\WebDriver\Remote\RemoteWebDriver::create($host, Facebook\WebDriver\Remote\DesiredCapabilities::chrome());

$driver->get("http://www.google.com");

$driver->manage()->window()->maximize();

// search for inception
$driver->get("https://www.google.com/search?sxsrf=ALeKk00ELapYZ6ems3hNCvfvv9jrcBAmTg%3A1607614437180&ei=5T_SX6PFCoWvrgSLo6zADg&q=inception&oq=inception&gs_lcp=CgZwc3ktYWIQAzIGCCMQJxATMgUIABDLATIFCAAQywEyBQgAEMsBMgUIABDLATIFCAAQywEyBQgAEMsBMgUIABDLATIFCAAQywEyBQgAEMsBOgQIABBHOgQIIxAnOgUIABDEAjoCCCY6BAgAEBNQhBRY_BpgoRxoAHACeAGAAeACiAHbDpIBBzAuMi41LjGYAQCgAQGqAQdnd3Mtd2l6yAEDwAEB&sclient=psy-ab&ved=0ahUKEwjjy9q73sPtAhWFl4sKHYsRC-gQ4dUDCAw&uact=5");

// click appropriate link
$driver->findElement(WebDriverBy::xpath("//a[@href='https://www.imdb.com/title/tt1375666/']"))->click();

// $driver->findElement(WebDriverBy::xpath("(.//*[normalize-space(text()) and normalize-space(.)='Web results'])[1]/folowing::h3[1]"))->click();

// wait until page is fully loaded
$driver->manage()->timeouts()->implicitlywait(7);

// get duration
$duration = $driver->findElement(WebDriverBy::xpath("//*[@id='title-overview-widget']/div[1]/div[2]/div/div[2]/div[2]/div/time"))->getText();

// get writer
$writer = $driver->findElement(WebDriverBy::xpath("//*[@id='title-overview-widget']/div[2]/div[1]/div[3]/a"))->getText();

// get grade
$grade = floatval($driver->findElement(WebDriverBy::xpath("//*[@id='title-overview-widget']/div[1]/div[2]/div/div[1]/div[1]/div[1]/strong/span"))->getText());

// get description
$description = $driver->findElement(WebDriverBy::xpath("//*[@id='title-overview-widget']/div[2]/div[1]/div[1]/div/div[1]/div/div"))->getAttribute("innerHTML");

$description = preg_replace('/\s\s+/', ' ', $description);

// get thumbnail
$thumbnail = $driver->findElement(WebDriverBy::xpath("//*[@id='title-overview-widget']/div[1]/div[3]/div[1]/a/img"))->getAttribute("src");

// get trailer
$trailer = $driver->findElement(WebDriverBy::xpath("//*[@id='title-overview-widget']/div[1]/div[3]/div[2]/a"))->getAttribute("href");

// get genre
$genresElements = $driver->findElements(WebDriverBy::xpath("//a[contains(@href, '/search/title?genres')]"));

$genresAll = [];

// for($i = 0; $i < 3; $i++) {
//     $genres[] = $genresElements[$i]->getText();
// }

foreach($genresElements as $genre) {
    $genresAll[] = $genre->getText();
}

$genre = array_unique($genresAll);


// get stars
$starsElements = $driver->findElements(WebDriverBy::xpath("//*[@id='title-overview-widget']/div[2]/div[1]/div[4]/a"));
$stars = [];

foreach($starsElements as $star) {
    $stars[] = $star->getAttribute('innerHTML');
}

array_pop($stars);

$postdata = http_build_query(
    array(
        "duration" => $duration,
        "writer" => $writer,
        "title" => "Inception",
        "grade" => $grade,
        "description" => $description,
        "thumbnail" => $thumbnail,
        "trailer" => $trailer,
        "btnInsertMovie" => "true"
    )
);

$opts = array('http' => 
    array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context = stream_context_create($opts);
$response = file_get_contents("http://localhost/selenium/public/api/movie/insert.php", false, $context);

echo $response;


// close window
$driver->quit();
