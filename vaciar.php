<?php 
  require_once('control/funciones.php');
  
  $cuenta_carrito = count($carrito) + 3;
  for ($i=0; $i <= $cuenta_carrito ; $i++) { 
    setcookie("carrito[$i]", '', time()-3600);
  }

  if(isset($_GET['compra'])) {
    header('Location: index.php?compra=true');
  } else {
    header('Location: index.php');
  }
?>