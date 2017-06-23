<?php
  include '../../../helpers/db_handler.php';

  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $adminID = htmlspecialchars($_POST['adminID']);
  $nombre = htmlspecialchars($_POST['nombre']);
  $email = htmlspecialchars($_POST['email']);
  $rol = htmlspecialchars($_POST['rol']);
  $password = htmlspecialchars($_POST['password']);
  $accessToken = htmlspecialchars($_POST['tokenAcceso']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $checkLogin = $dbHandler->checkLogin($adminID, $accessToken);
  $accessToken = false;

  if($checkLogin) {
    $accessToken = $dbHandler->editUsuario($usuarioID, $nombre, $email, $password, $rol);
  }

  if($checkLogin && $accessToken) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
