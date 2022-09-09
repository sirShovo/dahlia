<?php 
  require_once('control/funciones.php');

  if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])) { // Si ya hay una sesion activa, enviamos al index
    header("Location: $RUTA/login.php");
  }

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_SESSION['usuario'];

    if ($_POST['password'] != $_POST['password2']) {
      $error = "Las contraseñas no coinciden";
    } else {
      try {
        $sentencia = $conexion->prepare("UPDATE usuarios SET
          password_usuario = '".$_POST['password']."'
          WHERE id_usuario = '".$_SESSION['usuario']."' 
        ");
        $sentencia->execute();

        $mensaje= "Su contraseña se actualizo correctamente";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }    
  }

  $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = '".$_SESSION['usuario']."'");
  $sentencia->execute();
  $usuario = $sentencia->fetch();

  $sentencia = $conexion->prepare("SELECT * FROM ventas 
    INNER JOIN usuarios ON ventas.id_usuario = usuarios.id_usuario
    INNER JOIN productos ON ventas.id_producto = productos.id_producto
    INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria
    WHERE ventas.id_usuario = '".$_SESSION['usuario']."'
  ");
  $sentencia->execute();
  $ventas = $sentencia->fetchAll();

  require_once('control/traer_categorias.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once('vistas/head.php'); ?>
  <title>Dahlia - Clothes by Michelle | Cuenta</title>
</head>
<body>
  <?php require_once('vistas/siderbar.php'); ?>
  <div id="wrapper">
    <?php require_once('vistas/header.php'); ?>
    <div class="cart_area section_padding_100 clearfix">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="checkout_details_area mt-50 clearfix">
              <div class="cart-page-heading text-center">
                <h5>¡Mi información!</h5>
                <p>Solo puedes cambiar la contraseña, los demas datos solo los cambia el admin</p>
              </div>
              <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label">Nombre</label>
                      <input 
                        value="<?php echo($usuario['nombre_usuario']); ?>"
                        class="form-control"
                        disabled 
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label">Apellido</label>
                      <input 
                        value="<?php echo($usuario['apellido_usuario']); ?>"
                        class="form-control" 
                        disabled 
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label">Sexo</label>
                      <input 
                        value="<?php echo($usuario['sexo_usuario']); ?>"
                        class="form-control"  
                        disabled 
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label">Tipo de Documento</label>
                      <input 
                        value="<?php echo($usuario['tipo_documento_usuario']); ?>"
                        class="form-control"
                        disabled 
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label">Documento</label>
                      <input 
                        value="<?php echo($usuario['documento_usuario']); ?>"
                        class="form-control"
                        disabled
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label">Correo Electrónico</label>
                      <input 
                        value="<?php echo($usuario['correo_usuario']); ?>"
                        class="form-control"
                        disabled
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label">Contraseña</label>
                      <input 
                        class="form-control"
                        name="password" 
                        type="text"
                        required
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label">Repetir Contraseña</label>
                      <input 
                        class="form-control"
                        name="password2" 
                        type="text"
                        required
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <button type="submit" class="btn btn-pink w-100 mt-3">Cambiar contraseña</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-12 mt-5">
            <div class="cart-page-heading text-center">
              <h5>¡Mis Ventas!</h5>
              <p>Historial de tus ventas</p>
            </div>
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Producto</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Detalles</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($ventas as $venta): ?>
                  <tr>
                    <td>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm"><?php echo($venta['nombre_producto']); ?></h6>
                        <p class="text-xs text-secondary mb-0"><?php echo($venta['nombre_categoria']); ?> - $<?php echo($venta['precio_producto']); ?></p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">$<?php echo($venta['total_venta']); ?></h6>
                        <p class="text-xs text-secondary mb-0">Cantidad: <?php echo($venta['cantidad']); ?></p>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0"><?php echo(fecha($venta['fecha_venta'])); ?></p>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
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
        confirmButtonText: 'Cerrar'
      })
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
