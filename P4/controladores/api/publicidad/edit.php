<?php
  include '../../../helpers/db_handler.php';

  $publicidadID = htmlspecialchars($_POST['publicidadID']);
  $texto = htmlspecialchars($_POST['texto']);
  $imagen = htmlspecialchars($_POST['imagen']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $resultado = $dbHandler->editPublicidad($publicidadID, $texto, $imagen);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
