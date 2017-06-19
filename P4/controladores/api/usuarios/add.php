<?php
  include '../../../helpers/db_handler.php';
  $nombre = htmlspecialchars($_POST['nombre']);
  $email = htmlspecialchars($_POST['email']);
  $rol = htmlspecialchars($_POST['rol']);
  $password = htmlspecialchars($_POST['password']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $accessToken = $dbHandler->addUsuario($nombre, $email, $password, $rol);

  if($accessToken) {
    http_response_code(200);
    echo json_encode($accessToken);
  } else {
    http_response_code(500);
  }
?>
