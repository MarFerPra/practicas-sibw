<?php
  include '../../../helpers/db_handler.php';
  $comentarioID = htmlspecialchars($_POST['comentarioID']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $resultado = $dbHandler->deleteComentario($comentarioID);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
