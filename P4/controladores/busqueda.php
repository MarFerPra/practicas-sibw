<link rel = "stylesheet" type = "text/css" href = "./estilos/portada.css" />

<div class="contenedor-general">
  <h2>Busqueda</h2>

  <div class="search-wrapper">
    <input
      type="text"
      name="nombre"
      class="input"
      id="input-busqueda"
      placeholder="Buscar noticias..."
    >
  </div>

  <div id="lista-noticias">
  </div>

</div>

<script type="text/javascript">
  /* Se ejecuta despues de cargar el HTML */
  (function() {
    const inputBusqueda = document.getElementById('input-busqueda');
    inputBusqueda.onkeyup = accionInputBusqueda;
  })();

  let timer = null;

  function accionInputBusqueda(ev) {
    clearTimeout(timer);
    timer = setTimeout(() => fetchBusqueda(ev.target.value), 750);
  }

  function fetchBusqueda(input) {
    fetch("./controladores/api/noticias/search.php", {
      method: "POST",
      body: getFormData({input})
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
        addNoticiasBusqueda(data);
      }
    });
  }

  function addNoticiasBusqueda(noticias) {
    const listaNoticias = document.getElementById('lista-noticias');
    listaNoticias.innerHTML = '';
    noticias.forEach((noticia) => {
      listaNoticias.innerHTML += getNoticiaHTML(noticia);
    });
  }

  function getNoticiaHTML(noticia) {
    return (
      `<div class="noticia">
        <a href="?noticia=${noticia.ID}">
          <h4>${noticia.Titular}</h4>
        </a>
      </div>`
    );
  }
</script>
