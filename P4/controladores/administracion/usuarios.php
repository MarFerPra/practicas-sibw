<h3>Usuarios</h3>

<a href="./administracion?item=usuarios&action=add">
  <button id="btn-add-usuario" class="btn-add">
    <i class="fa fa-plus"></i> Crear nuevo usuario
  </button>
</a>

<table id='tabla-admin-usuarios'>
  <tr>
    <th>Acciones</th>
    <th>ID</th>
    <th>Nombre</th>
    <th>Email</th>
    <th>Rol</th>
  </tr>
</table>

<script type="text/javascript">
  (function() {
    fetch("./controladores/api/usuarios/get_all.php", {
      method: "POST"
    })
    .then((response) => {
      if (response.status === 200) {
        return response.json();
      } else {
        alert('Error.');
        return false;
      }
    }).then((data) => {
      if(data) {
        addUsuariosToTable(data);
      }
    });
  })();

  function addUsuariosToTable(data) {
    const usuariosTable = document.getElementById('tabla-admin-usuarios');
    data.forEach((usuario) => {
      usuariosTable.innerHTML += getUsuarioTablaItemHTML(usuario);
    })
  };

  function getUsuarioTablaItemHTML(usuario) {
    return (
      `<tr>
        <td>
          ${editButton('usuarios', usuario.ID)}
          ${deleteButton('usuarios', usuario.ID)}
        </td>
        <td>${usuario.ID}</td>
        <td>${usuario.Nombre}</td>
        <td>${usuario.Email}</td>
        <td>${usuario.Rol}</td>
      </tr>`
    );
  }

</script>
