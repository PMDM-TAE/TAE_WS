<?php
require_once("Mysql.php");
/* 
A domain Class to demonstrate RESTful web services
*/
Class Usuarios {		
	/*
		you should hookup the DAO here
	*/
	public function getAllUsuarios(){
            $conexion = new Mysql();
            $conexion -> dbConnect();
            $consulta = $conexion -> selectAll("tblusuarios");
            $items = array();
            $data_item = array();
            //print_r($datos);
            while ($row = mysql_fetch_assoc($consulta)) {
                $data_item['id'] = $row['id'];
                $data_item['email'] = $row['email'];
                $data_item['password'] = $row['password'];
                $data_item['activo'] = $row['activo'];
                //print_r($data_item);
                array_push($items, $data_item);
                //$items[] = $data_item;
            }
            //print_r($data_item);
            $conexion -> dbDisconnect();
            //print_r($items);
            return array($items);
	}
	
	public function getUsuarioId($id){
            $conexion = new Mysql();
            $conexion -> dbConnect();
            //$consulta = $conexion -> selectWhere2("tblusuarios", "id", "=", $id, "int");
			$consulta = $conexion -> selectId($id);
            $data_item = array();
            //print_r($consulta);
			while ($fila = $consulta->fetch_row()) {
				//printf ("%s (%s)\n", $fila[0], $fila[1]);
                $data_item['id'] = $fila[0];
                $data_item['email'] = $fila[1];
                $data_item['password'] = $fila[2];
                $data_item['activo'] = $fila[3];
			}
            /*while ($row = mysql_fetch_assoc($consulta)) {
                $data_item['id'] = $row['id'];
                $data_item['email'] = $row['email'];
                $data_item['password'] = $row['password'];
                $data_item['activo'] = $row['activo'];
                //print_r($data_item);
                //$items[] = $data_item;
            }*/
            //print_r($data_item);
            //$items[] = $data_item;
            //print_r($data_item);
            $conexion -> dbDisconnect();
            //print_r($items);
            return array($data_item);
	}
        
	public function getLogin($email, $pass){
            $conexion = new Mysql();
            $conexion -> dbConnect();
            $consulta = $conexion ->selectLogin($email, $pass);
            $data_item = array();
			/*while ($row = mysql_fetch_assoc($consulta)) {				
                $data_item['id'] = $row['id'];
                $data_item['email'] = $row['email'];
                $data_item['password'] = $row['password'];
                $data_item['activo'] = $row['activo'];
			*/
			while ($fila = $consulta->fetch_row()) {       
                $data_item['id'] = $fila[0];
                $data_item['email'] = $fila[1];
                $data_item['password'] = $fila[2];
                $data_item['activo'] = $fila[3];     
            }
            $conexion -> dbDisconnect();
            return array($data_item);
	}
	
	public function setUsuario($id, $email, $pass, $activo){		
            $conexion = new Mysql();
            $conexion -> dbConnect();
            $conexion ->updateUsuario($id, $email, $pass, $activo);
			$consulta = $conexion -> selectId($id);
            $data_item = array();
			while ($fila = $consulta->fetch_row()) {       
                $data_item['id'] = $fila[0];
                $data_item['email'] = $fila[1];
                $data_item['password'] = $fila[2];
                $data_item['activo'] = $fila[3];     
            }
            $conexion -> dbDisconnect();
            return array($data_item);
	}
	
}
?>