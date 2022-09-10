<?php 
  require_once('control/funciones.php'); 

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }
  require_once('control/traer_categorias.php');

  if (isset($_SESSION['usuario']) && isset($_SESSION['tipo'])) { // Si ya hay una sesion activa, enviamos al index
    header('Location: index.php');
  }

  if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Si se envian datos por el formulario
    $tipo_documento = limpiarDatos($_POST['tipo_documento']); 
    $apellidos = limpiarDatos($_POST['apellidos']); 
    $documento = limpiarDatos($_POST['documento']); 
    $nombres = limpiarDatos($_POST['nombres']); // Limpiamos el correo
    $correo = limpiarDatos($_POST['correo']); 
    $sexo = limpiarDatos($_POST['sexo']); 
    $password2 = $_POST['password-2'];
    $password = $_POST['password'];

    if ($password !== $password2) { // Si las contraseñas no son las mismas mostramos el error
      $error = 'Las contraseñas no son las mismas.';
    } else { // Sino, hacemos consulta a la base de datos
      $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE correo_usuario = '$correo' OR documento_usuario = '$documento' LIMIT 1");
      $sentencia->execute(); // Validar que el correo o el documento no existan en la base datos
      $resultado = $sentencia->fetch();
      
      if ($resultado != false) {
        $error = 'Correo o documento ya registrados, intenta de nuevo';
      } else {
        $password2 = hash('sha512', $password2);
        $sentencia = $conexion->prepare("INSERT INTO usuarios VALUES (NULL, '$nombres', '$apellidos', '$sexo', '$tipo_documento', '$documento', '$correo',  '$password2', 0, NULL)");
        $sentencia->execute();
        $resultadoRegistro = $sentencia->fetch();
        $mensaje = 'Te has registrado, ahora es tiempo de ingresar al cambio';
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once('vistas/head.php'); ?>

  <title>Dahlia - Clothes by Michelle | Registro</title>
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
                <h5>¡Quiero Registrarme!</h5>
                <p>Ingresa toda la información, porfis</p>
              </div>
              <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="nombres">Nombres <span>*</span></label>
                    <input
                      type="text"
                      class="form-control"
                      id="nombres"
                      name="nombres"
                      required
                    />
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="apellidos">Apellidos <span>*</span></label>
                    <input
                      type="text"
                      class="form-control"
                      id="apellidos"
                      name="apellidos"
                      required
                    />
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="tipo_documento">Tipo de Documento <span>*</span></label>
                    <select
                      class="form-control"
                      id="tipo_documento"
                      name="tipo_documento"
                      style="height: 52px;"
                      required
                    >
                      <option value="" hidden></option>
                      <option value="cédula de ciudadanía">Cédula de Ciudadanía</option>
                      <option value="tarjeta de identidad">Tarjeta de Identidad</option>
                      <option value="otro">Otro</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="documento">Documento <span>*</span></label>
                    <input
                      type="number"
                      class="form-control"
                      id="documento"
                      name="documento"
                      required
                    />
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="sexo">Sexo <span>*</span></label>
                    <select
                      class="form-control"
                      id="sexo"
                      name="sexo"
                      style="height: 52px;"
                      required
                    >
                      <option value="" hidden></option>
                      <option value="mujer">Mujer</option>
                      <option value="hombre">Hombre</option>
                      <option value="otro">Otro</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="correo">Correo Electrónico<span>*</span></label>
                    <input
                      type="email"
                      class="form-control"
                      id="correo"
                      name="correo"
                      required
                    />
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="password">Contraseña <span>*</span></label>
                    <input
                      type="password"
                      class="form-control"
                      id="password"
                      name="password"
                      required
                    />
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="password-2">Repetir Contraseña<span>*</span></label>
                    <input
                      type="password"
                      class="form-control"
                      id="password-2"
                      name="password-2"
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
                    <a href="login.php" class="btn btn-link">Ya tengo una cuenta :3</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <button type="submit" class="btn btn-pink w-100 mt-3">¡Registrarme!</button>
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
  <?php if(isset($mensaje)): ?>
    <script>
      Swal.fire({
        title: '¡Bien!',
        text: '<?php echo($mensaje); ?>',
        type: 'success',
        icon: 'success',
        confirmButtonText: 'Ingresar'
      }).then(function() {
        window.location = "login.php";
      });
    </script>
  <?php endif; ?>
  <?php if(isset($error)): ?>
    <script>
      Swal.fire({
        title: '¡Error!',
        text: '<?php echo($error); ?>',
        icon: 'error',
        confirmButtonText: 'Cerrar'
      })
    </script>
  <?php endif; ?>
</body>
</html>
