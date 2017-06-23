<?php
  include '../../../helpers/db_handler.php';

  $seccionID = htmlspecialchars($_POST['seccionID']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $seccion = $dbHandler->getSeccion($seccionID);

  if($seccion) {
    http_response_code(200);
    echo json_encode($seccion);
  } else {
    http_response_code(500);
  }
?>
