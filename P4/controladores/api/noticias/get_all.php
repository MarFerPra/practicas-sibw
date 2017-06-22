<?php
  include '../../../helpers/db_handler.php';

  // NOTE: Left it as post to authorize in refactor.

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $noticias = $dbHandler->getNoticias();
  
  if($noticias) {
    http_response_code(200);
    echo json_encode($noticias);
  } else {
    http_response_code(500);
  }
?>
