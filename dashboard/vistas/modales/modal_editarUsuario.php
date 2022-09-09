<div class="modal fade" id="editModal<?php echo($usuario['id_usuario']); ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
          <input type="hidden" name="id" value="<?php echo($usuario['id_usuario']); ?>">
          <input type="hidden" name="creado" value="<?php echo($usuario['creado_usuario']); ?>">
          <input type="hidden" name="editar_usuario" value="true">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Nombre</label>
                <input 
                  value="<?php echo($usuario['nombre_usuario']); ?>"
                  class="form-control"
                  name="nombre" 
                  type="text"  
                  required 
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Apellido</label>
                <input 
                  value="<?php echo($usuario['apellido_usuario']); ?>"
                  class="form-control" 
                  name="apellido" 
                  type="text"
                  required 
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Sexo</label>
                <select 
                  class="form-control"
                  name="sexo" 
                  required 
                >
                  <option value="<?php echo($usuario['sexo_usuario']); ?>" hidden>
                    <?php echo(ucfirst($usuario['sexo_usuario'])); ?>
                  </option>
                  <option value="mujer">Mujer</option>
                  <option value="hombre">Hombre</option>
                  <option value="otro">Otro</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Tipo de documento</label>
                <select 
                  class="form-control"
                  name="tipo_documento" 
                  required 
                >
                  <option value="<?php echo($usuario['tipo_documento_usuario']); ?>" hidden>
                    <?php echo(ucfirst($usuario['tipo_documento_usuario'])); ?>
                  </option>
                  <option value="cédula de ciudadanía">Cédula de Ciudadanía</option>
                  <option value="tarjeta de identidad">Tarjeta de Identidad</option>
                  <option value="otro">Otro</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Documento</label>
                <input 
                  value="<?php echo($usuario['documento_usuario']); ?>"
                  class="form-control"
                  name="documento" 
                  type="number"
                  required 
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Correo Electrónico</label>
                <input 
                  value="<?php echo($usuario['correo_usuario']); ?>"
                  class="form-control"
                  name="correo" 
                  type="email"
                  required 
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Tipo Usuario</label>
                <select 
                  class="form-control"
                  name="tipo" 
                  required 
                >
                  <option value="<?php echo($usuario['tipo_usuario']); ?>" hidden>
                    <?php echo($usuario['tipo_usuario'] ? 'Admin' : 'Usuario'); ?>
                  </option>
                  <option value="0">Usuario</option>
                  <option value="1">Admin</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Contraseña</label>
                <input 
                  class="form-control"
                  name="password" 
                  type="text"
                  required
                >
              </div>
            </div>
          </div>
          <input type="submit" class="d-none" id="editar_usuario<?php echo($usuario['id_usuario']); ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <label class="btn btn-primary" for="editar_usuario<?php echo($usuario['id_usuario']); ?>">Guardar</label>
      </div>
    </div>
  </div>
</div>