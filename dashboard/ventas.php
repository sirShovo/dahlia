<?php 
  require_once('../control/funciones.php');
  llevar_al_login();
  $pagina_actual = "ventas";

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }

  $sentencia = $conexion->prepare("SELECT * FROM ventas 
    INNER JOIN usuarios ON ventas.id_usuario = usuarios.id_usuario
    INNER JOIN productos ON ventas.id_producto = productos.id_producto
    INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria
  ");
  $sentencia->execute();
  $ventas = $sentencia->fetchAll();

?>
<!DOCTYPE html>
<html lang="es">
<?php require_once('vistas/head.php'); ?>
<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <?php require_once('vistas/sidebar.php'); ?>
  <main class="main-content position-relative border-radius-lg">
    <?php require_once('vistas/navbar.php'); ?>
    <div class="container-fluid py-4">
      <div class="row">
      <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Lista de Ventas</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comprador</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Documento</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Producto</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Detalles</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($ventas as $venta): ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="<?php echo($RUTA); ?>/archivos/dashboard/img/<?php echo($venta['sexo_usuario']); ?>.png" class="avatar avatar-sm me-3" alt="user">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo($venta['nombre_usuario']); ?> <?php echo($venta['apellido_usuario']); ?></h6>
                              <p class="text-xs text-secondary mb-0"><?php echo($venta['correo_usuario']); ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo($venta['documento_usuario']); ?></h6>
                            <p class="text-xs text-secondary mb-0"><?php echo($venta['tipo_documento_usuario']); ?></p>
                          </div>
                        </td>
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
      </div>
      <?php require_once('vistas/footer.php'); ?>
    </div>
  </main>
  <?php require_once('vistas/scripts.php'); ?>
</body>
</html>
