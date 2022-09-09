<?php 
  require_once('../control/funciones.php');
  llevar_al_login();
  $pagina_actual = "categorias";

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['crear_categoria'])) {
      try {
        $sentencia = $conexion->prepare("INSERT INTO categorias VALUES (
          NULL,
          '".$_POST['nombre_categoria']."'
        )");
        $sentencia->execute();

        $mensaje = "Categoría creada correctamente";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }
    if (isset($_POST['editar_categoria'])) {
      try {
        $sentencia = $conexion->prepare("UPDATE categorias SET 
          nombre_categoria = '".$_POST['nombre_categoria']."' 
          WHERE id_categoria = '".$_POST['id_categoria']."'
        ");
        $sentencia->execute();

        $mensaje = "Categoría editada correctamente";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }
    if (isset($_POST['eliminar_categoria'])) {
      try {
        $sentencia = $conexion->prepare("DELETE FROM categorias WHERE id_categoria = '".$_POST['id_categoria']."'");
        $sentencia->execute();

        $mensaje = "Categoría eliminada de la base de datos";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }
    
  }

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
            Categoría
          </button>
        </div>
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Lista de Categorías</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Control</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                      <tr>
                        <td class="align-middle">
                          <p class="text-xs text-secondary mb-0 ms-3"><?php echo($categoria['id_categoria']); ?></p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?php echo($categoria['nombre_categoria']); ?></p>
                        </td>
                        <td class="align-middle text-center">
                          <a href="#" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editModal<?php echo($categoria['id_categoria']); ?>">
                            Editar
                          </a>
                          <a href="#" class="text-danger font-weight-bold text-xs ms-3" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo($categoria['id_categoria']); ?>">
                            Borrar
                          </a>
                        </td>
                      </tr>
                      <?php include('vistas/modales/modal_editarCategoria.php'); ?>
                      <?php include('vistas/modales/modal_eliminarCategoria.php'); ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php require_once('vistas/modales/modal_crearCategoria.php'); ?>
      <?php require_once('vistas/footer.php'); ?>
    </div>
  </main>
  <?php require_once('vistas/scripts.php'); ?>
</body>
</html>
