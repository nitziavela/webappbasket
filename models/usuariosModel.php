<?php
    require_once ('../../config/DataBase.php');

    class UsuarioModel {
        private $PDO;
        public function __construct() {
            $connection = new DataBase();
            $this->PDO = $connection -> connect();
        }

        public function agregarUsuario($nombre, $username, $password, $rol) {
            $sql = "INSERT INTO usuarios VALUES (null, :nombre, :username, :passwd, :rol)";
            $stmt = $this->PDO -> prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':passwd', $password);
            $stmt->bindParam(':rol', $rol);
            return($stmt->execute()) ? $this->PDO->lastInsertId() : die('Error al agregar el usuario.');
        }

        public function agregarJugador($id, $nombre) {
            $sql = "INSERT INTO jugadores (fk_usuario, nombre) VALUES (:id, :nombre)";
            $stmt = $this->PDO -> prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            return($stmt->execute()) ? $this->PDO->lastInsertId() : die('Error al agregar el jugador.');
        }
    
        public function eliminarUsuario($idUsuario) {
            $sql = "DELETE FROM usuarios WHERE idusuarios = :id";
            $stmt = $this->PDO -> prepare($sql);
            $stmt->bindParam(':id', $idUsuario);
            return ($stmt->execute()) ? true : false;
        }
    
        public function updateUsuario($id, $nombre, $username, $password, $rol) {
            $stmt = $this->PDO -> prepare ('UPDATE usuarios SET nombre = :nombre, username = :username, password = :password, 
            rol = :rol WHERE idusuarios = '.$id);
            $stmt -> bindParam(':nombre', $nombre);
            $stmt -> bindParam(':username', $username);
            $stmt -> bindParam(':password', $password);
            $stmt -> bindParam(':rol', $rol);
            return ($stmt->execute()) ? true : false;
        }
    
        public function consultarUsuarios() {
            $statement = $this->PDO->prepare("SELECT * FROM usuarios");
            return ($statement->execute()) ? $statement->fetchAll() : false;
        }

        public function consultarOrganizadores() {
            $statement = $this->PDO->prepare("SELECT * FROM usuarios WHERE rol = 'ORGANIZADOR' ");
            return ($statement->execute()) ? $statement->fetchAll() : false;
        }

        public function consultarUsuario($id) {
            $statement = $this->PDO->prepare("SELECT * FROM usuarios where idusuarios = :id limit 1");
            $statement->bindParam(':id', $id);
            return ($statement->execute()) ? $statement->fetchAll() : false;
        }
    }

?>