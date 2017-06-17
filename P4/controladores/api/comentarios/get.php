<?php
  include '../helpers/db_handler.php';
  $dbHandler = DatabaseHandler::getInstance();
  $noticiaID = htmlspecialchars($_GET['noticiaID']);
  $comentarios = $dbHandler->getComentarios($noticiaID);
  echo json_encode($comentarios);
?>
