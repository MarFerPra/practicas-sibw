<h3>Comentarios</h3>

<table id='tabla-admin-comentarios'>
  <tr>
    <th>ID</th>
    <th>NoticiaID</th>
    <th>DirIp</th>
    <th>Autor</th>
    <th>Email</th>
    <th>FechaHora</th>
    <th>Texto</th>
  </tr>
</table>

<script type="text/javascript">
  (function() {
    fetch("./controladores/api/comentarios/get_all.php", {
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
        addComentariosToTable(data);
      }
    });
  })();

  function addComentariosToTable(data) {
    const comentariosTable = document.getElementById('tabla-admin-comentarios');
    data.forEach((comentario) => {
      comentariosTable.innerHTML += getComentarioTablaItemHTML(comentario);
    })
  };

  function getComentarioTablaItemHTML(comentario) {
    return (
      `<tr>
        <td>${comentario.ID}</td>
        <td>${comentario.NoticiaID}</td>
        <td>${comentario.DirIp}</td>
        <td>${comentario.Autor}</td>
        <td>${comentario.Email}</td>
        <td>${comentario.FechaHora}</td>
        <td>${comentario.Texto}</td>
      </tr>`
    );
  }

</script>
