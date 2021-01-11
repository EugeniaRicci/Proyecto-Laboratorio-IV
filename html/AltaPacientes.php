<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<?php require"../css/general.css"; ?>
	<title>Alta de pacientes</title>
	<script src="../html/Script.php"></script>
</head>
<body>
	<?php require"navbar.php"; ?>
	<div class="container">
	<div class="card">
  		<div class="card-body">
			<p>Por favor ingrese los datos del paciente</p>
			<form class="form-group" action="" method="POST">
				<table class="table table-dark" border="1">
					<tr>
						<th>Nombre</th>
						<th>Edad</th>
						<th>Peso</th>
						<th>Sexo</th>
						<th>Especie</th>
						<th>Raza</th>
						<th>Dueño</th>
					</tr>
				
					<tr>
						<td><input class="input-group" type="text" name="nombre" maxlength="30"></td>
						<td><input class="input-group" type="text" name="edad" maxlength="3"></td>
						<td><input class="input-group" type="text" name="peso" maxlength="3"></td>
						<td>
							<select name="sexo">
								<option value="m">macho</option>
								<option value="h">hembra</option>
							</select>
						</td>
						<td>
							<select name="especie">
							<?php foreach ($this->especies as $e) { ?>
								<option value=" <?= $e['especie_id']?>">
								<?= $e['descripcion']?>
								</option>
							<?php } ?>
							</select>
						</td>
						<td><input class="input-group" type="text" name="raza" maxlength="30"></td>
						<td>
							<select name="dueño">
							<?php foreach ($this->clientes as $c) { ?>
								<option value=" <?= $c['cliente_id']?>">
								<?= $c['nombre_cliente']?> <?= $c['apellido_cliente']?> 
								</option>
							<?php } ?>
							</select>
						</td>
					</tr>	
				</table>
				<input type="submit" name="setSubmit" value="Guardar">
			</form>
			<a  class="btn btn-primary" href="listaPacientes.php" class="">Volver</a>
		</div>
	</div>
	</div>
</body>


</html>