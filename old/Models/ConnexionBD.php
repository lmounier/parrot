<?php
    class ConnexionBD{
        private static $_connexion, $_instance;
        
        private function __construct(){
            if($_SERVER['HTTP_HOST'] == "localhost") {
                self::$_connexion = new PDO('mysql:host=localhost;dbname=management;charset=utf8', 'lisa', 'lisa');
            } else {
                self::$_connexion = new PDO('mysql:host=lmouniergiadmin.mysql.db;dbname=lmouniergiadmin;charset=utf8', 'lmouniergiadmin', 'ag8jA58A');
            }

        }
        
        private function __clone(){}
        
        public static function getInstance(){
            if(!isset(self::$_instance)) self::$_instance = new self;
            return self::$_instance;
        }

        public function getData($requete){
            $result = self::$_connexion->prepare($requete);
            $result->execute();
            return $result;
        }

        public function setData($requete){
            $result = self::$_connexion->prepare($requete);
            $result->execute();
        }
        
        public function getLastId(){
            return self::$_connexion->lastInsertId();
        }
    }
?>