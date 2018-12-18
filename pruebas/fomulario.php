<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Documento sin título</title>
<script src="jquery.min.js"></script>
</head>

<body>

<form id="frminformacion">
<label> Nombre: </label>
 <input type="text" id="nombre" name="nombre" value="max" >
 
 <label> Apellidos: </label>
 <input type="text" id="apellidos" name="apellidos" value="max">
 <br>
 <label> Sexo: </label>
 <input type="radio" name="sexo" value="f" > Femenino
 <input type="radio" name="sexo" value="m" > Masculino
 
 <label> Grado: </label>
	<select name="grado"> <option value="1"> Primero </option>
		 <option value="2"> Segundo </option>
		 <option value="2"> Tercero </option>
	</select>
 <br>
 <input id="enviar" type="button" value="Enviar">
 <br>
 <div id="res"></div>
</form>

<script type="text/javascript">
$(document).ready(function(){
$("#enviar").click(function(){
  alert("se esta enviando formulario");
	formulario = $("#frminformacion").serialize(); 	
	
	jQuery.post("guardar.php", 
		formulario
	, function(data, textStatus){
		
			$('#res').html("Datos insertados."+data);
			$('#res').css('color','green');
		
	});
	
});
	});
 

</script>
</body>
</html>