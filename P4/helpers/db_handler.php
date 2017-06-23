<?php
  // error_log(print_r($variable, TRUE));
  class DatabaseHandler {

	private $_connection;
	private static $_instance;
  private $_host = "localhost"; // TODO: Put sensible info in config file.
	private $_username = "marcofp";
	private $_password = "marcofp";
	private $_database = "geekleaks_db";

	public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __construct() {
		$this->_connection = mysql_connect ($this->_host, $this->_username, $this->_password);
    mysql_select_db ($this->_database, $this->_connection);
	}

  public function __destruct() {
    mysql_close($this->_connection);
  }

	private function __clone() { }

	public function getConnection() {
		return $this->_connection;
	}

  // TODO: Refactor long parameters in functions using hashes/objects.
  // TODO: Cipher passwords with strong crypto and salt.
  // ---------------------------------------------------------------------------
  //                                USUARIOS
  // ---------------------------------------------------------------------------

  public function getUsuarioByEmail($email) {
    $get_usuario_query = sprintf(
      "SELECT * FROM Usuarios WHERE Email='%s'", $email
    );
    $query = mysql_query($get_usuario_query, $this->_connection);
    return mysql_fetch_array($query);
  }

  public function getUsuarios() {
    $usuarios_query = mysql_query('SELECT * FROM Usuarios', $this->_connection);
    $usuarios = array();

    if (mysql_num_rows($usuarios_query) != 0) {
      while($usuario = mysql_fetch_array($usuarios_query)) {
        $usuarios[] = $usuario;
      }
    }
    return $usuarios;
  }

  public function getUsuario($usuarioID) {
    $query = mysql_query('SELECT * FROM Usuarios WHERE ID='.$usuarioID, $this->_connection);
    return mysql_fetch_array($query);
  }

  public function addUsuario($nombre, $email, $password, $rol) {
    $hashed_password = hash('sha256', $password);
    $accessToken = $this->generateAccessToken($email, $hashed_password);
    $add_usuario_query = sprintf(
      "INSERT INTO Usuarios (Nombre, Password, Email, Rol, TokenAcceso)
      VALUES ('%s', '%s', '%s', '%s', '%s')",
      $nombre, $hashed_password, $email, $rol, $accessToken
    );
    $resultado_insertar = mysql_query($add_usuario_query, $this->_connection);
    if($resultado_insertar) {
      return $accessToken;
    } else {
      return false;
    }
  }

  public function editUsuario($usuarioID, $nombre, $password, $email, $rol) {
    $hashed_password = hash('sha256', $password);
    $edit_usuario_query = sprintf(
      "UPDATE Usuarios
       SET Nombre='%s',
           Password='%s',
           Email='%s',
           Rol='%s'
       WHERE ID='%s'",
       $nombre, $hashed_password, $email, $rol, $usuarioID
    );
    $resultado_editar = mysql_query($edit_usuario_query, $this->_connection);
    return $resultado_editar;
  }

  public function deleteUsuario($usuarioID) {
    $delete_usuario_query = sprintf("DELETE FROM Usuarios WHERE ID='%s'", $usuarioID);
    $resultado_delete = mysql_query($delete_usuario_query, $this->_connection);
    return $resultado_delete;
  }

  public function isUser($email) {
    $is_user_query = sprintf("SELECT * FROM Usuarios WHERE Email='%s'", $email);
    $usuario_query = mysql_query($is_user_query, $this->_connection);
    return (mysql_num_rows($usuario_query) != 0);
  }

  public function authenticateUser($email, $password) {
    $user_query = sprintf("SELECT * FROM Usuarios WHERE Email='%s'", $email);
    $usuario_query = mysql_query($user_query, $this->_connection);

    $user = mysql_fetch_array($usuario_query);
    $hashed_password = hash('sha256', $password);

    if(mysql_num_rows($usuario_query) != 0 && $hashed_password == $user[2]) {
      $accessToken = $this->generateAccessToken($email, $hashed_password);

      $add_token_query = sprintf(
        "UPDATE Usuarios
         SET TokenAcceso='%s'
         WHERE Email='%s'",
         $accessToken, $email
      );
      $resultado_query = mysql_query($add_token_query, $this->_connection);

      $usuario = $this->getUsuarioByEmail($email);
      $respuesta['usuarioID'] = $usuario[0];
      $respuesta['accessToken'] = $accessToken;
      return $respuesta;
    }

    return false;
  }

  public function removeAccessToken($usuarioID) {
    $token_query = sprintf(
      "UPDATE Usuarios
       SET TokenAcceso='%s'
       WHERE ID='%s'",
       '-', $usuarioID
    );
    $resultado_query = mysql_query($token_query, $this->_connection);
    return $resultado_query;
  }

  public function checkLogin($usuarioID, $accessToken) {

    if($usuarioID && $accessToken) {
      $usuario = $this->getUsuario($usuarioID);
      if($usuario[5] == $accessToken) {
        $resultado['id'] = $usuario[0];
        $resultado['nombre'] = $usuario[1];
        $resultado['email'] = $usuario[3];
        $resultado['rol'] = $usuario[4];
        $resultado['tokenAcceso'] = $usuario[5];
        return $resultado;
      }
    }
    return false;
  }

  public function generateAccessToken($email, $hashed_password) {
    return hash('sha256', $email.$hashed_password.strval((rand(1, 1000000))));
  }

  // ---------------------------------------------------------------------------
  //                                NOTICIAS
  // ---------------------------------------------------------------------------

  public function getNoticia($noticiaID) {
    $noticia_query = mysql_query('SELECT * FROM Noticias WHERE ID='.$noticiaID, $this->_connection);
    return mysql_fetch_array($noticia_query);
  }

  public function addNoticia($titular, $subtitulo, $entradilla, $autor, $cuerpo, $fecha, $seccion, $publicada, $principal, $ultimas) {
    $add_noticia_query = sprintf(
      "INSERT INTO Noticias (Titular, Subtitulo, Entradilla, Autor, Cuerpo, Fecha, SeccionID, Publicada, Principal, Ultimas) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
      $titular, $subtitulo, $entradilla, $autor, $cuerpo, $fecha, $seccion, $publicada, $principal, $ultimas
    );
    $resultado_insertar = mysql_query($add_noticia_query, $this->_connection);
    return $resultado_insertar;
  }

  public function editNoticia($noticiaID, $titular, $subtitulo, $entradilla, $autor, $cuerpo, $fecha, $seccion, $publicada, $principal, $ultimas) {
    $edit_noticia_query = sprintf(
      "UPDATE Noticias SET Titular='%s', Subtitulo='%s', Entradilla='%s', Autor='%s', Cuerpo='%s', Fecha='%s', SeccionID='%s', Publicada='%s', Principal='%s', Ultimas='%s' WHERE ID='%s'",
       $titular, $subtitulo, $entradilla,
       $autor, $cuerpo, $fecha, $seccion, $publicada,
       $principal, $ultimas, $noticiaID
    );
    $resultado_editar = mysql_query($edit_noticia_query, $this->_connection);
    return $resultado_editar;
  }

  public function deleteNoticia($noticiaID) {
    $delete_noticia_query = sprintf("DELETE FROM Noticias WHERE ID='%s'", $noticiaID);
    $resultado_delete = mysql_query($delete_noticia_query, $this->_connection);
    return $resultado_delete;
  }

  public function getNoticiasSeccion($nombreSeccion) {
    $seccion = $this->getSeccionByNombre($nombreSeccion);
    $noticias_seccion_query = mysql_query('SELECT * FROM Noticias WHERE SeccionID='.$seccion[0], $this->_connection);
    $noticias_seccion = array();

    if (mysql_num_rows($noticias_seccion_query) != 0) {
      while($noticia = mysql_fetch_array($noticias_seccion_query)) {
        $noticias_seccion[] = $noticia;
      }
    }
    return $noticias_seccion;
  }

  public function getNoticias() {
    $noticias_query = mysql_query('SELECT * FROM Noticias', $this->_connection);
    $noticias = array();

    if (mysql_num_rows($noticias_query) != 0) {
      while($noticia = mysql_fetch_array($noticias_query)) {
        $noticias[] = $noticia;
      }
    }
    return $noticias;
  }

  public function setEstadoNoticia($noticiaID, $publicada) {
    $edit_noticia_query = sprintf(
      "UPDATE Noticias
       SET Publicada='%s'
       WHERE ID='%s'",
       $publicada, $noticiaID
    );
    $resultado_editar = mysql_query($edit_noticia_query, $this->_connection);
    return $resultado_editar;
  }

  public function getNoticiaPrincipal() {
    $noticia_principal_query = mysql_query('SELECT * FROM Noticias WHERE principal=true', $this->_connection);
    return mysql_fetch_array($noticia_principal_query);
  }

  public function getUltimasNoticias() {
    $ultimas_noticias_query = mysql_query('SELECT * FROM Noticias WHERE ultimas=true', $this->_connection);
    $ultimas_noticias = array();

    while($noticia = mysql_fetch_array($ultimas_noticias_query)){
      $ultimas_noticias[] = $noticia;
    }
    return $ultimas_noticias;
  }

  public function searchNoticias($input) {
    $query_string = "SELECT * FROM Noticias WHERE Titular like '%".$input."%';";
    error_log(print_r($query_string, TRUE));
    $query = mysql_query($query_string, $this->_connection);
    $noticias = array();

    while($noticia = mysql_fetch_array($query)){
      $noticias[] = $noticia;
    }
    return $noticias;
  }
  // ---------------------------------------------------------------------------
  //                               COMENTARIOS
  // ---------------------------------------------------------------------------
  public function getComentariosNoticia($noticiaID) {
    $comentarios_query = mysql_query('SELECT * FROM Comentarios WHERE NoticiaID='.$noticiaID, $this->_connection);

    $comentarios = array();

    while($comentario = mysql_fetch_array($comentarios_query)){
      $comentarios[] = $comentario;
    }

    return $comentarios;
  }

  public function getComentarios() {
    $comentarios_query = mysql_query('SELECT * FROM Comentarios', $this->_connection);
    $comentarios = array();
    while($comentario = mysql_fetch_array($comentarios_query)){
      $comentarios[] = $comentario;
    }
    return $comentarios;
  }

  public function getComentario($comentarioID) {
    $query = mysql_query('SELECT * FROM Comentarios WHERE ID='.$comentarioID, $this->_connection);
    return mysql_fetch_array($query);
  }

  public function addComentario($noticiaID, $dirIP, $autor, $email, $fecha, $texto) {
    $add_comentario_query = sprintf(
      "INSERT INTO Comentarios (NoticiaID, DirIP, Autor, Email, FechaHora, Texto) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
      $noticiaID, $dirIP, $autor, $email, $fecha, $texto
    );
    $resultado_insertar = mysql_query($add_comentario_query, $this->_connection);
    return $resultado_insertar;
  }

  public function editComentario($comentarioID, $noticiaID, $dirIP, $autor, $email, $fecha, $texto) {
    $edit_comentario_query = sprintf(
      "UPDATE Comentarios
       SET NoticiaID='%s', DirIP='%s',
           Autor='%s', Email='%s',
           FechaHora='%s', Texto='%s'
       WHERE ID='%s'",
       $noticiaID, $dirIP, $autor, $email, $fecha, $texto, $comentarioID
    );
    $resultado_editar = mysql_query($edit_comentario_query, $this->_connection);
    return $resultado_editar;
  }

  public function deleteComentario($comentarioID) {
    $delete_comentario_query = sprintf("DELETE FROM Comentarios WHERE ID='%s'", $comentarioID);
    $resultado_delete = mysql_query($delete_comentario_query, $this->_connection);
    return $resultado_delete;
  }

  // ---------------------------------------------------------------------------
  //                               PUBLICIDAD
  // ---------------------------------------------------------------------------

  public function addPublicidad($texto, $imagen) {
    $add_publicidad_query = sprintf(
      "INSERT INTO Publicidad (Texto, Imagen)
      VALUES ('%s', '%s')",
      $texto, $imagen
    );
    $resultado_insertar = mysql_query($add_publicidad_query, $this->_connection);
    return $resultado_insertar;
  }

  public function getAllPublicidad() {
    $query = mysql_query('SELECT * FROM Publicidad', $this->_connection);
    $resultado = array();
    while($item = mysql_fetch_array($query)){
      $resultado[] = $item;
    }
    return $resultado;
  }

  public function deletePublicidad($publicidadID) {
    $delete_publicidad_query = sprintf("DELETE FROM Publicidad WHERE ID='%s'", $publicidadID);
    $resultado_delete = mysql_query($delete_publicidad_query, $this->_connection);
    return $resultado_delete;
  }

  public function editPublicidad($publicidadID, $texto, $imagen) {
    $edit_query = sprintf(
      "UPDATE Publicidad
       SET Texto='%s',
           Imagen='%s'
       WHERE ID='%s'",
       $texto, $imagen, $publicidadID
    );
    $resultado_editar = mysql_query($edit_query, $this->_connection);
    return $resultado_editar;
  }

  public function getPublicidad($publicidadID) {
    $get_query = mysql_query('SELECT * FROM Publicidad WHERE ID='.$publicidadID, $this->_connection);
    return mysql_fetch_array($get_query);
  }

  // ---------------------------------------------------------------------------
  //                               SECCIONES
  // ---------------------------------------------------------------------------

  public function addSeccion($nombre) {
    $add_seccion_query = sprintf(
      "INSERT INTO Secciones (Nombre)
      VALUES ('%s')", $nombre
    );
    $resultado_insertar = mysql_query($add_seccion_query, $this->_connection);
    return $resultado_insertar;
  }

  public function getSecciones() {
    $query = mysql_query('SELECT * FROM Secciones', $this->_connection);
    $resultado = array();
    while($item = mysql_fetch_array($query)){
      $resultado[] = $item;
    }
    return $resultado;
  }

  public function deleteSeccion($seccionID) {
    $delete_secciones_query = sprintf("DELETE FROM Secciones WHERE ID='%s'", $seccionID);
    $resultado_delete = mysql_query($delete_secciones_query, $this->_connection);
    return $resultado_delete;
  }

  public function editSeccion($seccionID, $nombre) {
    $edit_query = sprintf(
      "UPDATE Secciones
       SET Nombre='%s'
       WHERE ID='%s'",
       $nombre, $seccionID
    );
    $resultado_editar = mysql_query($edit_query, $this->_connection);
    return $resultado_editar;
  }

  public function getSeccionByNombre($nombreSeccion) {
    $get_string = sprintf("SELECT * FROM Secciones WHERE Nombre='%s'", $nombreSeccion);
    $get_query = mysql_query($get_string, $this->_connection);
    return mysql_fetch_array($get_query);
  }

  public function getSeccion($seccionID) {
    $get_string = sprintf("SELECT * FROM Secciones WHERE ID='%s'", $seccionID);
    $get_query = mysql_query($get_string, $this->_connection);
    return mysql_fetch_array($get_query);
  }

  // ---------------------------------------------------------------------------
  //                          PALABRAS PROHIBIDAS
  // ---------------------------------------------------------------------------

  public function getPalabrasProhibidas() {
    $palabras_prohibidas_query = mysql_query('SELECT Valor FROM PalabrasProhibidas', $this->_connection);

    $palabras_prohibidas = array();

    while($palabra = mysql_fetch_array($palabras_prohibidas_query)){
      $palabras_prohibidas[] = $palabra;
    }

    return $palabras_prohibidas;
  }
}
?>
