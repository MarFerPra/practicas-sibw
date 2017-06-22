<?php
  include '../../../helpers/db_handler.php';

  // NOTE: Left it as post to authorize in refactor.

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $usuarios = $dbHandler->getUsuarios();

  if($usuarios) {
    http_response_code(200);
    echo json_encode($usuarios);
  } else {
    http_response_code(500);
  }
?>
