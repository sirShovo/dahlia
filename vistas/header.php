<header class="header_area">
  <div class="top_header_area">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-end">
        <div class="col-12 col-lg-7">
          <div class="top_single_area d-flex align-items-center">
            <div class="top_logo">
              <a href="index.php"><img src="<?php echo($RUTA); ?>/archivos/img/core-img/logo.png" alt="dahlia logo" /></a>
            </div>
            <div
              class="header-cart-menu d-flex align-items-center ml-auto"
            >
              <div class="cart">
                <a href="#" id="header-cart-btn"
                  ><span class="cart_quantity"><?php echo(count($carrito)); ?></span>
                  <i class="ti-bag"></i>Tu Bolsita</a
                >
                <ul class="cart-list">
                  <?php foreach($info_carrito as $item): ?>
                    <li>
                      <a href="#" class="image"
                        ><img
                          src="<?php echo($RUTA); ?>/archivos/img/productos/<?php echo($item->image_producto); ?>"
                          class="cart-thumb"
                          alt=""
                      /></a>
                      <div class="cart-item-desc">
                        <h6><a href="#"><?php echo($item->nombre_producto); ?></a></h6>
                        <p><?php echo($item->cantidad_producto); ?>x - <span class="price">$
                          <?php $total_carrito += $item->cantidad_producto * $item->precio_producto; echo($item->cantidad_producto * $item->precio_producto); ?></span>
                        </p>
                      </div>
                      <span class="dropdown-product-remove"
                        ><i class="icon-cross"></i
                      ></span>
                    </li>
                  <?php endforeach; ?>
                  <li class="total">
                    <span class="pull-right">Total: $<?php echo($total_carrito); ?></span>
                    <a href="<?php echo $RUTA; ?>/carrito.php" class="btn btn-sm btn-cart"
                      >Carrito</a
                    >
                  </li>
                </ul>
              </div>
              <div class="header-right-side-menu ml-15">
                <a href="#" id="sideMenuBtn"
                  ><i class="ti-menu" aria-hidden="true"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main_header_area">
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-12 d-md-flex justify-content-between">
          <div class="header-social-area">
            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
          </div>
          <div class="main-menu-area">
            <nav class="navbar navbar-expand-lg align-items-start">
              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#karl-navbar"
                aria-controls="karl-navbar"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"
                  ><i class="ti-menu"></i
                ></span>
              </button>
              <div
                class="collapse navbar-collapse align-items-start collapse"
                id="karl-navbar"
              >
                <ul class="navbar-nav animated" id="nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="<?php echo($RUTA); ?>/index.php">Inicio</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      id="tienda"
                      role="button"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                      >Tienda</a
                    >
                    <div
                      class="dropdown-menu"
                      aria-labelledby="tienda"
                    >
                      <a class="dropdown-item" href="tienda.php">Ver todo</a>
                      <hr>
                      <?php foreach($categorias as $categoria): ?>
                        <a class="dropdown-item" href="<?php echo($RUTA); ?>/tienda.php?categoria=<?php echo($categoria['nombre_categoria']); ?>"><?php echo($categoria['nombre_categoria']); ?></a>
                      <?php endforeach; ?>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                  </li>
                  <li class="nav-item">
                    <?php if(isset($_SESSION['usuario']) && isset($_SESSION['tipo'])): ?>
                      <a class="nav-link" href="<?php echo($RUTA); ?>/cuenta.php">Mi cuenta</a>
                    <?php elseif(!$login): ?>
                      <a class="nav-link" href="<?php echo($RUTA); ?>/login.php">Iniciar Sesión</a>
                    <?php elseif($login): ?>
                      <a class="nav-link" href="<?php echo($RUTA); ?>/registro.php">Registrarme</a>
                    <?php endif; ?>
                  </li>
                  <?php if(isset($_SESSION['usuario']) && isset($_SESSION['tipo']) && ($_SESSION['tipo'] == 1)): ?>
                    <li class="nav_item">
                      <a class="nav-link" href="<?php echo($RUTA); ?>/dashboard">Dashboard</a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </nav>
          </div>
          <div class="help-line">
            <a href="tel:+573123456789"
              ><i class="ti-headphone-alt"></i> +57 312 345 6789</a
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</header>