<?php

function listaHabitaciones($servername,$username,$password,$dbname, $tabla){

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM ".$tabla;
	$result = mysqli_query($conn, $sql);

	if ($result) {
		// output data of each row
		$data = array();
		while($row2 = mysqli_fetch_assoc($result)) {
			$data [] = $row2;
		}
		return($data);
	} else {
		echo $tabla;
	}
}

?>