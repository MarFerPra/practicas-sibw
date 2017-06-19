<!DOCTYPE html>
<html>
  <head>
    <title>GeekLeaks</title>
    <link rel = "stylesheet" type = "text/css" href = "./estilos/comun.css" />
    <link rel = "stylesheet" type = "text/css" href = "./estilos/noticia.css" />
    <link rel = "stylesheet" type = "text/css" href = "./estilos/registro.css" />
    <script src="./javascript/limpiarFormulario.js"></script>
  </head>
  <body>

  <?php include './layout/header.php';?>

  <div class="contenedor-general">

    <h2> Registro </h2>
    <div class="contenedor-registro">
      <form id="registro-form" action="">
        <input
          type="text"
          name="nombre"
          class="input"
          id="registro-form-nombre"
          placeholder="Nombre"
        >
        <input
          type="email"
          name="email"
          class="input"
          id="registro-form-email"
          placeholder="Email"
        >
        <input
          type="text"
          name="rol"
          class="input"
          id="registro-form-rol"
          placeholder="Rol"
        >
        <input
         type="password"
         name="password"
         class="input"
         id="registro-form-password"
         placeholder="Password"
        >
        <button id="btn-registro">Registro</button>
      </form>
    </div>
  </div>

  <script type="text/javascript">
    function registrarUsuario(ev) {
      ev.preventDefault();

      var formRegistro = new FormData(document.getElementById('registro-form'));
      fetch("./controladores/api/usuarios/add.php", {
        method: "POST",
        body: formRegistro
      }).then((response) => {
        if (response.status === 200) {
          alert('Registrado con exito.');
        } else {
          alert('Error en el registro de usuario.');
        }
      });

      if(typeof limpiarFormulario === 'function') {
        const formItems = [
          'registro-form-nombre',
          'registro-form-email',
          'registro-form-rol',
          'registro-form-password'
        ];

        limpiarFormulario(formItems);
      }
    }

    /* Se ejecuta despues de cargar el HTML */
    (function() {
      const btnRegistro = document.getElementById('btn-registro');
      btnRegistro.onclick = registrarUsuario;
    })();
  </script>

  </body>
</html>
