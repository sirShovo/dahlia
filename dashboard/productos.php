<?php 
  require_once('../control/funciones.php');
  llevar_al_login();
  $pagina_actual = "productos";

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['crear_producto'])) {
        $image_producto = $_FILES['image_producto']['tmp_name']; //Temporal del archivo
        $subir_a = '../archivos/img/productos/' . $_FILES['image_producto']['name']; // Ruta a la que va el archivo
        
        if (move_uploaded_file($image_producto, $subir_a)) {// Subimos la imagen del producto a la carpeta de productos
          try {
            $setencia = $conexion->prepare("INSERT INTO productos VALUES (
              NULL,  
              '".$_POST['nombre_producto']."',
              '".$_FILES['image_producto']['name']."',
              '".$_POST['stock_producto']."',
              '".$_POST['id_categoria']."',
              '".$_POST['precio_producto']."',
              '".$_POST['descripcion_producto']."'
            )");
            $setencia->execute();
    
            $mensaje = "Producto creado correctamente";
          } catch (\Throwable $th) { $error = $th->getMessage(); } 
        } else {
          $error = "No se pudo subir la imagen, intenta de nuevo";
        }
    }
    if (isset($_POST['editar_producto'])) {
      if($_FILES['image_producto']['error'] == 0) {
        try {
          $image_producto = $_FILES['image_producto']['tmp_name']; //Temporal del archivo
          $subir_a = '../archivos/img/productos/' . $_FILES['image_producto']['name']; // Ruta a la que va el archivo
        
          if (move_uploaded_file($image_producto, $subir_a)) {// Subimos la imagen del producto a la carpeta de productos
            try {
              $setencia = $conexion->prepare("UPDATE productos 
                SET nombre_producto = '".$_POST['nombre_producto']."',
                  image_producto = '".$_FILES['image_producto']['name']."',
                  stock_producto = '".$_POST['stock_producto']."',
                  id_categoria = '".$_POST['id_categoria']."',
                  precio_producto = '".$_POST['precio_producto']."',
                  descripcion_producto = '".$_POST['descripcion_producto']."'
                WHERE id_producto = '".$_POST['id_producto']."'"
              );
              $setencia->execute();
              $mensaje = "Producto editado correctamente, la imagen también fué actualizada";
            } catch (\Throwable $th) { $error = $th->getMessage(); } 
          } else {
            $error = "No se pudo subir la imagen, intenta de nuevo";
          }
        } catch (\Throwable $th) {
          $error = $th->getMessage();
        }
      } else {
        try {
          $setencia = $conexion->prepare("UPDATE productos SET 
            nombre_producto = '".$_POST['nombre_producto']."',
            stock_producto = '".$_POST['stock_producto']."',
            id_categoria = '".$_POST['id_categoria']."',
            precio_producto = '".$_POST['precio_producto']."',
            descripcion_producto = '".$_POST['descripcion_producto']."'
            WHERE id_producto = '".$_POST['id_producto']."'"
          );
          $setencia->execute();
  
          $mensaje = "Producto editado correctamente";
        } catch (\Throwable $th) {
          $error = $th->getMessage();
        }
      }
    }
    if (isset($_POST['eliminar_producto'])) {
      try {
        $sentencia = $conexion->prepare("DELETE FROM productos WHERE id_producto = '".$_POST['id_producto']."' ");
        $sentencia->execute();

        $mensaje= "Producto eliminado de la base de datos";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }
  }

  $sentencia = $conexion->prepare("SELECT * FROM productos INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria");
  $sentencia->execute();
  $productos = $sentencia->fetchAll();

  $sentencia = $conexion->prepare("SELECT * FROM categorias");
  $sentencia->execute();
  $categorias = $sentencia->fetchAll();

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
        <div class="col-12 d-flex justify-content-end">
          <button class="btn btn-outline text-white"
            data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fa fa-plus" aria-hidden="true"></i> 
            Producto
          </button>
        </div>
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Lista de productos</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Detalles</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descripción</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Control</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($productos as $producto): ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="<?php echo($RUTA); ?>/archivos/img/productos/<?php echo($producto['image_producto']); ?>" class="avatar avatar-sm me-3" alt="producto">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo($producto['nombre_producto']); ?></h6>
                              <p class="text-xs text-secondary mb-0"><?php echo($producto['nombre_categoria']); ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><strong>Precio: </strong>$<?php echo($producto['precio_producto']); ?></p>
                          <p class="text-xs text-secondary mb-0"><strong>Stock: </strong><?php echo($producto['stock_producto']); ?></p>
                        </td>
                        <td class="text-sm text-truncate" style="max-width: 300px">
                          <p class="text-xs text-secondary mb-0 "><?php echo($producto['descripcion_producto']); ?></p>
                        </td>
                        <td class="align-middle text-center">
                          <a href="#" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editModal<?php echo($producto['id_producto']); ?>">
                            Editar
                          </a>
                          <a href="#" class="text-danger font-weight-bold text-xs ms-3" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo($producto['id_producto']); ?>">
                            Borrar
                          </a>
                        </td>
                      </tr>
                      
                      <?php include('vistas/modales/modal_eliminarProducto.php'); ?>
                      <?php include('vistas/modales/modal_editarProducto.php'); ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php require_once('vistas/modales/modal_crearProducto.php'); ?>
      <?php require_once('vistas/footer.php'); ?>
    </div>
  </main>
  <?php require_once('vistas/scripts.php'); ?>
</body>
</html>
