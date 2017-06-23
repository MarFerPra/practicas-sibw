<?php
  include '../../../helpers/db_handler.php';

  $input = htmlspecialchars($_POST['input']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $noticias = $dbHandler->searchNoticias($input);

  if($noticias) {
    http_response_code(200);
    echo json_encode($noticias);
  } else {
    http_response_code(500);
  }
?>
