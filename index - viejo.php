<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIM</title>
<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css"> -->
<link href="css/bootstrap-3.3.7.css" rel="stylesheet" type="text/css">
<link href="css/csspropios.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">

</head>

<body style="padding-top: 60px">
<?php include("paginas/menu.php") ?>
<?php include("paginas/phpFunciones/funciones.php") ?>

<div class="container" id="principal">
  
	<div class="col-lg-12 text-center alert-info" id="titulo">
		<h2 >CONTROL DE HABITACIONES</h1>
	</div>
 	
  <div role="tabpanel">
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#habitaciones" data-toggle="tab" role="tab" aria-controls="tab1">Habitaciones</a></li>
	    <li role="presentation"><a href="#cajatabla" data-toggle="tab" role="tab" aria-controls="tab2">Visulizar en tabla</a></li>
	    <li role="presentation"><a href="#resumencaja" data-toggle="tab" role="tab" aria-controls="tab3">Resumen de caja</a></li>
	    
	  </ul>
	  <div id="tabContent1" class="tab-content">
	    <div role="tabpanel" class="tab-pane fade in active" id="habitaciones">
	      	<ol class="breadcrumb">
				<li><a href="#">Inicio</a></li>
				<li class="active">Control Caja</li>				
  			</ol>
      		
       		<div class="row col-lg-6 col-md-12">
       			<?php
					for($i=1; $i<=12; $i++){						
				?>
      			<div class="col-lg-3 col-md-3">
                    <div class="panel panel-primary zoom">
                        <div class="panel-heading">
                            <div class="row">                               
								<div class="col-lg-6">
									<div class="text-left">
										<div class="">201</div>                                    
									</div>
								</div>
								<div class="col-lg-6">
									
								</div>										
                          	</div>
                        </div>   
                        <div class="panel-body small">
							
							<div class="list-group bordes-estrecho">
                                
								<div class="list-group-item padding-5">Hora de ingreso
									<div class="text-right"><b>HH:MM:SS</b>
									</div>
                               	</div>
								<div class="list-group-item  padding-5">Consumos
									<div class="text-right  padding-5"><b>$120.000</b>
									</div>
                               	</div>
                               	<div class="list-group-item list-group-item-warning  padding-5">Tiempo
									<div class="text-right"><b>HH:MM:SS</b>
									</div>
                               	</div>                                
							</div>
                        </div>                     
						<div class="panel-footer small" align="center">                               	                                
							<button type="button" class="btn btn-success  btn-block">Ver Detalles</button>
						</div>                        
                    </div>
                </div>
                <?php
					}
				?>
       		</div>
       		
       		
        </div>
	    <div role="tabpanel" class="tab-pane fade" id="resumencaja">
	      	<ol class="breadcrumb">
				<li><a href="#">Inicio</a></li>
				<li class="active">Resumen de caja</li>				
			</ol>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="paneTwo1">
	      	<ol class="breadcrumb">
				<li><a href="#">Inicio</a></li>
				<li class="active">Resumen de caja</li>				
			</ol>
        </div>		    
    </div>
  </div>
</div>

<script src="js/jquery-1.11.3.min.js"></script>
<!-- <script src="js/bootstrap.js"></script> -->
<script src="js/bootstrap-3.3.7.js"></script>
</body>
</html>