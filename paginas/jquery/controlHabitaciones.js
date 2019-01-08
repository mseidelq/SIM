var listaHabitaciones;
var precios=[];
var codHab;
var noHab;
var itemsProductos;
var datosProd;
var productosAgregados;
//var _valorTotalConsumos = 0;
var objHabitacion;
// ============================================ CUANDO LA PAGINA SE CARGUE ======================================================================//
$(document).ready(function(){

	traerHabitaciones();

	// ====================== TRAE LOS PRODUCTOS DISPONIBLES A LA VARIABLE itemsProductos
	$.ajax({
	  type: 'GET',
	  url: "sql/controlHabitaciones-sql.php",
	  data: {'traeProductos':'ok'},
	  success: function(data){
				var data2 = JSON.parse(data);
				itemsProductos = data2;
				},

	  async:false
	});
	// ====================== (( FIN )) TRAE LOS PRODUCTOS DISPONIBLES A LA VARIABLE itemsProductos

	// Al cerrar el admin de la habitacion verifica si hay saldo por pagar
	$("#administrarHabitacion").on("hidden.bs.modal", function () {
	    var saldo = $("#administrarHabitacion #vlrSaldo").val();
			if(saldo>0)
			{
				alert("Hay saldo pendiente por pagar");
			}
	});
	// =========================== FIN ==================================

	$(".btnHabitacion").on("click",function(){

		codHab = $(this).val();
		noHab = listaHabitaciones[codHab]["Numero"];
		var tipo = listaHabitaciones[codHab]["CodTipoHab"];
		// SI YA ESTA OCUPADA LA HABITACION
		if($('#btn'+noHab).attr("data-target") == "#administrarHabitacion"){
			$("#tituloModalAdmin").text("Administrar habitación "+noHab);
		}
		//SI NO ESTA OCUPADA LA HABITACION
		else{
			precios.length=0;
			var listaActiva=[];

			//LIMPIA LOS CAMPOS QUE SE VAN A DILIGENCIAR
			$('#selectServicio').empty();
			$('#placa').val("");
			$('#observaciones').val("");
			$("#tituloModal").text("Ocupar habitacion: "+noHab);

			// VA A BUSCAR LA LISTA QUE ESTA ACTIVA EN EL MOMENTO
			$.ajax({
			  type: 'POST',
			  url: "sql/controlHabitaciones-sql.php",
			  data: {"listaActiva": "traer"},
			  success: function(data){
						var data2 = JSON.parse(data);
						listaActiva = data2;
						},

			  async:false
			});

			if(listaActiva.length>0){
				// VA A TRAER LOS SERVICIOS Y PRECIOS DE LA LISTA Y TIPO DE HABITACION SELECCIONADA
				$.ajax({
				  type: 'POST',
				  url: "sql/controlHabitaciones-sql.php",
				  data: {"listaSeleccionada": listaActiva[0]['CodLista'], "tipo": tipo},
				  success: function(data){
							var data2 = JSON.parse(data);
							precios = data2;
							},

				  async:false
				});

				if(precios.length>0){
					$.each(precios, function(i, val){
						$("#selectServicio").append("<option value="+i+">"+val.Hora+" Hora(s), Valor = $ "+val.ValorServicio+" </option>");
					});
				}
				else{
					alert("No hay precios configurados para el tipo de habitacion");
				}

			}
			else{
				alert("No hay lista de precios activada para el dia de hoy");
			}
		}

	});

	// DESPUES DE SELECCIONAR EL SERVICIO REQUERIDO SE DA CLICK EN OCUPAR
	$("#btnOcupar").click(function(){

		$('#btn'+noHab).attr("data-target","#administrarHabitacion"); //SE CAMBIA EL MODAL
		$('#tr'+noHab).attr("class","success"); // SE MARCA EN VERDE LA OCUPACION
		var servicio = $("#selectServicio").val();
		var horas = precios[servicio]['Hora'];
		var ocupacion = []; var v0=0; var fecha;
		//TRAE LA HORA ACTUAL DEL SERVIDOR
		$.ajax({
		  type: 'POST',
		  url: "sql/controlHabitaciones-sql.php",
		  data: { "horaActual":horas},
		  success: function(data2){
					fecha = JSON.parse(data2);
					// GUARDA UN ARRAY CON LA INFORMACION DE LA OCUPACION
					ocupacion.push(noHab); ocupacion.push(horas); ocupacion.push(precios[servicio]['ValorServicio']);
					ocupacion.push(fecha[0].substr(0,10).replace(/-/g,"/"));

					if(fecha[0].substr(20,2)=="am") ocupacion.push(fecha[0].substr(11,12).replace("am","a.m."));
					else ocupacion.push(fecha[0].substr(11,12).replace("pm","p.m."));

					ocupacion.push(fecha[1].substr(0,10).replace(/-/g,"/"));

					if(fecha[1].substr(20,2)=="am") ocupacion.push(fecha[1].substr(11,12).replace("am","a.m."));
					else ocupacion.push(fecha[1].substr(11,12).replace("pm","p.m."));
					//========================================================================

					// GUARDAR LA OCUPACION
						$.post("sql/controlHabitaciones-sql.php", {"ocupacion":ocupacion} ,function(data){
							var prueba = JSON.parse(data);
							if(prueba[0] == "Exito") $("#ocupacion"+noHab).val(prueba[1]["IdOcupacion"]);
							else alert(prueba);
							$('#btn'+noHab).click();
						});
					},

		  async:false
		});
		// MARCA GRAFICAMENTE DE VERDE LA OCUPACION
		marcarOcupadas(fecha[0], fecha[1], precios[servicio]['Hora'], precios[servicio]['ValorServicio'], noHab, v0, v0, precios[servicio]['ValorServicio'], precios[servicio]['ValorServicio']);
	});


	$("#productos").click(function(){
		$("#productos").attr("placeholder","Escanee codigo de barras del producto");
		$("#productos").val("");
	  	$("#valorP").html("");
	  	$("#valorT").html("");
	  	$("#cantidadP").val("");
	  	$("#productos").autocomplete("disable");
	  	$("#productos").focus();
	});

	$("#productos").keyup(function(e){

		if(e.keyCode>=65 && e.keyCode<=90){
			$("#productos").autocomplete("enable");
		}
		else if(e.keyCode == 13 && $( "#productos" ).autocomplete( "option", "disabled" )){

			var params = {
				productoCb: $("#productos").val()
			};
			$.get("sql/controlHabitaciones-sql.php", params, function (response) {
				prodEncontrado(JSON.parse(response));

			});
			$("#productos").val("");
		}
		else if(e.keyCode == 8 && $("#productos").val()== ""){
			$("#productos").autocomplete("disable");
		}

	});

	$( "#productos" ).autocomplete({
      	source: itemsProductos,
      	disabled: true,
      	select: function (event, item) {

			var params = {
				productoId: item.item.id
			};
			$.get("sql/controlHabitaciones-sql.php", params, function (response) {
				prodEncontrado(JSON.parse(response));
			});

		}
    });


	$("#cantidadP").on("change keyup",function(e){
		var cantidad = $("#cantidadP").val();
		datosProd[0].Cantidad = cantidad;
		$("#valorT").html(datosProd[0].ValorVenta * cantidad);
		$("#valorT").priceFormat({ prefix: '', centsLimit: 0});
		if(e.keyCode == 13){
			// INGRESARLO EN LA TABLA
			objHabitacion.agregarProducto(datosProd[0]);

			$("#productos").click();
		}
	});

});

// ============================================ (( FIN )) CUANDO LA PAGINA SE CARGUE ======================================================================//

// ======= cuando se ABRE EL MODAL de administrar habitacion ============== //
$('#administrarHabitacion').on('show.bs.modal', function () {
  	$("#tablaProductosAgregados tbody>tr").remove();

  	//_valorTotalConsumos = 0;
  	$("#productos").click();
  	productosAgregados = [];
  	objHabitacion = new Habitacion(noHab);
		$("#productos").focus();
  	//traerProductosAgregados();

});


// ========================================================================= //

function Habitacion(numHab) {

    // CONSTRUCTOR QUE TRAE LA OCUPACION Y LOS PRODUCTOS DE LA HABITACION ==============================================================================
  this.numHab = numHab;
	this.ocupacion = traeOcupacion(this.numHab);
	var _productos = traerProductosAgregados(this.ocupacion.IdOcupacion);;
	var _valorTotalConsumos = 0, _pagado = this.ocupacion.ValorPagado, _saldo = this.ocupacion.ValorTotal-this.ocupacion.ValorPagado;

	$.each(_productos, function(i, val){
		$("#tablaProductosAgregados").append("<tr><td><input type='hidden' id='tIdProducto' val='"+val.IdProducto+"'>"+val.NombreGrupo+"</td><td>"+val.Nombre+"</td><td class='moneda'>"+val.ValorVenta+"</td><td id='tcantidad'>"+val.Cantidad+"</td><td id='tValorVenta' class='moneda'>"+(val.Cantidad*val.ValorVenta)+"</td><td></td></tr>");
		_valorTotalConsumos += val.Cantidad*val.ValorVenta;
	});

	$("#vlrConsumo1").html(_valorTotalConsumos);
	$("#vlrServicio").html(this.ocupacion.ValorServicio);
	$("#vlrExtra").html(this.ocupacion.ValorExtra);
	$("#vlrConsumo2").html(_valorTotalConsumos);
	$("#vlrTotal").html(this.ocupacion.ValorTotal);
	$("#vlrPagado").html(_pagado);
	$("#vlrSaldo").html(_saldo).val(_saldo);

	$(".moneda").priceFormat({ prefix: '', centsLimit: 0});
	$(".moneda").css("text-align","right");
	// =======================================================================================================================================================

    this.agregarProducto = function(datosP){ //FUNCION AGREGAR PRODUCTOS
    	var sen=0;

		if(_productos.length>0){

			$.each(_productos, function(i, val){
				if(val.Nombre == datosP.Nombre){
					_productos[i].Cantidad = _productos[i].Cantidad*1+datosP.Cantidad*1;
					$("#tablaProductosAgregados tr").eq(i+1).find("#tcantidad").html(_productos[i].Cantidad);
					$("#tablaProductosAgregados tr").eq(i+1).find("#tValorVenta").html(_productos[i].Cantidad*_productos[i].ValorVenta);
					sen = 1;

				}
			});

		}
		if(sen == 0){
			$("#tablaProductosAgregados").append("<tr><td><input type='hidden' id='tIdProducto' val='"+datosP.IdProducto+"'>"+datosP.NombreGrupo+"</td><td>"+datosP.Nombre+"</td><td class='moneda'>"+datosP.ValorVenta+"</td><td id='tcantidad'>"+datosP.Cantidad+"</td><td id='tValorVenta' class='moneda'>"+(datosP.Cantidad*datosP.ValorVenta)+"</td><td></td></tr>");

			_productos.push(datosP);

		}
		var IdOcupacion = this.ocupacion.IdOcupacion;

		// INSERTAR A LA TABLA DE VENTAS
		$.post("sql/controlHabitaciones-sql.php",
			{ "Consumos":datosP, "IdOcupacion": IdOcupacion  } ,
			function(data){
		});

		_valorTotalConsumos = 0;
		$.each(_productos, function(i, val){
			_valorTotalConsumos += val.Cantidad*val.ValorVenta;
		});

		var _consumosTotal = this.ocupacion.ValorServicio*1 + this.ocupacion.ValorExtra*1 + _valorTotalConsumos*1;
		_saldo = _consumosTotal-this.ocupacion.ValorPagado;

		$("#vlrConsumo1").html(_valorTotalConsumos);
		$("#vlrConsumo2").html(_valorTotalConsumos);
		$("#vlrTotal").html(_consumosTotal);
		$("#vlrPagado").html(_pagado);
		$("#vlrSaldo").html(_saldo);

		$("#vlrConsumo"+numHab).val(_valorTotalConsumos); $("#vlrConsumo"+numHab).html(_valorTotalConsumos);
		$("#total"+numHab).val(_consumosTotal); $("#total"+numHab).html(_consumosTotal);
		$("#saldo"+numHab).val(_saldo); $("#saldo"+numHab).html(_saldo);

		$(".moneda").priceFormat({ prefix: '', centsLimit: 0});
		$(".moneda").css("text-align","right");
    }

}



function traeOcupacion(numHab){
	var data2;
	$.ajax({
	  type: 'GET',
	  url: "sql/controlHabitaciones-sql.php",
	  data: {"habitaciones": numHab},
	  success: function(data){
				data2 = JSON.parse(data);

				},

	  async:false
	});
	return(data2[0]);
}

//TRAER LOS PRODUCTOS QUE SE AGREGARON ANTERIORMENTE AL CONSUMO

function traerProductosAgregados(IdOcupacionT){

	var IdOcupacion = IdOcupacionT;
	productosAgregados2 = [];
	$.ajax({
	  type: 'GET',
	  url: "sql/controlHabitaciones-sql.php",
	  data: {"traeConsumo": IdOcupacion },
	  success: function(data){
				var data2 = JSON.parse(data);
				productosAgregados2 = data2;
				},

	  async:false
	});
	return(productosAgregados2);
}

function prodEncontrado(datosP){
	datosProd = [];
	datosProd = datosP;


	$("#productos").val(datosProd[0].Nombre+" ["+datosProd[0].NombreGrupo+"]");
	$("#valorP").html(datosProd[0].ValorVenta);

	$("#valorP").priceFormat({ prefix: '', centsLimit: 0});
	$("#cantidadP").val("1");
	$("#cantidadP").focus();

}

//TRAE LAS HABITACIONES Y DETECTA CUALES ESTAN OCUPADAS

function traerHabitaciones()
{
	$.ajax({
	  type: 'GET',
	  url: "sql/controlHabitaciones-sql.php",
	  data: {"habitaciones": "traer"},
	  success: function(data){
				var data2 = JSON.parse(data);
				listaHabitaciones = data2;
				},

	  async:false
	});

	if(listaHabitaciones.length>0){

		$.each(listaHabitaciones, function(i, val){

			$("#tablaControlHabitaciones").append("<tr id='tr"+val["Numero"]+"'><td style='width:100px'><button type='button' class='btn btn-success btn-block btnHabitacion' id='btn"+val["Numero"]+"' data-toggle='modal' data-target='#modalOcuparHabitacion' value="+i+">"+val["Numero"]+"</button></td></tr>");

			$("#tr"+val["Numero"]).append("<td style='width:180px'><div>"+val["NomTipo"]+"</div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:100px; text-align:right' ><div id='ingresoF"+val["Numero"]+"'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:100px; text-align:right'><div id='ingresoH"+val["Numero"]+"'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:100px; text-align:right' ><div id='salidaF"+val["Numero"]+"'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:100px; text-align:right'><div id='salidaH"+val["Numero"]+"'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:80px; text-align:right'><div id='faltante"+val["Numero"]+"'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:90px; text-align:right'><div id='extra"+val["Numero"]+"'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:90px; text-align:right'><div id='servicio"+val["Numero"]+"'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:90px; text-align:right'><div id='vlrServicio"+val["Numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:90px; text-align:right'><div id='vlrExtra"+val["Numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:130px; text-align:right'><div id='vlrConsumo"+val["Numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:140px; text-align:right';><div id='total"+val["Numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:140px; text-align:right';><div id='saldo"+val["Numero"]+"' class='moneda'></div></td>");
			$("#tr"+val["Numero"]).append("<td style='width:140px'><div id='placa"+val["Numero"]+"'></td>");
			$("#tr"+val["Numero"]).append("<td><div id='observaciones"+val["Numero"]+"'></div></div><input type='hidden' id='ocupacion"+val["Numero"]+"'></td>");
			//alert(_habitaciones[i].getParametros());


		});
		conteo();
	}
}

// MARCA LAS OCUPADAS

function marcarOcupadas(fechaI, fechaS, horas, valor, hab, vExtra, vConsumos, vTotal,T_Faltante, vSaldo){

	$("#vlrConsumo"+hab).html(vConsumos).val(vConsumos);
	$("#total"+hab).html(vTotal).val(vTotal);
	$("#saldo"+hab).html(vSaldo).val(vSaldo);
	$("#vlrServicio"+hab).html(valor).val(valor);

	$("#ingresoF"+hab).html(fechaI.substr(0,10));
	$("#ingresoH"+hab).html(fechaI.substr(11,12));
	$("#faltante"+hab).html(T_Faltante);
	$("#vlrExtra"+hab).html(vExtra).val(vExtra);

	$("#salidaF"+hab).html(fechaS.substr(0,10));
	$("#salidaH"+hab).html(fechaS.substr(11,12));

	$("#servicio"+hab).html(horas+" Hora(s)");
	//FALTA PONER EL SALDO  ******************************************
	$(".moneda").priceFormat({ prefix: '', centsLimit: 0});
	$('#btn'+hab).attr("data-target","#administrarHabitacion");
	if(T_Faltante.substr(0,1)=="-")
	{
		$('#tr'+hab).attr("class","danger");
		$("#extra"+hab).html(T_Faltante.substr(1,8));
		$("#faltante"+hab).html("00:00:00");
	}
	else {
		$("#faltante"+hab).html(T_Faltante);
		$('#tr'+hab).attr("class","success");
	}

}

// INICIA EL CONTEO DE LAS HORAS

function conteo(){
	/*if(ampm=="pm" && hora[0]<12) hora[0]=hora[0]*1+12;
	var countDownDate = new Date(fecha[2],fecha[1]-1,fecha[0],hora[0],hora[1],hora[2],0);*/

	ocupadas();
	// Update the count down every 1 second
	var x = setInterval(ocupadas

	, 10000);
}

function ocupadas() {

	var habOcupadas=[];
	$.ajax({
		type: 'GET',
		url: "sql/controlHabitaciones-sql.php",
		data: { "habitaciones": "ocupacion"},
		success: function(data){
				var data2 = JSON.parse(data);
				habOcupadas = data2;
			},

		async:false
	});
	if(habOcupadas.length>0){
		// EMPEZAR A OCUPAR LAS HABITACIONES QUE ESTAN OCUPADAS EN BD
		$.each(habOcupadas, function(i, val){
			$.each(listaHabitaciones, function(i2, val2){
				if(val["NumeroHab"] == val2["Numero"]){

					var nhab = val["NumeroHab"];
					var fechaI = val["FIngreso"].toLowerCase();
					var fechaS = val["F_Estimada"].toLowerCase();
					var vExtra = val["ValorExtra"]; if(vExtra == null) vExtra=0;
					var vConsumos = val["ValorConsumos"]; if(vConsumos == null) vConsumos=0;
					var vTotal = val["ValorTotal"]; if(vTotal == null) vTotal=val['ValorServicio'];
					var vSaldo = val["ValorPagado"]; if(vSaldo == null) vSaldo=0;
					var T_Faltante = val["T_Faltante"];
					vSaldo = vTotal - vSaldo;
					$("#ocupacion"+nhab).val(val["IdOcupacion"]);

					marcarOcupadas(fechaI, fechaS, val["Horas"], val['ValorServicio'], nhab, vExtra, vConsumos, vTotal, T_Faltante, vSaldo);

				}
			});

		});

	}

	$(".moneda").priceFormat({ prefix: '', centsLimit: 0});
}
