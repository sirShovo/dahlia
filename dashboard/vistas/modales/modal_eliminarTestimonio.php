<div class="modal fade" id="deleteModal<?php echo($testimonio['id_testimonio']); ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">¿Estas seguro de que quieres eliminar este testimonio?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_testimonio" type="number" value="<?php echo($testimonio['id_testimonio']); ?>">
          <input type="submit" name="eliminar_testimonio" class="d-none" id="eliminar_testimonio<?php echo($testimonio['id_testimonio']); ?>">
        </form>
        <div class="text-center">
          <strong>Autor: </strong>
          <p><?php echo($testimonio['nombre_testimonio']); ?></p>
          <strong>Ubicación: </strong>                              
          <p>$<?php echo($testimonio['ubicacion_testimonio']); ?></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <label class="btn btn-danger" for="eliminar_testimonio<?php echo($testimonio['id_testimonio']); ?>">Eliminar</label>
      </div>
    </div>
  </div>
</div>