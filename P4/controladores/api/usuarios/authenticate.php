<?php
  include '../../../helpers/db_handler.php';
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $nombre = htmlspecialchars($_POST['nombre']);
  $email = htmlspecialchars($_POST['email']);
  $rol = htmlspecialchars($_POST['rol']);
  $password = htmlspecialchars($_POST['password']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $accessToken = $dbHandler->authenticateUser($email, $password);

  if($accessToken) {
    http_response_code(200);
    echo json_encode($accessToken);
  } else {
    http_response_code(401);
  }
?>
