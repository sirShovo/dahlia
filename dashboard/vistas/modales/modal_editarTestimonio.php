<div 
  class="modal fade" 
  id="editModal<?php echo($testimonio['id_testimonio']); ?>" 
  tabindex="-1" 
  aria-labelledby="editModalLabel" 
  aria-hidden="true"
  data-bs-keyboard="false" 
  data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Testimonio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_testimonio" value="<?php echo($testimonio['id_testimonio']); ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Autor</label>
                <input 
                  value="<?php echo($testimonio['nombre_testimonio']); ?>"
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
                  value="<?php echo($testimonio['ubicacion_testimonio']); ?>"
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
                  value="<?php echo($testimonio['image_testimonio']); ?>"
                  class="form-control"
                  type="file"
                  name="image_testimonio" 
                >
                <small class="form-text">
                  Puedes dejar este campo vacío si no quieres cambiar la imágen
                </small>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label">Descripción</label>
                <textarea 
                  class="form-control"
                  name="descripcion_testimonio" 
                  required 
                ><?php echo($testimonio['descripcion_testimonio']); ?></textarea>
              </div>
            </div>
          </div>
          <input type="submit" class="d-none" id="editar_testimonio<?php echo($testimonio['id_testimonio']); ?>" name="editar_testimonio">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <label class="btn btn-primary" for="editar_testimonio<?php echo($testimonio['id_testimonio']); ?>">Guardar</label>
      </div>
    </div>
  </div>
</div>