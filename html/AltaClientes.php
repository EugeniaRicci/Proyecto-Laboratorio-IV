<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<?php require"../css/general.css"; ?>
	<title>Alta de Clientes</title>
	<script src="../html/Script.php"></script>
</head>
<body>
	<?php require"navbar.php"; ?>
	<div class="container">
	<div class="card">
  		<div class="card-body">
			<p>Por favor ingrese los datos del cliente</p>
			<form class="form-group" action="" method="POST">
				<table class="table table-dark" border="1">
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Telefono</th>
						<th>Direccion</th>
						<th>DNI</th>
						<th>Email</th>
					</tr>
				
					<tr>
						<td><input type="text" class="input-group" name="nombre_cliente" maxlength="50"></td>
						<td><input type="text" class="input-group" name="apellido" maxlength="50"></td>
						<td><input type="text" class="input-group" name="telefono" maxlength="20"></td>
						<td><input type="text" class="input-group" name="direccion" maxlength="60"></td>
						<td><input type="text" class="input-group" name="dni" maxlength="20"></td>
						<td><input type="text" class="input-group" name="email" maxlength="70"></td>
						<td><a href=altaPacientes.php class= "btn btn-primary">Agregar Mascota</a></td>
					</tr>	
				</table>
				<input type="submit" name="setSubmit" value="Guardar">
			</form>
			<a class="btn btn-primary" href="listaClientes.php" class="">Volver</a>
		</div>
	</div>
	</div>
</body>


</html>
