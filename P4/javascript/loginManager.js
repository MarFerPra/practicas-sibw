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

// Taken from:
// https://stackoverflow.com/questions/22783108/convert-js-object-to-form-data
function getFormData(object) {
    const formData = new FormData();
    Object.keys(object).forEach(key => formData.append(key, object[key]));
    return formData;
}

function logout() {
  deleteCookie('accessToken');
  deleteCookie('usuarioID');
  usuario = null;
  location.reload();
}
