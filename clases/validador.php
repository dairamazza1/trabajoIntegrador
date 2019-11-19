<?php

require_once("db.php");

class Validator {
	function validarLogin($informacion, DB $db) {
		$errores = [];

		foreach ($informacion as $clave => $valor) {
			$informacion[$clave] = trim($valor);
		}


		if ($informacion["email"] == "") {
			$errores["email"] = "Debe completar el Email";
		}
		else if (filter_var($informacion["email"], FILTER_VALIDATE_EMAIL) == false) {
			$errores["email"] = "Su correo debe ser válido";
		} else if ($db->traerPorMail($informacion["email"]) == NULL) {
			$errores["email"] = "El usuario no esta en nuestra base";
		}

		$usuario = $db->traerPorMail($informacion["email"]);

		if ($informacion["password"] == "") {
			$errores["password"] = "Completar contraseña";
		} else if ($usuario != NULL) {
			//El usuario existe y puso contraseña
			// Tengo que validar que la contraseño que ingreso sea valida
			if (password_verify($informacion["password"], $usuario->getPassword()) == false) {
				$errores["password"] = "La contraseña es inválida";
			}
		}
		return $errores;
	}

	function validarInformacion($informacion, DB $db) {
		$errores = [];

		foreach ($informacion as $clave => $valor) {
			$informacion[$clave] = trim($valor);
		}

		if (empty($informacion["username"])) {
			$errores["username"] = "Este campo no puede estar vacío";
        }
        if (empty($informacion["lastName"])) {
                $errores["lastName"] = "Este campo no puede estar vacío";
        }

        if (empty($informacion["name"])) {
            $errores["name"] = "Este campo no puede estar vacío";
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
        
        if($informacion["edad"] < 18){
            $errores["edad"] = "Debes ser mayor a 18 años";
        }

    return $errores;
	}
}

?>