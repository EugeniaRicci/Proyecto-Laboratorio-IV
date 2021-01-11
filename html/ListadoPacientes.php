<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<?php require"../css/general.css"; ?>
	<title>Lista de Pacientes</title>
	<script src="../html/Script.php"></script>
</head>
<body>
	<?php require"navbar.php"; ?>
	<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>Lista de Pacientes</h1>
		</div>
  		<div class="card-body">
			<form class="form-group" action="listaPacientes.php" method="POST">
				
				<input type="text" name="valor" class="txtSize" placeholder="Buscar pacientes: por ID o por Nombre" size="20" maxlength="20">
				<input type="submit" value="buscar">

			</form>


			<table class="table table-dark" border="1">
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Edad</th>
					<th>Peso</th>
					<th>Sexo</th>
					<th>Especie</th>
					<th>Raza</th>
					<th>Dueño</th>
					<th>Opciones</th>
				</tr>
				<?php
				foreach ($this->pacientes as $p) 
				{//'DESCRIPCION' viene de ESPECIES -->DESCRIPCION por el JOIN
					echo'<tr>
							<td>'.$p['paciente_id'].'</td>
							<td>'.$p['nombre_paciente'].'</td>
							<td>'.$p['edad'].'</td>
							<td>'.$p['peso'].'</td>
							<td>'.$p['sexo'].'</td>
							<td>'.$p['descripcion'].'</td>
							<td>'.$p['raza'].'</td>
							<td>'.$p['nombre_cliente'].' '.$p['apellido_cliente']. '</td> 
							<td>
								<button class="btn btn-primary" onclick="borrarRegistro(this.name)" name='.$p['paciente_id'].'>Borrar</button>
								
								<a href=modificarPacientes.php?p='.$p['paciente_id'].' class="btn btn-primary">Modificar</a>

							</td>					
						</tr>';			
				}
				?>
			<form action="bajaPacientes.php" method="POST" id="hiddenform">
				<input type="hidden" id="hiddenID" name="ID" value="">
				<input type="submit" id="enviar" style="visibility: hidden;">
			</form>

			</table>
			<a class="btn btn-primary" href="altaPacientes.php">Alta de pacientes</a> 
		</div>
	</div>
	</div>	
</body>
</html>

