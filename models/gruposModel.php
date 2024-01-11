<?php
    require_once("../../config/DataBase.php");
    class gruposModel {
        public $PDO;
        public function __construct(){
            $connection = new DataBase();
            //Llamamos al método connect y lo asignamos a nuestra variable PDO
            $this->PDO = $connection->connect();
        }
        //Método para hacer un INSERT en la BD, en la tabla "grupos"
        public function insert($nombre,$categoria,$torneo){
                //iniciamos declarando el statement y preparando la consulta
                $statement = $this->PDO->prepare("INSERT INTO grupos VALUES(null, :nombre, :categoria, :torneo)");
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":nombre", $nombre);
                $statement->bindParam(":categoria", $categoria);
                $statement->bindParam(":torneo", $torneo);

                //Ejecutamos el statement mediante execute(). Valoraremos mediante un shorthand if lo que regresará este método 
                return($statement->execute()) ? $this->PDO->lastInsertId() : false;
            }   
            //El administrador creará el torneo y al usuario (organizador) por lo que al crear su password, buscaremos encriptarla por seguridad utilizando el método password_hash y password_Verify
          
            public function read(){
                $statement = $this->PDO->prepare("SELECT gr.*, tr.nombre as torneo FROM grupos gr LEFT JOIN torneos tr ON tr.idtorneos = gr.fk_torneo");
                return ($statement->execute()) ? $statement->fetchAll() : false;
            }
            //Metodo para devolver la informacion de un solo torneo.
            public function readOne($id){
                $statement = $this->PDO->prepare("SELECT * FROM grupos WHERE idgrupos= :id limit 1");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? $statement->fetch() : false;
            }
            public function update($id, $nombre, $categoria, $torneo){
                $statement = $this->PDO->prepare("UPDATE grupos SET nombre = :nombre,
                categoria = :categoria, fk_torneo = :torneo WHERE idgrupos = :id ");
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":id", $id);
                $statement->bindParam(":nombre", $nombre);
                $statement->bindParam(":categoria", $categoria);
                $statement->bindParam(":torneo", $torneo);
                return ($statement->execute()) ? $id : false;
            }
            public function delete($id){
                $statement = $this->PDO->prepare("DELETE FROM grupos WHERE idgrupos= :id ");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? true : false;
            }
    }
?>