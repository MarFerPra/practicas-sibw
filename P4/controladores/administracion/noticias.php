<h3>Noticias</h3>

<a href="./administracion?item=noticias&action=add">
  <button id="btn-add-noticia" class="btn-add">
    <i class="fa fa-plus"></i> Crear nueva noticia
  </button>
</a>

<table id='tabla-admin-noticias'>
  <tr>
    <th>Acciones</th>
    <th>ID</th>
    <th>Titular</th>
    <th>Subtitulo</th>
    <th>Entradilla</th>
    <th>Autor</th>
    <th>Cuerpo</th>
    <th>Fecha</th>
    <th>SeccionID</th>
    <th>Publicada</th>
    <th>Principal</th>
    <th>Ultimas</th>
  </tr>
</table>

<script type="text/javascript">
  (function() {
    fetch("./controladores/api/noticias/get_all.php", {
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
        addNoticiasToTable(data);
      }
    });
  })();

  function addNoticiasToTable(data) {
    const noticiasTable = document.getElementById('tabla-admin-noticias');
    data.forEach((noticia) => {
      noticiasTable.innerHTML += getNoticiaTablaItemHTML(noticia);
    })
  };

  function getNoticiaTablaItemHTML(noticia) {
    return (
      `<tr>
        <td>
          ${editButton('noticias', noticia.ID)}
          ${deleteButton('noticias', noticia.ID)}
        </td>
        <td>${noticia.ID}</td>
        <td>${truncateText(noticia.Titular)}</td>
        <td>${truncateText(noticia.Subtitulo)}</td>
        <td>${truncateText(noticia.Entradilla)}</td>
        <td>${noticia.Autor}</td>
        <td>${truncateText(noticia.Cuerpo)}</td>
        <td>${noticia.Fecha}</td>
        <td>${noticia.SeccionID}</td>
        <td>${noticia.Publicada}</td>
        <td>${noticia.Principal}</td>
        <td>${noticia.Ultimas}</td>
      </tr>`
    );
  }

</script>
