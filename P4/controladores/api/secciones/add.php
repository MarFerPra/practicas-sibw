<?php
  include '../../../helpers/db_handler.php';

  $nombre = htmlspecialchars($_POST['nombre']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $resultado = $dbHandler->addSeccion($nombre);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
