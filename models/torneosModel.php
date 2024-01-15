<?php
    //Requerir para conexion a base de datos
    require_once("../../config/DataBase.php");
    class torneosModel {
        public $PDO;
        public function __construct(){
            //INSTANCIA
            $connection = new DataBase();
            //Llamamos al método connect y lo asignamos a nuestra variable PDO
            $this->PDO = $connection->connect();
        }
        //Método para hacer un INSERT en la BD, en la tabla "torneos"
        public function insert($nombreTorneo,$organizador,$sede,$categoria,$premio1,$premio2,$premio3,$otroPremio,$usuario,$contrasena){

                //VALIDAR SI LA CONTRASEÑA Y EL USUARIO PERTENECEN AL ORGANIZADOR
                $sql = "SELECT * FROM usuarios WHERE username = :usuario AND password = :password AND idusuarios = :organizador";
                $stmt = $this->PDO->prepare($sql);
                $stmt->bindParam(":usuario", $usuario);
                $stmt->bindParam(":password", $contrasena);
                $stmt->bindParam(":organizador", $organizador);
                $stmt->execute() ? $stmt->fetch() : die('El usuario y/o la contraseña no coinciden con el organizador.');

                //iniciamos declarando el statement y preparando la consulta
                $statement = $this->PDO->prepare("INSERT INTO torneos VALUES(null, :nombreTorneo, :sede, :premio1, :premio2, :premio3,
                :otroPremio, :organizador, :categoria)");
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":nombreTorneo", $nombreTorneo);
                $statement->bindParam(":organizador", $organizador);
                $statement->bindParam(":sede", $sede);
                $statement->bindParam(":categoria", $categoria);
                $statement->bindParam(":premio1", $premio1);
                $statement->bindParam(":premio2", $premio2);
                $statement->bindParam(":premio3", $premio3);
                $statement->bindParam(":otroPremio", $otroPremio);
                //Ejecutamos el statement mediante execute(). Valoraremos mediante un shorthand if lo que regresará este método 
                return($statement->execute()) ? $this->PDO->lastInsertId() : false;
            }

            //Funcion para almacenar los patrocinadores de los torneos
            public function insertST($torneo, $patrocinador,$usuario,$contrasena, $organizador){
                //VALIDAR SI LA CONTRASEÑA Y EL USUARIO PERTENECEN AL ORGANIZADOR
                $sql = "SELECT * FROM usuarios WHERE username = :usuario AND password = :password AND idusuarios = :organizador";
                $stmt = $this->PDO->prepare($sql);
                $stmt->bindParam(":usuario", $usuario);
                $stmt->bindParam(":password", $contrasena);
                $stmt->bindParam(":organizador", $organizador);
                $stmt->execute() ? $stmt->fetch() : die('El usuario y/o la contraseña no coinciden con el organizador.');

                $statement = $this->PDO->prepare("INSERT INTO patrocinadores_torneos VALUES(null, :patrocinador, :torneo)");
                $statement->bindParam(":patrocinador", $patrocinador);
                $statement->bindParam(":torneo", $torneo);

                return($statement->execute()) ? $this->PDO->lastInsertId() : die("Error al almacenar el patrocinador");
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
                $statement = $this->PDO->prepare("SELECT t.*, users.nombre as organizador, 
                (SELECT GROUP_CONCAT(p.logo SEPARATOR ', ') 
                    FROM patrocinadores p
                    LEFT JOIN patrocinadores_torneos pt ON pt.fk_patrocinador = p.idpatrocinadores
                    WHERE pt.fk_torneo = t.idtorneos
                    GROUP BY pt.fk_torneo
                ) as patrocinadores 
            FROM torneos t 
            LEFT JOIN usuarios users ON users.idusuarios = t.fk_organizador;");
                return ($statement->execute()) ? $statement->fetchAll() : false;
            }
            //Metodo para devolver la informacion de un solo torneo.
            public function readOne($id){
                $statement = $this->PDO->prepare("SELECT tournament.*, users.nombre as organizador, (SELECT GROUP_CONCAT(p.nombre SEPARATOR ', ') 
                FROM patrocinadores p
                LEFT JOIN patrocinadores_torneos pt ON pt.fk_patrocinador = p.idpatrocinadores
                WHERE pt.fk_torneo = tournament.idtorneos
                GROUP BY pt.fk_torneo
                order by p.idpatrocinadores
            ) as patrocinadores  FROM torneos tournament 
                LEFT JOIN usuarios users on users.idusuarios = tournament.fk_organizador
                WHERE idtorneos= :id limit 1");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? $statement->fetch() : true;
            }
            public function update($id, $nombreTorneo, $sede, $categoria, 
            $premio1, $premio2, $premio3, $otroPremio){
                $statement = $this->PDO->prepare("UPDATE torneos SET nombre = :nombreTorneo,
                fk_organizador = :organizador, sede = :sede, premio1 = :premio1, premio2 = :premio2, premio3 = :premio3,
                premio_otro = :otroPremio, categoria = :categoria, WHERE idtorneos = :id ");
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":id", $id);
                $statement->bindParam(":nombreTorneo", $nombreTorneo);
                $statement->bindParam(":sede", $sede);
                $statement->bindParam(":categoria", $categoria);
                $statement->bindParam(":premio1", $premio1);
                $statement->bindParam(":premio2", $premio2);
                $statement->bindParam(":premio3", $premio3);
                $statement->bindParam(":otroPremio", $otroPremio);
                $statement->bindParam(":categoria", $categoria);
                return ($statement->execute()) ? $id : false;
            }
            public function delete($id){
                $statement = $this->PDO->prepare("DELETE FROM torneos WHERE idtorneos = :id ");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? true : false;
            }

            public function deleteAll($id){
                $stmt = $this->PDO->prepare("SELECT * FROM torneos WHERE idtorneos= :id limit 1");
                $stmt->bindParam(":id",$id);
                $stmt->execute() ? $data = $stmt->fetch() : die("No se pudo encontrar el torneo.");

                $nombreTorneo = $data['nombre'];

                $statement = $this->PDO->prepare("DELETE FROM patrocinadores_torneos WHERE nombre_torneo= :nombreTorneo ");
                $statement->bindParam("nombreTorneo",$nombreTorneo);
                $statement->execute();
            }
    }
?>