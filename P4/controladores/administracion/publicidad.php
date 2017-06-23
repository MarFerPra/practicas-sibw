<h3>Publicidad</h3>

<a href="./administracion?item=publicidad&action=add">
  <button id="btn-add-publicidad" class="btn-add">
    <i class="fa fa-plus"></i> Crear nueva publicidad
  </button>
</a>

<table id='tabla-admin-publicidad'>
  <tr>
    <th>Acciones</th>
    <th>ID</th>
    <th>Texto</th>
    <th>Imagen</th>
  </tr>
</table>

<script type="text/javascript">
  (function() {
    fetch("./controladores/api/publicidad/get_all.php", {
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
        addPublicidadToTable(data);
      }
    });
  })();

  function addPublicidadToTable(data) {
    const publicidadTable = document.getElementById('tabla-admin-publicidad');
    data.forEach((publicidad) => {
      publicidadTable.innerHTML += getPublicidadTablaItemHTML(publicidad);
    })
  };

  function getPublicidadTablaItemHTML(publicidad) {
    return (
      `<tr>
        <td>
          ${editButton('publicidad', publicidad.ID)}
          ${deleteButton('publicidad', publicidad.ID)}
        </td>
        <td>${publicidad.ID}</td>
        <td>${publicidad.Texto}</td>
        <td>${publicidad.Imagen}</td>
      </tr>`
    );
  }

</script>
