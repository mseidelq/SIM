<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIM</title>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../datatable/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../priceformat/jquery.priceformat.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link href="../datatable/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css"> -->
<link href="../css/bootstrap-3.3.7.css" rel="stylesheet" type="text/css">
<link href="../css/csspropios.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


</head>

<body style="padding-top: 60px">
<?php include("menu.php") ?>
<?php include("phpFunciones/funciones.php");
	  include("modales/modales.php");
?>

<div class="container" id="principal">

	<div class="col-lg-12 text-center alert-info" id="titulo">
		<h2 >CONTROL DE HABITACIONES</h1>
	</div>

  <div role="tabpanel">
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#habitaciones" data-toggle="tab" role="tab" aria-controls="tab1">Habitaciones</a></li>
	    <li role="presentation"><a href="#resumencaja" data-toggle="tab" role="tab" aria-controls="tab2">Resumen de caja</a></li>

	  </ul>
	  <div id="tabContent1" class="tab-content">
	    <div role="tabpanel" class="tab-pane fade in active" id="habitaciones">
	      	<ol class="breadcrumb">
				<li><a href="#">Inicio</a></li>
				<li class="active">Control Caja</li>
  			</ol>
      		<input type="text" id="codigobarras" hidden="true">
       		<div class="row">


				<!-- PANEL PARA PRECIOS DE LA LISTA -->

				<div class="col-lg-12 col-md-6">
					<div class="panel panel-info">
					  <div class="panel-heading">OCUPACION HABITACIONES</div>
					  <div class="panel-body">

						<div class="col-lg-12 col-md-12">

							<div class="table-responsive">

								<table id="tablaControlHabitaciones" class="table-hover display table" style="width:100%" border>
									<thead class="bg-primary">
									<tr>
										<th >Hab</th>
										<th >Tipo</th>
										<th  colspan="2">Ingreso</th>
										<th colspan="2">Salida</th>
										<th >Faltante</th>
										<th >H. Extra</th>
										<th >Servicio</th>
										<th >Vlr.Servicio</th>
										<th >Vlr.Extra</th>
										<th >Consumos</th>
										<th >Total</th>
										<th >Saldo</th>
										<th >Placa</th>
										<th >Observaciones</th>
									</tr>
									</thead>

									<tbody>
									</tbody>

									<tfoot></tfoot>
								</table>

						  	</div>

						</div>

					</div>
				  </div>
				</div>

       		</div>

       		<audio id="15left">
       			<source src="../mp3/15left.mp3" type="audio/mp3" />
       		</audio>
       		<audio id="timeout">
       			<source src="../mp3/timeout.mp3" type="audio/mp3" />
       		</audio>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="resumencaja">
	      	<ol class="breadcrumb">
				<li><a href="#">Inicio</a></li>
				<li class="active">Resumen de caja</li>
			</ol>
        </div>
    </div>
  </div>
</div>


<script src="../js/bootstrap-3.3.7.js"></script>


<script src="jquery/controlHabitaciones.js"></script>

</body>
</html>
