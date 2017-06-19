<?php
  include '../../../helpers/db_handler.php';

  $texto = htmlspecialchars($_POST['texto']);
  $imagen = htmlspecialchars($_POST['imagen']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $resultado = $dbHandler->addPublicidad($texto, $imagen);

  if($resultado) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
