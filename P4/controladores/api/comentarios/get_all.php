<?php
  include '../../../helpers/db_handler.php';

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $comentarios = $dbHandler->getComentarios();

  if($comentarios) {
    http_response_code(200);
    echo json_encode($comentarios);
  } else {
    http_response_code(500);
  }
?>
