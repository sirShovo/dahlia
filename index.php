<?php
  require_once('control/funciones.php'); // Requiere de este archivo una vez para funcionar, si no lo encuentra tira error
  
  $conexion = conexion();
  if (!$conexion) { // Si no hay conexion a la base de datos, mandamos a la pagina de error
    header('Location: error.php');
  }
  require_once('control/traer_categorias.php');
  
  // Configuraciones de la base de datos
  $sentencia = $conexion->prepare("SELECT * FROM configuraciones");
  $sentencia->execute();
  $configuraciones = $sentencia->fetchAll();

  // Ultimos productos agregados, El INNER JOIN es para traer datos de otras tablas cuando tienen una relacion 
  $sentencia = $conexion->prepare("SELECT * FROM productos 
    INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria 
    ORDER BY id_producto DESC LIMIT ".$configuraciones[0]['valor_configuracion']."
  "); // Preparamos la consulta SQL para traer los ultimos productos dependiendo de la configuracion
  $sentencia->execute(); // Ejecuta la sentencia (la consulta sql)
  $productos = $sentencia->fetchAll(); // Tomamos solo los dados la consulta sql
  $categoriasUsadas = array(); // Creamos la variable que va a guardar las categorias existentes dentro de los procutos

  foreach ($productos as $producto) { // Recorremos los productos y guardamos la categoria si no existe en el arreglo
    if (!in_array($producto['nombre_categoria'], $categoriasUsadas)) { // Si la categoria que tiene el producto no esta dentro del arreglo, se guarda
      array_push($categoriasUsadas, $producto['nombre_categoria']); // Guardamos la categoria dentro del array
    }
  }

  // Ultimos productos agregados
  $sentencia = $conexion->prepare("SELECT * FROM testimonios 
    ORDER BY id_testimonio DESC LIMIT ".$configuraciones[1]['valor_configuracion']."
  ");
  $sentencia->execute();
  $testimonios = $sentencia->fetchAll();

  if(isset($_GET['compra'])) { // Si la variable compra se envia por la url, mostramos el mensaje de compra
    $mensaje = "La compra se ha hecho exitosamente, valídala en tu perfíl"; // Seteamos el mensaje de compra
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once('vistas/head.php'); ?>

  <title>Dahlia - Clothes by Michelle | Inicio</title>
</head>

<body>
  <?php require_once('vistas/siderbar.php'); ?>
  
  <div id="wrapper">
    <?php require_once('vistas/header.php'); ?>
    <section class="welcome_area">
      <div class="welcome_slides owl-carousel">
        <div
          class="single_slide height-800 bg-img background-overlay"
          style="background-image: url(<?php echo($RUTA); ?>/archivos/img/bg-img/bg-1.jpg)"
        >
          <div class="container h-100">
            <div class="row h-100 align-items-center">
              <div class="col-12">
                <div class="welcome_slide_text">
                  <h2
                    data-animation="fadeInUp"
                    data-delay="500ms"
                    data-duration="500ms"
                  >
                    Cositas Interesantes
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="single_slide height-800 bg-img background-overlay"
          style="background-image: url(<?php echo($RUTA); ?>/archivos/img/bg-img/bg-4.jpg)"
        >
          <div class="container h-100">
            <div class="row h-100 align-items-center">
              <div class="col-12">
                <div class="welcome_slide_text">
                  <h2
                    data-animation="fadeInUp"
                    data-delay="500ms"
                    data-duration="500ms"
                  >
                    Innovación y Moda
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="single_slide height-800 bg-img background-overlay"
          style="background-image: url(<?php echo($RUTA); ?>/archivos/img/bg-img/bg-2.jpg)"
        >
          <div class="container h-100">
            <div class="row h-100 align-items-center">
              <div class="col-12">
                <div class="welcome_slide_text">
                  <h2
                    data-animation="bounceInDown"
                    data-delay="500ms"
                    data-duration="500ms"
                  >
                    Women Fashion
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="top_catagory_area d-md-flex clearfix">
      <div
        class="single_catagory_area d-flex align-items-center bg-img"
        style="background-image: url(<?php echo($RUTA); ?>/archivos/img/bg-img/bg-2.jpg)"
      >
        <div class="catagory-content">
          <h6>En Accesorios</h6>
          <h2>30% Descuento</h2>
        </div>
      </div>
      <div
        class="single_catagory_area d-flex align-items-center bg-img"
        style="background-image: url(<?php echo($RUTA); ?>/archivos/img/bg-img/bg-3.jpg)"
      >
        <div class="catagory-content">
          <h6>En Conjuntos y Bolsos</h6>
          <h2>Nuevos Diseños</h2>
        </div>
      </div>
    </section>
    <section class="new_arrivals_area section_padding_100_0 clearfix">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section_heading text-center">
              <h2>Nuevos Productos</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="karl-projects-menu mb-100">
        <div class="text-center portfolio-menu">
          <button class="btn active" data-filter="*">Todo</button>
          <?php foreach($categoriasUsadas as $categoria): ?>
            <button class="btn" data-filter=".<?php echo($categoria); ?>">
              <?php echo($categoria); ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="container">
        <div class="row karl-new-arrivals">
          <?php foreach($productos as $producto): ?>
            <div
              class="col-12 col-sm-6 col-md-4 single_gallery_item wow fadeInUpBig <?php echo($producto['nombre_categoria']); ?>"
              data-wow-delay="0.2s"
            >
              <div class="product-img">
                <img src="<?php echo($RUTA); ?>/archivos/img/productos/<?php echo($producto['image_producto']); ?>" alt="image_producto" />
              </div>
              <div class="product-description">
                <h4 class="product-price">$<?php echo($producto['precio_producto']); ?></h4>
                <p><?php echo($producto['nombre_producto']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section
      class="offer_area height-700 section_padding_100 bg-img"
      style="background-image: url(<?php echo($RUTA); ?>/archivos/img/bg-img/bg-5.jpg)"
    >
      <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-end">
          <div class="col-12 col-md-8 col-lg-6">
            <div class="offer-content-area wow fadeInUp" data-wow-delay="1s">
              <h2>White t-shirt <span class="karl-level">New</span></h2>
              <p>* Envio grátis hasta Agos 25, 2022</p>
              <div class="offer-product-price">
                <h3><span class="regular-price">$25.90</span> $15.90</h3>
              </div>
              <!-- <a href="#" class="btn karl-btn mt-30">Shop Now</a> -->
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="karl-testimonials-area section_padding_100">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section_heading text-center">
              <h2>Testimonios</h2>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-12 col-md-8">
            <div class="karl-testimonials-slides owl-carousel">
              <?php foreach($testimonios as $testimonio): ?>
                <div class="single-testimonial-area text-center">
                  <span class="quote">"</span>
                  <h6>
                    <?php echo($testimonio['descripcion_testimonio']); ?>
                  </h6>
                  <div
                    class="testimonial-info d-flex align-items-center justify-content-center"
                  >
                    <div class="tes-thumbnail">
                      <img src="<?php echo($RUTA); ?>/archivos/img/testimonios/<?php echo($testimonio['image_testimonio']); ?>" alt="testimonio" />
                    </div>
                    <div class="testi-data">
                      <p><?php echo($testimonio['nombre_testimonio']); ?></p>
                      <span><?php echo($testimonio['ubicacion_testimonio']); ?></span>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php require_once('vistas/footer.php'); ?>
  </div>

  <?php require_once('vistas/scripts.php'); ?>
  <?php if(isset($mensaje)): ?>
    <script>
      Swal.fire({
        title: '¡Excelente!',
        text: '<?php echo($mensaje); ?>',
        type: 'success',
        icon: 'success',
        confirmButtonText: 'Cerrar'
      })
    </script>
  <?php endif; ?>
</body>
</html>
