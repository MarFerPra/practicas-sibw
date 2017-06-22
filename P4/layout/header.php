<script src="./javascript/loginManager.js"></script>
<script src="./javascript/cookieHelpers.js"></script>

<div id="titulo-periodico">
  <h1> Geek Leaks </h1>
</div>

<ul class="navbar">
  <li><a href="./">Portada</a></li>
  <li><a href="./?seccion=Tecnologia">Tecnologia</a></li>
  <li><a href="./?seccion=Ciencia">Ciencia</a></li>
  <li><a href="./?seccion=Politica">Politica</a></li>
  <li><a href="./?seccion=Economia">Economia</a></li>
  <li class="user-option"><a href="./registro">Registro</a></li>
  <li class="user-option"><a href="./login">Login</a></li>
  <li class="user-option" id="logout-option"><a href="#">Logout</a></li>
  <li class="user-info"><a id="login-info"></a></li>
</ul>

<ul id="admin-menu" class="navbar">
  <li><a href="./administracion?item=noticias">Noticias</a></li>
  <li><a href="./administracion?item=comentarios">Comentarios</a></li>
  <li><a href="./administracion?item=usuarios">Usuarios</a></li>
  <li><a href="./administracion?item=secciones">Secciones</a></li>
  <li><a href="./administracion?item=publicidad">Publicidad</a></li>
</ul>


<script type="text/javascript">
  /* Se ejecuta despues de cargar el HTML */
  (function() {
    const logoutOption = document.getElementById('logout-option');
    logoutOption.onclick = logout;

    if(typeof checkLogin === 'function'){
      checkLogin();
    }
  })();
</script>
