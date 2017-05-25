<link rel = "stylesheet" type = "text/css" href = "./estilos/portada.css" />

<?php
$conexion = mysql_connect ("localhost", "marcofp", "marcofp");
$abreBD = mysql_select_db ("geekleaks_db", $conexion);

$noticia_principal_query = mysql_query('SELECT * FROM Noticias WHERE principal=true', $conexion);
$ultimas_noticias_query = mysql_query('SELECT * FROM Noticias WHERE ultimas=true', $conexion);

$noticia_principal = mysql_fetch_array($noticia_principal_query);
$ultimas_noticias = array();

while($noticia = mysql_fetch_array($ultimas_noticias_query)){
  $ultimas_noticias[] = $noticia;
}

?>

  <a href="?noticia=<?php echo $noticia_principal[0] ?>" class="link-noticia">
    <div id="noticia-principal">
      <div id="noticia-principal-titular">
        <h1> <?php echo $noticia_principal[1]; ?> </h1>
      </div>
    </div>
  </a>

  <div class="contenedor-general">

    <div id="ultimas-noticias">

    <h2> Ultimas noticias </h2>

      <div class="noticia">
        <a href="?noticia=<?php echo $ultimas_noticias[0][0] ?>">
          <h4><?php echo $ultimas_noticias[0][1] ?></h4>
        </a>
      </div>

      <div id="col-izq">
      <?php
        for ($i = 1 ; $i < 5; $i++){
          echo '<div class="noticia">';
          echo '<a href="?noticia='.$ultimas_noticias[$i][0].'">';
          echo '<h4>'.$ultimas_noticias[$i][1].'</h4>';
          echo '</a>';
          echo '</div>';
        }
      ?>
      </div>

      <div id="col-der">
      <?php
        for ($i = 5 ; $i < 9; $i++){
          echo '<div class="noticia">';
          echo '<a href="?noticia='.$ultimas_noticias[$i][0].'">';
          echo '<h4>'.$ultimas_noticias[$i][1].'</h4>';
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

  <?php mysql_close($conexion); ?>
