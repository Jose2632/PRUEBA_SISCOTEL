<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Formulario</title>
	<link rel="stylesheet" href="">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<h1 class="text-center">Formulario Prueba SISCOTEL - JM</h1>
		<form>
			<div class="row">	
				<div class="col-md-6">
					<label class="form-label">Nombre</label>
					<input type="text" class="form-control" id="nombre" maxlength="20" placeholder="Ingresar Nombre">
				</div>
				<div class="col-md-6">
					<label class="form-label">Apellido</label>
					<input type="text" class="form-control"  id="apellido" maxlength="20" placeholder="Ingresar Apellido">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label class="form-label">Cédula</label>
					<input type="number" class="form-control" id="cedula"  maxlength="10" placeholder="Ingresar Cédula">
				</div>
				<div class="col-md-6">
					<label class="form-label">Correo</label>
					<input type="email" class="form-control" id="correo"  maxlength="20" placeholder="Ingresar Correo">
				</div>
			</div>
			<div class="mb-3">
				<label class="form-label">Descripción</label>
				<input type="text" class="form-control" id="descripcion"  maxlength="30" placeholder="Ingresar Descripción">
			</div>
			<a onclick="insparms()" class="btn btn-dark" title="aceptar">Aceptar</a>
		</form>
		<br>
		<div id="contentreads"></div>
	</div>


	<script>

		function insparms() {

			var nombre = $('#nombre').val();
			var apellido = $('#apellido').val();
			var cedula = $('#cedula').val();
			var correo = $('#correo').val(); 
			var descripcion = $('#descripcion').val();
			var INSPARMS = "INSPARMS";

			if(nombre==''||apellido==''||cedula==''||correo==''||descripcion=='') {
				$('#contentreads').fadeIn(1000).html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Completar todos los campos.</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				return false;
			}

			if (nombre.length > 20 || apellido.length > 20 || cedula.length > 10 || correo.length > 20 || descripcion.length > 20) {
				$('#contentreads').fadeIn(1000).html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Revisar longitud de campos.</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				return false;
			}

			valemail=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
			if(!valemail.exec(correo)){ 
				$('#contentreads').fadeIn(1000).html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Ingresar dirección de Email válida.</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				return false;
			}


			$("#formins").prop('disabled', true);
			$('#contentreads').html('<div class="d-flex align-items-center"><strong>Cargando...</strong><div class="spinner-border ms-auto" role="status" aria-hidden="true"></div></div>');

			$.ajax({
				type: "POST",
				url: "check.php",
				data: {
					nombre:nombre,
					apellido:apellido,
					cedula:cedula,
					correo:correo,
					descripcion:descripcion,
					INSPARMS: INSPARMS
				},
				cache: false,
				success: function(data) {
					data = JSON.parse(data);
					if (data.error == 1) {
						$('#contentreads').fadeIn(1000).html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>'+data.msg+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
						$("#formins").prop('disabled', false);
						return false;
					}
					else {
						$('#contentreads').fadeIn(1000).html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>'+data.msg+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
						$('#nombre,#apellido,#cedula,#correo,#descripcion').val('');
						$("#formins").prop('disabled', false);
						lstparms();
						return true;
					}     
				},
				error: function(data) {
					$('#contentreads').fadeIn(1000).html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>'+data.msg+'</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
					$("#formins").prop('disabled', false);
					return false;
				},
			});  
		}

	</script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>