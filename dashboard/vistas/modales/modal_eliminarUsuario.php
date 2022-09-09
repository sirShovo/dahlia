<div class="modal fade" id="deleteModal<?php echo($usuario['id_usuario']); ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">¿Estas seguro de que quieres eliminar este usuario?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
          <input type="hidden" name="id" type="number" value="<?php echo($usuario['id_usuario']); ?>">
          <input type="hidden" name="eliminar_usuario" value="true">
          <input type="submit" class="d-none" id="eliminar_usuario<?php echo($usuario['id_usuario']); ?>">
        </form>
        <div class="text-center">
          <strong>Usuario: </strong>
          <p><?php echo($usuario['nombre_usuario']); ?> <?php echo($usuario['apellido_usuario']); ?></p>
          <strong>Correo: </strong>                              
          <p><?php echo($usuario['correo_usuario']); ?></p>
          <strong>Documento: </strong>
          <p><?php echo($usuario['documento_usuario']); ?></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <label class="btn btn-danger" for="eliminar_usuario<?php echo($usuario['id_usuario']); ?>">Eliminar</label>
      </div>
    </div>
  </div>
</div>