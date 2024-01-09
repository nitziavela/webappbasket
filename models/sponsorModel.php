<?php
    require_once("../../config/DataBase.php");
    class sponsorModel {
        public $PDO;
        public function __construct(){
            $connection = new DataBase();
            //Llamamos al método connect y lo asignamos a nuestra variable PDO
            $this->PDO = $connection->connect();
        }
        //Método para hacer un INSERT en la BD, en la tabla "patrocinadores"
        public function insert($nombre,$logo){
                //iniciamos declarando el statement y preparando la consulta
                $statement = $this->PDO->prepare("INSERT INTO patrocinadores VALUES(null, :nombre, :logo)");
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":nombre", $nombre);
                $statement->bindParam(":logo", $logo);


                //Ejecutamos el statement mediante execute(). Valoraremos mediante un shorthand if lo que regresará este método 
                return($statement->execute()) ? $this->PDO->lastInsertId() : false;
            }   
            //El administrador creará el torneo y al usuario (organizador) por lo que al crear su password, buscaremos encriptarla por seguridad utilizando el método password_hash y password_Verify
          
            public function read(){
                $statement = $this->PDO->prepare("SELECT * FROM patrocinadores order by idpatrocinadores");
                return ($statement->execute()) ? $statement->fetchAll() : false;
            }
            //Metodo para devolver la informacion de un solo torneo.
            public function readOne($id){
                $statement = $this->PDO->prepare("SELECT * FROM patrocinadores WHERE idpatrocinadores= :id limit 1");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? $statement->fetch() : false;
            }
            public function update($id, $nombre,$logo){
                $statement = $this->PDO->prepare("UPDATE patrocinadores SET nombre = :nombre,
                logo = :logo WHERE idpatrocinadores = :id ");
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":id", $id);
                $statement->bindParam(":nombreTorneo", $nombre);
                $statement->bindParam(":logo", $logo);
                return ($statement->execute()) ? $id : false;
            }
            public function delete($id){
                $statement = $this->PDO->prepare("DELETE FROM patrocinadores WHERE idpatrocinadores= :id ");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? true : false;
            }
    }
?>