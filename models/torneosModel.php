<?php
    require_once("../../config/DataBase.php");
    class torneosModel {
        public $PDO;
        public function __construct(){
            $connection = new DataBase();
            //Llamamos al método connect y lo asignamos a nuestra variable PDO
            $this->PDO = $connection->connect();
        }
        //Método para hacer un INSERT en la BD, en la tabla "torneos"
        public function insert($nombreTorneo,$organizador,$patrocinadores,$sede,$categoria,$premio1,$premio2,$premio3,$otroPremio,$usuario,$contrasena){
            //Encriptar contraseña.
                $contrasena = $this->passwordEncrypt($contrasena);
                //iniciamos declarando el statement y preparando la consulta
                $statement = $this->PDO->prepare("INSERT INTO torneos VALUES(null, :nombreTorneo,:organizador, :patrocinadores, :sede, :categoria, :premio1, :premio2, :premio3,
                :otroPremio, :usuario, :contrasena )");
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":nombreTorneo", $nombreTorneo);
                $statement->bindParam(":organizador", $organizador);
                $statement->bindParam(":patrocinadores", $patrocinadores);
                $statement->bindParam(":sede", $sede);
                $statement->bindParam(":categoria", $categoria);
                $statement->bindParam(":premio1", $premio1);
                $statement->bindParam(":premio2", $premio2);
                $statement->bindParam(":premio3", $premio3);
                $statement->bindParam(":otroPremio", $otroPremio);
                $statement->bindParam(":usuario", $usuario);
                $statement->bindParam(":contrasena", $contrasena);
                //Ejecutamos el statement mediante execute(). Valoraremos mediante un shorthand if lo que regresará este método 
                return($statement->execute()) ? $this->PDO->lastInsertId() : false;
            }   
            //El administrador creará el torneo y al usuario (organizador) por lo que al crear su password, buscaremos encriptarla por seguridad utilizando el método password_hash y password_Verify
            public function passwordEncrypt($password){
                $passwordEncrypted = password_hash($password, PASSWORD_DEFAULT);
                return $passwordEncrypted;
            }
            //Método para verificar si la password introducida corresponde con la encriptada
            public function passwordDencryted($passwordEncrypted, $passwordCandidate){
                //Con un shorthand if, verificamos si el password candidato es correcto
                return (password_verify($passwordCandidate, $passwordEncrypted)) ? true : false;
            }
            public function read(){
                $statement = $this->PDO->prepare("SELECT * FROM torneos");
                return ($statement->execute()) ? $statement->fetchAll() : false;
            }
            //Metodo para devolver la informacion de un solo torneo.
            public function readOne($id){
                $statement = $this->PDO->prepare("SELECT * FROM torneos WHERE id= :id limit 1");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? $statement->fetch() : false;
            }
            public function update($id, $nombreTorneo,$organizador, $patrocinadores, $sede, $categoria, 
            $premio1, $premio2, $premio3, $otroPremio){
                $statement = $this->PDO->prepare("UPDATE torneos SET nombreTorneo = :nombreTorneo,
                organizador = :organizador, patrocinadores = :patrocinadores, sede = :sede, categoria = :categoria, premio1 = :premio1, premio2 = :premio2, premio3 = :premio3,
                otroPremio = :otroPremio WHERE id = :id ");
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":id", $id);
                $statement->bindParam(":nombreTorneo", $nombreTorneo);
                $statement->bindParam(":organizador", $organizador);
                $statement->bindParam(":patrocinadores", $patrocinadores);
                $statement->bindParam(":sede", $sede);
                $statement->bindParam(":categoria", $categoria);
                $statement->bindParam(":premio1", $premio1);
                $statement->bindParam(":premio2", $premio2);
                $statement->bindParam(":premio3", $premio3);
                $statement->bindParam(":otroPremio", $otroPremio);
                return ($statement->execute()) ? $id : false;
            }
            public function delete($id){
                $statement = $this->PDO->prepare("DELETE FROM torneos WHERE id= :id ");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? true : false;
            }
    }
?>