<aside
  class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
  id="sidenav-main">
  <div class="sidenav-header">
    <i
      class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true"
      id="iconSidenav">
    </i>
    <a
      class="navbar-brand m-0 text-center"
      href="#"
      target="_blank">
      <img
        src="<?php echo($RUTA); ?>/archivos/img/core-img/logo.png"
        class="navbar-brand-img h-100"
        alt="dahlia logo"
      />
    </a>
  </div>
  <hr class="horizontal dark mt-0" />
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?php pagina_actual('index', $pagina_actual) ?>" href="<?php echo($RUTA); ?>/dashboard/index.php">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
          >
            <i class="ni ni-tv-2 text-darkpink text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6
          class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6"
        >
          Comercial
        </h6>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php pagina_actual('ventas', $pagina_actual) ?>" href="<?php echo($RUTA); ?>/dashboard/ventas.php">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
          >
            <i
              class="ni ni-credit-card text-pink text-sm opacity-10"
            ></i>
          </div>
          <span class="nav-link-text ms-1">Ventas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php pagina_actual('testimonios', $pagina_actual) ?>" href="<?php echo($RUTA); ?>/dashboard/testimonios.php">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
          >
            <i class="ni ni-collection text-pink text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Testimonios</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6
          class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6"
        >
          Productos
        </h6>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php pagina_actual('productos', $pagina_actual) ?>" href="<?php echo($RUTA); ?>/dashboard/productos.php">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
          >
            <i class="ni ni-favourite-28 text-pink text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Productos</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php pagina_actual('categorias', $pagina_actual) ?>" href="<?php echo($RUTA); ?>/dashboard/categorias.php">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
          >
            <i class="ni ni-tag text-pink text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Categorías</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6
          class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6"
        >
          Administración
        </h6>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php pagina_actual('usuarios', $pagina_actual) ?>" href="<?php echo($RUTA); ?>/dashboard/usuarios.php">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
          >
            <i
              class="ni ni-calendar-grid-58 text-pink text-sm opacity-10"
            ></i>
          </div>
          <span class="nav-link-text ms-1">Usuarios</span>
        </a>
      </li>
    </ul>
  </div>
</aside>