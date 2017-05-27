<?php
  // TODO: Refactor into class and class methods.

  function db_conectar() {
    $conexion = mysql_connect ("localhost", "marcofp", "marcofp");
    $abreBD = mysql_select_db ("geekleaks_db", $conexion);
    return $conexion;
  }

  function db_desconectar($conexion) {
    mysql_close($conexion);
  }

  function db_get_noticia($conexion, $noticiaID) {
    $noticia_query = mysql_query('SELECT * FROM Noticias WHERE ID='.$noticiaID, $conexion);
    return mysql_fetch_array($noticia_query);
  }

  function db_get_comentarios($conexion, $noticiaID) {
    $comentarios_query = mysql_query('SELECT * FROM Comentarios WHERE NoticiaID='.$noticiaID, $conexion);

    $comentarios = array();

    while($comentario = mysql_fetch_array($comentarios_query)){
      $comentarios[] = $comentario;
    }

    return $comentarios;
  }

  function db_get_palabras_prohibidas($conexion) {
    $palabras_prohibidas_query = mysql_query('SELECT Valor FROM PalabrasProhibidas', $conexion);

    $palabras_prohibidas = array();

    while($palabra = mysql_fetch_array($palabras_prohibidas_query)){
      $palabras_prohibidas[] = $palabra;
    }

    return $palabras_prohibidas;
  }

  function db_get_noticia_principal($conexion) {
    $noticia_principal_query = mysql_query('SELECT * FROM Noticias WHERE principal=true', $conexion);
    return mysql_fetch_array($noticia_principal_query);
  }

  function db_get_ultimas_noticias($conexion) {
    $ultimas_noticias_query = mysql_query('SELECT * FROM Noticias WHERE ultimas=true', $conexion);
    $ultimas_noticias = array();

    while($noticia = mysql_fetch_array($ultimas_noticias_query)){
      $ultimas_noticias[] = $noticia;
    }

    return $ultimas_noticias;
  }
?>
