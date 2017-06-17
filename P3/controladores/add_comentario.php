<?php
  include '../helpers/db_handler.php';

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $email = htmlspecialchars($_POST['email']);

  if ($dbHandler->isUser($email)) {
    $autor = htmlspecialchars($_POST['autor']);
    $texto = htmlspecialchars($_POST['texto']);
    $noticia = htmlspecialchars($_POST['noticia']);
    $dirIP = $_SERVER['REMOTE_ADDR'];
    $fecha = date("Y-m-d H:i:s");
    $dbHandler->addComentario($noticia, $dirIP, $autor, $email, $fecha, $texto);
    http_response_code(200);
  } else {
    http_response_code(401);
  }
?>
