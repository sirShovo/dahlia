<?php 
  require_once('control/funciones.php');

  if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])) { // Si ya hay una sesion activa, enviamos al index
    header("Location: $RUTA/login.php");
  }

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['carrito'])) {
    $id_usuario = $_SESSION['usuario'];
    
    for ($i=0; $i < count($carrito); $i++) { 
      $id_producto = $_POST["id_producto$i"];
      $cantidad = $_POST["cantidad$i"];
      $precio_producto = $_POST["precio_producto$i"];
      $total_venta = $_POST["total_venta$i"];
      
      try {
        // Ingresamos a la db producto por producto
        $sentencia = $conexion->prepare("INSERT INTO ventas VALUES (NULL, $id_usuario, $id_producto, $cantidad, $precio_producto, $total_venta, NULL)");
        $sentencia->execute();
        $sentenciaUpdate = $conexion->prepare("UPDATE productos SET stock_producto = stock_producto - $cantidad WHERE id_producto = $id_producto");
        $sentenciaUpdate->execute();
        // eliminamos el producto del carrito
        header("Location: vaciar.php?compra=true");
      } catch (\Throwable $th) {
        $error = $th->getMessage();
      }
    }
  }

  require_once('control/traer_categorias.php');
  $totalCantidad = 0;
  $totalPagar = 0;

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once('vistas/head.php'); ?>
  <title>Dahlia - Clothes by Michelle | Tienda</title>
</head>
<body>
  <?php require_once('vistas/siderbar.php'); ?>
  <div id="wrapper">
    <?php require_once('vistas/header.php'); ?>
    <div class="cart_area section_padding_100 clearfix">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="cart-table clearfix">
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" id="carrito">
                    <?php foreach($info_carrito as $i => $item): ?>
                      <input type="hidden" name="id_producto<?php echo $i; ?>" value="<?php echo $item->id_producto; ?>">
                      <input type="hidden" name="cantidad<?php echo $i; ?>" value="<?php echo $item->cantidad_producto; ?>">
                      <input type="hidden" name="precio_producto<?php echo $i; ?>" value="<?php echo $item->precio_producto; ?>">
                      <input type="hidden" name="total_venta<?php echo $i; ?>" value="<?php echo($item->cantidad_producto * $item->precio_producto); ?>">
                      <tr>
                        <td class="cart_product_img d-flex align-items-center">
                          <a href="#"
                            ><img
                              src="<?php echo $RUTA; ?>/archivos/img/productos/<?php echo $item->image_producto; ?>"
                              alt="Producto"
                          /></a>
                          <h6><?php echo $item->nombre_producto; ?></h6>
                        </td>
                        <td class="price"><span>$<?php echo $item->precio_producto; ?></span></td>
                        <td class="qty">
                          <div class="quantity">
                            <input
                              type="number"
                              readonly
                              class="qty-text"
                              disabled
                              value="<?php $totalCantidad += $item->cantidad_producto; echo $item->cantidad_producto; ?>"
                            />
                          </div>
                        </td>
                        <td class="total_price"><span>$<?php $totalPagar += $item->cantidad_producto * $item->precio_producto; echo($item->cantidad_producto * $item->precio_producto); ?></span></td>
                      </tr>
                    <?php endforeach; ?>
                  </form>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="1">
                      <p><strong>Total productos: </strong><?php echo $totalCantidad; ?></p>  
                    </td>
                    <td colspan="2">
                      <p><strong>Total a pagar: </strong>$<?php echo $totalPagar; ?></p>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="cart-footer d-flex mt-30">
              <div class="back-to-shop w-50">
                <a href="<?php echo $RUTA; ?>/tienda.php">Continuar Comprando</a>
              </div>
              <div class="update-checkout w-50 text-right">
                <a href="<?php echo $RUTA; ?>/vaciar.php">Vaciar carrito</a>
                <button type="submit" name="carrito" form="carrito">Comprar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once('vistas/footer.php'); ?>
  </div>
  <?php require_once('vistas/scripts.php'); ?>
  <?php if(isset($mensaje)): ?>
    <script>
      Swal.fire({
        title: '¡Bien!',
        text: '<?php echo($mensaje); ?>',
        type: 'success',
        icon: 'success',
        confirmButtonText: 'Cerrar'
      })
    </script>
  <?php endif; ?>
  <?php if(isset($error)): ?>
    <script>
      Swal.fire({
        title: '¡Error!',
        text: '<?php echo($error); ?>',
        icon: 'error',
        confirmButtonText: 'Cerrar'
      })
    </script>
  <?php endif; ?>
</body>
</html>
