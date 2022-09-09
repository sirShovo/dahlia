<script src="<?php echo($RUTA); ?>/archivos/js/jquery/jquery-2.2.4.min.js"></script>
<script src="<?php echo($RUTA); ?>/archivos/js/popper.min.js"></script>
<script src="<?php echo($RUTA); ?>/archivos/js/bootstrap.min.js"></script>
<script src="<?php echo($RUTA); ?>/archivos/js/plugins.js"></script>
<script src="<?php echo($RUTA); ?>/archivos/js/active.js"></script>
<script src="<?php echo($RUTA); ?>/archivos/js/sweetalert2.all.min.js"></script>
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