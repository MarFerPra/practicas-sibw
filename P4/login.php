<!DOCTYPE html>
<html>
  <head>
    <title>GeekLeaks</title>
    <link rel = "stylesheet" type = "text/css" href = "./estilos/comun.css" />
    <link rel = "stylesheet" type = "text/css" href = "./estilos/noticia.css" />
    <link rel = "stylesheet" type = "text/css" href = "./estilos/login.css" />
    <script src="./javascript/cookieHelpers.js"></script>
    <script src="./javascript/getFormData.js"></script>
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

  <script type="text/javascript">
    function loginUsuario(ev) {
      ev.preventDefault();
      var formLogin = new FormData(document.getElementById('login-form'));
      fetch("./controladores/api/usuarios/authenticate.php", {
        method: "POST",
        body: formLogin
      }).then((response) => {
        if (response.status === 200) {
          return response.json();
          alert('Inicio de sesion con exito.');
        } else {
          alert('Error en el inicio de sesion.');
        }
      }).then((data) => {
        setCookie('accessToken', data.accessToken, 7);
        setCookie('usuarioID', data.usuarioID, 7);
      });

      if(typeof limpiarFormulario === 'function') {
        const formItems = [
          'login-form-email',
          'login-form-password'
        ];

        limpiarFormulario(formItems);
      }
    }

    /* Se ejecuta despues de cargar el HTML */
    (function() {
      const btnLogin = document.getElementById('btn-login');
      btnLogin.onclick = loginUsuario;
    })();
  </script>

  </body>
</html>
