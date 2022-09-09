<?php
  require_once('control/funciones.php');

  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $para_carrito = array(
      'id_producto' => $_POST['id_producto'],
      'nombre_producto' => $_POST['nombre_producto'],
      'image_producto' => $_POST['image_producto'],
      'cantidad_producto' => $_POST['cantidad'],
      'precio_producto' => $_POST['precio_producto']
    );

    $siguiente = count($carrito) + 1;
    setcookie("carrito[$siguiente]", json_encode($para_carrito));
    header('Location: tienda.php');
  }

  require_once('control/traer_categorias.php');

  if (!isset($_GET['categoria'])) {
    $sentencia = $conexion->prepare("SELECT * FROM productos 
      INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria 
      ORDER BY id_producto DESC
    ");
  } else {
    $filtro = $_GET['categoria'];
    $sentencia = $conexion->prepare("SELECT * FROM productos 
      INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria
      WHERE categorias.nombre_categoria = '$filtro' 
      ORDER BY id_producto DESC
    ");
  }
  $sentencia->execute();
  $productos = $sentencia->fetchAll();
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
    <section class="shop_grid_area section_padding_100">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-4 col-lg-3">
            <div class="shop_sidebar_area">
              <div class="widget catagory mb-50">
                <div class="nav-side-menu">
                  <h6 class="mb-0">Categorías</h6>
                  <div class="menu-list">
                    <ul id="menu-content2" class="menu-content collapse out">
                      <li><a href="?">Ver todo</a></li>
                      <?php foreach($categorias as $categoria): ?>
                        <li><a href="?categoria=<?php echo($categoria['nombre_categoria']); ?>"><?php echo($categoria['nombre_categoria']); ?></a></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-8 col-lg-9">
            <div class="shop_grid_product_area">
              <div class="row">
                <?php foreach($productos as $producto): ?>
                  <div
                    class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig"
                    data-wow-delay="0.2s">
                    <div class="product-img">
                      <img src="<?php echo $RUTA; ?>/archivos/img/productos/<?php echo($producto['image_producto']); ?>" alt="producto" />
                      <div class="product-quicview">
                        <a href="#" data-toggle="modal" data-target="#quickview<?php echo($producto['id_producto']); ?>"
                          ><i class="ti-plus"></i
                        ></a>
                      </div>
                    </div>
                    <div class="product-description">
                      <h4 class="product-price">$<?php echo($producto['precio_producto']); ?></h4>
                      <p><?php echo($producto['nombre_producto']); ?></p>
                      <a href="#" class="add-to-cart-btn  text-uppercase" 
                        data-toggle="modal" data-target="#quickview<?php echo($producto['id_producto']); ?>">Añadir</a>
                    </div>
                  </div>
                  <?php include('vistas/modales/modal_producto.php'); ?>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php require_once('vistas/footer.php'); ?>
  </div>
  
  <?php require_once('vistas/scripts.php'); ?>
</body>
</html>
