<link rel = "stylesheet" type = "text/css" href = "./estilos/portada.css" />

  <div class="contenedor-general">
    <div id="lista-noticias">
      <h2>
        Seccion: <?php echo $_GET['seccion'] ?>
      </h2>
    </div>
      <a href="#" id="publicidad-vertical">
        <img src="./imagenes/publicidad.jpg">
      </a>
  </div>

  <script type="text/javascript">
    (function() {
      const nombreSeccionData = getFormData({ seccion: '<?php echo $_GET['seccion'] ?>'});
      fetch("./controladores/api/noticias/get_seccion.php", {
        method: "POST",
        body: nombreSeccionData
      })
      .then((response) => {
        if (response.status === 200) {
          return response.json();
        } else {
          return false;
        }
      }).then((data) => {
        if(data) {
          addNoticiasSeccion(data);
        }
      });
    })();

    function addNoticiasSeccion(data) {
      const listaNoticias = document.getElementById('lista-noticias');
      data.forEach((noticia, index) => {
        if(index === 0) {
          listaNoticias.innerHTML += getNoticiaHTML(noticia);
        } else if(index === 1) {
          listaNoticias.innerHTML += '<div id="col-izq"></div>';
          const colIzq = document.getElementById('col-izq');
          colIzq.innerHTML += getNoticiaHTML(noticia);
        } else if(index > 1 && index < 5 ) {
          const colIzq = document.getElementById('col-izq');
          colIzq.innerHTML += getNoticiaHTML(noticia);
        } else if(index === 5) {
          listaNoticias.innerHTML += '<div id="col-der"></div>';
          const colDer = document.getElementById('col-der');
          colDer.innerHTML += getNoticiaHTML(noticia);
        } else if(index > 5 && index < 9) {
          const colDer = document.getElementById('col-der');
          colDer.innerHTML += getNoticiaHTML(noticia);
        }
      })
    };

    function getNoticiaHTML(noticia) {
      return (
        `<div class="noticia">
          <a href="?noticia=${noticia.ID}">
            <h4>${noticia.Titular}</h4>
          </a>
        </div>`
      );
    }

    function getFormData(object) {
        const formData = new FormData();
        Object.keys(object).forEach(key => formData.append(key, object[key]));
        return formData;
    }

  </script>
