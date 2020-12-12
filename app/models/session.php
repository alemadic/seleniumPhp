<?php 

    class Session {

        private $signedIn = false;
        public $userId;
        public $message;
        public $count;
        
        function __construct() {
            session_start();

            $this->checkLogin();
            $this->visitorCount();
            $this->checkMessage();
        }

        public function isSignedIn() {
            return $this->signedIn;
        }

        private function checkLogin() {
            if(isset($_SESSION['userId'])) {
                $this->userId = $_SESSION['userId'];
                $this->signedIn = true;
            } else {
                unset($this->userId);
                $this->signedIn = false;
            }
        }

        public function login($user) {
            if($user) {
                $this->userId = $_SESSION['userId'] = $user->id;

                $this->signedIn = true;
            }
        }

        public function logout() {
            unset($_SESSION['userId']);
            unset($this->userId);
            $this->signedIn = false;
        }

        private function checkMessage() {
            if(isset($_SESSION['message'])) {
                $this->message = $_SESSION['message'];
                unset($_SESSION['message']);
            } else {
                $this->message = "";
            }
        
        }

        public function message($msg = "") {
            if(!empty($msg)) {
                $_SESSION['message'] = $msg;
            } else {
                return $this->message;
            }
        }

        public function visitorCount() {
            if(isset($_SESSION['count'])) {
                return $this->count = $_SESSION['count']++;
            } else {
                return $_SESSION['count'] = 1;
            }
        }

    }


    $session = new Session();
    $message = $session->message();

?>