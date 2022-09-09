<?php
  session_start(); // Trabajamos con sesiones
  $RUTA = 'http://localhost/pages/dahlia';
  $login = false;

  function conexion() {
    try { // nos intentamos conectar a la base de datos
      $conexion = new PDO(
        'mysql:host=localhost; dbname=dahlia',
        'root', // usuario para conectarse a la base de datos
        '' // contraseña para conectarse a la base de datos (por defecto, viene vacia)
      );
      return $conexion;

    } catch (PDOException $e) { // si la conexion falla devolvemos false
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  function limpiarDatos($datos) { // Esta funcion nos sirve para limpiar los datos que ingresamos a los formularios
    $datos = trim($datos); // Quita los espacios al principio y al final
    $datos = stripcslashes($datos); // Elimina los backslash (evita la navegacion por carpetas)
    $datos = htmlspecialchars($datos); // Quita las etiquetas que se puedan inyectar en los formularios
    return $datos;
  }

  function salto_actual() {
    return isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Si se pasa la pagina por la url la devuelve, sino es 0
  }

  function pagina_actual($pagina, $pagina_actual) { // Validar si estamos en la pagina actual para mostrar un active
    if ($pagina_actual == $pagina) {
      echo('active');
    }
  }

  function llevar_al_login() {
    if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) || ($_SESSION['tipo'] != 1)) { // Si ya hay una sesion activa, enviamos al index
      global $RUTA;
      header("Location: $RUTA/login.php");
    }
  }

  $carrito = array();
  if (isset($_COOKIE['carrito'])) {
    $carrito = $_COOKIE['carrito'];
  }

  $info_carrito = array();
  $total_carrito = 0;
  foreach ($carrito as $item) {
    array_push($info_carrito, json_decode($item));
  }
    
  function fecha($fecha){
    $timestamp = strtotime($fecha);
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
  
    $dia = date('d', $timestamp);
  
    // -1 porque los meses en la funcion date empiezan desde el 1
    $mes = date('m', $timestamp) - 1;
    $year = date('Y', $timestamp);
  
    $fecha = $dia . ' de ' . $meses[$mes] . ' del ' . $year;
    return $fecha;
  }
  
  function inactividad() {
    $conexion = conexion();
    $sentencia = $conexion->prepare("SELECT valor_configuracion FROM configuraciones WHERE id_configuracion = 3");
    $sentencia->execute();
    $respuesta = $sentencia->fetch();
    $tiempo = $respuesta[0] * 60; 

    if (time() - $_SESSION['tiempo'] >= $tiempo) {
      global $RUTA;
      header("Location: $RUTA/cerrar.php?error=true");
    }
    $_SESSION['tiempo'] = time();
  }

  if (isset($_SESSION['usuario'])) {
    inactividad();
  }

?>