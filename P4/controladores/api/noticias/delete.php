<?php
  include '../../../helpers/db_handler.php';

  $noticiaID = htmlspecialchars($_POST['$noticiaID']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $resultado = $dbHandler->deleteNoticia($noticiaID);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
