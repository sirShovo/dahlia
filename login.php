<?php 
  require_once('control/funciones.php');
  $login = true;

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }
  require_once('control/traer_categorias.php');
  
  if (isset($_SESSION['usuario']) && isset($_SESSION['tipo'])) { // Si ya hay una sesion activa, enviamos al index
    header('Location: index.php');
  }

  if (isset($_GET['error'])) {
    $error = "Se cerró la sesión por inactividad";
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Si se envian datos por el formulario
    $correo = limpiarDatos($_POST['correo']); // Limpiamos el correo
    $password = $_POST['password'];

    if (empty($correo) or empty($password)) { // Si esta vacio el formulario mostramos error
      $error = 'No pueden haber campos vacios';
    } else { // Sino, hacemos consulta a la base de datos
      $password = hash('sha512', $password);
      $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE correo_usuario = '$correo' AND password_usuario = '$password' LIMIT 1");
      $sentencia->execute();
      $resultado = $sentencia->fetch();

      if ($resultado != false) {
        $_SESSION['usuario'] = $resultado['id_usuario'];
        $_SESSION['tipo'] = $resultado['tipo_usuario'];
        $_SESSION['tiempo'] = time();

        if ($resultado['tipo_usuario']) {
          header('Location: dashboard/index.php');
        } else {
          header('Location: index.php');
        }
      } else {
        $error = 'Credenciales incorrectas, intenta de nuevo';
      
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once('vistas/head.php'); ?>
  
  <title>Dahlia - Clothes by Michelle | Iniciar Sesión</title>
</head>

<body>
  <?php require_once('vistas/siderbar.php'); ?>

  <div id="wrapper">
    <?php require_once('vistas/header.php'); ?>

    <div class="checkout_area section_padding_100">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="checkout_details_area mt-50 clearfix">
              <div class="cart-page-heading text-center">
                <h5>¡Iniciar al Cambio!</h5>
                <p>Ingresa tus credenciales <i class="fa fa-heart-o color-dark-pink" aria-hidden="true"></i></p>
              </div>

              <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
                <div class="row">
                  <div class="col-12 mb-3">
                    <label for="correo">Correo Electrónico <span>*</span></label>
                    <input
                      type="email"
                      class="form-control"
                      id="correo"
                      name="correo"
                      required
                    />
                  </div>
                  <p><?php if(isset($resultado)) {print_r($resultado);} ?></p>
                  <div class="col-12 mb-3">
                    <label for="password">Contraseña <span>*</span></label>
                    <input
                      type="password"
                      class="form-control"
                      id="password"
                      name="password"
                      required
                    />
                  </div>                  
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox d-block mb-2">
                      <input
                        type="checkbox"
                        class="custom-control-input"
                        id="terminos"
                        name="terminos"
                      />
                      <label class="custom-control-label custom-control-label-pink" for="terminos"
                        >Términos y Condiciones</label
                      >
                    </div>
                  </div>
                  <div class="col-md-6 text-right">
                    <a href="registro.php" class="btn btn-link">Aún no tengo cuenta :c</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <button type="submit" class="btn btn-pink w-100 mt-3">¡Quiero Entrar!</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php require_once('vistas/footer.php'); ?>
  </div>
  
  <?php require_once('vistas/scripts.php'); ?>
  <?php if(isset($error)): ?>
    <script>
      Swal.fire({
        title: '¡Noo!',
        text: '<?php echo($error); ?>',
        icon: 'error',
        confirmButtonText: 'Cerrar'
      })
    </script>
  <?php endif; ?>
</body>
</html>
