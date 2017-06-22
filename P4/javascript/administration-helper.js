function editButton(item, itemID) {
  return (
    `
      <a href="./administracion?item=${item}&itemID=${itemID}&action=edit">
        <i class="fa fa-pencil-square-o fa-2x"></i>
      </a>
    `
  )
}

function deleteButton(item, itemID) {
  return (
    `
      <a href="./administracion?item=${item}&itemID=${itemID}&action=delete">
        <i class="fa fa-minus-square-o fa-2x"></i>
      </a>
    `
  )
}
