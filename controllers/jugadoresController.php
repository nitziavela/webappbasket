<?php

    require_once('../../models/jugadoresModel.php');
    class jugadoresController{
        private $model;
        public function __construct(){
            $this->model = new jugadoresModel();
        }
        
        public function read(){
            return ($this->model->read()) ? $this->model->read() : false;
        }

        public function update($id,$nombre,$apellido1,$apellido2,$fechanac,$correo, $celular, $tipo_sangre,$fotografia, $equipo, $posicion){
             // Ruta donde se almacenará la imagen en el servidor
             $uploadDir = '../../img/jugadores/';

             // Generar un nombre único para el archivo
            if(isset($fotografia['name'])){
                 $uploadFile = $uploadDir . uniqid() . '_' . basename($fotografia['name']);

            if (move_uploaded_file($fotografia['tmp_name'], $uploadFile)) {
                $id = $this->model->update($id,$nombre,$apellido1,$apellido2,$fechanac,$correo, $celular, $tipo_sangre, $uploadFile, $equipo, $posicion);
            }
            } else{
                $id = $this->model->update($id,$nombre,$apellido1,$apellido2,$fechanac,$correo, $celular, $tipo_sangre, $fotografia, $equipo, $posicion);
            }

       return($id!=false) ? header('Location: consultarJugadores.php') : die ("Error al modificar el jugador");
        }

        public function delete($id){
            return ($this->model->delete($id)) ? header("Location: consultarJugadores.php") : die('Error al eliminar el jugador');
        }

        public function readOne($id){
            return ($this->model->readOne($id) != false) ? $this->model->readOne($id) : die('No se encontró el jugador');
        }

    }
?>