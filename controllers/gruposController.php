<?php

    require_once('../../models/gruposModel.php');
    class grupoController{
        private $model;
        public function __construct(){
            $this->model = new gruposModel();
        }

        public function insert($nombre, $categoria, $torneo){
            $id = $this->model->insert($nombre, $categoria, $torneo);
            return ($id!=false) ? header('Location: consultarGrupos.php') : die ("Error al agregar el Grupo");
        }
        
        public function read(){
            return ($this->model->read()) ? $this->model->read() : false;
        }

        public function update($id, $nombre, $categoria){
            return ($this->model->update($id, $nombre, $categoria)) != false ? header("Location: consultarGrupos.php") : die('Error al modificar el grupo');
        }

        public function delete($id){
            return ($this->model->delete($id)) ? header("Location: consultarGrupos.php") : die('Error al eliminar el grupo');
        }

        public function readOne($id){
            return ($this->model->readOne($id) != false) ? $this->model->readOne($id) : die('No se encontró el grupo');
        }

    }
?>