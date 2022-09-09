<div 
  class="modal fade" 
  id="editModal<?php echo($producto['id_producto']); ?>" 
  tabindex="-1" 
  aria-labelledby="editModalLabel" 
  aria-hidden="true"
  data-bs-keyboard="false" 
  data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_producto" value="<?php echo($producto['id_producto']); ?>">
          <input type="hidden" name="editar_producto" value="true">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Nombre</label>
                <input 
                  value="<?php echo($producto['nombre_producto']); ?>"
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
                  value="<?php echo($producto['precio_producto']); ?>"
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
                  value="<?php echo($producto['stock_producto']); ?>"
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
                  value="<?php echo($producto['image_producto']); ?>"
                  class="form-control"
                  name="image_producto" 
                  type="file"
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
                  name="descripcion_producto" 
                  required 
                ><?php echo($producto['descripcion_producto']); ?></textarea>
              </div>
            </div>
          </div>
          <input type="submit" class="d-none" id="editar_producto<?php echo($producto['id_producto']); ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <label class="btn btn-primary" for="editar_producto<?php echo($producto['id_producto']); ?>">Guardar</label>
      </div>
    </div>
  </div>
</div>