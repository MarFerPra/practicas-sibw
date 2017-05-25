<!DOCTYPE html>
<html>
  <head>
    <title>GeekLeaks</title>
    <link rel = "stylesheet" type = "text/css" href = "./estilos/comun.css" />
    <script src="./javascript/noticia.js"></script>
  </head>
  <body>

  <?php include './layout/header.php';?>

  <?php
  if(count($_GET) == 0) {
    include './controladores/portada.php';
  } else {
    include './controladores/noticia.php';
    include './layout/sidebar.php';
  }
  ;?>

  <?php include './layout/footer.php';?>

  </body>
</html>
