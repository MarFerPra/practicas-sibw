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
  const comentarios = document.getElementById('comentarios');
  const autor = document.getElementById('comentario-form-autor');
  const texto = document.getElementById('comentario-form-texto');
  const fechaAhora = formatearFecha(new Date());

  comentarios.innerHTML += getComentarioHtml(autor.value, fechaAhora, texto.value);

  mostrarComentarios();
  limpiarFormularioComentario();
}

function mostrarComentarios() {
  const comentarios = document.getElementById('comentarios');
  comentarios.style.maxHeight = comentarios.scrollHeight + 'px';

  const botton = document.getElementById('btn-dropdown-comentarios');
  botton.classList.add('active');
}

function limpiarFormularioComentario() {
  const autor = document.getElementById('comentario-form-autor');
  const email = document.getElementById('comentario-form-email');
  const texto = document.getElementById('comentario-form-texto');

  autor.value = "";
  email.value = "";
  texto.value = "";
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
