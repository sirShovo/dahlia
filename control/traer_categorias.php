<?php 
  $sentencia = $conexion->prepare("SELECT * FROM categorias");
  $sentencia->execute();
  $categorias = $sentencia->fetchAll();
?>