<?php 
  require_once('../control/funciones.php');
  llevar_al_login();
  $pagina_actual = "usuarios";

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['editar_usuario'])) {
      $password = hash('sha512', $_POST['password']);
      
      try {
        $sentencia = $conexion->prepare("UPDATE usuarios SET
          nombre_usuario = '".$_POST['nombre']."', 
          apellido_usuario = '".$_POST['apellido']."', 
          sexo_usuario = '".$_POST['sexo']."', 
          tipo_documento_usuario = '".$_POST['tipo_documento']."', 
          documento_usuario = '".$_POST['documento']."', 
          correo_usuario = '".$_POST['correo']."', 
          password_usuario = '".$password."', 
          tipo_usuario = '".$_POST['tipo']."', 
          creado_usuario = '".$_POST['creado']."' 
          WHERE id_usuario = '".$_POST['id']."' ");
        $sentencia->execute();

        $mensaje= "Usuario editado correctamente";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    } 
    if (isset($_POST['eliminar_usuario'])) {
      try {
        $sentencia = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = '".$_POST['id']."' ");
        $sentencia->execute();

        $mensaje= "Usuario eliminado de la base de datos";
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }
  }

  $sentencia = $conexion->prepare("SELECT * FROM usuarios");
  $sentencia->execute();
  $usuarios = $sentencia->fetchAll();

  if (!$usuarios) {
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
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Lista de usuarios</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Documento</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registro</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Control</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="<?php echo($RUTA); ?>/archivos/dashboard/img/<?php echo($usuario['sexo_usuario']); ?>.png" class="avatar avatar-sm me-3" alt="user">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo($usuario['nombre_usuario']); ?> <?php echo($usuario['apellido_usuario']); ?></h6>
                              <p class="text-xs text-secondary mb-0"><?php echo($usuario['correo_usuario']); ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?php echo($usuario['documento_usuario']); ?></p>
                          <p class="text-xs text-secondary mb-0"><?php echo(ucwords($usuario['tipo_documento_usuario'])); ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <?php if($usuario['tipo_usuario']): ?>
                          <span class="badge badge-sm bg-gradient-success">Admin</span>
                          <?php else: ?>
                            <span class="badge badge-sm bg-gradient-warning">Usuario</span>
                        <?php endif; ?>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold"><?php echo(fecha($usuario['creado_usuario'])); ?></span>
                        </td>
                        <td class="align-middle text-center">
                          <a href="#" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editModal<?php echo($usuario['id_usuario']); ?>">
                            Editar
                          </a>
                          <a href="#" class="text-danger font-weight-bold text-xs ms-3" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo($usuario['id_usuario']); ?>">
                            Borrar
                          </a>
                        </td>
                      </tr>
                      <?php include('vistas/modales/modal_editarUsuario.php'); ?>
                      <?php include('vistas/modales/modal_eliminarUsuario.php'); ?>
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
