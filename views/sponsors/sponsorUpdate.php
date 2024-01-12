<?php
    require_once("../../controllers/sponsorController.php");

    $objController = new sponsorController();

    $id = $_POST['idSponsor'];
    $nombre = $_POST['nombre'];
    if(!empty($_FILES['logo']['name'])){  
        $logo = $_FILES['logo'];
    } else{
        $logo = $_POST['nombre_logo'];
    }

    $objController->update($id,$nombre,$logo);
?>