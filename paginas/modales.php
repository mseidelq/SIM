	<!-- MODAL DE CREAR TIPO DE HABITACION -->

	<div class="modal fade fixed-top modalCrear" id="modalTipoHab" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Crear tipo de habitacion</h4>
		</div>
		<div class="modal-body">
		  <form id="frmCrearTipo">
			  <div class="form-group">
				<label for="nomTipo">Ingrese tipo de habitacion</label>
				<input type="text" class="form-control" name="nomTipo" id="nomTipo" placeholder="Tipo de habitacion" required value="">
			  </div>
			  <div class="form-group">
				<label for="caracteristicas">Caracteristicas de la habitacion</label>
				<textarea value="" class="form-control" rows="4" name="caracteristicas" id="caracteristicas" maxlength="200" placeholder="Caracteristicas de la habitaciones, maximo 200 caracteres"></textarea>
			  </div>
			  <div class="form-group">		
				<button type="submit" id="btnCrearTipo" class="btn btn-info">Crear tipo de habitacion</button>		
			  </div>
				<div class="alert alert-success hidden alertaCrear" role="alert" id="alertaCrearTipo"></div>
	      </form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
			
	  </div>

	</div>
	</div>


	<!-- MODAL DE CREAR SERVICIO ADICIONAL -->

	<div class="modal fade fixed-top modalCrear" id="modalServicioAdicional" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Crear servicio adicional</h4>
		</div>
		<div class="modal-body">
		  <form id="frmCrearServicioAdicional">
			  <div class="form-group">
				<label for="nomServicio">Ingrese nombre del servicio</label>
				<input type="text" class="form-control" name="nomServicio" id="nomServicio" placeholder="Nombre del servicio" required value="">
			  </div>
			  <div class="form-group">
				<label for="descripcion">Descripcion del servicio</label>
				<textarea value="" class="form-control" rows="4" name="descripcion" id="descripcion" maxlength="200" placeholder="Descripcion del servicio, maximo 200 caracteres"></textarea>
			  </div>
			  <div class="form-group">		
				<button type="submit" id="btnCrearServicioAdicional" class="btn btn-info">Crear Servicio</button>		
			  </div>
				<div class="alert alert-success hidden alertaCrear" role="alert" id="alertaCrearServicioAdicional"></div>
	      </form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
			
	  </div>

	</div>
	</div>


	<!-- MODAL DE CREAR TIPO DE HABITACION -->

	<div class="modal fade fixed-top modalCrear" id="modalTipoHab" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Crear tipo de habitacion</h4>
		</div>
		<div class="modal-body">
		  <form id="frmCrearTipo">
			  <div class="form-group">
				<label for="nomTipo">Ingrese tipo de habitacion</label>
				<input type="text" class="form-control" name="nomTipo" id="nomTipo" placeholder="Tipo de habitacion" required value="">
			  </div>
			  <div class="form-group">
				<label for="caracteristicas">Caracteristicas de la habitacion</label>
				<textarea value="" class="form-control" rows="4" name="caracteristicas" id="caracteristicas" maxlength="200" placeholder="Caracteristicas de la habitaciones, maximo 200 caracteres"></textarea>
			  </div>
			  <div class="form-group">		
				<button type="submit" id="btnCrearTipo" class="btn btn-info">Crear tipo de habitacion</button>		
			  </div>
				<div class="alert alert-success hidden alertaCrear" role="alert" id="alertaCrearTipo"></div>
	      </form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
			
	  </div>

	</div>
	</div>


	<!-- MODAL DE OCUPAR HABITACION -->

	<div class="modal fade fixed-top modalCrear" id="modalOcuparHabitacion" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title" id="tituloModal">Ocupar habitacion</h4>
		</div>
		<div class="modal-body">
		  
			  <div class="form-group">
				<label for="selectServicio">Que servicio deseas tomar ?</label>
				<select class="form-control" name="selectServicio" id="selectServicio" placeholder="Seleccione servicio" required>
			  	</select>
			  			  
			  </div>
			  
			  <div class="form-group">		
				<button type="button" id="btnOcupar" class="btn btn-info"  data-dismiss="modal">Ocupar habitacion</button>		
			  </div>
			<div class="alert alert-success hidden alertaCrear" role="alert" id=""></div>
	      
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
			
	  </div>

	</div>
	</div>


	<!-- MODAL DE AGREGAR ARTICULOS O FINALIZAR SERVICIO HABITACION -->

	<div class="modal fade bd-example-modal-lg" id="administrarHabitacion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg"  role="document">

	  <!-- Modal content-->
	  <div class="modal-content fixed-top" id="administrarHabitacion2">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title" id="tituloModalAdmin">Administrar habitacion</h4>
		</div>
		<div class="modal-body">
		  
			<div class="container-fluid">
				<div class="row">
					
					<div class="panel panel-info">
						  <div class="panel-heading">VENTA DE PRODUCTOS</div>
						  <div class="panel-body" >				  	
							<div class="col-lg-12">
								<div class="col-lg-6 divmodal ui-front">
								  <label>Productos: </label>
								  <input id="productos" class="form-control ">
								</div>
								<div class="col-lg-2 divmodal">
								  <div class=""><label>Valor: </label></div>
								  <div id="valorP" class=""></div>
								</div>
								<div class=" col-lg-2 divmodal">
								  <label for="cantidadP">Cant: </label><br>
								  <input type="number" id="cantidadP" maxlength="2" class="form-control ">
								</div>
								<div class="col-lg-2 divmodal">
								  <div class=""><label>Total: </label></div>
								  <div id="valorT" class=""></div>
								</div>	
							</div>	
							<div class="col-lg-12"><hr></div>
							<div class="col-lg-12">
								<div class="table-responsive">
							
									<table id="tablaProductosAgregados" class="table-hover display table" style="width:100%" border>								
										<thead class="bg-primary"> 						
										<tr>
											<th >Grupo</th>
											<th >Producto</th>
											<th >Valor</th>
											<th >Cant</th>
											<th >Valor Total</th>
											<th >Acciones</th>											
										</tr>
										</thead>
										
										<tbody>									
										</tbody>

										<tfoot class="bg-success">
											<th colspan="4">
												Total consumos
											</th>
											<th><div id="vlrConsumo1" class="moneda"></div></th>
											<th>-----</th>
										</tfoot>								
									</table>
							
						  		</div>
							</div>
							<div class="col-lg-12">
								<div class="table-responsive">
							
									<table id="tablaResumenHabitacion" class="table-hover display table" style="width:100%" border>								
										<thead class="bg-warning"> 						
										<tr>
											<th >Vlr Servicio</th>
											<th >Vlr Extra</th>
											<th >Vlr Consumos</th>
											<th >Vlr Total</th>
											<th >Pagado</th>
											<th >Saldo</th>											
										</tr>
										</thead>
										<tr>
											<td><div id="vlrServicio" class="moneda">0</div></td>
											<td><div id="vlrExtra" class="moneda">0</div></td>
											<td><div id="vlrConsumo2" class="moneda"></div></td>
											<td><div id="vlrTotal" class="moneda">0</div></td>
											<td><div id="vlrPagado" class="moneda">0</div></td>
											<td><div id="vlrSaldo" class="moneda">0</div></td>
										</tr>
										<tbody>									
										</tbody>
																	
									</table>
							
						  		</div>
							</div>				
					  </div>
					  <div class="panel-footer" >
					  		
					  </div>
					</div>
				</div>

				<div class="panel panel-info">
					<div class="panel-heading">TOTALES</div>
					<div class="panel-body" >	
					</div>
				</div>

				<hr>  
				<div class="form-group">		
					<button type="button" id="" class="btn btn-info">Finalizar servicio</button>		
					<button type="button" id="" class="btn btn-info">Realizar pago</button>		
				</div>
				  
				<div class="alert alert-success hidden alertaCrear" role="alert" id=""></div>
			</div>
	      
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
			
	  </div>

	</div>
	</div>