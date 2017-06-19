<?php
  include '../../../helpers/db_handler.php';

  $seccionID = htmlspecialchars($_POST['seccionID']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $resultado = $dbHandler->deleteSeccion($seccionID);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
