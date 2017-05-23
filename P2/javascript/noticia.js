let fechaBase = new Date();
const ayer = fechaBase.setDate(fechaBase.getDate() - 1);
const semanaPasada = fechaBase.setDate(fechaBase.getDate() - 6);

const comentariosPorDefecto = [
  {
    autor: "Arthur Dent",
    fecha: formatearFecha(ayer),
    texto: "There's an infinite number of monkeys who want to talk to us about this script for Hamlet they've worked out."
  },
  {
    autor: "HAL9000",
    fecha: formatearFecha(semanaPasada),
    texto: "I'm sorry Dave, I'm afraid I can't do that."
  }
];

const palabrasProhibidas = [
  'fullstack',
  'devops',
  'agile',
  'php',
  'jquery',
  'koala'
];

function addComentariosPorDefecto() {
    const comentarios = document.getElementById('comentarios');

    if (!comentarios.children.length) {
    comentariosPorDefecto.forEach((comentario) => {
      const { autor, fecha, texto } = comentario;
      comentarios.innerHTML += getComentarioHtml(autor, fecha, texto);
    });
  }
}


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
