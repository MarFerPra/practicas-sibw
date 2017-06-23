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
    <script src="./javascript/getFormData.js"></script>
  </head>
  <body>

  <?php include './layout/header.php';?>

  <div class="contenedor-general">
    <h2>Panel Administracion</h2>

    <?php
      $item = $_GET['item'];
      $itemID = $_GET['itemID'];
      $action = $_GET['action'];

      if(!$item){
        echo '<h4>Error: Ningun item para administrar seleccionado.</h4>';
      } else {
        if($item && (!$action && !$itemID)) {
          $item_page = sprintf("./controladores/administracion/%s.php", $item);
          include $item_page;
        } else if($action == 'delete'){
          include "./controladores/administracion/acciones/delete.php";
        } else if($action == 'add' || $action == 'edit') {
          $action_page = sprintf("./controladores/administracion/acciones/forms/%s.php", $item);
          include $action_page;
        }
      }
    ?>

  </div>

  </body>
</html>
