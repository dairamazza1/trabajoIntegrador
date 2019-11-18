<?php

require_once("db.php");

class Validator {
	
	function validarInformacion($informacion, DB $db) {
		$errores = [];

		foreach ($informacion as $clave => $valor) {
			$informacion[$clave] = trim($valor);
		}

		if (empty($informacion["username"])) {
			$errores["username"] = "Este campo no puede estar vacío";
        }
        if (empty($informacion["lastname"])) {
                $errores["lastname"] = "Este campo no puede estar vacío";
        }

        /*
        if ($informacion["edad"] < 18) {
                $errores["edad"] = "Tenes que tener más de 18 años";
        }
        */
		if ($informacion["email"] == "") {
			$errores["email"] = "Completar E-mail";
		}
		else if (filter_var($informacion["email"], FILTER_VALIDATE_EMAIL) == false) {
			$errores["mail"] = "Asegurese de que su direccion sea válida";
		} else if ($db->traerPorMail($informacion["email"]) != NULL) {
			$errores["mail"] = "El usuario ya existe";
		}

		if ($informacion["password"] == "") {
			$errores["password"] = "Completar contraseña";
		}

    return $errores;
	}
}

?>