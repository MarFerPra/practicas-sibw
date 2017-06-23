<h2> Usuario: <?php echo $action ?> </h2>
<?php if($itemID){ echo '<h4>ID: '.$itemID.'</h4>'; } ?>
<div class="contenedor-registro">
  <form id="admin-item-form" action="">
    <input
      type="text"
      name="nombre"
      class="input"
      id="form-usuario-nombre"
      placeholder="Nombre"
    >
    <input
      type="text"
      name="email"
      class="input"
      id="form-usuario-email"
      placeholder="Email"
    >
    <input
      type="text"
      name="password"
      class="input"
      id="form-usuario-password"
      placeholder="Password"
    >
    <input
      type="text"
      name="rol"
      class="input"
      id="form-usuario-rol"
      placeholder="Rol"
    >
    <button id="btn-admin">Submit</button>
  </form>
</div>

<script type="text/javascript">
  document.addEventListener('loginFinished', function() {
    const btnAccion = document.getElementById('btn-admin');
    btnAccion.onclick = accionUsuario;

    const itemID = '<?php echo $itemID ?>';

    if(itemID) {
      fetchUsuario(itemID);
    }
  });

  function accionUsuario(ev) {
    ev.preventDefault();
    const accion = '<?php echo $action ?>';
    const usuarioID = '<?php echo $itemID ?>';

    const nombre = document.getElementById('form-usuario-nombre').value;
    const email = document.getElementById('form-usuario-email').value;
    const password = document.getElementById('form-usuario-password').value;
    const rol = document.getElementById('form-usuario-rol').value;

    const accionDataObj = {
      nombre,
      email,
      password,
      rol,
      tokenAcceso: usuario && usuario.tokenAcceso,
      adminID: usuario && usuario.id
    };

    if(accion === 'edit' && usuarioID){
      accionDataObj.usuarioID = usuarioID;
    }

    const accionData = getFormData(accionDataObj);

    fetch(`./controladores/api/usuarios/${accion}.php`, {
      method: "POST",
      body: accionData
    })
    .then((response) => {
      if (response.status === 200) {
        alert('Accion realizada correctamente.');
        return true;
      } else {
        alert('Error.');
        return false;
      }
    });
  }

  function fetchUsuario(usuarioID) {
    const accionData = getFormData({
      usuarioID,
      tokenAcceso: usuario && usuario.tokenAcceso,
      adminID: usuario && usuario.id
    });

    fetch(`./controladores/api/usuarios/get.php`, {
      method: "POST",
      body: accionData
    })
    .then((response) => {
      if (response.status === 200) {
        return response.json();
      } else {
        alert('Error.');
        return false;
      }
    }).then((usuario) => {
      document.getElementById('form-usuario-nombre').value = usuario.Nombre;
      document.getElementById('form-usuario-email').value = usuario.Email;
      document.getElementById('form-usuario-password').value = usuario.Password;
      document.getElementById('form-usuario-rol').value = usuario.Rol;
    });
  }
</script>
