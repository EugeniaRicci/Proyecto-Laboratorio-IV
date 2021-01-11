<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
   	<?php require"../css/general.css"; ?>
	<title>Reserva de turnos</title>
	<!-- <link rel="stylesheet" type="text/css" href="../html/Style.css"> -->
	<script src="../html/Script.php"></script>
</head>
<body>
	<?php require"navbar.php"; ?>
	<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>Turnos disponibles</h1>
		</div>
		<div class="card-body">
			<form class="form-group" action="reservarTurnos.php" method="POST"> <!--CAMBIAR DESPUES -->
				
				<label for="filtro">Ver por:</label>

				<select name="filtro" id="filtro">
		  			<option value="dia" selected >Dia</option>
		 			<option value="mes">Mes</option>
				</select>
				<input type="submit" value="Buscar" name="buscar">
			</form>


			
			<table class="table table-dark" border="1">
				<tr>
					<th>ID Turno</th>
					<th>Fecha</th>
					<th>Hora</th>
					<th>Veterinario</th>
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
							<td>
							<select id="'.$t['turno_id'].'" name="clientes">';
							foreach ($this->clientes as $c) {
								echo '<option value="'.$c['cliente_id'].'">
								'.$c['nombre_cliente'].' '.$c['apellido_cliente'].' 
								</option>';
							}
							echo'</select>
							<td>
							<button onclick="reservarTurno(this.name)" name='.$t['turno_id'].' id="btnReservar" >Reservar</button>
							</td>
							</td>				
						</tr>';			
				}
				?>
			<form action="reservarTurnos.php" method="POST" id="hiddenform">
				<input type="hidden" id="hiddenIDt" name="ID" value="">
				<input type="hidden" id="hiddenIDc" name="cliente" value="clientes">
				<input type="submit" name="setSubmit" style="visibility: hidden;">
			</form>

			</table>
		</div>
	</div>
</div>
</body>
</html>