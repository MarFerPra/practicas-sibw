<!DOCTYPE html>
<html>
  <head>
    <title>GeekLeaks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel = "stylesheet" type = "text/css" href = "./estilos/comun.css" />
    <link rel = "stylesheet" type = "text/css" href = "./estilos/administracion.css" />
    <script src="./javascript/limpiarFormulario.js"></script>
    <script src="./javascript/cookieHelpers.js"></script>
    <script src="./javascript/truncateText.js"></script>
    <script src="./javascript/administration-helper.js"></script>
  </head>
  <body>

  <?php include './layout/header.php';?>

  <div class="contenedor-general">
    <h2>Panel Administracion</h2>

    <?php
      $item = $_GET['item'];
      if($item) {
        $item_page = sprintf("./controladores/administracion/%s.php", $item);
        include $item_page;
      } else {
        echo '<h4>Error: Ningun item para administrar seleccionado.</h4>';
      }
    ?>

  </div>

  </body>
</html>
