<h3>Usuarios</h3>

<table id='tabla-admin-usuarios'>
  <tr>
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
        <td>${usuario.ID}</td>
        <td>${usuario.Nombre}</td>
        <td>${usuario.Email}</td>
        <td>${usuario.Rol}</td>
      </tr>`
    );
  }

</script>
