<script type="text/javascript">
  document.addEventListener('loginFinished', function() {
    const item = '<?php echo $item ?>';
    const itemID = '<?php echo $itemID ?>';
    const deleteData = getFormData({
      itemID: itemID,
      tokenAcceso: usuario && usuario.tokenAcceso,
      usuarioID: usuario && usuario.id
    })
    fetch(`./controladores/api/${item}/delete.php`, {
      method: "POST",
      body: deleteData
    })
    .then((response) => {
      if (response.status === 200) {
        alert('Borrado correctamente.');
        return true;
      } else {
        alert('Error.');
        return false;
      }
    })
  });
</script>
