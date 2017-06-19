<!DOCTYPE html>
<html>
  <head>
    <title>GeekLeaks</title>
    <link rel = "stylesheet" type = "text/css" href = "./estilos/comun.css" />
    <link rel = "stylesheet" type = "text/css" href = "./estilos/noticia.css" />
    <link rel = "stylesheet" type = "text/css" href = "./estilos/login.css" />
    <script src="./javascript/noticia.js"></script>
  </head>
  <body>

  <?php include './layout/header.php';?>

  <?php

  ?>

  <div class="contenedor-general">

    <h2> Login </h2>
    <div class="contenedor-login">
      <form id="login-form" action="" method="POST">
        <input
          type="email"
          name="email"
          class="input"
          id="login-form-email"
          placeholder="Email"
        >
        <input
         type="password"
         name="password"
         class="input"
         id="login-form-password"
         placeholder="Password"
        >
        <button id="btn-login">Login</button>
      </form>
    </div>
  </div>

  </body>
</html>
