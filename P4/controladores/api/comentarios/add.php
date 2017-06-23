<?php
  include '../../../helpers/db_handler.php';

  $email = htmlspecialchars($_POST['Email']);
  $autor = htmlspecialchars($_POST['Autor']);
  $texto = htmlspecialchars($_POST['Texto']);
  $noticia = htmlspecialchars($_POST['NoticiaID']);
  $dirIP = htmlspecialchars($_POST['DirIP']);
  $fecha = date("Y-m-d H:i:s");
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $accessToken = htmlspecialchars($_POST['tokenAcceso']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $checkLogin = $dbHandler->checkLogin($usuarioID, $accessToken);
  $resultado = false;

  if($checkLogin) {
    $resultado = $dbHandler->addComentario($noticia, $dirIP, $autor, $email, $fecha, $texto);
  }

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
