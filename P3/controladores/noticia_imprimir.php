<link rel = "stylesheet" type = "text/css" href = "./estilos/noticia_imprimir.css" />
<link rel = "stylesheet" type = "text/css" href = "./estilos/comun.css" />

<?php
  include './helpers/db_handler.php';
  $dbHandler = DatabaseHandler::getInstance();
  $noticia = $dbHandler->getNoticia($_GET["noticia"]);
?>

<div class="contenedor-general">
    <h1 id="titular" class="texto-noticia">
      <?php echo $noticia[1]; ?>
    </h1>

    <h4 id="subtitulo" class="texto-noticia">
      <?php echo $noticia[2]; ?>
    </h4>

    <p id="entradilla" class="texto-noticia">
      <?php echo $noticia[3]; ?>
    </p>

    <div id="autor-fecha" class="texto-noticia">
      <?php echo $noticia[4].' '.$noticia[6]; ?>
    </div>

    <div id="cuerpo" class="texto-noticia">
      <?php echo $noticia[5]; ?>
    </div>
</div>
