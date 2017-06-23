<?php
  include '../../../helpers/db_handler.php';

  $titular = htmlspecialchars($_POST['Titular']);
  $subtitulo = htmlspecialchars($_POST['Subtitulo']);
  $entradilla = htmlspecialchars($_POST['Entradilla']);
  $autor = htmlspecialchars($_POST['Autor']);
  $cuerpo = htmlspecialchars($_POST['Cuerpo']);
  $fecha = date("Y-m-d H:i:s");
  $seccion = htmlspecialchars($_POST['SeccionID']);
  $publicada = htmlspecialchars($_POST['Publicada']);
  $principal = htmlspecialchars($_POST['Principal']);
  $ultimas = htmlspecialchars($_POST['Ultimas']);
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $accessToken = htmlspecialchars($_POST['tokenAcceso']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $checkLogin = $dbHandler->checkLogin($usuarioID, $accessToken);
  $resultado = false;

  if($checkLogin) {
    $resultado = $dbHandler->addNoticia($titular, $subtitulo, $entradilla, $autor, $cuerpo, $fecha, $seccion, $publicada, $principal, $ultimas);
  }

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
