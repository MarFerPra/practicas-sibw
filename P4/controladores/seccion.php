<link rel = "stylesheet" type = "text/css" href = "./estilos/portada.css" />

<?php
  include './helpers/db_handler.php';
  $dbHandler = DatabaseHandler::getInstance();
  $noticias_seccion = $dbHandler->getNoticiasSeccion($_GET['seccion']);
?>

  <div class="contenedor-general">

    <div id="ultimas-noticias">

    <h2> Seccion: <?php echo $_GET['seccion'] ?> </h2>

      <div class="noticia">
        <a href="?noticia=<?php echo $noticias_seccion[0][0] ?>">
          <h4><?php echo $noticias_seccion[0][1] ?></h4>
        </a>
      </div>

      <div id="col-izq">
      <?php
        for ($i = 1 ; $i < 5; $i++) {
          echo '<div class="noticia">';
          echo '<a href="?noticia='.$noticias_seccion[$i][0].'">';
          echo '<h4>'.$noticias_seccion[$i][1].'</h4>';
          echo '</a>';
          echo '</div>';
        }
      ?>
      </div>

      <div id="col-der">
      <?php
        for ($i = 5 ; $i < 9; $i++){
          echo '<div class="noticia">';
          echo '<a href="?noticia='.$noticias_seccion[$i][0].'">';
          echo '<h4>'.$noticias_seccion[$i][1].'</h4>';
          echo '</a>';
          echo '</div>';
        }
      ?>
      </div>
    </div>


      <a href="#" id="publicidad-vertical">
        <img src="./imagenes/publicidad.jpg">
      </a>


  </div>
