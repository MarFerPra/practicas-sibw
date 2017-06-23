<?php
  include '../../../helpers/db_handler.php';
  $dbHandler = DatabaseHandler::getInstance();
  $noticia_principal = $dbHandler->getNoticiaPrincipal();
  $ultimas_noticias = $dbHandler->getUltimasNoticias();

  $respuesta['principal'] = $noticia_principal;
  $respuesta['ultimas'] = $ultimas_noticias;

  echo json_encode($respuesta);
?>
