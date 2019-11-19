<?php

require_once("db.php");
require_once("usuario.php");

class DBMySQL extends DB {
	protected $conn;

	public function __construct() {  //VER REGLOG
		$dsn = 'mysql:host=localhost;dbname=danez;
		charset=utf8mb4;port=3306';
		$user ="root";
		$pass = "123456";

		try {
		  $this->conn = new PDO($dsn, $user, $pass);
		} catch (Exception $e) {
		  echo "La conexion a la base de datos falló: " . $e->getMessage();
		}
	}

	function guardarUsuario(Usuario $usuario) {
		$query = $this->conn->prepare("Insert into usuarios values(default, :email, :password,:edad,:pais,:username,:name,:lastName)");

		$query->bindValue(":email", $usuario->getEmail());
		$query->bindValue(":password", $usuario->getPassword());
		//$query->bindValue(":edad", $usuario->getEdad());
		$query->bindValue(":pais", $usuario->getPais());
        $query->bindValue(":username", $usuario->getUsername());
        $query->bindValue(":name", $usuario->getName());
        $query->bindValue(":lastName", $usuario->getlastName());

		$query->execute();

		$id = $this->conn->lastInsertId();
		$usuario->setId($id);

		return $usuario;
	}

	function traerTodos() {
		$query = $this->conn->prepare("Select * from usuarios");
		$query->execute();

		$usuariosFormatoArray = $query->fetchAll();

		$usuariosFormatoClase = [];

		foreach ($usuariosFormatoArray as $usuario) {
			$usuariosFormatoClase[] = new Usuario($usuario["email"], $usuario["password"], $usuario["username"], $usuario["pais"], $usuario["name"], $usuario["lastName"], $usuario["id"]); //$email, $password, $username, $pais, $name, $lastName, $id = null)
		}

		return $usuariosFormatoClase;
	}

	function traerPorMail($email) {
		$query = $this->conn->prepare("Select * from usuarios where email = :email");
		$query->bindValue(":email", $email);

		$query->execute();

		$usuarioFormatoArray = $query->fetch();

		if ($usuarioFormatoArray) {
			$usuario = new Usuario($usuarioFormatoArray["email"], $usuarioFormatoArray["password"], $usuarioFormatoArray["username"], $usuarioFormatoArray["pais"], $usuarioFormatoArray["name"], $usuarioFormatoArray["lastName"], $usuarioFormatoArray["id"]);
			return $usuario;
		} else {
			return NULL;
		}
	}
}

?>