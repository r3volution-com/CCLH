<?php
session_start();
include("class/user.class.php");
if (!isset($_GET["op"])) die(json_encode(array("status" => "ERROR", "msg" => "No tienes permitido hacer eso")));
if (isset($_SESSION["uid"])) $user = new User($_SESSION["uid"]);
else $user = new User();
switch ($_GET["op"]){
	case "login":
		if ($user->getUID()) die(json_encode(array("status" => "ERROR", "msg" => "No tienes permitido hacer eso")));
		if ((isset($_POST["username"]) && isset($_POST["password"])) && ($_POST["username"] != "" && $_POST["password"] != "")){
			if ($user->doLogin(htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8'), htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8'))){
				$_SESSION["uid"] = $user->getUID();
				die(json_encode(array("status" => "OK")));
			}else die(json_encode(array("status" => "ERROR", "msg" => "El usuario/email o la contrase&ntilde;a no coinciden")));
		}else die(json_encode(array("status" => "ERROR", "msg" => "El usuario/email y la contrase&ntilde;a no pueden estar en blanco")));
	break;
	case "register":
		if ($user->getUID()) die(json_encode(array("status" => "ERROR", "msg" => "No tienes permitido hacer eso")));
		if ((isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["repassword"])) && ($_POST["username"] != "" && $_POST["password"] != "" && $_POST["email"] != "" && $_POST["repassword"] != "")){
			if (ctype_alnum($_POST["username"])){
				if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
					if (strlen($_POST["password"]) >= 6) {
						if ($_POST["password"] == $_POST["repassword"]){
							if ($user->doRegister($_POST["username"], $_POST["email"], $_POST["password"])){
								die(json_encode(array("status" => "OK")));
							} else die(json_encode(array("status" => "ERROR", "msg" => "Este usuario o email ya esta registrado")));
						} else die(json_encode(array("status" => "ERROR", "msg" => "Las contrase&ntilde;as no coinciden")));
					} else die(json_encode(array("status" => "ERROR", "msg" => "La contrase&ntilde;a debe tener 6 o mas caracteres")));
				} else die(json_encode(array("status" => "ERROR", "msg" => "El e-mail introducido no es valido")));
			} else die(json_encode(array("status" => "ERROR", "msg" => "El nombre de usuario solo puede contener numeros y letras")));
		} else die(json_encode(array("status" => "ERROR", "msg" => "Por favor rellene todos los campos")));
	break;
	case "logout":
		session_unset();
	break;
	default:
		die(json_encode(array("status" => "ERROR", "msg" => "No tienes permitido hacer eso")));
	break;
}