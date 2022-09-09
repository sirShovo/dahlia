<div class="modal fade" id="deleteModal<?php echo($categoria['id_categoria']); ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">¿Estas seguro de que quieres eliminar esta categoria?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
          <input type="hidden" name="id_categoria" value="<?php echo($categoria['id_categoria']); ?>">
          <input type="hidden" name="eliminar_categoria" value="true">
          <input type="submit" class="d-none" id="eliminar_categoria<?php echo($categoria['id_categoria']); ?>">
        </form>
        <div class="text-center">
          <strong>Categoría: </strong>
          <p><?php echo($categoria['nombre_categoria']); ?></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <label class="btn btn-danger" for="eliminar_categoria<?php echo($categoria['id_categoria']); ?>">Eliminar</label>
      </div>
    </div>
  </div>
</div>