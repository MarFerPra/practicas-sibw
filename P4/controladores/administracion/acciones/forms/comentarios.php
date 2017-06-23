<h2> Comentario: <?php echo $action ?> </h2>
<?php if($itemID){ echo '<h4>ID: '.$itemID.'</h4>'; } ?>
<div class="contenedor-registro">
  <form id="admin-item-form" action="">
    <input
      type="text"
      name="noticiaID"
      class="input"
      id="form-comentario-noticiaID"
      placeholder="ID de Noticia"
    >
    <input
      type="text"
      name="dirIP"
      class="input"
      id="form-comentario-dirIP"
      placeholder="Direccion IP"
    >
    <input
      type="text"
      name="autor"
      class="input"
      id="form-comentario-autor"
      placeholder="Autor"
    >
    <input
      type="text"
      name="email"
      class="input"
      id="form-comentario-email"
      placeholder="Email"
    >
    <textarea
      rows="4"
      cols="93"
      name="texto"
      class="input"
      placeholder="Texto"
      id="form-comentario-texto"
    ></textarea>
    <button id="btn-admin">Submit</button>
  </form>
</div>

<script type="text/javascript">
  document.addEventListener('loginFinished', function() {
    const btnAccion = document.getElementById('btn-admin');
    btnAccion.onclick = accionComentario;

    const itemID = '<?php echo $itemID ?>';

    if(itemID) {
      fetchComentario(itemID);
    }
  });

  function accionComentario(ev) {
    ev.preventDefault();
    const accion = '<?php echo $action ?>';
    const comentarioID = '<?php echo $itemID ?>';

    const NoticiaID = document.getElementById('form-comentario-noticiaID').value;
    const DirIP = document.getElementById('form-comentario-dirIP').value;
    const Autor = document.getElementById('form-comentario-autor').value;
    const Email = document.getElementById('form-comentario-email').value;
    const Texto = document.getElementById('form-comentario-texto').value;

    const accionDataObj = {
      NoticiaID,
      DirIP,
      Autor,
      Email,
      Texto,
      tokenAcceso: usuario && usuario.tokenAcceso,
      usuarioID: usuario && usuario.id
    };

    if(accion === 'edit' && comentarioID){
      accionDataObj.ComentarioID = comentarioID;
    }

    const accionData = getFormData(accionDataObj);

    fetch(`./controladores/api/comentarios/${accion}.php`, {
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

  function fetchComentario(comentarioID) {
    const accionData = getFormData({
      comentarioID,
      tokenAcceso: usuario && usuario.tokenAcceso,
      usuarioID: usuario && usuario.id
    });

    fetch(`./controladores/api/comentarios/get.php`, {
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
    }).then((comentario) => {
      document.getElementById('form-comentario-noticiaID').value = comentario.NoticiaID;
      document.getElementById('form-comentario-dirIP').value = comentario.DirIP;
      document.getElementById('form-comentario-autor').value = comentario.Autor;
      document.getElementById('form-comentario-email').value = comentario.Email;
      document.getElementById('form-comentario-texto').value = comentario.Texto;
    });
  }
</script>
