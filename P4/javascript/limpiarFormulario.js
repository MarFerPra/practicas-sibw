function limpiarFormulario(formItems) {
  formItems.forEach((itemId) => {
    const item = document.getElementById(itemId);
    item.value = "";
  });
};
