<?php

    // require_once "config.php";

    define("SERVER", "localhost");
    define("DBNAME", "lucuslab");
    define("USERNAME", "root");
    define("PASSWORD", "");

    class Database {

        private $conn;

        function __construct() {
            $this->openConnection();
        }

        public function getConn() {
            return $this->conn;
        }

        public function openConnection() {

            try {
                $this->conn = new PDO("mysql:host=" . SERVER . ";dbname=" . DBNAME . ";charset=utf8", USERNAME, PASSWORD);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                die("Error establishing connection to database. Try again later");
            }
        }

        public function lastInsertId() {
            return $this->conn->lastInsertId();
        }

        public function execQuery($sql, $data = []) {
            $stmt = $this->conn->prepare($sql);

            try {
                $stmt->execute($data);
                return $stmt->fetchAll();
            } catch (PDOException $ex) {
                return "Query failed: " . $stmt->errorInfo()[2];
            }
        }

        public function execQueryStmt($sql, $data = []) {
            $stmt = $this->conn->prepare($sql);

            try {
                return $stmt->execute($data);
            } catch (PDOException $ex) {
                return "Query failed: " . $stmt->errorInfo()[2];
            }

        }

    }

    $db = new Database();