<?php 
    
    require_once "../../../app/models/init.php";

    if(isset($_POST['btnInsertMovie'])) {
        extract($_POST);

        $inceptionMovie = new Movie();
        $inceptionMovie->duration = $duration;
        $inceptionMovie->writer = $writer;
        $inceptionMovie->title = $title;
        $inceptionMovie->grade = $grade;
        $inceptionMovie->description = $description;
        $inceptionMovie->thumbnail = $thumbnail;
        $inceptionMovie->trailer = $trailer;

        $resultOp = $inceptionMovie->save();

        echo $resultOp;

    } else {
        die("Send data first!");
    }




?>