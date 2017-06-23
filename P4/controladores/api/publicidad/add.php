<?php
  include '../../../helpers/db_handler.php';

  $texto = htmlspecialchars($_POST['texto']);
  $imagen = htmlspecialchars($_POST['imagen']);
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $accessToken = htmlspecialchars($_POST['tokenAcceso']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $checkLogin = $dbHandler->checkLogin($usuarioID, $accessToken);
  $resultado = false;

  if($checkLogin) {
    $resultado = $dbHandler->addPublicidad($texto, $imagen);
  }

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
