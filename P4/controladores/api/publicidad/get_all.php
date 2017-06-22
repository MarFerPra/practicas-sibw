<?php
  include '../../../helpers/db_handler.php';

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $publicidad = $dbHandler->getAllPublicidad();

  if($publicidad) {
    http_response_code(200);
    echo json_encode($publicidad);
  } else {
    http_response_code(500);
  }
?>
