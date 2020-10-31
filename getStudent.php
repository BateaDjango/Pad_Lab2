<?php

$database_connection = new mysqli("127.0.0.1", "root", "",  "pad_lab2") or die('Connection error!');

if (!isset($result)) 
    $result = new stdClass();

$id;
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
}
else
{
	$result->status = "Error";
	$result->message = "Please select an id";

	echo json_encode($result,JSON_PRETTY_PRINT);
	exit();
}

try {
	    $db_query = "SELECT * FROM studenti WHERE id={$id}";
		$res = $database_connection->query($db_query);
		
		if (!$res) 
		{ 
			$result->status = "Error";
			$result->message = "No Student with such id.";

			echo json_encode($result,JSON_PRETTY_PRINT);
			exit();
		}
		else
		{
			$stundets=mysqli_fetch_array($res);
			
			$result->status = "Success";
			$result->id = $stundets['id'];
			$result->nume = $stundets['Nume'];
			$result->prenume = $stundets['Prenume'];
			$result->email = $stundets['Email'];

			echo json_encode($result,JSON_PRETTY_PRINT);
		    
		}

}
catch(Exception $e)
{
	$result->status = "Error";
	$result->message = "General Error.";

	echo json_encode($result,JSON_PRETTY_PRINT);
}
	
?>