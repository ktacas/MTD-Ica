<?php 
        require '../config/Conexion_MTD.php';

        $id=$_REQUEST['ID_titulo'];
        $query = "SELECT * FROM `tbeventos` WHERE ID_titulo='$id'";
        
        $resultado= $conexion->query($query);
        
        $row = $resultado->fetch_assoc();
?>