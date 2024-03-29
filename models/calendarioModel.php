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
            $equipo_ganador, $razon_ganador, $marcador_visitante, $marcador_local, $jornada, $equipo_perdedor){
                $this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                if($razon_ganador == 'ANOTACIONES'){
                    $puntaje = 1;
                }
                
                if($razon_ganador == 'DEFAULT'){
                    $puntaje = 0;
                }

                $sqlUpdateEquipoGanador = 'UPDATE equipos SET puntos_a_favor = puntos_a_favor + :puntos_a_favor, puntos_en_contra = puntos_en_contra + :puntos_en_contra, 
                puntaje = puntaje + 2, juegos_ganados = juegos_ganados + 1
                WHERE idequipos = :equipo_ganador';
                $stmt = $this->PDO->prepare($sqlUpdateEquipoGanador);
                if($equipo_ganador == $equipo_local){
                    $stmt->bindParam(':puntos_a_favor', $marcador_local);
                    $stmt->bindParam(':puntos_en_contra', $marcador_visitante);
                }else{
                    $stmt->bindParam(':puntos_a_favor', $marcador_visitante);
                    $stmt->bindParam(':puntos_en_contra', $marcador_local);
                }
                $stmt->bindParam(':equipo_ganador', $equipo_ganador);
                $stmt->execute();

                $sqlUpdateEquipoPerdedor = 'UPDATE equipos SET puntos_a_favor = puntos_a_favor + :puntos_a_favor, puntos_en_contra = puntos_en_contra + :puntos_en_contra, 
                puntaje = puntaje + :puntaje, juegos_perdidos = juegos_perdidos + 1, partidos_perdidos_default = partidos_perdidos_default + :partidos_perdidos_default
                WHERE idequipos = :equipo_perdedor';
                $stmt = $this->PDO->prepare($sqlUpdateEquipoPerdedor);
               if ($equipo_ganador == $equipo_local) {
                    $stmt->bindValue(':puntos_en_contra', $marcador_local, PDO::PARAM_INT);
                    $stmt->bindValue(':puntos_a_favor', $marcador_visitante, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue(':puntos_a_favor', $marcador_local, PDO::PARAM_INT);
                    $stmt->bindValue(':puntos_en_contra', $marcador_visitante, PDO::PARAM_INT);
                }

                $stmt->bindParam(':puntaje', $puntaje, PDO::PARAM_INT);

                if ($razon_ganador == 'DEFAULT') {
                    $stmt->bindValue(':partidos_perdidos_default', 1, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue(':partidos_perdidos_default', 0, PDO::PARAM_INT);
                }
                $stmt->bindParam(':equipo_perdedor', $equipo_perdedor);
                $stmt->execute();

                $sql = 'UPDATE calendarios SET fk_equipo_visitante = :equipo_visitante, fk_equipo_local = :equipo_local,
                fecha_hora = :fecha_hora,sede = :sede,tipo_juego = :tipo_juego, equipo_ganador = :equipo_ganador,
                razon_ganador = :razon_ganador,marcador_visitante = :marcador_visitante, marcador_local = :marcador_local,
                jornada = :jornada, equipo_perdedor = :equipo_perdedor
                WHERE idcalendarios = :id';
                $statement = $this->PDO->prepare($sql);
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":equipo_visitante", $equipo_visitante);
                $statement->bindParam(":equipo_local", $equipo_local);
                $statement->bindParam(":fecha_hora", $fecha_hora);
                $statement->bindParam(":sede", $sede);
                $statement->bindParam(":tipo_juego", $tipo_juego);
                $statement->bindParam(":equipo_ganador", $equipo_ganador);
                $statement->bindParam(":equipo_perdedor", $equipo_perdedor);
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

            public function delete($id){
                $statement = $this->PDO->prepare("DELETE FROM calendarios WHERE idcalendarios= :id ");
                $statement->bindParam(":id",$id);
                return ($statement->execute()) ? true : false;
            }

        //Método para hacer un INSERT en la BD, en la tabla "calendarios"
        public function insert($equipo_local, $equipo_visitante){
            $this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                //$sql = 'INSERT INTO equipos VALUES(null, :nombre, :nombre_capitan, :correo_capitan, :telefono_capitan, :logo, :torneo)';
                $sql = 'INSERT INTO calendarios (idcalendarios, fk_equipo_local, fk_equipo_visitante) VALUES(null, :equipo_local, :equipo_visitante)';
                //iniciamos declarando el statement y preparando la consulta
                $statement = $this->PDO->prepare($sql);
                //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                $statement->bindParam(":equipo_local", $equipo_local);
                $statement->bindParam(":equipo_visitante", $equipo_visitante);

                //Ejecutamos el statement mediante execute(). Valoraremos mediante un shorthand if lo que regresará este método 
                return($statement->execute()) ? $this->PDO->lastInsertId() : die("No se pudo agregar el partido");
            }   

            public function insertResultados($jugador, $torneo, $equipo, $calendario, $jornada, $triples, $dobles, $faltas){
                $this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                    //$sql = 'INSERT INTO equipos VALUES(null, :nombre, :nombre_capitan, :correo_capitan, :telefono_capitan, :logo, :torneo)';
                    $sql = 'UPDATE jugadores SET triples = triples + :triples, dobles = dobles +:dobles, faltas = faltas + :faltas WHERE idjugadores = :jugador';
                    //iniciamos declarando el statement y preparando la consulta
                    $statement = $this->PDO->prepare($sql);
                    //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                    $statement->bindParam(":triples", $triples, PDO::PARAM_INT);
                    $statement->bindParam(":dobles", $dobles, PDO::PARAM_INT);
                    $statement->bindParam(":faltas", $faltas, PDO::PARAM_INT);
                    $statement->bindParam(":jugador", $jugador, PDO::PARAM_INT);
                    $statement->execute();

                    $sql = 'INSERT INTO calendario_equipos_jugadores_torneo_jornada (id, fk_calendario, fk_equipo, fk_jugador, fk_torneo, jornada, triples, dobles, faltas) 
                    VALUES(null, :fk_calendario, :fk_equipo, :fk_jugador, :fk_torneo, :jornada, :triples, :dobles, :faltas)';
                    //iniciamos declarando el statement y preparando la consulta
                    $statement = $this->PDO->prepare($sql);
                    //Asociamos los valores colocados como placeholder en el query mediante el bindParam()
                    $statement->bindParam(":fk_calendario", $calendario);
                    $statement->bindParam(":fk_equipo", $equipo);
                    $statement->bindParam(":fk_jugador", $jugador);
                    $statement->bindParam(":fk_torneo", $torneo);
                    $statement->bindParam(":jornada", $jornada);
                    $statement->bindParam(":triples", $triples);
                    $statement->bindParam(":dobles", $dobles);
                    $statement->bindParam(":faltas", $faltas);
    
                    //Ejecutamos el statement mediante execute(). Valoraremos mediante un shorthand if lo que regresará este método 
                    return($statement->execute()) ? $this->PDO->lastInsertId() : die("No se pudo agregar el equipo");
                }   
            //El administrador creará el torneo y al usuario (organizador) por lo que al crear su password, buscaremos encriptarla por seguridad utilizando el método password_hash y password_Verify
          
    }
?>