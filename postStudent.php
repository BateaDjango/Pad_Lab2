<?php

$database_connection = new mysqli("127.0.0.1", "root", "",  "pad_lab2") or die('Connection error!');

if (!isset($result)) 
    $result = new stdClass();

if(!isset($_POST['Nume']) || !isset($_POST['Prenume']) || !isset($_POST['Email']))
{
	$result->status = "Error";
	$result->message = "Fuck you.";

	echo json_encode($result);
	exit();
}


try {
	
    	$db_query = "INSERT INTO `studenti` (`Nume`, `Prenume`, `Email`) VALUES ('{$_POST['Nume']}', '{$_POST['Prenume']}', '{$_POST['Email']}')";

		if (!$database_connection->query($db_query)) 
		{ 
			$result->status = "Error";
			$result->message = "FUCK U";

			echo json_encode($result);
		}
		else
		{
			
		    
			$result->status = "Success";
			
			//$db_query = "SELECT * FROM studenti WHERE id={$id}";
			
			$result->id = $database_connection->insert_id;

			echo json_encode($result,JSON_UNESCAPED_SLASHES);
		}
	
}
catch(Exception $e)
{
	$result->status = "Error";
	$result->message = "There was a problem uploading your image. Try again later or use smaller sized image.";

	echo json_encode($result);
}
	
?>