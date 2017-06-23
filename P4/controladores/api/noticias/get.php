<?php
  include '../../../helpers/db_handler.php';

  $noticiaID = htmlspecialchars($_POST['noticiaID']);
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $accessToken = htmlspecialchars($_POST['tokenAcceso']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $checkLogin = $dbHandler->checkLogin($usuarioID, $accessToken);
  $noticia = false;

  if($checkLogin){
    $noticia = $dbHandler->getNoticia($noticiaID);
  }

  if($checkLogin && $noticia) {
    http_response_code(200);
    echo json_encode($noticia);
  } else {
    http_response_code(500);
  }
?>
