<?php
  include '../../../helpers/db_handler.php';
  $usuarioID = htmlspecialchars($_POST['usuarioID']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $resultado = $dbHandler->deleteUsuario($usuarioID);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
