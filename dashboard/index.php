<?php 
  require_once('../control/funciones.php');
  llevar_al_login();
  $pagina_actual = "index";

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['productos'])) {
      try {
        $setencia = $conexion->prepare("UPDATE configuraciones SET 
          valor_configuracion = '".$_POST['cantidad']."'
          WHERE id_configuracion = '1'
        ");
        $setencia->execute();

        $mensaje = "Configuracion editada correctamente";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }
    if (isset($_POST['testimonios'])) {
      try {
        $setencia = $conexion->prepare("UPDATE configuraciones SET 
          valor_configuracion = '".$_POST['cantidad']."'
          WHERE id_configuracion = '2'
        ");
        $setencia->execute();

        $mensaje = "Configuracion editada correctamente";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }
    if (isset($_POST['inactividad'])) {
      try {
        $setencia = $conexion->prepare("UPDATE configuraciones SET 
          valor_configuracion = '".$_POST['cantidad']."'
          WHERE id_configuracion = '3'
        ");
        $setencia->execute();

        $mensaje = "Configuracion editada correctamente";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }
  }

  // Total Ventas
  $sentencia = $conexion->prepare("SELECT COUNT(*), SUM(total_venta) FROM ventas");
  $sentencia->execute();
  $totalVentas = $sentencia->fetch();
  // Total Usuarios
  $sentencia = $conexion->prepare("SELECT COUNT(*) FROM usuarios");
  $sentencia->execute();
  $totalUsuarios = $sentencia->fetch();
  // Total Productos
  $sentencia = $conexion->prepare("SELECT COUNT(*) FROM productos");
  $sentencia->execute();
  $totalProductos = $sentencia->fetch();
  // Ultimos 5 productos
  $sentencia = $conexion->prepare("SELECT * FROM productos 
    INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria 
    ORDER BY id_producto DESC LIMIT 5
  ");
  $sentencia->execute();
  $ultimosProductos = $sentencia->fetchAll();
  // ultimas 5 ventas
  $sentencia = $conexion->prepare("SELECT * FROM ventas 
    INNER JOIN usuarios ON ventas.id_usuario = usuarios.id_usuario
    INNER JOIN productos ON ventas.id_producto = productos.id_producto
    ORDER BY id_venta DESC LIMIT 5
  ");
  $sentencia->execute();
  $ultimasVentas = $sentencia->fetchAll();
  
  // Cantidades (configuraciones)
  $sentencia = $conexion->prepare("SELECT * FROM configuraciones");
  $sentencia->execute();
  $configuraciones = $sentencia->fetchAll();

  if (!$configuraciones) {
    header("Location: $RUTA/error.php");
  }
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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                      Ventas
                    </p>
                    <h5 class="font-weight-bolder"><?php echo($totalVentas ? $totalVentas[0] : 0); ?></h5>
                    <p class="mb-0">En total</p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div
                    class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle"
                  >
                    <i
                      class="ni ni-money-coins text-lg opacity-10"
                      aria-hidden="true"
                    ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                      Usuarios
                    </p>
                    <h5 class="font-weight-bolder"><?php echo($totalUsuarios ? $totalUsuarios[0] : 0); ?></h5>
                    <p class="mb-0">Registrados</p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div
                    class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle"
                  >
                    <i
                      class="ni ni-world text-lg opacity-10"
                      aria-hidden="true"
                    ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                      Ganancias
                    </p>
                    <h5 class="font-weight-bolder"><?php echo($totalVentas[1] ? $totalVentas[1] : 0); ?></h5>
                    <p class="mb-0">Generales</p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div
                    class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle"
                  >
                    <i
                      class="ni ni-paper-diploma text-lg opacity-10"
                      aria-hidden="true"
                    ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                      Productos
                    </p>
                    <h5 class="font-weight-bolder"><?php echo($totalProductos ? $totalProductos[0] : 0); ?></h5>
                    <p class="mb-0">Ingresados</p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div
                    class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle"
                  >
                    <i
                      class="ni ni-cart text-lg opacity-10"
                      aria-hidden="true"
                    ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Productos por página</h6>
            </div>
            <div class="card-body p-3">
              <form action="" method="post" name="cantidad_productos">
                <div class="row d-flex align-items-end">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cantidad-p" class="form-control-label">Cantidad</label>
                      <input 
                        value="<?php echo($configuraciones[0]['valor_configuracion']); ?>"
                        class="form-control"
                        name="cantidad" 
                        id="cantidad-p" 
                        type="number" 
                        required 
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary w-100" name="productos">Guardar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Cantidad de testimonios</h6>
            </div>
            <div class="card-body p-3">
              <form action="" method="post" name="cantidad_testimonios">
                <div class="row d-flex align-items-end">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cantidad-t" class="form-control-label">Cantidad</label>
                      <input 
                        value="<?php echo($configuraciones[1]['valor_configuracion']); ?>"
                        class="form-control"
                        name="cantidad"
                        id="cantidad-t"
                        type="number" 
                        required 
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary w-100" name="testimonios">Guardar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Tiempo de inactividad</h6>
            </div>
            <div class="card-body p-3">
              <form action="" method="post" name="cantidad_productos">
                <div class="row d-flex align-items-end">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cantidad-p" class="form-control-label">Minutos</label>
                      <input 
                        value="<?php echo($configuraciones[2]['valor_configuracion']); ?>"
                        class="form-control"
                        name="cantidad" 
                        id="cantidad-p" 
                        type="number" 
                        required 
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary w-100" name="inactividad">Guardar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">Últimas Ventas</h6>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center">
                <tbody>
                  <tr>
                    <?php foreach($ultimasVentas as $venta): ?>
                    <td class="w-30">
                      <div class="ms-4">
                        <p class="text-xs font-weight-bold mb-0">
                          Usuario:
                        </p>
                        <h6 class="text-sm mb-0"><?php echo($venta['nombre_usuario']) ?> <?php echo($venta['apellido_usuario']) ?></h6>
                      </div>
                    </td>
                    <td>
                      <div class="text-center">
                        <p class="text-xs font-weight-bold mb-0">Producto:</p>
                        <h6 class="text-sm mb-0"><?php echo($venta['nombre_producto']) ?></h6>
                      </div>
                    </td>
                    <td>
                      <div class="text-center">
                        <p class="text-xs font-weight-bold mb-0">Valor:</p>
                        <h6 class="text-sm mb-0">$<?php echo($venta['precio_producto']) ?></h6>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">Últimos Productos</h6>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center">
                <tbody>
                  <?php foreach($ultimosProductos as $producto): ?>
                    <tr>
                      <td class="w-30">
                        <div class="ms-4">
                          <p class="text-xs font-weight-bold mb-0">
                            Producto:
                          </p>
                          <h6 class="text-sm mb-0"><?php echo($producto['nombre_producto']); ?></h6>
                        </div>
                      </td>
                      <td>
                        <div class="text-center">
                          <p class="text-xs font-weight-bold mb-0">Categoría:</p>
                          <h6 class="text-sm mb-0"><?php echo($producto['nombre_categoria']); ?></h6>
                        </div>
                      </td>
                      <td>
                        <div class="text-center">
                          <p class="text-xs font-weight-bold mb-0">Valor:</p>
                          <h6 class="text-sm mb-0">$<?php echo($producto['precio_producto']); ?></h6>
                        </div>
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
  </main>
  <?php require_once('vistas/scripts.php'); ?>
</body>
</html>
