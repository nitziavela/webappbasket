<?php
    require_once("../../config/DataBase.php");
    class equiposModel {
        public $PDO;
        public function __construct(){
            $connection = new DataBase();
            //Llamamos al método connect y lo asignamos a nuestra variable PDO
            $this->PDO = $connection->connect();
        }
        //Método para hacer un INSERT en la BD, en la tabla "patrocinadores"
        public function insert($nombre, $nombre_capitan, $correo_capitan, $telefono_capitan, $logo, $torneo){
            $this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                //$sql = 'INSERT INTO equipos VALUES(null, :nombre, :nombre_capitan, :correo_capitan, :telefono_capitan, :logo, :torneo)';
                $sql = 'INSERT INTO equipos (idequipos, nombre, nombre_capitan, correo_capitan, telefono_capitan, logo, fk_torneo) VALUES(null, :nombre, :nombre_capitan, :correo_capitan, :telefono_capitan, :logo, :torneo)';
                //iniciamos declarando el statement y preparando la consulta
                $statement = $this->PDO->prepare($sql);
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":nombre", $nombre);
                $statement->bindParam(":nombre_capitan", $nombre_capitan);
                $statement->bindParam(":correo_capitan", $correo_capitan);
                $statement->bindParam(":telefono_capitan", $telefono_capitan);
                $statement->bindParam(":logo", $logo);
                $statement->bindParam(":torneo", $torneo);

                //Ejecutamos el statement mediante execute(). Valoraremos mediante un shorthand if lo que regresará este método 
                return($statement->execute()) ? $this->PDO->lastInsertId() : die("No se pudo agregar el equipo");
            }   
            //El administrador creará el torneo y al usuario (organizador) por lo que al crear su password, buscaremos encriptarla por seguridad utilizando el método password_hash y password_Verify
          
            public function read(){
                $statement = $this->PDO->prepare("SELECT teams.*, torneo.nombre as nombre_torneo FROM equipos teams
                LEFT JOIN torneos torneo ON torneo.idtorneos = teams.fk_torneo");
                return ($statement->execute()) ? $statement->fetchAll() : false;
            }
            //Metodo para devolver la informacion de un solo equipo.
            public function readOne($id){
                $statement = $this->PDO->prepare("SELECT teams.*, torneo.nombre as nombre_torneo FROM equipos teams 
                LEFT JOIN torneos torneo ON torneo.idtorneos = fk_torneo
                WHERE idequipos= :id limit 1");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? $statement->fetch() : false;
            }
            public function update($id, $nombre, $nombre_capitan, $correo_capitan, $telefono_capitan, $logo, $torneo){
                $this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                $sql = 'UPDATE equipos SET nombre = :nombre, nombre_capitan = :nombre_capitan, correo_capitan = :correo_capitan, telefono_capitan = :telefono_capitan, 
                logo = :logo, fk_torneo = :torneo WHERE idequipos = '.$id;
                $statement = $this->PDO->prepare($sql);
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":nombre", $nombre);
                $statement->bindParam(":nombre_capitan", $nombre_capitan);
                $statement->bindParam(":correo_capitan", $correo_capitan);
                $statement->bindParam(":telefono_capitan", $telefono_capitan);
                $statement->bindParam(":logo", $logo); 
                $statement->bindParam(":torneo", $torneo);
                return ($statement->execute()) ? true : false;
            }
            public function delete($id){
                $statement = $this->PDO->prepare("DELETE FROM equipos WHERE idequipos= :id ");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? true : false;
            }
    }
?>