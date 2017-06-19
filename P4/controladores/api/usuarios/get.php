<?php
  include '../../../helpers/db_handler.php';

  $usuarioID = htmlspecialchars($_POST['usuarioID']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $usuario = $dbHandler->getUsuario($usuarioID);

  if($usuario) {
    http_response_code(200);
    echo json_encode($usuario);
  } else {
    http_response_code(500);
  }
?>
