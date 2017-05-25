<link rel = "stylesheet" type = "text/css" href = "./estilos/noticia.css" />

<?php

$conexion = mysql_connect ("localhost", "marcofp", "marcofp");
$abreBD = mysql_select_db ("geekleaks_db", $conexion);

$noticiaID = $_GET["noticia"];

$noticia_query = mysql_query('SELECT * FROM Noticias WHERE ID='.$noticiaID, $conexion);
$noticia = mysql_fetch_array($noticia_query);

$comentarios_query = mysql_query('SELECT * FROM Comentarios WHERE NoticiaID='.$noticiaID, $conexion);

$comentarios = array();

while($comentario = mysql_fetch_array($comentarios_query)){
  $comentarios[] = $comentario;
}

$count_comentarios = sizeof($comentarios);

$palabras_prohibidas_query = mysql_query('SELECT Valor FROM PalabrasProhibidas', $conexion);

$palabras_prohibidas = array();

while($palabra = mysql_fetch_array($palabras_prohibidas_query)){
  $palabras_prohibidas[] = $palabra;
}

$count_palabras_prohibidas = sizeof($palabras_prohibidas);


?>


<div class="contenedor-noticia">

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

    <div id="social-enlaces">
      <a href="https://www.facebook.com/">
        <img src="./imagenes/fb.png" height="24" width="24">
      </a>

      <a href="https://www.twitter.com/">
        <img src="./imagenes/tw.png" height="24" width="24">
      </a>

      <a href="noticia_imprimir.html">
        <img src="./imagenes/print.png" height="24" width="24">
      </a>
    </div>

    <div id="wrapper-comentarios">
      <button id="btn-dropdown-comentarios" onclick="toggleComentarios()">COMENTARIOS</button>
      <div id="comentarios">
      <?php
        for ($i = 0 ; $i < $count_comentarios; $i++){
          echo '<div class="comentario">';
          echo   '<div class="comentario-autor-fecha">';
          echo     '<span class="comentario-autor">'.$comentarios[$i][3].'</span>';
          echo     '&nbsp;';
          echo     '<span class="comentario-fecha">'.$comentarios[$i][5].'</span>';
          echo   '</div>';
          echo   '<span class="comentario-texto">'.$comentarios[$i][6].'</span>';
          echo '</div>';
        }
      ?>
      </div>

      <form id="comentario-form" action="./controladores/add_comentario.php" method="POST">
        <input
          type="text"
          name="autor"
          class="input"
          id="comentario-form-autor"
          placeholder="Autor"
        >
        <input
         type="email"
         name="email"
         class="input"
         id="comentario-form-email"
         placeholder="Email"
        >
        <textarea
          rows="4"
          cols="50"
          name="texto"
          class="input"
          placeholder="Introduce tu comentario..."
          id="comentario-form-texto"
          onkeydown="(ev) => filtrarPalabras(ev)"
        ></textarea>
        <input type="hidden" name="noticia" value="<?php echo $noticiaID?>">
        <input type="submit" id="btn-comentar" value="Comentar">
      </form>
    </div>

</div>


  <script type="text/javascript">

  const palabrasProhibidas = [
    <?php
      for ($i = 0 ; $i < $count_palabras_prohibidas; $i++){
        echo '\''.$palabras_prohibidas[$i][0].'\',';
      }
    ?>
  ];

    /* Se ejecuta despues de cargar el HTML */
    (function() {
      const textareaComentario = document.getElementById('comentario-form-texto');
      textareaComentario.onkeyup = filtrarPalabras;
      const btnComentar = document.getElementById('btn-comentar');
      btnComentar.onclick = addComentario;
    })();
  </script>


<?php mysql_close($conexion); ?>
