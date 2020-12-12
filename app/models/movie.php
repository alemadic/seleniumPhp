<?php 

    class Movie extends DbObject {

        public $id;
        public $title;
        public $writer;
        public $grade;
        public $duration;
        public $description;
        public $thumbnail;
        public $trailer;

        protected static $dbTable = "movie";
        protected static $tableFields = array("title", "writer", "grade", "duration", "description", "thumbnail", "trailer");
        protected static $idColumnName = "id";

    }


?>