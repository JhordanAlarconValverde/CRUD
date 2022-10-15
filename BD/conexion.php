<?php
    class Conexion{
        private $host = "localhost:3307";
        private $user = "root";
        private $bd = "CRUD";
        private $psw = "";

        public function Conectar(){
            try {
                $conexion = new PDO("mysql:host=".$this->host.";dbname=".$this->bd.";", $this->user, $this->psw);
            } catch (PDOException $e) {
                $conexion = $e->getMessage();
            }
            return $conexion;
        }
    }
?>