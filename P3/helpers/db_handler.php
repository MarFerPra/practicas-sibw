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

  public function getNoticia($noticiaID) {
    $noticia_query = mysql_query('SELECT * FROM Noticias WHERE ID='.$noticiaID, $this->_connection);
    return mysql_fetch_array($noticia_query);
  }

  public function getComentarios($noticiaID) {
    $comentarios_query = mysql_query('SELECT * FROM Comentarios WHERE NoticiaID='.$noticiaID, $this->_connection);

    $comentarios = array();

    while($comentario = mysql_fetch_array($comentarios_query)){
      $comentarios[] = $comentario;
    }

    return $comentarios;
  }

  public function getPalabrasProhibidas() {
    $palabras_prohibidas_query = mysql_query('SELECT Valor FROM PalabrasProhibidas', $this->_connection);

    $palabras_prohibidas = array();

    while($palabra = mysql_fetch_array($palabras_prohibidas_query)){
      $palabras_prohibidas[] = $palabra;
    }

    return $palabras_prohibidas;
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

  public function isUser($email) {
    $is_user_query = sprintf("SELECT * FROM Usuarios WHERE Email='%s'", $email);
    $usuario_query = mysql_query($is_user_query, $this->_connection);
    return (mysql_num_rows($usuario_query) != 0);
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
}
?>
