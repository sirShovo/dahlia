<?php 
  require_once('../control/funciones.php');
  llevar_al_login();
  $pagina_actual = "testimonios";

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['crear_testimonio'])) {
      $image_testimonio = $_FILES['image_testimonio']['tmp_name']; //Temporal del archivo
      $subir_a = '../archivos/img/testimonios/' . $_FILES['image_testimonio']['name']; // Ruta a la que va el archivo
      if (move_uploaded_file($image_testimonio, $subir_a)) {// Subimos la imagen del testimonio a la carpeta de testimonios
        try {
          $setencia = $conexion->prepare("INSERT INTO testimonios VALUES (
            NULL,  
            '".$_POST['descripcion_testimonio']."',
            '".$_FILES['image_testimonio']['name']."',
            '".$_POST['nombre_testimonio']."',
            '".$_POST['ubicacion_testimonio']."'
          )");
          $setencia->execute();
  
          $mensaje = "Testimonio creado correctamente";
        } catch (\Throwable $th) { $error = $th->getMessage(); } 
      } else {
        $error = "No se pudo subir la imagen, intenta de nuevo";
      }
    }
    if (isset($_POST['editar_testimonio'])) {
      if ($_FILES['image_testimonio']['error'] == 0) { // Si envian la imagen por el editar, la va a actualizar
        $image_testimonio = $_FILES['image_testimonio']['tmp_name']; //Temporal del archivo
        $subir_a = '../archivos/img/testimonios/' . $_FILES['image_testimonio']['name']; // Ruta a la que va el archivo
        if (move_uploaded_file($image_testimonio, $subir_a)) {// Subimos la imagen del testimonio a la carpeta de testimonios
          try { //Intentamos la consulta para actualizar
            $setencia = $conexion->prepare("UPDATE testimonios SET  
              descripcion_testimonio = '".$_POST['descripcion_testimonio']."',
              image_testimonio = '".$_FILES['image_testimonio']['name']."',
              nombre_testimonio = '".$_POST['nombre_testimonio']."',
              ubicacion_testimonio = '".$_POST['ubicacion_testimonio']."'
              WHERE id_testimonio = '".$_POST['id_testimonio']."'
            "); // Preparamos la consulta SQL que hara los cambios en la DB
            $setencia->execute(); // Ejecutamos la consulta
    
            $mensaje = "Testimonio creado correctamente, la imagen también fué actualizada"; // Si no hay errores, mostramos mensaje
          } catch (\Throwable $th) { $error = $th->getMessage(); } // Si hay errores, se muestran 
        } else {
          $error = "No se pudo subir la imagen, intenta de nuevo"; // Si el archivo no pudo subirse al servidor, mostramos el error
        }
      } else { // Actualizamos testimonio sin imagen
        try {
          $setencia = $conexion->prepare("UPDATE testimonios SET  
            descripcion_testimonio = '".$_POST['descripcion_testimonio']."',
            nombre_testimonio = '".$_POST['nombre_testimonio']."',
            ubicacion_testimonio = '".$_POST['ubicacion_testimonio']."'
            WHERE id_testimonio = '".$_POST['id_testimonio']."'
          ");
          $setencia->execute();
  
          $mensaje = "Testimonio editado correctamente";
        } catch (\Throwable $th) {
          $error = $th->getMessage();
        }
      }
    }
    if (isset($_POST['eliminar_testimonio'])) {
      try {
        $sentencia = $conexion->prepare("DELETE FROM testimonios WHERE id_testimonio = '".$_POST['id_testimonio']."' ");
        $sentencia->execute();

        $mensaje= "Testimonio eliminado de la base de datos";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }
  }

  $sentencia = $conexion->prepare("SELECT * FROM testimonios");
  $sentencia->execute();
  $testimonios = $sentencia->fetchAll();

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
            Testimonio
          </button>
        </div>
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Lista de Testimonios</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Autor</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descripción</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Control</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($testimonios as $testimonio): ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="<?php echo($RUTA); ?>/archivos/img/testimonios/<?php echo($testimonio['image_testimonio']); ?>" class="avatar avatar-sm me-3" alt="testimonio">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo($testimonio['nombre_testimonio']); ?></h6>
                              <p class="text-xs text-secondary mb-0"><?php echo($testimonio['ubicacion_testimonio']); ?></p>
                            </div>
                          </div>
                        </td>
                        <td class="text-sm text-truncate" style="max-width: 300px">
                          <p class="text-xs text-secondary mb-0 "><?php echo($testimonio['descripcion_testimonio']); ?></p>
                        </td>
                        <td class="align-middle text-center">
                          <a href="#" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editModal<?php echo($testimonio['id_testimonio']); ?>">
                            Editar
                          </a>
                          <a href="#" class="text-danger font-weight-bold text-xs ms-3" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo($testimonio['id_testimonio']); ?>">
                            Borrar
                          </a>
                        </td>
                      </tr>
                      
                      <?php include('vistas/modales/modal_editarTestimonio.php'); ?>
                      <?php include('vistas/modales/modal_eliminarTestimonio.php'); ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php require_once('vistas/modales/modal_crearTestimonio.php'); ?>
      <?php require_once('vistas/footer.php'); ?>
    </div>
  </main>
  <?php require_once('vistas/scripts.php'); ?>
</body>
</html>
