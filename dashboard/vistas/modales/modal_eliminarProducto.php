<div class="modal fade" id="deleteModal<?php echo($producto['id_producto']); ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">¿Estas seguro de que quieres eliminar este producto?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_producto" type="number" value="<?php echo($producto['id_producto']); ?>">
          <input type="hidden" name="eliminar_producto" value="true">
          <input type="submit" class="d-none" id="eliminar_producto<?php echo($producto['id_producto']); ?>">
        </form>
        <div class="text-center">
          <strong>Producto: </strong>
          <p><?php echo($producto['nombre_producto']); ?></p>
          <strong>Precio: </strong>                              
          <p>$<?php echo($producto['precio_producto']); ?></p>
          <strong>Stock: </strong>
          <p><?php echo($producto['stock_producto']); ?></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <label class="btn btn-danger" for="eliminar_producto<?php echo($producto['id_producto']); ?>">Eliminar</label>
      </div>
    </div>
  </div>
</div>