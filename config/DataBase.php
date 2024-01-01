<?php 

    /** Clase para conexion a base de datos mediante PDO */
    class DataBase{

        /** Atributos de la clase */
        private $host = "localhost";
        private $db = "basket";
        private $user = "root";
        private $password = '';

        public function __construct()
        {
            //Constructor...
        }

        public function connect(){
            try{
                $pdo = new PDO("mysql: host =".$this->host.";dbname=".$this->db, $this->user, $this->password);
                return $pdo;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

    }

?>