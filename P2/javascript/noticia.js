let fechaHoy = new Date();
const ayer = fechaHoy.setDate(fechaHoy.getDate() - 1);
const semanaPasada = fechaHoy.setDate(fechaHoy.getDate() - 6);

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


function mostrarComentarios() {
  const botton = document.getElementById('btn-dropdown-comentarios');
  const comentarios = document.getElementById('comentarios');

  if (!comentarios.children.length) {
    comentariosPorDefecto.forEach((comentario) => {
      const { autor, fecha, texto } = comentario;
      comentarios.innerHTML += getComentarioHtml(autor, fecha, texto);
    });
  }

  botton.classList.toggle('active');
  comentarios.style.maxHeight = comentarios.style.maxHeight ? null : comentarios.scrollHeight + 'px';
}


function getComentarioHtml(autor, fecha, texto) {
  return (
    `<div class="comentario">
        <span class="comentario-autor">${autor}</span>
        <span class="comentario-fecha">${fecha}</span>
        <span class="comentario-texto">${texto}</span>
      </div>`
  );
}


function formatearFecha(f) {
  const fecha = new Date(f);
  return fecha.getDate() + "-" + fecha.getMonth() + "-" + fecha.getFullYear();
}


function addComentario() {
  console.log("Add comentario!");
}
