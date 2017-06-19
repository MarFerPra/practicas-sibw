<?php
  include '../../../helpers/db_handler.php';

  $seccionID = htmlspecialchars($_POST['publicidadID']);
  $nombre = htmlspecialchars($_POST['nombre']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $resultado = $dbHandler->editSeccion($seccionID, $nombre);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
