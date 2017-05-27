<link rel = "stylesheet" type = "text/css" href = "./estilos/noticia_imprimir.css" />
<link rel = "stylesheet" type = "text/css" href = "./estilos/comun.css" />

<?php

  $conexion = mysql_connect ("localhost", "marcofp", "marcofp");
  $abreBD = mysql_select_db ("geekleaks_db", $conexion);

  $noticiaID = $_GET["noticia"];

  $noticia_query = mysql_query('SELECT * FROM Noticias WHERE ID='.$noticiaID, $conexion);
  $noticia = mysql_fetch_array($noticia_query);

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


<?php mysql_close($conexion); ?>
