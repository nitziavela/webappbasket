<?php

    require_once('../../models/usuariosModel.php');
    class usuarioController{
        private $model;
        public function __construct(){
            $this->model = new UsuarioModel();
        }

        public function agregarUsuario($nombre, $username, $password, $rol){
            $id = $this->model->agregarUsuario($nombre, $username, $password, $rol);
            return ($id!=false) ? header('Location: consultarUsuarios.php') : header('Location: consultarUsuarios.php');
        }
        
        public function consultarUsuarios(){
            return ($this->model->consultarUsuarios()) ? $this->model->consultarUsuarios() : false;
        }

        public function consultarOrganizadores(){
            return ($this->model->consultarOrganizadores()) ? $this->model->consultarOrganizadores() : false;
        }

        public function updateUsuario($id, $nombre, $username, $password, $rol){
            return ($this->model->updateUsuario($id, $nombre, $username, $password, $rol)) != false ? header("Location: consultarUsuarios.php") : die('Error al eliminar el usuario');
        }

        public function eliminarUsuario($id){
            return ($this->model->eliminarUsuario($id)) ? header("Location: consultarUsuarios.php") : die('Error al eliminar el usuario');
        }

        public function consultarUsuario($id){
            return ($this->model->consultarUsuario($id) != false) ? $this->model->consultarUsuario($id) : die('No se encontró el usuario');
        }

    }
?>