<?php
  include '../../../helpers/db_handler.php';

  $publicidadID = htmlspecialchars($_POST['publicidadID']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $resultado = $dbHandler->deletePublicidad($publicidadID);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
