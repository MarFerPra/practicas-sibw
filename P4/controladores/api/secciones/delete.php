<?php
  include '../../../helpers/db_handler.php';

  $itemID = htmlspecialchars($_POST['itemID']);
  $usuarioID = htmlspecialchars($_POST['usuarioID']);
  $accessToken = htmlspecialchars($_POST['tokenAcceso']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $checkLogin = $dbHandler->checkLogin($usuarioID, $accessToken);

  if($checkLogin && $dbHandler->deleteSeccion($itemID)) {
    http_response_code(200);
  } else {
    http_response_code(500);
  }
?>
