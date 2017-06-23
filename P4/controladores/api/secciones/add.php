<?php
  include '../../../helpers/db_handler.php';

  $nombre = htmlspecialchars($_POST['nombre']);
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $accessToken = htmlspecialchars($_POST['tokenAcceso']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $checkLogin = $dbHandler->checkLogin($usuarioID, $accessToken);
  $resultado = false;

  if($checkLogin) {
    $resultado = $dbHandler->addSeccion($nombre);
  }

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
