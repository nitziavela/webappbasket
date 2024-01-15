<?php

    require_once('../../models/calendarioModel.php');
    class calendarioController{
        private $model;
        public function __construct(){
            $this->model = new calendarioModel();
        }

        public function insert($equipo_local, $equipo_visitante){
            $id = $this->model->insert($equipo_local, $equipo_visitante);
            return ($id!=false) ? header('Location: consultarCalendarios.php') : die ("Error al agregar el Partido");
        }

        public function insertRol($jornadas, $torneo, $nombre){
            $id = $this->model->insertRol($jornadas, $torneo,  $nombre);
            return ($id!=false) ? header('Location: consultarRoles.php') : die ("Error al agregar el Rol");
        }

        public function insertResultados($jugador, $torneo, $equipo, $calendario, $jornada, $triples, $dobles, $faltas){
            $id = $this->model->insertResultados($jugador, $torneo, $equipo, $calendario, $jornada, $triples, $dobles, $faltas);
            return ($id!=false) ? header('Location: consultarCalendarios.php') : die ("Error al agregar los resultados");
        }
        
        public function read(){
            return ($this->model->read()) ? $this->model->read() : false;
        }

        public function readRoles(){
            return ($this->model->readRoles()) ? $this->model->readRoles() : false;
        }

        public function update($id, $equipo_visitante, $equipo_local, $fecha_hora, $sede, $tipo_juego, 
        $equipo_ganador, $razon_ganador, $marcador_visitante, $marcador_local, $jornada, $equipo_perdedor){
            return ($this->model->update($id, $equipo_visitante, $equipo_local, $fecha_hora, $sede, $tipo_juego, 
            $equipo_ganador, $razon_ganador, $marcador_visitante, $marcador_local, $jornada, $equipo_perdedor)) != false ? header("Location: consultarCalendarios.php") : die('Error al modificar el calendario');
        }

        public function updateRol($id, $jornadas, $torneo){
            return ($this->model->updateRol($id, $jornadas, $torneo)) != false ? header("Location: consultarRoles.php") : die('Error al modificar el rol');
        }

        public function delete($id){
            return ($this->model->delete($id)) ? header("Location: consultarCalendarios.php") : die('Error al eliminar el grupo');
        }

        public function deleteRol($id){
            return ($this->model->deleteRol($id)) ? header("Location: consultarRoles.php") : die('Error al eliminar el rol');
        }

        public function readOne($id){
            return ($this->model->readOne($id) != false) ? $this->model->readOne($id) : die('No se encontró el calendario');
        }

        public function readOneRol($id){
            return ($this->model->readOneRol($id) != false) ? $this->model->readOneRol($id) : die('No se encontró el rol');
        }

    }
?>