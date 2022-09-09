<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Crear Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" id="crear_producto" enctype="multipart/form-data">
          <input type="hidden" name="crear_producto" value="true">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Nombre</label>
                <input 
                  class="form-control"
                  name="nombre_producto" 
                  type="text"  
                  required 
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Categoría</label>
                <select 
                  class="form-control"
                  name="id_categoria" 
                  required 
                >
                  <option hidden selected></option>
                  <?php foreach($categorias as $categoria): ?>
                    <option value="<?php echo($categoria['id_categoria']); ?>"><?php echo($categoria['nombre_categoria']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Precio</label>
                <input 
                  class="form-control"
                  name="precio_producto" 
                  type="number"
                  required 
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Stock</label>
                <input 
                  class="form-control"
                  name="stock_producto" 
                  type="number"
                  required 
                >
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label">Imagen</label>
                <input 
                  class="form-control"
                  name="image_producto" 
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
                  name="descripcion_producto" 
                  required 
                ></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" form="crear_producto">Guardar</button>
      </div>
    </div>
  </div>
</div>