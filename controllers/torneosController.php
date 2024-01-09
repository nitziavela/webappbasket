<?php
    require_once("../../models/torneosModel.php");
    class torneosController{
        private $model;
        public function __construct(){
            $this->model = new torneosModel();
        }
        public function saveTorneo($nombreTorneo,$organizador, $sede, $categoria, 
        $premio1, $premio2, $premio3, $otroPremio, $usuario, $contrasena){
            $id = $this->model->insert($nombreTorneo,$organizador, $sede, $categoria, 
            $premio1, $premio2, $premio3, $otroPremio, $usuario, $contrasena);
            return($id!=false) ? header("Location: readAllTorneos.php") : die("Error al crear el torneo.");
        }

        public function saveSponsorsTorneo($nombreTorneo,$patrocinador, $usuario, $contrasena, $organizador){
            $id = $this->model->insertST($nombreTorneo,$patrocinador, $usuario, $contrasena, $organizador);
        }

        public function readTorneos(){
            return ($this->model->read()) ? $this->model->read() : false;
        }
        public function readOneTorneo($id){
            return ($this->model->readOne($id) != false) ? $this->model->readOne($id) : header("Location: readAllTorneos.php");
        }
        public function updateTorneo($id, $nombreTorneo, $sede, $categoria, 
        $premio1, $premio2, $premio3, $otroPremio){
            return ($this->model->update($id,$nombreTorneo, $sede,$categoria,$premio1,$premio2,$premio3,
            $otroPremio)) != false ? header("Location: readOneTorneo.php?id=".$id) : header("Location: readAllTorneos.php");
        }
        public function delete($id){
            $this->model->deleteAll($id);

            return ($this->model->delete($id)) ? header("Location: readAllTorneos.php") 
            : header("Location: readOneTorneo.php?id=".$id);
        }
    }
?>