<div
  class="modal fade"
  id="quickview<?php echo($producto['id_producto']); ?>"
  tabindex="-1"
  role="dialog"
  aria-labelledby="quickview"
  aria-hidden="true">
  <div
    class="modal-dialog modal-lg modal-dialog-centered"
    role="document"
  >
    <div class="modal-content">
      <button
        type="button"
        class="close btn"
        data-dismiss="modal"
        aria-label="Close"
      >
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-body">
        <div class="quickview_body">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-5">
                <div class="quickview_pro_img">
                  <img src="<?php echo($RUTA); ?>/archivos/img/productos/<?php echo($producto['image_producto']); ?>" alt="Producto" />
                </div>
              </div>
              <div class="col-12 col-lg-7">
                <div class="quickview_pro_des">
                  <h4 class="title"><?php echo($producto['nombre_producto']); ?></h4>
                  <h5 class="price">$<?php echo($producto['precio_producto']); ?></h5>
                  <p>
                    <?php echo($producto['descripcion_producto']); ?>
                  </p>
                </div>
                <form class="cart" method="post" action="<?php echo($_SERVER['PHP_SELF']); ?>">
                  <input type="hidden" name="id_producto" value="<?php echo($producto['id_producto']); ?>">
                  <input type="hidden" name="nombre_producto" value="<?php echo($producto['nombre_producto']); ?>">
                  <input type="hidden" name="image_producto" value="<?php echo($producto['image_producto']); ?>">
                  <input type="hidden" name="precio_producto" value="<?php echo($producto['precio_producto']); ?>">
                  <div class="quantity">
                    <span
                      class="qty-minus"
                      onclick="var effect = document.getElementById('qty<?php echo($producto['id_producto']); ?>'); 
                        var qty = effect.value; if( !isNaN( qty ) & qty > 1) effect.value--;return false;
                      "
                      ><i class="fa fa-minus" aria-hidden="true"></i
                    ></span>

                    <input
                      type="number"
                      class="qty-text"
                      id="qty<?php echo($producto['id_producto']); ?>"
                      min="1"
                      max="<?php echo($producto['stock_producto']); ?>"
                      name="cantidad"
                      value="1"
                    />

                    <span
                      class="qty-plus"
                      onclick="var effect = document.getElementById('qty<?php echo($producto['id_producto']); ?>'); 
                        var qty = effect.value; if( !isNaN( qty ) & qty < <?php echo($producto['stock_producto']); ?>) effect.value++;return false;
                      "
                      ><i class="fa fa-plus" aria-hidden="true"></i
                    ></span>
                  </div>
                  <button
                    type="submit"
                    name="agregar"
                    class="cart-submit text-uppercase"
                  >
                    Añadir
                  </button>
                </form>
                <div class="share_wf mt-30">
                  <p>Compartir</p>
                  <div class="_icon">
                    <a href="#">
                      <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="#">
                      <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="#">
                      <i class="fa fa-pinterest" aria-hidden="true"></i>
                    </a>
                    <a href="#">
                      <i class="fa fa-google-plus" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>