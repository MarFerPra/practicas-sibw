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
  $resultado = $dbHandler->editUsuario($usuarioID, $nombre, $email, $password, $rol);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
