<?php
  include '../../../helpers/db_handler.php';

  $titular = htmlspecialchars($_POST['titular']);
  $subtitulo = htmlspecialchars($_POST['subtitulo']);
  $entradilla = htmlspecialchars($_POST['entradilla']);
  $autor = htmlspecialchars($_POST['autor']);
  $cuerpo = htmlspecialchars($_POST['cuerpo']);
  $fecha = htmlspecialchars($_POST['fecha']);
  $seccion = htmlspecialchars($_POST['seccion']);
  $publicada = htmlspecialchars($_POST['publicada']);
  $principal = htmlspecialchars($_POST['principal']);
  $ultimas = htmlspecialchars($_POST['ultimas']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $resultado = $dbHandler->addNoticia($titular, $subtitulo, $entradilla, $autor, $cuerpo, $fecha, $seccion, $publicada, $principal, $ultimas);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
