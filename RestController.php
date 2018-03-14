<?php
require_once("UsuarioRestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "all":
		$usuarioRestHandler = new UsuarioRestHandler();
		$usuarioRestHandler->getAllUsuarios();
		break;
		
	case "id":
		$usuarioRestHandler = new UsuarioRestHandler();
		$usuarioRestHandler->getUsuarioId($_GET["id"]);
		break;

	case "login":
		$usuarioRestHandler = new UsuarioRestHandler();
		$usuarioRestHandler->getLogin($_GET["email"], $_GET["pass"]);
		break;
		
	case "editar":
		$usuarioRestHandler = new UsuarioRestHandler();
		$usuarioRestHandler->setUsuario($_GET["id"], $_GET["email"], $_GET["pass"], $_GET["activo"]);
		break;
		
	case "" :
		//404 - not found;
		break;
}
?>
