<?php

	// ../controllers/altaClientes.php

	require'../fw/fw.php';
	require'../models/Clientes.php';
	require'../models/Especies.php';
	require'../views/AltaClientes.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	if (isset($_POST['setSubmit'])){

		//VALIDACIONES DEL INPUT
		if (empty($_POST['nombre_cliente']))die("Debe ingresar el nombre del empleado.");
		if (empty($_POST['apellido']))die("Debe ingresar el apellido del empleado.");
		if (empty($_POST['telefono']))die("Debe ingresar un telefono.");
		if (empty($_POST['direccion']))die("Debe ingresar direccion del empleado");
		if (empty($_POST['dni'])) die("Debe ingresar un DNI valido");
		if (empty($_POST['email'])) die("Debe ingresar un email valido");
		
		$c = new Clientes;
		
		$c->cargarClientes(
			$_POST['nombre_cliente'],
			$_POST['apellido'],
			$_POST['telefono'],
			$_POST['direccion'],
			$_POST['dni'],
			$_POST['email']
		);

	}

	
	$v = new AltaClientes;
	$e = new Especies; 
	$especies = $e->getTodos();
	$v->especies = $especies;
 	
	$v->render();

