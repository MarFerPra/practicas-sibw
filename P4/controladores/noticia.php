<link rel = "stylesheet" type = "text/css" href = "./estilos/noticia.css" />

<?php
  include './helpers/db_handler.php';

  $dbHandler = DatabaseHandler::getInstance();

  $noticiaID = $_GET["noticia"];
  $noticia = $dbHandler->getNoticia($noticiaID);

  $comentarios = $dbHandler->getComentarios($noticiaID);

  $count_comentarios = sizeof($comentarios);

  $palabras_prohibidas = $dbHandler->getPalabrasProhibidas();

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

      <a href="<?php echo "?noticia=$noticiaID&imprimir=true" ?>">
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

      <form id="comentario-form" action="" method="POST">
        <input type="hidden" name="add_comentario" value="true" />
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
