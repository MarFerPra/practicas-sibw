<?php
  include '../../../helpers/db_handler.php';
  $comentarioID = htmlspecialchars($_POST['comentarioID']);
  $noticiaID = htmlspecialchars($_POST['noticiaID']);
  $dirIP = htmlspecialchars($_POST['dirIP']);
  $autor = htmlspecialchars($_POST['autor']);
  $email = htmlspecialchars($_POST['email']);
  $fecha = htmlspecialchars($_POST['fecha']);
  $texto = htmlspecialchars($_POST['texto']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $resultado = $dbHandler->editComentario($comentarioID, $noticiaID, $dirIP, $autor, $email, $fecha, $texto);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
