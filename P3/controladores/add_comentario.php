<?php
  include './helpers/db_handler.php';
  $conexion = db_conectar();

  $email = htmlspecialchars($_POST['email']);
  $autor = htmlspecialchars($_POST['autor']);

  $add_comentario_query = "INSERT INTO geekleaks_db.Comentarios(NoticiaID, DirIP, Autor, Email, FechaHora, Texto)
                          VALUES (1, '1.1.1.1', 'Usuario', 'usuario@prueba.com', '2017-01-01 00:00:00', 'Comentario de prueba');";

  $usuario_query = mysql_query('SELECT * FROM Usuarios WHERE Email='.$email.' AND Nombre='.$autor, $conexion);
  if (mysql_num_rows($usuario_query) != 0) {
    $texto = htmlspecialchars($_POST['texto']);
    $noticia = htmlspecialchars($_POST['noticia']);
    $dirIP = $_SERVER['HTTP_CLIENT_IP'];

    $add_comentario_query = "INSERT INTO geekleaks_db.Comentarios(NoticiaID, DirIP, Autor, Email, FechaHora, Texto)
                             VALUES ($noticia, $dirIP, $autor, $email, date("Y-m-d H:i:s"), $texto);";

    $resultado_insertar = mysql_query($add_comentario_query, $conexion);
  }


  db_desconectar($conexion);
?>
