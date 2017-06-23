<?php
  include '../../../helpers/db_handler.php';

  $comentarioID = htmlspecialchars($_POST['comentarioID']);
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $accessToken = htmlspecialchars($_POST['tokenAcceso']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $checkLogin = $dbHandler->checkLogin($usuarioID, $accessToken);
  $comentario = false;

  if($checkLogin){
    $comentario = $dbHandler->getComentario($comentarioID);
  }

  if($checkLogin && $comentario) {
    http_response_code(200);
    echo json_encode($comentario);
  } else {
    http_response_code(500);
  }
?>
