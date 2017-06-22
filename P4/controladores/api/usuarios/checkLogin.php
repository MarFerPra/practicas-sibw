<?php
  include '../../../helpers/db_handler.php';
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $accessToken = htmlspecialchars($_POST['accessToken']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $resultado = $dbHandler->checkLogin($usuarioID, $accessToken);
  if($resultado) {
    http_response_code(200);
    echo json_encode($resultado);
  } else {
    http_response_code(401);
  }
?>
