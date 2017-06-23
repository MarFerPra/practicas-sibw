<h2> Noticia: <?php echo $action ?> </h2>
<?php if($itemID){ echo '<h4>ID: '.$itemID.'</h4>'; } ?>
<div class="contenedor-registro">
  <form id="admin-item-form" action="">
    <textarea
      rows="4"
      cols="93"
      name="texto"
      class="input"
      placeholder="Titular"
      id="form-noticia-titular"
    ></textarea>
    <textarea
      rows="4"
      cols="93"
      name="texto"
      class="input"
      placeholder="Subtitulo"
      id="form-noticia-subtitulo"
    ></textarea>
    <textarea
      rows="4"
      cols="93"
      name="texto"
      class="input"
      placeholder="Entradilla"
      id="form-noticia-entradilla"
    ></textarea>
    <input
      type="text"
      name="autor"
      class="input"
      id="form-noticia-autor"
      placeholder="Autor"
    >
    <textarea
      rows="4"
      cols="93"
      name="texto"
      class="input"
      placeholder="Cuerpo"
      id="form-noticia-cuerpo"
    ></textarea>
    <input
      type="text"
      name="seccionID"
      class="input"
      id="form-noticia-seccionID"
      placeholder="ID Seccion"
    >
    <input
      type="text"
      name="publicada"
      class="input"
      id="form-noticia-publicada"
      placeholder="Publicada (0/1)"
    >
    <input
      type="text"
      name="principal"
      class="input"
      id="form-noticia-principal"
      placeholder="Principal (0/1)"
    >
    <input
      type="text"
      name="ultimas"
      class="input"
      id="form-noticia-ultimas"
      placeholder="Ultimas (0/1)"
    >
    <button id="btn-admin">Submit</button>
  </form>
</div>

<script type="text/javascript">
  document.addEventListener('loginFinished', function() {
    const btnAccion = document.getElementById('btn-admin');
    btnAccion.onclick = accionNoticia;

    const itemID = '<?php echo $itemID ?>';

    if(itemID) {
      fetchNoticia(itemID);
    }
  });

  function accionNoticia(ev) {
    ev.preventDefault();
    const accion = '<?php echo $action ?>';
    const noticiaID = '<?php echo $itemID ?>';

    const Titular = document.getElementById('form-noticia-titular').value;
    const Subtitulo = document.getElementById('form-noticia-subtitulo').value;
    const Entradilla = document.getElementById('form-noticia-entradilla').value;
    const Autor = document.getElementById('form-noticia-autor').value;
    const Cuerpo = document.getElementById('form-noticia-cuerpo').value;
    const SeccionID = document.getElementById('form-noticia-seccionID').value;
    const Publicada = document.getElementById('form-noticia-publicada').value;
    const Principal = document.getElementById('form-noticia-principal').value;
    const Ultimas = document.getElementById('form-noticia-ultimas').value;

    const accionDataObj = {
      Titular,
      Subtitulo,
      Entradilla,
      Autor,
      Cuerpo,
      SeccionID,
      Publicada,
      Principal,
      Ultimas,
      tokenAcceso: usuario && usuario.tokenAcceso,
      usuarioID: usuario && usuario.id
    };

    if(accion === 'edit' && noticiaID){
      accionDataObj.noticiaID = noticiaID;
    }

    const accionData = getFormData(accionDataObj);

    fetch(`./controladores/api/noticias/${accion}.php`, {
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

  function fetchNoticia(noticiaID) {
    const accionData = getFormData({
      noticiaID,
      tokenAcceso: usuario && usuario.tokenAcceso,
      usuarioID: usuario && usuario.id
    });

    fetch(`./controladores/api/noticias/get.php`, {
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
    }).then((noticia) => {
      document.getElementById('form-noticia-titular').value = noticia.Titular;
      document.getElementById('form-noticia-subtitulo').value = noticia.Subtitulo;
      document.getElementById('form-noticia-entradilla').value = noticia.Entradilla;
      document.getElementById('form-noticia-autor').value = noticia.Autor;
      document.getElementById('form-noticia-cuerpo').value = noticia.Cuerpo;
      document.getElementById('form-noticia-seccionID').value = noticia.SeccionID;
      document.getElementById('form-noticia-publicada').value = noticia.Publicada;
      document.getElementById('form-noticia-principal').value = noticia.Principal;
      document.getElementById('form-noticia-ultimas').value = noticia.Ultimas;
    });
  }
</script>
