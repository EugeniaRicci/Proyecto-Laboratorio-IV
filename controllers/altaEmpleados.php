<?php

	// ../controllers/altaEmpleados.php

	require'../fw/fw.php';
	require'../models/Empleados.php';
	require'../views/AltaEmpleados.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}
	if (isset($_POST['setSubmit'])){

		//VALIDACIONES DEL INPUT
		if (empty($_POST['nombre']))die("Debe ingresar el nombre del empleado.");
		if (empty($_POST['apellido']))die("Debe ingresar el apellido del empleado.");
		if (empty($_POST['telefono']))die("Debe ingresar un telefono.");
		if (empty($_POST['direccion']))die("Debe ingresar direccion del empleado");
		if (empty($_POST['dni'])) die("Debe ingresar un DNI valido");
		
		$e = new Empleados;
		$e->cargarEmpleados(
			$_POST['nombre'],
			$_POST['apellido'],
			$_POST['telefono'],
			$_POST['direccion'],
			$_POST['dni']
		);
		header('Location: listaEmpleados.php');
	}
	
	$v = new AltaEmpleados;
	$v->render();

