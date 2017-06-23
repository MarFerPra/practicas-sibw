async function fetchUser(formData) {
  await fetch("./controladores/api/usuarios/checkLogin.php", {
    method: "POST",
    body: formData
  })
  .then((response) => {
    if (response.status === 200) {
      return response.json();
    } else {
      alert('Error autenticando el usuario.');
      return false;
    }
  }).then((data) => {
    usuario = data;
    const loginFinishedEvent = document.createEvent('Event');
    loginFinishedEvent.initEvent('loginFinished', true, true);
    document.dispatchEvent(loginFinishedEvent);
  });
}

let usuario = null;

function checkLogin() {
  const accessToken = getCookie('accessToken');
  const usuarioID = getCookie('usuarioID');
  if(accessToken && usuarioID) {
    const loginData = getFormData({accessToken, usuarioID});
    fetchUser(loginData).then(() => {
      if(usuario) {
        if(usuario.rol == 'admin' || usuario.rol == 'editor_jefe') {
          const adminMenu = document.getElementById('admin-menu');
          adminMenu.style.display = 'block';
        }

        const navBarUserOptions = document.getElementsByClassName('user-option');
        Array.prototype.forEach.call(navBarUserOptions, (elem) => {
          elem.style.display = 'none';
        });

        const navBarUserInfoContainer = document.getElementsByClassName('user-info')[0];
        const navBarUserInfo = document.getElementById('login-info');
        navBarUserInfo.innerHTML = usuario.nombre;
        navBarUserInfoContainer.style.display = 'block';
        const logOutOption = document.getElementById('logout-option');
        logOutOption.style.display = 'block';
      } else {
        deleteCookie('accessToken');
        deleteCookie('usuarioID');
        usuario = null;
      }
    })
  }
}

function logout() {
  deleteCookie('accessToken');
  deleteCookie('usuarioID');
  usuario = null;
  location.reload();
}
