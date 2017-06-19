<?php
  include '../../../helpers/db_handler.php';
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $accessToken = htmlspecialchars($_POST['accessToken']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $resultado = $dbHandler->checkAcessToken($usuarioID, $accessToken);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(401);
  }
?>
