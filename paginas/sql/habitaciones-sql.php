<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "u207546111_motel";

	// FUNCION PARA CREAR TIPO DE HABITACION
	if(isset($_POST["nomTipo"])){
		
		if( $_POST["nomTipo"]!=""){
			$nomtipo = strtoupper($_POST["nomTipo"]);
			$caracteristicas = NULL;

			if(isset($_POST["caracteristicas"]))
			   $caracteristicas = strtoupper($_POST["caracteristicas"]); 				   				

			$insertar  = "INSERT INTO tiposhabitaciones(NomTipo, Caracteristicas) VALUES ('".$nomtipo."', '".$caracteristicas."')";

			$conexion = mysqli_connect($servername,$username,$password, $dbname);

			if (!$conexion) {
				die("Connection failed: " . mysqli_connect_error());		
			}
			$resultado = mysqli_query($conexion, $insertar);

			if($resultado)
			{
				$data [] = "Exito";
				$data [] = "El tipo de habitacion ".$nomtipo." fue creada con exito";
				echo json_encode($data);
			}
			else
			{
				$data [] = "Error";
				$data [] = "Tipo de habitacion ya existe";
				echo json_encode($data);
			}

		}
		else{
			$data [] = "Error";
			$data [] = "El tipo de habitacion esta vacia";
			echo json_encode($data);
		}
	}

	// FUNCION PARA CREAR HABITACION
	if(isset($_POST["funCreaHab"]))
	{
		if($_POST["NoHabNueva"]!="")
		{			
			$NoHabNueva = $_POST["NoHabNueva"];
			$CodTipoHab = $_POST['CodTipoHab'];
			$insertar  = "INSERT INTO habitaciones(Numero, CodTipoHab) VALUES ('".$NoHabNueva."', ".$CodTipoHab.")";

			$conexion = mysqli_connect($servername,$username,$password, $dbname);

			if (!$conexion) {
				die("Connection failed: " . mysqli_connect_error());		
			}
			$resultado = mysqli_query($conexion, $insertar);

			if($resultado)
			{
				$data [] = "Exito";
				$data [] = "La habitacion fue creada exitosamente";
				echo json_encode($data);
			}
			else
			{
				$data [] = "Error";
				$data [] = "Habitacion duplicada";
				echo json_encode($data);
			}
		}
		else{
			$data [] = "Error";
			$data [] = "El numero de habitacion esta vacia";
			echo json_encode($data);
		}
	}	

	// FUNCION PARA CREAR HSERVICIO ADICIONAL
	if(isset($_POST["nomServicio"])){
		
		if( $_POST["nomServicio"]!=""){
			$nom = strtoupper($_POST["nomServicio"]);
			$descripcion = NULL;

			if(isset($_POST["descripcion"]))
			   $caracteristicas = strtoupper($_POST["descripcion"]); 				   				

			$insertar  = "INSERT INTO servicioshabitaciones(NomServicio, Descripcion) VALUES ('".$nom."', '".$descripcion."')";

			$conexion = mysqli_connect($servername,$username,$password, $dbname);

			if (!$conexion) {
				die("Connection failed: " . mysqli_connect_error());		
			}
			$resultado = mysqli_query($conexion, $insertar);

			if($resultado)
			{
				$data [] = "Exito";
				$data [] = "El servicio ".$nom." fue creada con exito";
				echo json_encode($data);
			}
			else
			{
				$data [] = "Error";
				$data [] = "El Servicio ya existe";
				echo json_encode($data);
			}

		}
		else{
			$data [] = "Error";
			$data [] = "El nombre del servicio esta vacia";
			echo json_encode($data);
		}
	}
	
	// funciona para traer tipo de habitacion
	if(isset($_POST["traeTiposHabtiacion"])){
			
		$conexion = mysqli_connect($servername,$username,$password, $dbname);
		$consulta = "SELECT * FROM tiposhabitaciones";
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());		
		}
		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();
		
		while($row = mysqli_fetch_assoc($resultado))
			$datos[] = $row;
		
		echo json_encode($datos);
		
	}

	// funciona para traer precio por lista de habitaciones
	if(isset($_POST["lista"]) and isset($_POST["tipo"])){
		$lista = $_POST["lista"];
		$tipo = $_POST["tipo"];
		
		$conexion = mysqli_connect($servername,$username,$password, $dbname);
		$consulta = "SELECT * FROM vistaprecios WHERE CodLista=".$lista." AND CodTipo=".$tipo;
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());		
		}
		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();
		
		while($row = mysqli_fetch_assoc($resultado))
			$datos[] = $row;
		
		echo json_encode($datos);
		
	}

	// trae las horas activas en el sistema
	if(isset($_GET["horas"])){
		
		$conexion = mysqli_connect($servername,$username,$password, $dbname);
		$consulta = "SELECT * FROM Horas WHERE Estado='Activo'";
		
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());		
		}
		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();
		
		while($row = mysqli_fetch_assoc($resultado))
			$datos[] = $row;
		
		echo json_encode($datos);
		
	}

	//funcion para consultar si el servicio esta creado
	if(isset($_GET["consultaServicio"])){
		
		$info = $_GET["consultaServicio"];
		$conexion = mysqli_connect($servername,$username,$password, $dbname);
		$consulta = "SELECT * FROM precioshabitaciones WHERE CodLista=".$info[0]." AND CodTipoHab=".$info[1]." AND CodServicioHab=".$info[2];
		
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());		
		}
		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();
		
		while($row = mysqli_fetch_assoc($resultado))
			$datos[] = $row;				
		
		echo json_encode($datos);
		
		
	}
	
	// FUNCION PARA CREAR/ACTUALIZAR VALOR DEL SERVICIO DE HABITACIONES
	if(isset($_POST["crearPrecio"])){
		
		if( $_POST["crearPrecio"]!=""){
			
			$insertar  = $_POST["crearPrecio"];

			$conexion = mysqli_connect($servername,$username,$password, $dbname);

			if (!$conexion) {
				die("Connection failed: " . mysqli_connect_error());		
			}
			$resultado = mysqli_query($conexion, $insertar);

			if($resultado)
			{
				$data [] = "Exito";
				$data [] = "El servicio fue actualizado con exito";
				echo json_encode($data);
			}
			else
			{
				$data [] = "Error";
				$data [] = "No se pudo actualizar el servicio";
				echo json_encode($data);
			}

		}
		else{
			$data [] = "Error";
			$data [] = "El nombre del servicio esta vacia";
			echo json_encode($data);
		}
	}

?>