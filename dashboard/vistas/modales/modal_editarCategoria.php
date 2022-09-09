<div class="modal fade" id="editModal<?php echo($categoria['id_categoria']); ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
          <input type="hidden" name="id_categoria" value="<?php echo($categoria['id_categoria']); ?>">
          <input type="hidden" name="editar_categoria" value="true">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label">Nombre</label>
                <input 
                  value="<?php echo($categoria['nombre_categoria']); ?>"
                  class="form-control"
                  name="nombre_categoria" 
                  type="text"  
                  required 
                >
              </div>
            </div>
          </div>
          <input type="submit" class="d-none" id="editar_categoria<?php echo($categoria['id_categoria']); ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <label class="btn btn-primary" for="editar_categoria<?php echo($categoria['id_categoria']); ?>">Guardar</label>
      </div>
    </div>
  </div>
</div>