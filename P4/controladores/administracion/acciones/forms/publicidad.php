<h2> Publicidad: <?php echo $action ?> </h2>
<?php if($itemID){ echo '<h4>ID: '.$itemID.'</h4>'; } ?>
<div class="contenedor-registro">
  <form id="admin-item-form" action="">
    <input
      type="text"
      name="texto"
      class="input"
      id="form-publicidad-texto"
      placeholder="Texto"
    >
    <input
      type="text"
      name="texto"
      class="input"
      id="form-publicidad-imagen"
      placeholder="Imagen (Nombre del fichero en el servidor)"
    >
    <button id="btn-admin">Submit</button>
  </form>
</div>

<script type="text/javascript">
  document.addEventListener('loginFinished', function() {
    const btnAccion = document.getElementById('btn-admin');
    btnAccion.onclick = accionPublicidad;

    const itemID = '<?php echo $itemID ?>';

    if(itemID) {
      fetchPublicidad(itemID);
    }
  });

  function accionPublicidad(ev) {
    ev.preventDefault();
    const accion = '<?php echo $action ?>';
    const publicidadID = '<?php echo $itemID ?>';

    const texto = document.getElementById('form-publicidad-texto').value;
    const imagen = document.getElementById('form-publicidad-imagen').value;

    const accionDataObj = {
      texto,
      imagen,
      tokenAcceso: usuario && usuario.tokenAcceso,
      usuarioID: usuario && usuario.id
    };

    if(accion === 'edit' && publicidadID){
      accionDataObj.publicidadID = publicidadID;
    }

    const accionData = getFormData(accionDataObj);

    fetch(`./controladores/api/publicidad/${accion}.php`, {
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

  function fetchPublicidad(publicidadID) {
    const accionData = getFormData({
      publicidadID,
      tokenAcceso: usuario && usuario.tokenAcceso,
      usuarioID: usuario && usuario.id
    });

    fetch(`./controladores/api/publicidad/get.php`, {
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
    }).then((publicidad) => {
      console.log(publicidad);
      document.getElementById('form-publicidad-texto').value = publicidad.Texto;
      document.getElementById('form-publicidad-imagen').value = publicidad.Imagen;
    });
  }
</script>
