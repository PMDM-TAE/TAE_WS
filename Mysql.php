<?php
require 'Dbconfig.php';

class Mysql extends Dbconfig    {

public $connectionString;
public $dataSet;
private $sqlQuery;

public $hostName;
public $databaseName;
public $userName;
public $passCode;

function Mysql()    {
    $this -> connectionString = NULL;
    $this -> sqlQuery = NULL;
    $this -> dataSet = NULL;
	
	$dbPara = new Dbconfig();
	$this -> databaseName = $dbPara -> dbName;
	$this -> hostName = $dbPara -> serverName;
	$this -> userName = $dbPara -> userName;
	$this -> passCode = $dbPara ->passCode;
	$dbPara = NULL;

}

function dbConnect()    {
	$this -> connectionString = mysqli_connect($this -> hostName, $this -> userName, $this -> passCode, $this -> databaseName);
	
	return $this -> connectionString;
}

function dbDisconnect() {
    $this -> connectionString = NULL;
    $this -> sqlQuery = NULL;
    $this -> dataSet = NULL;
	$this -> databaseName = NULL;
	$this -> hostName = NULL;
	$this -> userName = NULL;
	$this -> passCode = NULL;
}

function selectId($id)  {
    $this -> sqlQuery = 'SELECT * FROM tblusuarios WHERE id=';
	$this -> sqlQuery .= $id;

	$this -> connectionString = mysqli_connect($this -> hostName, $this -> userName, $this -> passCode, $this -> databaseName);
    $this -> dataSet = mysqli_query($this -> connectionString, $this -> sqlQuery);
            return $this -> dataSet;
}

function selectLogin($email, $pass)  {
	$this -> sqlQuery = 'SELECT * FROM tblusuarios WHERE email="'.$email.'" AND password="'.$pass.'"';
	$this -> connectionString = mysqli_connect($this -> hostName, $this -> userName, $this -> passCode, $this -> databaseName);
    $this -> dataSet = mysqli_query($this -> connectionString, $this -> sqlQuery);
            return $this -> dataSet;

	/*
	$this -> sqlQuery = 'SELECT * FROM tblusuarios WHERE email="'.$email.'" AND password="'.$pass.'"';
    $this -> dataSet = mysql_query($this -> sqlQuery,$this -> connectionString);
            return $this -> dataSet;
	*/
}


function updateUsuario($id, $email, $pass, $activo)  {
	$this -> sqlQuery = 'UPDATE tblusuarios SET email="'.$email.'", password="'.$pass.'", activo='.$activo.' WHERE id='.$id;
	$this -> connectionString = mysqli_connect($this -> hostName, $this -> userName, $this -> passCode, $this -> databaseName);
    //$this -> dataSet = mysqli_query($this -> connectionString, $this -> sqlQuery);
	
	//$this -> connectionString -> query($this -> sqlQuery);
	
	mysqli_query($this -> connectionString, $this -> sqlQuery);
	
	/*
	$this -> sqlQuery = 'SELECT * FROM tblusuarios WHERE id="'.$email.'" AND password="'.$pass.'"';
    $this -> dataSet = mysqli_query($this -> connectionString, $this -> sqlQuery);
		
		return $this -> dataSet;
	*/
}

function selectAll($tableName)  {
    $this -> sqlQuery = 'SELECT * FROM '.$this -> databaseName.'.'.$tableName;
    $this -> dataSet = mysql_query($this -> sqlQuery,$this -> connectionString);
            return $this -> dataSet;
}

function selectWhere($tableName,$rowName,$operator,$value,$valueType)   {
    $this -> sqlQuery = 'SELECT * FROM '.$tableName.' WHERE '.$rowName.' '.$operator.' ';
    if($valueType == 'int') {
        $this -> sqlQuery .= $value;
    }
    else if($valueType == 'char')   {
        $this -> sqlQuery .= "'".$value."'";
    }
    //$this -> sqlQuery = 'SELECT * FROM tblusuarios WHERE id=1';
    $this -> dataSet = mysql_query($this -> sqlQuery,$this -> connectionString);
    $this -> sqlQuery = NULL;
    return $this -> dataSet;
    #return $this -> sqlQuery;
}

function insertInto($tableName,$values) {
    $i = NULL;

    $this -> sqlQuery = 'INSERT INTO '.$tableName.' VALUES (';
    $i = 0;
    while($values[$i]["val"] != NULL && $values[$i]["type"] != NULL)    {
        if($values[$i]["type"] == "char")   {
            $this -> sqlQuery .= "'";
            $this -> sqlQuery .= $values[$i]["val"];
            $this -> sqlQuery .= "'";
        }
        else if($values[$i]["type"] == 'int')   {
            $this -> sqlQuery .= $values[$i]["val"];
        }
        $i++;
        if($values[$i]["val"] != NULL)  {
            $this -> sqlQuery .= ',';
        }
    }
    $this -> sqlQuery .= ')';
            #echo $this -> sqlQuery;
    mysql_query($this -> sqlQuery,$this ->connectionString);
            return $this -> sqlQuery;
    #$this -> sqlQuery = NULL;
}

function selectFreeRun($query)  {
    $this -> dataSet = mysql_query($query,$this -> connectionString);
    return $this -> dataSet;
}

function freeRun($query)    {
    return mysql_query($query,$this -> connectionString);
  }
}
?>