<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<?php require"../css/general.css"; ?>
	<title>Lista de Veterinarios</title>
	<script src="../html/Script.php"></script>
</head>
<body>
	<?php require"navbar.php"; ?>
	<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>Lista de Veterinarios</h1>
		</div>
  		<div class="card-body">
			<form class="form-group" action="listaEmpleados.php" method="POST">
				
				<input type="text" name="valor" class="txtSize" placeholder="Buscar empleados: por N° Doc. o por Apellido" size="20" maxlength="20">
				<input type="submit" value="buscar">

			</form>


			<table class="table table-dark" border="1">
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>DNI</th>
					<th>Opciones</th>
				</tr>
				<?php
				foreach ($this->empleados as $e) 
				{
					echo'<tr>
							<td>'.$e['empleado_id'].'</td>
							<td>'.$e['nombre'].'</td>
							<td>'.$e['apellido'].'</td>
							<td>'.$e['telefono'].'</td>
							<td>'.$e['direccion'].'</td>
							<td>'.$e['dni'].'</td>
							<td>
								<button class="btn btn-primary" onclick="borrarRegistro(this.name)" name= '.$e['empleado_id'].'>Borrar</button>
								
								<a href=modificarEmpleados.php?e='.$e['empleado_id'].' class="btn btn-primary">Modificar</a>
							</td>					
						</tr>';			
				}
				?>
			<form action="bajaEmpleados.php" method="POST" id="hiddenform">
				<input type="hidden" id="hiddenID" name="ID" value="">
				<input type="submit" id="enviar" style="visibility: hidden;">
			</form>

			</table>
			<a class="btn btn-primary" href="altaEmpleados.php" class="">Alta de empleado</a>
		</div>
	</div>
	</div>
</body>
</html>
