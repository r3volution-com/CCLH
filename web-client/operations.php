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
			if ($user->doLogin(htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8'), htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8')))
				die(json_encode(array("status" => "OK")));
			else die(json_encode(array("status" => "ERROR", "msg" => "El usuario/email o la contrase&ntilde;a no coinciden")));
		}else die(json_encode(array("status" => "ERROR", "msg" => "El usuario/email y la contrase&ntilde;a no pueden estar en blanco")));
	break;
	case "register":
		if ($user->getUID()) die(json_encode(array("status" => "ERROR", "msg" => "No tienes permitido hacer eso")));
		
		die(json_encode(array("status" => "ERROR", "msg" => "ToDo")));
	break;
	default:
		die(json_encode(array("status" => "ERROR", "msg" => "No tienes permitido hacer eso")));
	break;
}