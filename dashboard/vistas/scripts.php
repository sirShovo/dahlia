<script src="<?php echo($RUTA); ?>/archivos/dashboard/js/core/popper.min.js"></script>
<script src="<?php echo($RUTA); ?>/archivos/dashboard/js/core/bootstrap.min.js"></script>
<script src="<?php echo($RUTA); ?>/archivos/dashboard/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?php echo($RUTA); ?>/archivos/dashboard/js/plugins/smooth-scrollbar.min.js"></script>
<script>
  var win = navigator.platform.indexOf("Win") > -1;
  if (win && document.querySelector("#sidenav-scrollbar")) {
    var options = {
      damping: "0.5",
    };
    Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
  }
</script>
<script src="<?php echo($RUTA); ?>/archivos/dashboard/js/argon-dashboard.min.js?v=2.0.4"></script>
<script src="<?php echo($RUTA); ?>/archivos/js/sweetalert2.all.min.js"></script>
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