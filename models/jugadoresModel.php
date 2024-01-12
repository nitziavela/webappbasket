<?php
    require_once("../../config/DataBase.php");
    class jugadoresModel {
        public $PDO;
        public function __construct(){
            $connection = new DataBase();
            //Llamamos al método connect y lo asignamos a nuestra variable PDO
            $this->PDO = $connection->connect();
        }
          
            public function read(){
                $statement = $this->PDO->prepare("SELECT jg.*, 
                CASE
                    WHEN jg.nombre IS NOT NULL AND jg.apellido1 IS NOT NULL AND jg.apellido2 IS NOT NULL THEN
                        CONCAT_WS(' ', jg.nombre, jg.apellido1, jg.apellido2)
                    WHEN jg.nombre IS NOT NULL AND jg.apellido2 IS NOT NULL THEN
                        CONCAT_WS(' ', jg.nombre, jg.apellido2)
                    WHEN jg.nombre IS NOT NULL AND jg.apellido1 IS NOT NULL THEN
                    CONCAT_WS(' ', jg.nombre, jg.apellido1)
                    WHEN jg.nombre IS NOT NULL THEN
                        jg.nombre
                    ELSE
                        'N/A'
                END AS nombre_jugador,
                eq.nombre AS nombre_equipo, eq.logo as logo
                FROM 
                jugadores jg
                LEFT JOIN equipos eq ON eq.idequipos = jg.fk_equipo;");
                return ($statement->execute()) ? $statement->fetchAll() : false;
            }

            public function readByName($name){
                $this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                $statement = $this->PDO->prepare("SELECT jg.*, 
                CASE
                    WHEN jg.nombre IS NOT NULL AND jg.apellido1 IS NOT NULL AND jg.apellido2 IS NOT NULL THEN
                        CONCAT_WS(' ', jg.nombre, jg.apellido1, jg.apellido2)
                    WHEN jg.nombre IS NOT NULL AND jg.apellido2 IS NOT NULL THEN
                        CONCAT_WS(' ', jg.nombre, jg.apellido2)
                    WHEN jg.nombre IS NOT NULL AND jg.apellido1 IS NOT NULL THEN
                    CONCAT_WS(' ', jg.nombre, jg.apellido1)
                    WHEN jg.nombre IS NOT NULL THEN
                        jg.nombre
                    ELSE
                        'N/A'
                END AS nombre_jugador,
                eq.nombre AS nombre_equipo, eq.logo as logo
                FROM 
                jugadores jg
                LEFT JOIN equipos eq ON eq.idequipos = jg.fk_equipo
                WHERE jg.nombre = :nombre ");
                $statement->bindParam(':nombre', $nombre);
                return ($statement->execute()) ? $statement->fetchAll() : false;
            }

            //Metodo para devolver la informacion de un solo torneo.
            public function readOne($id){
                $statement = $this->PDO->prepare("SELECT jg.*, 
                CASE
                    WHEN jg.nombre IS NOT NULL AND jg.apellido1 IS NOT NULL AND jg.apellido2 IS NOT NULL THEN
                        CONCAT_WS(' ', jg.nombre, jg.apellido1, jg.apellido2)
                    WHEN jg.nombre IS NOT NULL AND jg.apellido2 IS NOT NULL THEN
                        CONCAT_WS(' ', jg.nombre, jg.apellido2)
                    WHEN jg.nombre IS NOT NULL AND jg.apellido1 IS NOT NULL THEN
                    CONCAT_WS(' ', jg.nombre, jg.apellido1)
                    WHEN jg.nombre IS NOT NULL THEN
                        jg.nombre
                    ELSE
                        'N/A'
                END AS nombre_jugador,
                eq.nombre AS nombre_equipo
                FROM 
                jugadores jg
                LEFT JOIN equipos eq ON eq.idequipos = jg.fk_equipo
                WHERE idjugadores= :id limit 1;");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? $statement->fetch() : false;
            }
            public function update($id,$nombre,$apellido1,$apellido2,$fechanac,$correo, $celular, $tipo_sangre, $fotografia, $equipo, $posicion){
                $statement = $this->PDO->prepare("UPDATE jugadores SET nombre = :nombre,
                apellido1 = :apellido1, apellido2 =:apellido2, fecha_nac = :fechanac, correo = :correo,
                celular = :celular, tipo_sangre = :tipo_sangre, fotografia = :fotografia, fk_equipo = :equipo, posicion = :posicion
                WHERE idjugadores = :id ");
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":id", $id);
                $statement->bindParam(":nombre", $nombre);
                $statement->bindParam(":apellido1", $apellido1);
                $statement->bindParam(":apellido2", $apellido2);
                $statement->bindParam(":fechanac", $fechanac);
                $statement->bindParam(":correo", $correo);
                $statement->bindParam(":celular", $celular);
                $statement->bindParam(":tipo_sangre", $tipo_sangre);
                $statement->bindParam(":fotografia", $fotografia);
                $statement->bindParam(":equipo", $equipo);
                $statement->bindParam(":posicion", $posicion);
                return ($statement->execute()) ? $id : false;
            }
            public function delete($id){
                $statement = $this->PDO->prepare("DELETE FROM jugadores WHERE idpatrocinadores= :id ");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? true : false;
            }
    }
?>