<link rel = "stylesheet" type = "text/css" href = "./estilos/portada.css" />

  <span id='noticia-principal-wrapper'>
  </span>
  <div class="contenedor-general">

    <div id="lista-noticias">

    <h2> Ultimas noticias </h2>

      <div id="noticias-col-izq"></div>

      <div id="noticias-col-centro"></div>

      <div id="noticias-col-der"></div>

    </div>

      <a href="#" id="publicidad-vertical">
        <img src="./imagenes/publicidad.jpg">
      </a>

  </div>


<script type="text/javascript">
  (function() {
    fetch("./controladores/api/noticias/get_tres_columnas.php", {
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
        addNoticiaPrincipal(data.principal);
        addNoticiasToColumnas(data.ultimas);
      }
    });
  })();

  function addNoticiasToColumnas(data) {
    const colIzq = document.getElementById('noticias-col-izq');
    const colDer = document.getElementById('noticias-col-der');
    const colCentro = document.getElementById('noticias-col-centro');
    let indice = 0;
    data.forEach((noticia) => {
      switch (indice) {
        case 0:
          colIzq.innerHTML += getNoticiaHTML(noticia);
          break;
        case 1:
          colCentro.innerHTML += getNoticiaHTML(noticia);
          break;
        case 2:
          colDer.innerHTML += getNoticiaHTML(noticia);
          break;
        default:
          break;
      }
      indice = (indice + 1) % 3;
    })
  };

  function addNoticiaPrincipal(noticia) {
    const noticiaPrincipalWrapper = document.getElementById('noticia-principal-wrapper');
    noticiaPrincipalWrapper.innerHTML += getNoticiaPrincipalHTML(noticia);
  }

  function getNoticiaPrincipalHTML(noticia) {
    return (
      `
      <a href="/P4/?noticia=${noticia.ID}&updateCount=${parseInt(noticia.Num_visitas) + 1}" class="link-noticia">
        <div id="noticia-principal">
          <div id="noticia-principal-titular">
            <h1>${noticia.Titular}</h1>
          </div>
        </div>
      </a>
      `
    );
  }

  function getNoticiaHTML(noticia) {
    return (
      `<div class="noticia">
        <a href="/P4/?noticia=${noticia.ID}&updateCount=${parseInt(noticia.Num_visitas) + 1}">
          <h4>${noticia.Titular}</h4>
        </a>
      </div>`
    );
  }

</script>
