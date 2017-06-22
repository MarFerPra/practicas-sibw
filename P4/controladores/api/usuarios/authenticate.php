<?php
  include '../../../helpers/db_handler.php';
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);

  if(!isset($dbHandler)){
    $dbHandler = DatabaseHandler::getInstance();
  }

  $response = $dbHandler->authenticateUser($email, $password);

  if($response['accessToken']) {
    http_response_code(200);
    echo json_encode($response);
  } else {
    http_response_code(401);
  }
?>
