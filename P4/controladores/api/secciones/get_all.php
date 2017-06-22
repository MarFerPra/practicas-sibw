<?php
  include '../../../helpers/db_handler.php';

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $secciones = $dbHandler->getSecciones();

  if($secciones) {
    http_response_code(200);
    echo json_encode($secciones);
  } else {
    http_response_code(500);
  }
?>
