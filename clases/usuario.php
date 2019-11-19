<?php

class Usuario {
	protected $id;
	protected $email;
	protected $password;
	protected $username;
	protected $pais;
    protected $name;
    protected $lastName;

    public function __construct($email, $password, $username, $pais, $name, $lastName, $id = null)
    {
		if ($id == null) {
			$this->password = password_hash($password, PASSWORD_DEFAULT);
		}
		else {
			$this->password = $password;
		}

		$this->id = $id;
		$this->email = $email;
		$this->username = $username;
        $this->pais = $pais;
        $this->name=$name;
        $this->lastName=$lastName;
	}
    //GET SET NAME
    public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
    }
    //GET SET LAST NAME
    public function getlastName() {
		return $this->lastame;
	
    }
	public function setLastName($lastName) {
		$this->lastName = $lastName;
    }
    //GET SET ID
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}
    //GET SET EMAIL
	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}
    //GET SET PASS
	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	//GET SET USERNAME

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}
    //GET SET PAIS 
	public function getPais() {
		return $this->pais;
	}

	public function setPais($pais) {
		$this->pais = $pais;
	}

	public function guardarImagen($mail) {

		if ($_FILES["avatar"]["error"] == UPLOAD_ERR_OK)
		{

			$nombre=$_FILES["avatar"]["name"];
			$archivo=$_FILES["avatar"]["tmp_name"];

			$ext = pathinfo($nombre, PATHINFO_EXTENSION);

			if ($ext != "jpg" && $ext != "png" && $ext != "jpeg") {
				return "Error";
			}

			$miArchivo = dirname(__FILE__);
			$miArchivo = $miArchivo . "/../img/";
			$miArchivo = $miArchivo . $this->getEmail() . "." . $ext;

			move_uploaded_file($archivo, $miArchivo);
		}
	}

}

?>