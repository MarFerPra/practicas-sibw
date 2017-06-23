<?php
  include '../../../helpers/db_handler.php';

  $nombre = htmlspecialchars($_POST['nombre']);
  $seccionID = htmlspecialchars($_POST['seccionID']);
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $accessToken = htmlspecialchars($_POST['tokenAcceso']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $checkLogin = $dbHandler->checkLogin($usuarioID, $accessToken);
  $resultado = false;

  if($checkLogin) {
    $resultado = $dbHandler->editSeccion($seccionID, $nombre);
  }

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
