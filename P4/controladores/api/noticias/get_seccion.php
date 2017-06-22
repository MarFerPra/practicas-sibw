<?php
  include '../../../helpers/db_handler.php';

  // NOTE: Left it as post to authorize in refactor.

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $noticias_seccion = $dbHandler->getNoticiasSeccion($_POST['seccion']);

  if($noticias_seccion) {
    http_response_code(200);
    echo json_encode($noticias_seccion);
  } else {
    http_response_code(500);
  }
?>
