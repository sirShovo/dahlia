<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Crear Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" id="crear_categoria" enctype="multipart/form-data">
          <div class="row">
            <div class="form-group">
              <label for="nombre_categoria" class="form-control-label">Nombre</label>
              <input 
                class="form-control"
                id="nombre_categoria" 
                name="nombre_categoria" 
                type="text"
                required 
              >
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" name="crear_categoria" class="btn btn-primary" form="crear_categoria">Guardar</button>
      </div>
    </div>
  </div>
</div>