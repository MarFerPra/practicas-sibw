<?php
  include '../../../helpers/db_handler.php';

  $publicidadID = htmlspecialchars($_POST['publicidadID']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $publicidad = $dbHandler->getPublicidad($publicidadID);

  if($publicidad) {
    http_response_code(200);
    echo json_encode($publicidad);
  } else {
    http_response_code(500);
  }
?>
