<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<?php require"../css/general.css"; ?>
	<title>Agenda de próximos turnos</title>
	<script src="../html/Script.php"></script>
</head>
<body>
	<?php require"navbar.php"; ?>
	<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>Próximos turnos</h1>
		</div>
  		<div class="card-body">
			<form class="form-group" action="agendaTurnos.php" method="POST">
				
				<input type="text" name="valor" class="txtSize" placeholder="Buscar turnos por cliente: ingrese apellido" size="20" maxlength="30">
				<input type="submit" value="buscar">

			</form>


			<table class="table table-dark" border="1">
				<tr>
					<th>ID Turno</th>
					<th>Fecha</th>
					<th>Hora</th>
					<th>Empleado</th>
					<th>Consultorio</th>
					<th>Cliente</th>
					<th>Opciones</th>
				</tr>
				<?php
				foreach ($this->turnos as $t) 
				{
					echo'<tr>
							<td>'.$t['turno_id'].'</td>
							<td>'.$t['fecha'].'</td>
							<td>'.$t['hora'].'</td>
							<td>'.$t['nombre'].' '.$t['apellido'].'</td>
							<td>'.$t['descripcion'].'</td>
							<td>'.$t['nombre_cliente'].' '.$t['apellido_cliente'].'</td>
							<td>
								<button class="btn btn-primary" onclick="anularTurno(this.name)" name= '.$t['turno_id'].'>Anular</button>
							</td>					
						</tr>';			
				}
				?>
			<form action="anularTurnos.php" method="POST" id="hiddenform">
				<input type="hidden" id="hiddenID" name="ID" value="">
				<input type="submit" name="setSubmit" id="enviar" style="visibility: hidden;">
			</form>

			</table>

		</div>
	</div>
	</div>
</body>
</html>
