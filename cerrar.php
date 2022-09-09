<?php 
  require_once('control/funciones.php');

  session_destroy();
  $_SESSION = array();

  if (isset($_GET['error'])) {
    header("Location: $RUTA/login.php?error=true");
  } else {
    header('Location: login.php');
  }
?>