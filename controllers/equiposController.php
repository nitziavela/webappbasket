<?php

    require_once('../../models/equiposModel.php');
    class equiposController{
        private $model;
        public function __construct(){
            $this->model = new equiposModel();
        }

        public function insert($nombre, $nombre_capitan, $correo_capitan, $telefono_capitan, $logo, $torneo){
             // Ruta donde se almacenará la imagen en el servidor
             $uploadDir = '../../img/equipos/';

             // Generar un nombre único para el archivo
             $uploadFile = $uploadDir . uniqid() . '_' . basename($logo['name']);
 
            if (move_uploaded_file($logo['tmp_name'], $uploadFile)) {
                $id = $this->model->insert($nombre, $nombre_capitan, $correo_capitan, $telefono_capitan, $uploadFile, $torneo);
            } 
            return ($id!=false) ? header('Location: consultarEquipos.php') : die ("Error al agregar el Equipo");
        }
        
        public function read(){
            return ($this->model->read()) ? $this->model->read() : false;
        }

        public function update($id, $nombre, $nombre_capitan, $correo_capitan, $telefono_capitan, $logo, $torneo){
                // Ruta donde se almacenará la imagen en el servidor
                $uploadDir = '../../img/equipos/';
                // Generar un nombre único para el archivo
                if(isset($logo['name'])){
                    $uploadFile = $uploadDir . uniqid() . '_' . basename($logo['name']);

                    if (move_uploaded_file($logo['tmp_name'], $uploadFile)) {
                        $id = $this->model->update($id, $nombre, $nombre_capitan, $correo_capitan, $telefono_capitan, $uploadFile, $torneo);
                    }
                } else{
                    $id = $this->model->update($id, $nombre, $nombre_capitan, $correo_capitan, $telefono_capitan, $logo, $torneo);
                }

           return($id!=false) ? header('Location: consultarEquipos.php') : die ("Error al modificar el Equipo");
        }

        public function delete($id){
            return ($this->model->delete($id)) ? header("Location: consultarEquipos.php") : die('Error al eliminar el Equipo');
        }

        public function readOne($id){
            return ($this->model->readOne($id) != false) ? $this->model->readOne($id) : die('No se encontró el equipo');
        } 
        
        public function readTeamsPlayers($id, $calendario){
            return ($this->model->readTeamsPlayers($id, $calendario) != false) ? $this->model->readTeamsPlayers($id, $calendario) : die('No se encontró el equipo');
        }

    }
?>