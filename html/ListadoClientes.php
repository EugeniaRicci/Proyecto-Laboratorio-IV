<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<?php require"../css/general.css"; ?>
	<title>Lista de Clientes</title>
	<script src="../html/Script.php"></script>
</head>
<body>
	<?php require"navbar.php"; ?>
	<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>Lista de Clientes</h1>
		</div>
  		<div class="card-body">
			<form class="form-group" action="listaClientes.php" method="POST">
				
				<input type="text" name="valor" placeholder="Buscar clientes: por N° Doc. o por Apellido" size="20" maxlength="20" class="txtSize">
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
					<th>Email</th>
					<th>Mascotas</th>
					<th>Opciones</th>
				</tr>
				<?php
				foreach ($this->clientes as $c) 
				{
					echo'<tr>
							<td>'.$c['cliente_id'].'</td>
							<td>'.$c['nombre_cliente'].'</td>
							<td>'.$c['apellido_cliente'].'</td>
							<td>'.$c['telefono'].'</td>
							<td>'.$c['direccion'].'</td>
							<td>'.$c['dni'].'</td>
							<td>'.$c['email'].'</td>
							<td>'.$c['mascota'].'</td>
							<td>
								<button class= "btn btn-primary" onclick="borrarCliente(this.name)" name= '.$c['cliente_id'].'>Borrar</button>
								
								<a href=modificarClientes.php?c='.$c['cliente_id'].' class= "btn btn-primary">Modificar</a>
							</td>					
						</tr>';			
				}
				?>
			
			<form action="bajaClientes.php" method="POST" id="hiddenform">
				<input type="hidden" id="hiddenID" name="ID" value="">
				<input type="submit" name="setSubmit" id="enviar" style="visibility: hidden;">
			</form>

			</table>
			<a class="btn btn-primary" href="altaClientes.php">Alta de cliente</a>
		</div>
	</div>
	</div>
</body>
</html>