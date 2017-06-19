<?php
  include '../../../helpers/db_handler.php';

  $noticiaID = htmlspecialchars($_POST['$noticiaID']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }
  $noticia = $dbHandler->getNoticia($noticiaID);

  if($noticia) {
    http_response_code(200);
    echo json_encode($noticia);
  } else {
    http_response_code(500);
  }
?>
