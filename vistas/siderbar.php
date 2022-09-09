<div class="catagories-side-menu">
  <div id="sideMenuClose">
    <i class="ti-close"></i>
  </div>
  <div class="nav-side-menu">
    <div class="menu-list">
      <h6>Categorías</h6>
      <ul id="menu-content" class="menu-content">
        <?php foreach($categorias as $categoria): ?>
          <li>
            <a href="<?php echo($RUTA); ?>/tienda.php?categoria=<?php echo($categoria['nombre_categoria']); ?>">
              <?php echo($categoria['nombre_categoria']); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <?php if(isset($_SESSION['usuario']) && isset($_SESSION['tipo'])): ?>
      <div class="menu-list">
        <h6>Control</h6>
        <ul id="menu-content" class="menu-content">
          <li><a href="<?php echo($RUTA); ?>/cuenta.php">Mi cuenta</a></li>
          <li><a href="<?php echo($RUTA); ?>/cerrar.php">Cerrar Sesión</a></li>
        </ul>
      </div>
    <?php endif; ?>
  </div>
</div>