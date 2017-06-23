<!DOCTYPE html>
<html>
  <head>
    <title>GeekLeaks</title>
    <link rel = "stylesheet" type = "text/css" href = "./estilos/comun.css" />
    <script src="./javascript/noticia.js"></script>
    <script src="./javascript/limpiarFormulario.js"></script>
    <script src="./javascript/cookieHelpers.js"></script>
    <script src="./javascript/getFormData.js"></script>
  </head>
  <body>

  <?php include './layout/header.php';?>

  <?php
  if(count($_GET) == 0) {
    include './controladores/portada.php';
  } else {
    $noticiaID = $_GET["noticia"];
    $imprimir = $_GET["imprimir"];

    if($noticiaID and $imprimir == true) {
      include './controladores/noticia_imprimir.php';
    } elseif ($noticiaID) {
      include './controladores/noticia.php';
      include './layout/sidebar.php';
    }

    if($_GET["seccion"]) {
      include './controladores/seccion.php';
    }

    if($_GET["busqueda"]) {
      include './controladores/busqueda.php';
    }
  }
  ;?>

  <?php include './layout/footer.php';?>

  </body>
</html>
