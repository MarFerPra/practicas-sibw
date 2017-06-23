<h2> Seccion: <?php echo $action ?> </h2>
<?php if($itemID){ echo '<h4>ID: '.$itemID.'</h4>'; } ?>
<div class="contenedor-registro">
  <form id="admin-item-form" action="">
    <input
      type="text"
      name="nombre"
      class="input"
      id="form-seccion-nombre"
      placeholder="Nombre"
    >
    <button id="btn-admin">Submit</button>
  </form>
</div>

<script type="text/javascript">
  document.addEventListener('loginFinished', function() {
    const btnAccion = document.getElementById('btn-admin');
    btnAccion.onclick = accionSeccion;

    const itemID = '<?php echo $itemID ?>';

    if(itemID) {
      fetchSeccion(itemID);
    }
  });

  function accionSeccion(ev) {
    ev.preventDefault();
    const accion = '<?php echo $action ?>';
    const seccionID = '<?php echo $itemID ?>';

    const nombre = document.getElementById('form-seccion-nombre').value;

    const accionDataObj = {
      nombre,
      tokenAcceso: usuario && usuario.tokenAcceso,
      usuarioID: usuario && usuario.id
    };

    if(accion === 'edit' && seccionID){
      accionDataObj.seccionID = seccionID;
    }

    const accionData = getFormData(accionDataObj);

    fetch(`./controladores/api/secciones/${accion}.php`, {
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

  function fetchSeccion(seccionID) {
    const accionData = getFormData({
      seccionID,
      tokenAcceso: usuario && usuario.tokenAcceso,
      usuarioID: usuario && usuario.id
    });

    fetch(`./controladores/api/secciones/get.php`, {
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
    }).then((seccion) => {
      document.getElementById('form-seccion-nombre').value = seccion.Nombre;
    });
  }
</script>
