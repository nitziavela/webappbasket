<?php

    require_once('../../models/sponsorModel.php');
    class sponsorController{
        private $model;
        public function __construct(){
            $this->model = new sponsorModel();
        }

        public function insert($nombre, $logo){
            // Ruta donde se almacenará la imagen en el servidor
            $uploadDir = '../../img/sponsors/';

            // Generar un nombre único para el archivo
            $uploadFile = $uploadDir . uniqid() . '_' . basename($logo['name']);

            if (move_uploaded_file($logo['tmp_name'], $uploadFile)) {
                $id = $this->model->insert($nombre, $uploadFile);
            }
            return ($id!=false) ? header('Location: consultarSponsors.php') : die ("Error al agregar el patrocinador");
        }
        
        public function read(){
            return ($this->model->read()) ? $this->model->read() : false;
        }

        public function update($id, $nombre, $logo){
             // Ruta donde se almacenará la imagen en el servidor
             $uploadDir = '../../img/equipos/';
             // Generar un nombre único para el archivo
             if(!empty(($logo['name']))){
                 $uploadFile = $uploadDir . uniqid() . '_' . basename($logo['name']);

                 if (move_uploaded_file($logo['tmp_name'], $uploadFile)) {
                    $id = $this->model->update($id, $nombre,$uploadFile);
                }
            } else{
                $id = $this->model->update($id, $nombre, $logo);
            }

       return($id!=false) ? header('Location: consultarSponsors.php') : die ("Error al modificar el patrocinador");
        }

        public function delete($id){
            return ($this->model->delete($id)) ? header("Location: consultarSponsors.php") : die('Error al eliminar el patrocinador');
        }

        public function readOne($id){
            return ($this->model->readOne($id) != false) ? $this->model->readOne($id) : die('No se encontró el patrocinador');
        }

    }
?>