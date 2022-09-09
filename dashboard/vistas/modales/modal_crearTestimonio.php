<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Crear Testimonio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" id="crear_testimonio" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Autor</label>
                <input 
                  class="form-control"
                  name="nombre_testimonio" 
                  type="text"
                  required 
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Ubicación</label>
                <input 
                  class="form-control"
                  name="ubicacion_testimonio" 
                  type="text"
                  required 
                >
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label">Imagen</label>
                <input 
                  class="form-control"
                  name="image_testimonio" 
                  type="file"
                  accept="image/*"
                  required
                >
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label">Descripción</label>
                <textarea 
                  class="form-control"
                  name="descripcion_testimonio" 
                  required 
                ></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" form="crear_testimonio" name="crear_testimonio">Guardar</button>
      </div>
    </div>
  </div>
</div>