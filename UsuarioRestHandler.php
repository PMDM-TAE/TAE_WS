<?php
require_once("SimpleRest.php");
require_once("Usuarios.php");
require_once("Respuesta.php");
		
class UsuarioRestHandler extends SimpleRest {

	function getAllUsuarios() {	
                /*
		$mobile = new Mobile();
		$rawData = $mobile->getAllMobile();
                */
            
		$Usuarios = new Usuarios();
		$rawData = $Usuarios->getAllUsuarios();
                
                
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No se encontro el usuario!');		
		} else {
			$statusCode = 200;
		}

			$response = $this->encodeJson($rawData);
			echo $response;
                        /*
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
                
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeJson($rawData);
                        //$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
                        $response = $this->encodeJson($rawData);
			//$response = $this->encodeXml($rawData);
			echo $response;
		}*/
	}
	
	public function encodeHtml($responseData) {	
            $htmlResponse = "<table border='1'>";
            /*
            foreach($responseData as $key=>$value) {
                    $htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
            }
            */
            foreach ($responseData as $row) {
                /*print_r($responseData);
                echo array_count_values($responseData);
               if(sizeof($responseData)>1){*/
                    $i = 0;
                    foreach ($row as $column) {
                         if($i == 0){
                              //print_r($row);
                              //echo count($column);
                              if(count($column) > 1){
                                $htmlResponse .= "<tr>";
                                foreach ($column as $key => $value) {
                                    $htmlResponse .= "<td>".$key."</td>";
                                }                        
                                $htmlResponse .= "</tr>";
                                $i++;
                              }else{
                                $htmlResponse .= "<tr>";
                                foreach ($row as $key => $value) {
                                    $htmlResponse .= "<td>".$key."</td>";
                                }                        
                                $htmlResponse .= "</tr>";
                                $i++;
                              }                              
                        }
                    }
                    
                    $i = 0;
                    foreach ($row as $column) {
                        //print_r($row);                        
                        if(count($column) > 1){
                            $htmlResponse .= "<tr>";
                            foreach ($column as $key => $value) {
                                $htmlResponse .= "<td>".$value."</td>";
                            }
                            $htmlResponse .= "</tr>"; 
                        }else{                            
                            if($i == 0){
                                //echo $i;
                               $htmlResponse .= "<tr>";
                               foreach ($row as $key => $value) {
                                   $htmlResponse .= "<td>".$value."</td>";
                               }
                               $htmlResponse .= "</tr>"; 
                               $i++;
                            }
                        }
                    }
               /*}*/
            } 
            $htmlResponse .= "</table>";   


            return $htmlResponse;		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
	
	public function getUsuarioId($id) {
                $Usuarios = new Usuarios();
		$rawData = $Usuarios->getUsuarioId($id);

                $respuestaUsuario = new RespuestaUsuario();
                $respuesta = new Respuesta();
                $respuesta -> funcion = "getLogin";
                $respuesta -> fecha = date("d/m/Y H:i:s");
                //print_r($rawData);
                
                $errors = array_filter($rawData);
		if(empty($errors)) {
                        $respuesta -> codigo = 2;
                        $respuesta -> mensaje = "Usuario no encontrado";
			$statusCode = 404;
			$rawData = array('error' => 'No se encontro el usuario!');		
		} else {
                        $respuesta -> codigo = 1;
                        $respuesta -> mensaje = "Usuario encontrado";
                        $respuestaUsuario -> usuario = array_shift($rawData);
			$statusCode = 200;
		}
                $respuestaUsuario -> respuesta = $respuesta;
                
                $response = $this->encodeJson($respuestaUsuario);
                echo $response;
            /*
		$Usuarios = new Usuarios();
		
		$rawData = $Usuarios->getUsuarioId($id);
		
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No se encontro el usuario!');		
		} else {
			$statusCode = 200;
		}
                
                $response = $this->encodeJson(array_shift($rawData));
                echo $response;
            */
	}
        
	public function getLogin($email, $pass) {                        
                $Usuarios = new Usuarios();
		$rawData = $Usuarios->getLogin($email, $pass);

                $respuestaUsuario = new RespuestaUsuario();
                $respuesta = new Respuesta();
                $respuesta -> funcion = "getLogin";
                $respuesta -> fecha = date("d/m/Y H:i:s");
                //print_r($rawData);
                
                $errors = array_filter($rawData);
		if(empty($errors)) {
                        $respuesta -> codigo = 2;
                        $respuesta -> mensaje = "Usuario no encontrado";
			$statusCode = 404;
			$rawData = array('error' => 'No se encontro el usuario!');		
		} else {
                        $respuesta -> codigo = 1;
                        $respuesta -> mensaje = "Usuario encontrado";
                        $respuestaUsuario -> usuario = array_shift($rawData);
			$statusCode = 200;
		}
                $respuestaUsuario -> respuesta = $respuesta;
                
                $response = $this->encodeJson($respuestaUsuario);
                echo $response;
                
                /*
		$Usuarios = new Usuarios();
		$rawData = $Usuarios->getLogin($email, $pass);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No se encontro el usuario!');		
		} else {
			$statusCode = 200;
		}
		
		$response = $this->encodeJson(array_shift($rawData));
		echo $response;*/
	}
	
	
	public function setUsuario($id, $email, $pass, $activo) {            
		$Usuarios = new Usuarios();
		$rawData = $Usuarios->setUsuario($id, $email, $pass, $activo);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No se encontro el usuario!');		
		} else {
			$statusCode = 200;
		}
		
		$response = $this->encodeJson(array_shift($rawData));
		echo $response;
	}
}
?>