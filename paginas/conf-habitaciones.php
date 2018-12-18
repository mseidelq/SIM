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

<link href="../datatable/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css"> -->
<link href="../css/bootstrap-3.3.7.css" rel="stylesheet" type="text/css">
<link href="../css/csspropios.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">



</head>

<body style="padding-top: 60px">
<?php include("menu.php") ?>
<?php include("phpFunciones/funciones.php") ?>
<?php include("phpFunciones/func-habitaciones-sql.php"); 
		include("modales.php");
	
/*$servername = "sql139.main-hosting.eu";
$username = "u207546111_max";
$password = "sofia0731";
$dbname = "u207546111_motel";
*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "u207546111_motel";

?>

<div class="container-fluid" id="principal">
  
	<div class="col-lg-12 text-center alert-info" id="titulo">
		<h2 >CONFIGURACIONES DE HABITACIONES</h1>
	</div>
 	
  <div role="tabpanel">
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#habitaciones" data-toggle="tab" role="tab" aria-controls="tab1">Tipos de habitaciones</a></li>
	    <li role="presentation"><a href="#precios" data-toggle="tab" role="tab" aria-controls="tab2">Precios</a></li>
	    
	  </ul>
	  
	  <div id="tabContent1" class="tab-content">
	    <div role="tabpanel" class="tab-pane fade in active" id="habitaciones">
	      	<ol class="breadcrumb">
				<li><a href="#">Configuraciones</a></li>
				<li class="active">Tipos de habitaciones</li>				
  			</ol>			
  			<!-- PANEL PARA HABITACIONES -->
			<div class="col-lg-5 col-md-6">
				<div class="panel panel-info">
				  <div class="panel-heading">HABITACIONES CREADAS</div>
				  <div class="panel-body">
					<?php $row=listaHabitaciones($servername,$username,$password,$dbname, "vistahabitaciones"); ?>
					<div class="col-lg-12 col-md-12">
						<button type="button" class="btn btn-success btn-block btnCrear" id="btnCrearHabitacion">Crear Habitacion</button>
						<div class="table-responsive">
				  		<table id="tableHabitaciones" class="table display" style="width:100%">
							<thead class="bg-primary">
								<tr>
									<th>No</th>
									<th>Tipo Habitacion</th>
									<th>Estado</th>    
								    <th>Acciones</th>    									            
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($row)>0){
								foreach($row as $row2) {

									echo "<tr id='trhab".$row2['Numero']."' name='".$row2['CodHabitacion']."'>
										<td id='" . $row2['Numero']. "'>" . $row2['Numero']. "</td>
										<td>" . $row2['Nombre']. "</td>
										<td>" . $row2['Estado']. "</td>
										<td>
											<a href='#' data-toggle='tooltip' data-placement='top' title='Editar habitacion'>
												<i class='fa fa-pencil fa-lg tableiconblue iconoEditar' id='" . $row2['Numero']. "'></i>
											</a>&nbsp;";

											if($row2['Estado']=="Activo") echo "<a href='#' data-toggle='tooltip' data-placement='top' title='Desactivar habitacion'><i class='fa fa-lock fa-lg tableicongreen'></i></a>&nbsp;";

											else echo "<a href='#' data-toggle='tooltip' data-placement='top' title='Activar habitacion'><i class='fa fa-unlock fa-lg 		tableicongreen'></i></a>&nbsp;";

											echo "<a href='#' data-toggle='tooltip' data-placement='top' title='Eliminar habitacion'><i class='fa fa-trash fa-lg tableiconred'></i></a>
										</td>
									</tr>";
								}	
							}
							?>

							</tbody>

							<tfoot>
								<tr>
									<th>No</th>
									<th>Tipo Habitacion</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</tfoot>
				  </table>
					  </div>
					</div>


				</div>
			  </div>
			</div>
			
			<!-- PANEL PARA TIPO DE HABITACIONES -->
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-info">
				  <div class="panel-heading">TIPOS DE HABITACIONES</div>
				  <div class="panel-body">
					<?php $rowTipo=listaHabitaciones($servername,$username,$password,$dbname, "tiposhabitaciones"); ?>
					<div class="col-lg-12 col-md-12">
						<button type="button" class="btn btn-success btn-block btnCrear" id="btnCrearTipoHab" data-toggle="modal" data-target="#modalTipoHab">Crear Tipo</button>				  		
					  	<div class="table-responsive">
						  <table id="tableTipoHab" class="table display table-hover" style="width:100%">
							<thead class="bg-primary">
								<tr>
									<th>Tipo</th>																		   
								    <th>Acciones</th>    									    								            
								</tr>
							</thead>
							<tbody>
							<?php 
							if(count($rowTipo)>0){
								foreach($rowTipo as $rowTipo2) {

									echo "<tr id='". $rowTipo2['NomTipo']."' name='". $rowTipo2['CodTipoHab']. "'>
										<td>" . $rowTipo2['NomTipo']. "</td>									

										<td>
											<a href='#' data-toggle='tooltip' data-placement='top' title='Editar Tipo'><i class='fa fa-pencil fa-lg tableiconblue iconoEditar'></i></a>&nbsp				<a href='#' data-toggle='tooltip' data-placement='top' title='Eliminar Tipo'><i class='fa fa-trash fa-lg tableiconred'></i></a>
										</td>
									</tr>";
								}
							}
							?>

							</tbody>

							
						</table>
						</div>
					</div>


				</div>
			  </div>
			</div>
								
			<!-- PANEL PARA SERVICIOS DE HABITACIONES -->
			<div class="col-lg-4 col-md-6">
				<div class="panel panel-info">
				  <div class="panel-heading">LISTA DE PRECIOS</div>
				  <div class="panel-body">
					<?php 
					  $rowLPrecios=listaHabitaciones($servername,$username,$password,$dbname, "listarlistas"); 
					  $rowListas=listaHabitaciones($servername,$username,$password,$dbname, "listaprecios"); 

					?>

					<div class="col-lg-12 col-md-12">
						<button type="button" class="btn btn-success btn-block btnCrear" id="btnCrearLista">Crear lisrta de precios</button>
						<div class="table-responsive">
						<table id="tablaListas" class="table display" style="width:100%">
							<thead class="bg-primary">
								<tr>									
									<th>Nombre</th>
									<th>Especial</th>    								    
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($rowListas)>0){
								foreach($rowListas as $rowLPrecios2) {

									echo "<tr id='trLista" . $rowLPrecios2['CodLista']. "'>										
										<td>" . $rowLPrecios2['NomLista']. "</td>										
										<td>" . $rowLPrecios2['Especial']. "</td>

										<td>
											<a href='#' data-toggle='tooltip' data-placement='top' title='Editar Lista'><i class='fa fa-pencil fa-lg tableiconblue'></i></a>&nbsp<a href='#' data-toggle='tooltip' data-placement='top' title='Eliminar Lista'><i class='fa fa-trash fa-lg tableiconred'></i></a>
											&nbsp<a href='#' data-toggle='tooltip' data-placement='top' title='Ver Precios'><i class='fa fa-eye fa-lg tableiconblue'></i></a>
										</td>

									</tr>";
								}	
							}
							?>
							</tbody>
						</table>
						</div>
					  </div>
					<div class="col-lg-12 col-md-12">
						<button type="button" class="btn btn-success btn-block btnCrear" id="btnCrearLista">Configurar dias o fechas</button>
						<div class="table-responsive">
						<table id="tablaLPrecios" class="table display" style="width:100%">
							<thead class="bg-primary">
								<tr>									
									<th>Nombre</th>									    
									<th>Dias</th>    									            
									<th>Desde</th>
									<th>Hasta</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($rowLPrecios)>0){
								foreach($rowLPrecios as $rowLPrecios2) {

									echo "<tr id='trLista" . $rowLPrecios2['CodLista']. "'>										
										<td>" . $rowLPrecios2['NombreLista']. "</td>										
										<td>" . $rowLPrecios2['Dias']. "</td>
										<td>" . $rowLPrecios2['FechaInicial']. "</td>
										<td>" . $rowLPrecios2['FechaFinal']. "</td>
										<td>
											<a href='#' data-toggle='tooltip' data-placement='top' title='Editar Lista'><i class='fa fa-pencil fa-lg tableiconblue'></i></a>&nbsp<a href='#' data-toggle='tooltip' data-placement='top' title='Eliminar Lista'><i class='fa fa-trash fa-lg tableiconred'></i></a>
										</td>

									</tr>";
								}	
							}
							?>

							</tbody>

							<tfoot>

							</tfoot>
				  </table>
					  </div>
					</div>


				</div>
			  </div>
			</div>							
			
			
									
		</div>
			
		  <!-- PANEL PARA PRECIOS DE HABITACIONES -->
      		
	    <div role="tabpanel" class="tab-pane fade in" id="precios">
	      	<ol class="breadcrumb">
				<li><a href="#">Configuraciones</a></li>
				<li class="active">Precios</li>				
			</ol>
      		
      		<!-- PANEL PARA PRECIOS DE HABITACIONES -->
      		       		       		
       		<div class="row">
				

				<!-- PANEL PARA PRECIOS DE LA LISTA -->								
				
				<div class="col-lg-12 col-md-6">
					<div class="panel panel-info">
					  <div class="panel-heading">PRECIOS DE LAS LISTAS </div>
					  <div class="panel-body">
						
						<div class="col-lg-12 col-md-12">							
							
							<div class="table-responsive">
							
							<table id="tablaPreciosListas" class="table display" style="width:auto" border>								
								<thead class="bg-primary"> 						
								</thead>
								
								<tbody></tbody>

								<tfoot></tfoot>								
							</table>
							
						  </div>
						  
						</div>

					</div>
				  </div>
				</div>
								     		
       		</div>
        </div>	
        	    		    
    </div>
  </div>
</div>

<script type="text/javascript">
	
$(document).ready(function() {
    var tableHabitaciones = $('#tableHabitaciones').DataTable();
	var tableTipoHab = $('#tableTipoHab').DataTable();
	var tableServicioAdicional = $('#tableServicioAdicional').DataTable();
	var horasHabilitadas=[];
	crearTablaListaPrecios();
		
	
	function crearTablaListaPrecios(){
		var listasPrecios = <?php echo json_encode($rowListas); ?>;	// LISTADO DE LISTA DE PRECIOS
		var tiposHab = <?php echo json_encode($rowTipo); ?>; //LISTADO DE TIPOS DE HABITACION
		
		$("<tr id='trLista' align='center' style='font-weight: bold'><td align='center'>-</td></tr><tr id='trSubLista' align=center><th align='center'>Horas</th></tr>").appendTo('#tablaPreciosListas thead');	//AGREGA EL TITULO DE "HORA"
		
		$.ajax({
		  type: 'GET',
		  url: "sql/habitaciones-sql.php",
		  data: {"horas" : "horas" },
		  success: function(dataHora){
					var horas = JSON.parse(dataHora);									  		
			  		horasHabilitadas = horas;
					},
		  
		  async:false
		});
		
		
		
		if(horasHabilitadas.length>0){
				
			$.each(horasHabilitadas, function(i,horas1){ //AGREGA LAS CELDAS CON EL NUMERO DE HORAS ACTIVADAS
				$("<tr id='trH"+horas1['id']+"'><td align='right'>"+horas1['Descripcion']+"</td></tr>").appendTo('#tablaPreciosListas tbody');																	
			});

		}
								
		// EMPEZAMOS A RECORRER LA LISTA DE LAS LISTAS DE PRECIOS
		$.each(listasPrecios, function(i, dato){
			
			//AGREGAMOS EL TITULO DE LA LISTA, OCUPANDO EL NUMERO DE COLUMNAS IGUAL AL NUMERO DE TIPOS DE HABITACIONES CREADAS
			
			$("<td colspan="+tiposHab.length+" id='th"+dato['CodLista']+"'>"+dato['NomLista']+"</td>").appendTo('#tablaPreciosListas thead #trLista');
							
			// EMPEZAMOS A RECORRERES LOS TIPOS DE HABITACIONES
			$.each(tiposHab, function(i, dato2){
				
				// AGREGAMOS LOS SUBTITULOS EN LOS CUALES ESTAN LOS TIPOS DE HABITACIONES EN CADA LISTA DE PRECIO
				$("<th id='th"+dato2['CodTipoHab']+"'>"+dato2['NomTipo']+"</th>").appendTo("#tablaPreciosListas thead #trSubLista");
				
				
				
				// AQUI HAY QUE RECORRER LAS HORAS Y CREAR LOS TD Y LOS INPUT DE CADA TIPO POR LISTA			
				$.each(horasHabilitadas, function(i,hora){
					var celdaId = dato['CodLista']+"-"+dato2['CodTipoHab']+"-"+hora['id'];
					$("#trH"+hora["id"]).append("<td id='"+celdaId+"'></td>")
					$("#"+celdaId).append("<input type='text' class='form-control txtTablaPrecios' value='0' name='' id='input-"+celdaId+"' placeholder='#'>");
					$("#input"+celdaId).priceFormat({ prefix: '', centsLimit: 0});
					
				});
				
				// AQUI ASIGNAR EL VALOR A CADA INPUT
				$.post("sql/habitaciones-sql.php", {"lista" : dato['CodLista'], tipo: dato2['CodTipoHab'] }
					, function(data2, textStatus){
					var arrayPrecioJs = JSON.parse(data2);

					if(arrayPrecioJs.length>0){
						$.each(arrayPrecioJs, function(i,precio){
							var celda = dato['CodLista']+"-"+dato2['CodTipoHab']+"-"+precio['Servicio'];							
							$("#input-"+celda).val(precio["Valor"]);
							$("#input-"+celda).priceFormat({ prefix: '', centsLimit: 0});	
						});
					}
											
				});
			});
		});				
	}	
	
	/*function funcionHoras(data)
	{
		horasHabilitadas = data;
			
		if(horasHabilitadas.length>0){
				
			$.each(horasHabilitadas, function(i,horas1){ //AGREGA LAS CELDAS CON EL NUMERO DE HORAS ACTIVADAS
				$("<tr id='trH"+horas1['Hora']+"'><td align='right'>"+horas1['Hora']+" H</td></tr>").appendTo('#tablaPreciosListas tbody');																	
			});

		}
		alert($("#trH1 td").text());
	}*/
	
	$('#btnCrearPrecio').click(function(){
		$('#tablaPrecios').prepend("<tr><td>..</td><td>..</td><td>..</td><td>..</td></tr>");	
	});
	
	// HACE QUE CUANDO SE EDITE UN VALOR DE LA TABLA DE PRECIOS SE CAMBIE AUTOMATICAMENTE
	$(".txtTablaPrecios").change(function(){
		var id = $(this).attr("id");
		var valor = $(this).val();
		valor = valor.replace(',','');
		if(valor==''){
			var valor = '0';
			$(this).val("0");
		}
		id = id.substring(6);
		id = id.split('-'); // 0 = CodLista, 1 = CodTipo, 2 = Servicio

		$.get("sql/habitaciones-sql.php", { "consultaServicio": id },
			function(data, textStatus){
			var res = JSON.parse(data);
			var consulta ="";
			if(res.length==0){
				// ES NUEVO REGISTRO
				consulta = "INSERT INTO precioshabitaciones VALUES ("+id[0]+","+id[1]+","+id[2]+","+valor+")";
			}
			else{
				// YA EXISTE EL REGISTRO Y SE DEBE MODIFICAR

				consulta = "UPDATE precioshabitaciones SET ValorServicio = "+valor+" WHERE CodLista="+id[0]+" AND CodTipoHab="+id[1]+" AND CodServicioHab="+id[2];
			}
			$.post("sql/habitaciones-sql.php", { "crearPrecio" : consulta }
			,function(data, textStatus){
				var res2 = JSON.parse(data);
				if(res2[0]=="Error")
					alert(res2[1]);
			});
		});
		$(this).priceFormat({ prefix: '', centsLimit: 0});		
		
	});
	
	
	
	
	// CREAR HABITACION ====================================================================================================================
	$('#btnCrearHabitacion').click(function(){	
				
		
		$.post("sql/habitaciones-sql.php", {"traeTiposHabtiacion" : "ok"}
			, function(data2, textStatus){
			var arrayTipoJs = JSON.parse(data2);
			
			if(arrayTipoJs.length>0){
				if($('#trhabNueva').length==0){
					
					$('#tableHabitaciones').prepend("<tr id='trhabNueva'></tr>");			
					$('#trhabNueva').append("<td><input type='text' class='form-control' name='' id='txtNoNueva' placeholder='No' required autofocus></td>");
					$('#txtNoNueva').focus();
					$('#trhabNueva').append("<td><select class='form-control' id='selectTipo'></td>");

					$.each(arrayTipoJs, function( i, l ){
					  $('#selectTipo').prepend("<option value='"+l['CodTipoHab']+"' >"+l['NomTipo']+"</option>");
					});
					$('#trhabNueva').append("<td>Activo</td>");
					$('#trhabNueva').append("<td><button type='button' id='btnCreaHab' class='btn btn-info'>Crear</button>&nbsp<button type='cancel' id='btnCancelHab' class='btn btn-default'>Cancelar</button></td>");	

					// EVENTOS QUE DISPARAN EL AJAX
					$('#btnCreaHab').click(fnCrearHab);
					$('#btnCancelHab').click(function(){
						$('#trhabNueva').remove();
					});
					$("#txtNoNueva").keypress(function(e) {
					   if(e.which == 13) {				  
						  fnCrearHab();
					   }
					});
				}else{
					alert("En este momento estas creando una habitacion");
				}
			}
			else{
				alert("Antes de agregar una habitacion debes crear al menos un tipo de habitacion");
			}
			
		});		
		
	});	
	
	function fnCrearHab(){
		var formulario = {"NoHabNueva" : $('#txtNoNueva').val(), "TipoHabNueva" : $('#selectTipo option:selected').text(), "CodTipoHab" : $('#selectTipo option:selected').val(), "funCreaHab" : "SI" };

		var statusConfirm = confirm("Desea crear la habitacion No: "+ formulario["NoHabNueva"]+ " - "+formulario["TipoHabNueva"] + "?");
		if(statusConfirm){
			jQuery.post("sql/habitaciones-sql.php", formulario
			, function(data, textStatus){

				if(data)
				{	data = JSON.parse(data);
					alert(data[0]+": "+data[1]);

					if(data[0]=="Exito") 
					{														
						$('#trhabNueva td').remove();
						$('#trhabNueva').append("<td>"+formulario["NoHabNueva"]+"</td>");
						$('#trhabNueva').append("<td>"+formulario["TipoHabNueva"]+"</td>");
						$('#trhabNueva').append("<td>Activo</td>");
						$('#trhabNueva').append("<td><a href='#' data-toggle='tooltip' data-placement='top' title='Editar habitacion'><i class='fa fa-pencil fa-lg tableiconblue'></i></a>&nbsp;<a href='#' data-toggle='tooltip' data-placement='top' title='Desactivar habitacion'><i class='fa fa-lock fa-lg tableicongreen'></i></a>&nbsp;<a href='#' data-toggle='tooltip' data-placement='top' title='Eliminar habitacion'><i class='fa fa-trash fa-lg tableiconred'></i></a></td>");

						var prueba = $('#trhabNueva');
						$('#trhabNueva').removeAttr("id");
						tableHabitaciones.row.add(prueba).draw();		 																						
					}
				}
				else
					alert("La habitacion no puede ser creada, error en la base de datos");

			});
		}


	}
	// =====================================================================================================================================
	
	// CREAR TIPO DE HABITACION ============================================================================================================
	$('#btnCrearTipo').click(function(event){
		event.preventDefault();
		formulario = $("#frmCrearTipo").serialize(); 						
		
		jQuery.post("sql/habitaciones-sql.php", formulario
		, function(data, textStatus){
			
			if(data)
			{
				data = JSON.parse(data);				
				
				if(data[0]=="Error") $('#alertaCrearTipo').attr("class","alert alert-warning").html(data[1]); 
			 	else{
					$('#alertaCrearTipo').attr("class","alert alert-success").html(data[1]);// MENSAJE DE EXITO
					//AGRERGAR <TR> TIPO A LA TABLA
					$('#tableTipoHab').prepend("<tr id='trtipNueva'><td>" + $('#nomTipo').val().toUpperCase()+ "</td><td><a href='#' data-toggle='tooltip' data-placement='top' title='Editar Tipo'><i class='fa fa-pencil fa-lg tableiconblue'></i></a>&nbsp<a href='#' data-toggle='tooltip' data-placement='top' title='Eliminar Tipo'><i class='fa fa-trash fa-lg tableiconred'></i></a></td></tr>");
					$('#nomTipo').val("");
					$('#caracteristicas').val("");	
					
					//AGRERGAR <TR> TIPO AL DATATABLE
					var prueba = $('#trtipNueva');
					$('#trtipNueva').removeAttr("id");
					
					tableTipoHab.row.add(prueba).draw();
				}
			}
			else
				$('#alertaCrearTipo').attr("class","alert alert-danger").html("El tipo de habitacion no pudo ser creada, puede ser que ya existe un tipo con el mismo nombre");
			
		});				
	});
	
		// CUANDO SE CIERRA EL MODAL SE ESCONDE EL ALERT
	$('.modalCrear').on('hidden.bs.modal', function(){
		$('#alertaCrearTipo').attr("class","hidden");
		$('#alertaCrearServicioAdicional').attr("class","hidden");
	});
	// =====================================================================================================================================
	
	// CREAR SERVICIOS ============================================================================================================
	$('#btnCrearServicioAdicional').click(function(event){
		event.preventDefault();
		formulario = $("#frmCrearServicioAdicional").serialize(); 						
		
		jQuery.post("sql/habitaciones-sql.php", formulario
		, function(data, textStatus){
			
			if(data)
			{
				data = JSON.parse(data);				
				
				if(data[0]=="Error") $('#alertaCrearServicioAdicional').attr("class","alert alert-warning").html(data[1]); 
			 	else{
					$('#alertaCrearTipo').attr("class","alert alert-success").html(data[1]);// MENSAJE DE EXITO
					//AGRERGAR <TR> TIPO A LA TABLA
					$('#tableServicioAdicional').prepend("<tr id='trservNueva'><td>" + $('#nomServicio').val().toUpperCase()+ "</td><td>Activo</td><td><a href='#' data-toggle='tooltip' data-placement='top' title='Editar Servicio'><i class='fa fa-pencil fa-lg tableiconblue'></i></a>&nbsp<a href='#' data-toggle='tooltip' data-placement='top' title='Desactivar servicio'><i class='fa fa-lock fa-lg tableicongreen'></i></a>&nbsp;<a href='#' data-toggle='tooltip' data-placement='top' title='Eliminar Servicio'><i class='fa fa-trash fa-lg tableiconred'></i></a></td></tr>");
					$('#nomServicio').val("");
					$('#descripcion').val("");	
					
					//AGRERGAR <TR> TIPO AL DATATABLE
					var prueba = $('#trservNueva');
					$('#trservNueva').removeAttr("id");
					
					tableServicioAdicional.row.add(prueba).draw();
				}
			}
			else
				$('#alertaCrearTipo').attr("class","alert alert-danger").html("El tipo de habitacion no pudo ser creada, puede ser que ya existe un tipo con el mismo nombre");
			
		});	
	});
	// =====================================================================================================================================
	
	$('[data-toggle="tooltip"]').tooltip(); 
	
	$('.iconoEditar').click(function(){
		alert($(this).parents("tr").attr("name"));						
	});
} );
</script>
<!-- <script src="js/bootstrap.js"></script> -->
<script src="../js/bootstrap-3.3.7.js"></script>
</body>

</script>
</html>