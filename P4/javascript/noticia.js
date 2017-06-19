function toggleComentarios() {
  const botton = document.getElementById('btn-dropdown-comentarios');
  botton.classList.toggle('active');

  const comentarios = document.getElementById('comentarios');
  comentarios.style.maxHeight = comentarios.style.maxHeight ? null : comentarios.scrollHeight + 'px';
}


function getComentarioHtml(autor, fecha, texto) {
  return (
    `<div class="comentario">
        <div class="comentario-autor-fecha">
          <span class="comentario-autor">${autor}</span>
          <span class="comentario-fecha">${fecha}</span>
        </div>
        <span class="comentario-texto">${texto}</span>
      </div>`
  );
}


function formatearFecha(f) {
  const fecha = new Date(f);
  const diaMesAnyo = fecha.getDate() + "-" + fecha.getMonth() + "-" + fecha.getFullYear();
  const horaMinSeg = fecha.getHours() + ":" + fecha.getMinutes() + ":" + fecha.getSeconds();
  return diaMesAnyo + " " + horaMinSeg;
}


function addComentario(ev) {
  ev.preventDefault();

  var formComentario = new FormData(document.getElementById('comentario-form'));
  fetch("./controladores/api/comentarios/add.php", {
    method: "POST",
    body: formComentario
  }).then((response) => {
    if (response.status === 200) {
      const comentarios = document.getElementById('comentarios');
      const autor = document.getElementById('comentario-form-autor');
      const texto = document.getElementById('comentario-form-texto');
      const fechaAhora = formatearFecha(new Date());
      comentarios.innerHTML += getComentarioHtml(autor.value, fechaAhora, texto.value);
      mostrarComentarios();
    } else {
      alert('Error, no estas registrado en el sistema.');
    }
  });

  if(typeof limpiarFormulario === 'function') {
    const formItems = [
      'comentario-form-autor',
      'comentario-form-email',
      'comentario-form-texto'
    ];

    limpiarFormulario(formItems);
  }
}

function mostrarComentarios() {
  const comentarios = document.getElementById('comentarios');
  comentarios.style.maxHeight = comentarios.scrollHeight + 'px';

  const botton = document.getElementById('btn-dropdown-comentarios');
  botton.classList.add('active');
}

function filtrarPalabras(ev) {
  let texto = ev.target.value;

  palabrasProhibidas.forEach((palabra) => {
    if(texto.search(palabra) > -1) {
      texto = texto.replace(palabra, '*'.repeat(palabra.length)); // En ES5 seria: Array(palabra.length + 1).join('*')
    }
  });

  ev.target.value = texto;
}
