<?php

function connection(){

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spot";

//------------------------------------------------------------
//
// CREATION D'UNE CONNECTION A LA BASE SPOT EN TANT QUE ROOT
//
//------------------------------------------------------------

//connection

$conn = mysql_connect($servername,$username,$password);

//gestion des erreurs    function 'nom' (var 1, ...)
if (! $conn)
{
	echo "no server connection";
}
else 
{
	if( mysql_select_db($dbname) )
	{
		
	}
	else
	{
		echo "no db connection";
	}
}
return $conn;
}

function verifIDClient($IDClient){

$sql = "SELECT *
	   FROM SPOT.CLIENTS
	   WHERE IDClient = {$IDClient}";
	   
$result = mysql_query($sql);
 
//return 0;

return mysql_num_rows($result);
}

function verifIDCarte($IDCarte){

$sql = "SELECT *
	   FROM SPOT.CARTE
	   WHERE IDCarte = {$IDCarte}";
	   
$result = mysql_query($sql);
 
//return 0;

return mysql_num_rows($result);
}

function getPartage($IDCarte){

$sql = "SELECT typePartage
	   FROM SPOT.CARTE
	   WHERE IDCarte = 1";
	   
$result = mysql_query($sql);
 
//return 0;

print ($result);

return $result;
}

function verifProprioCarte($IDClient, $IDCarte){
	$sql = "SELECT *
	   FROM SPOT.CARTE
	   WHERE IDCarte = {$IDCarte}
	   AND IDClient = {$IDClient}";
	   
	$result = mysql_query($sql);
 
	//return 0;  if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $_POST['telephone']))
	//if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
	//isset($_POST['mail'])	
	//preg_replace('#[-. ]#','', )
	return mysql_num_rows($result);	
}

// ---- CLIENTS ---- 

function verifEmail($Email){
	
	// -- VERIF NO SPACE INTO EMAIL --
	$Email = preg_replace('#[ ]#','', $Email);

	// -- VERIF VALIDITY OF EMAIL --
	if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $Email)) {
	
		printf("3::Email not valid::%s",$Email);
		exit;
		
	}
	
	// -- REQUET SQL --
	$sql = "SELECT *
	   FROM SPOT.CLIENTS
	   WHERE Email = '{$Email}'";
	   
	$result = mysql_query($sql);
 
	//return 0;

	return mysql_num_rows($result);
}

function verifNumTel($Num){
	
	// -- VERIF NO SPACE INTO NUM --
	$Num = preg_replace('#[ ]#','', $Num);

	// -- VERIF VALIDITY OF NUM --
	if (!preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $Num)) {
	
		printf("4::Num not valid::%s",$Num);
		exit;
		
	}
	
	// -- REQUET SQL --
	$sql = "SELECT *
	   FROM SPOT.CLIENTS
	   WHERE NumTel = '{$Num}'";
	   
	$result = mysql_query($sql);
 
	//return 0;

	return mysql_num_rows($result);
}
?>