<h3>Publicidad</h3>

<a href="./administracion?item=secciones&action=add">
  <button id="btn-add-secciones" class="btn-add">
    <i class="fa fa-plus"></i> Crear nueva seccion
  </button>
</a>

<table id='tabla-admin-secciones'>
  <tr>
    <th>Acciones</th>
    <th>ID</th>
    <th>Nombre</th>
  </tr>
</table>

<script type="text/javascript">
  (function() {
    fetch("./controladores/api/secciones/get_all.php", {
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
        addSeccionesToTable(data);
      }
    });
  })();

  function addSeccionesToTable(data) {
    const seccionesTable = document.getElementById('tabla-admin-secciones');
    data.forEach((seccion) => {
      seccionesTable.innerHTML += getSeccionTablaItemHTML(seccion);
    })
  };

  function getSeccionTablaItemHTML(seccion) {
    return (
      `<tr>
        <td>
          ${editButton('secciones', seccion.ID)}
          ${deleteButton('secciones', seccion.ID)}
        </td>
        <td>${seccion.ID}</td>
        <td>${seccion.Nombre}</td>
      </tr>`
    );
  }

</script>
