<?php
    require_once("../../config/DataBase.php");
    class calendarioModel {
        public $PDO;
        public function __construct(){
            $connection = new DataBase();
            //Llamamos al método connect y lo asignamos a nuestra variable PDO
            $this->PDO = $connection->connect();
        }

        //Método para hacer un INSERT en la BD, en la tabla "rol_juegos"
        public function insertRol($jornadas, $torneo, $nombre){
            $this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                //$sql = 'INSERT INTO equipos VALUES(null, :nombre, :nombre_capitan, :correo_capitan, :telefono_capitan, :logo, :torneo)';
                $sql = 'INSERT INTO rol_juegos VALUES(null, :jornadas, :torneo, :nombre)';
                //iniciamos declarando el statement y preparando la consulta
                $statement = $this->PDO->prepare($sql);
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":jornadas", $jornadas);
                $statement->bindParam(":torneo", $torneo);
                $statement->bindParam(":nombre", $nombre);

                //Ejecutamos el statement mediante execute(). Valoraremos mediante un shorthand if lo que regresará este método 
                return($statement->execute()) ? $this->PDO->lastInsertId() : die("No se pudo agregar el rol de juegos");
            }

            public function updateRol($id, $jornadas, $torneo){
                $this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                $sql = 'UPDATE rol_juegos SET jornadas = :jornadas, fk_torneo = :torneo WHERE idrol_juegos = :id';
                $statement = $this->PDO->prepare($sql);
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":jornadas", $jornadas);
                $statement->bindParam(":torneo", $torneo);
                $statement->bindParam(":id", $id);
                return ($statement->execute()) ? true : false;
            }

            public function update($id, $equipo_visitante, $equipo_local, $fecha_hora, $sede, $tipo_juego, 
            $equipo_ganador, $razon_ganador, $marcador_visitante, $marcador_local, $jornada){
                $this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                $sql = 'UPDATE calendarios SET fk_equipo_visitante = :equipo_visitante, fk_equipo_local = :equipo_local,
                fecha_hora = :fecha_hora,sede = :sede,tipo_juego = :tipo_juego, equipo_ganador = :equipo_ganador,
                razon_ganador = :razon_ganador,marcador_visitante = :marcador_visitante, marcador_local = :marcador_local,
                jornada = :jornada
                WHERE idcalendarios = :id';
                $statement = $this->PDO->prepare($sql);
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":equipo_visitante", $equipo_visitante);
                $statement->bindParam(":equipo_local", $equipo_local);
                $statement->bindParam(":fecha_hora", $fecha_hora);
                $statement->bindParam(":sede", $sede);
                $statement->bindParam(":tipo_juego", $tipo_juego);
                $statement->bindParam(":equipo_ganador", $equipo_ganador);
                $statement->bindParam(":razon_ganador", $razon_ganador);
                $statement->bindParam(":marcador_visitante", $marcador_visitante);
                $statement->bindParam(":marcador_local", $marcador_local);
                $statement->bindParam(":jornada", $jornada);
                $statement->bindParam(":id", $id);
                return ($statement->execute()) ? true : false;
            }

            public function read(){
                $statement = $this->PDO->prepare("SELECT 
                sch.*,
                eq_visitante.nombre AS equipo_visitante,
                eq_local.nombre AS equipo_local,
                eq_visitante.logo AS logo_visitante,
                eq_local.logo AS logo_local,
                    (SELECT GROUP_CONCAT(CASE
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
                    END SEPARATOR ', ')
                    FROM jugadores jg
                    LEFT JOIN equipos eq ON eq.idequipos = jg.fk_equipo
                    WHERE eq.idequipos = sch.fk_equipo_visitante
                    GROUP BY eq.idequipos) AS jugadores_visitante,
                    (SELECT GROUP_CONCAT(CASE
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
                    END SEPARATOR ', ')
                    FROM jugadores jg
                    LEFT JOIN equipos eq ON eq.idequipos = jg.fk_equipo
                    WHERE eq.idequipos = sch.fk_equipo_local
                    GROUP BY eq.idequipos) AS jugadores_local
                FROM calendarios sch
                LEFT JOIN equipos eq_visitante ON eq_visitante.idequipos = sch.fk_equipo_visitante
                LEFT JOIN equipos eq_local ON eq_local.idequipos = sch.fk_equipo_local;");
                return ($statement->execute()) ? $statement->fetchAll() : false;
            }

            public function readOne($id){
                $statement = $this->PDO->prepare("SELECT 
                sch.*,
                eq_visitante.nombre AS equipo_visitante,
                eq_local.nombre AS equipo_local,
                eq_visitante.logo AS logo_visitante,
                eq_local.logo AS logo_local,
                    (SELECT GROUP_CONCAT(CASE
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
                    END SEPARATOR ', ')
                    FROM jugadores jg
                    LEFT JOIN equipos eq ON eq.idequipos = jg.fk_equipo
                    WHERE eq.idequipos = sch.fk_equipo_visitante
                    GROUP BY eq.idequipos) AS jugadores_visitante,
                    (SELECT GROUP_CONCAT(CASE
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
                    END SEPARATOR ', ')
                    FROM jugadores jg
                    LEFT JOIN equipos eq ON eq.idequipos = jg.fk_equipo
                    WHERE eq.idequipos = sch.fk_equipo_local
                    GROUP BY eq.idequipos) AS jugadores_local,
                    rj.jornadas as jornadas
                FROM calendarios sch
                LEFT JOIN equipos eq_visitante ON eq_visitante.idequipos = sch.fk_equipo_visitante
                LEFT JOIN equipos eq_local ON eq_local.idequipos = sch.fk_equipo_local
                LEFT JOIN rol_juegos rj ON rj.idrol_juegos = sch.fk_rol
                WHERE idcalendarios = :id ;");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? $statement->fetchAll() : false;
            }

            public function readRoles(){
                $statement = $this->PDO->prepare("SELECT roles.*, torneo.nombre as nombre_torneo FROM rol_juegos roles
                LEFT JOIN torneos torneo ON torneo.idtorneos = roles.fk_torneo");
                return ($statement->execute()) ? $statement->fetchAll() : false;
            }

            

            public function readOneRol($id){
                $statement = $this->PDO->prepare("SELECT roles.*, torneo.nombre as nombre_torneo FROM rol_juegos roles
                LEFT JOIN torneos torneo ON torneo.idtorneos = roles.fk_torneo
                WHERE idrol_juegos= :id limit 1");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? $statement->fetch() : false;
            }

            public function deleteRol($id){
                $statement = $this->PDO->prepare("DELETE FROM rol_juegos WHERE idrol_juegos= :id ");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? true : false;
            }

        //Método para hacer un INSERT en la BD, en la tabla "calendarios"
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

            public function insertResultados($jugador, $torneo, $equipo, $calendario, $jornada, $triples, $dobles, $faltas){
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
          
    }
?>