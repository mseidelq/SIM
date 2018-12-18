<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "u207546111_motel";

	if(isset($_GET["habitaciones"]))
	{
		$habitaciones = $_GET["habitaciones"];

		if($habitaciones == "traer")
			$consulta = "SELECT * FROM view_lista_habtiaciones";
		else if($habitaciones == "ocupacion")
				$consulta = "SELECT * FROM view_ocupaciones";
			else $consulta = "SELECT * FROM view_ocupaciones WHERE NumeroHab=$habitaciones";

		$conexion = mysqli_connect($servername,$username,$password, $dbname);
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();

		while($row = mysqli_fetch_assoc($resultado))
			$datos[] = $row;

		echo json_encode($datos);
	}

// LISTAS DE PRECIOS ACTIVAS

	if(isset($_POST["listaActiva"]))
	{
		$listaActiva = $_POST["listaActiva"];
		if($listaActiva == "traer"){
			$conexion = mysqli_connect($servername,$username,$password, $dbname);

			$consulta = "SELECT * FROM view_lista_precios_activaXrango";

			if (!$conexion) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$resultado = mysqli_query($conexion, $consulta);

			if(mysqli_num_rows($resultado)<=0)
			{
				$consulta = "SELECT * FROM view_lista_precios_activaXdia";
				if (!$conexion) {
					die("Connection failed: " . mysqli_connect_error());
				}
				$resultado = mysqli_query($conexion, $consulta);
			}

			$datos = array();

			while($row = mysqli_fetch_assoc($resultado))
				$datos[] = $row;

			echo json_encode($datos);
		}
	}

// PRECIOS PARA LA LISTA DE PRECIO ACTIVA

	if(isset($_POST["listaSeleccionada"]))
	{
		$listaSeleccionada = $_POST["listaSeleccionada"];
		$tipo = $_POST["tipo"];

		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		$consulta = "CALL S_Precios_Lista($listaSeleccionada,$tipo)";

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();

		while($row = mysqli_fetch_assoc($resultado))
			$datos[] = $row;

		echo json_encode($datos);
	}

	if(isset($_POST["horaActual"])){
		date_default_timezone_set('America/Bogota');
		$horas = $_POST["horaActual"];
		$fecha = array();
		$fecha [] = date('d-m-Y h:i:s a');
		$horas = time() + (60*60*$horas);
		$fecha [] = date('d-m-Y h:i:s a',$horas);

		echo json_encode($fecha);
	}

// INSERTAR OCUPACION DE LA HABITACION
	if(isset($_POST['ocupacion'])){
		$datos = $_POST['ocupacion'];

		$insertar  = "CALL I_Insertar_Ocupacion($datos[0], $datos[1], $datos[2])";
		// YA GUARDA EN LA BASE DE DATOS DE OCUPACION

		//** verificar si la habitacion ya está ocupada
		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$resultado = mysqli_query($conexion, $insertar);

		if($resultado)
		{

			$consulta = "SELECT IdOcupacion FROM ocupacion WHERE NumeroHab = $datos[0] AND Estado = 'OCUPADO'";
			$resultado2 = mysqli_query($conexion, $consulta);

			$data [] = "Exito";
			while($row = mysqli_fetch_assoc($resultado2))
				$data[] = $row;

			echo json_encode($data);
		}
		else
		{
			$data [] = "Error";
			$data [] = "La habitacion ya esta ocupada";
			echo json_encode($data);
		}



	}

	// BUSCAR PRODUCTO POR ID O POR CODIGO DE BARRAS
	if(isset($_GET['productoId']) || isset($_GET['productoCb'])){

		//$producto = $_GET['productoId'];
		$conexion = mysqli_connect($servername,$username,$password, $dbname);


		if(isset($_GET['productoId'])){
			$producto = $_GET['productoId'];
			$consulta = "CALL S_Buscar_Producto(1,$producto)";
		}
		else{
			$producto = $_GET['productoCb'];
			$consulta = "CALL S_Buscar_Producto(2,$producto)";
		}

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();

		while($row = mysqli_fetch_assoc($resultado))
			$datos[] = $row;

		echo json_encode($datos);
	}
	// vamor por aqui
	if(isset($_GET['traeProductos'])){

		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		$consulta = "SELECT productos.*, grupoproductos.NombreGrupo AS NombreGrupo FROM productos INNER JOIN grupoproductos ON productos.Grupo = grupoproductos.Idgrupo";

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();


		while($row = mysqli_fetch_assoc($resultado)){

			$nom = (object)array('label'=>$row['Nombre']." [".$row['NombreGrupo']."]", 'value'=>$row['Nombre']." [".$row['NombreGrupo']."]", 'id'=>$row['IdProducto']);

			$datos[] = $nom;
		}

		echo json_encode($datos);
	}


	// traer consumos de la ocupacion
	if(isset($_GET['traeConsumo'])){

		$IdOcupacion = $_GET['traeConsumo'];
		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		$consulta = "CALL S_Traer_Consumos(".$IdOcupacion.")";

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();


		while($row = mysqli_fetch_assoc($resultado)){

			$datos[] = $row;
		}

		echo json_encode($datos);
	}

	// INSERTAR CONSUMO

	if(isset($_POST['Consumos']) && isset($_POST['IdOcupacion'])){

		$datos = $_POST['Consumos'];
		$IdOcupacion = $_POST['IdOcupacion'];

		$insertar  = " CALL I_Insertar_Consumo(".$IdOcupacion.", ".$datos['IdProducto'].", ".$datos['Cantidad'].", ".$datos['ValorVenta'].")";

		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$resultado = mysqli_query($conexion, $insertar);

		if($resultado)
		{
			$data [] = "Exito";
			$data [] = "Se guardó el consumo";
			echo json_encode($data);
		}
		else
		{
			$data [] = "Error";
			$data [] = "El consumo no puede ser guardado";
			echo json_encode($data);
		}

	}

	// INSERTAR HORA EXTRA

	if(isset($_POST['hExtra']) && isset($_POST['IdOcupacion'])){

		$hora = $_POST['hExtra']*1;
		$IdOcupacion = $_POST['IdOcupacion']*1;
		$listaP = $_POST['listaP']*1; $precio=0;

		$insertar  = "CALL S_Precio_HExtra(".$hora.", ".$IdOcupacion.", ".$listaP.")";

		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$resultado = mysqli_query($conexion, $insertar);

		/*if($resultado)
		{
			$data [] = "Exito";
			$data [] = $resultado['precio'];
			echo json_encode($data);
		}
		else
		{
			$data [] = "Error";
			$data [] = "La hora extar no pudo ser insertada";
			echo json_encode($data);
		}*/
		echo json_encode($resultado);

	}

?>
