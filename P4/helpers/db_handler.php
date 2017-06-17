<?php
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
  // ---------------------------------------------------------------------------
  //                                USUARIOS
  // ---------------------------------------------------------------------------

  public function addUsuario($nombre, $email, $roles) {
    $add_usuario_query = sprintf(
      "INSERT INTO Usuarios (Nombre, Email, Roles)
      VALUES ('%s', '%s', '%s')",
      $nombre, $email, $roles
    );
    $resultado_insertar = mysql_query($add_usuario_query, $this->_connection);
    return $resultado_insertar;
  }

  public function editUsuario($usuarioID, $nombre, $email, $roles) {
    $edit_usuario_query = sprintf(
      "UPDATE Usuarios
       SET Nombre='%s',
           Email='%s',
           Roles='%s'
       WHERE ID='%s'",
       $nombre, $email, $roles, $usuarioID
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

  // ---------------------------------------------------------------------------
  //                                NOTICIAS
  // ---------------------------------------------------------------------------

  public function getNoticia($noticiaID) {
    $noticia_query = mysql_query('SELECT * FROM Noticias WHERE ID='.$noticiaID, $this->_connection);
    return mysql_fetch_array($noticia_query);
  }

  public function addNoticia($titular, $subtitulo, $entradilla, $autor, $cuerpo, $fecha, $seccion, $publicada, $principal, $ultimas) {
    $add_noticia_query = sprintf(
      "INSERT INTO Noticias
      (Titular, Subtitulo, Entradilla, Autor, Cuerpo, Fecha, Seccion, Publicada, Principal, Ultimas)
      VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
      $titular, $subtitulo, $entradilla, $autor, $cuerpo, $fecha, $seccion,
      $publicada, $principal, $ultimas
    );
    $resultado_insertar = mysql_query($add_noticia_query, $this->_connection);
    return $resultado_insertar;
  }

  public function editNoticia($noticiaID, $titular, $subtitulo, $entradilla, $autor, $cuerpo, $fecha, $seccion, $publicada, $principal, $ultimas) {
    $edit_noticia_query = sprintf(
      "UPDATE Noticias
       SET Titular='%s',
           Subtitulo='%s',
           Entradilla='%s',
           Autor='%s',
           Cuerpo='%s',
           Fecha='%s',
           Seccion='%s',
           Publicada='%s',
           Principal='%s',
           Ultimas='%s',
       WHERE ID='%s'",
       $noticiaID, $titular, $subtitulo, $entradilla,
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

  public function getNoticiasSeccion($seccionID) {
    $noticias_seccion_query = mysql_query('SELECT * FROM Noticias WHERE SeccionID='.$seccionID, $this->_connection);
    $noticias_seccion = array();

    while($noticia = mysql_fetch_array($noticias_seccion_query)){
      $noticias_seccion[] = $noticia;
    }
    return $noticias_seccion;
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
  // ---------------------------------------------------------------------------
  //                               COMENTARIOS
  // ---------------------------------------------------------------------------
  public function getComentarios($noticiaID) {
    $comentarios_query = mysql_query('SELECT * FROM Comentarios WHERE NoticiaID='.$noticiaID, $this->_connection);

    $comentarios = array();

    while($comentario = mysql_fetch_array($comentarios_query)){
      $comentarios[] = $comentario;
    }

    return $comentarios;
  }

  public function addComentario($noticiaID, $dirIP, $autor, $email, $fecha, $texto) {
    $add_comentario_query = sprintf(
      "INSERT INTO Comentarios (NoticiaID, DirIP, Autor, Email, FechaHora, Texto)
      VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
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

  public function getSeccion($seccionID) {
    $get_query = mysql_query('SELECT * FROM Secciones WHERE ID='.$seccionID, $this->_connection);
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
