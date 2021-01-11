<?php

	// ../controllers/modificarEmpleados.php

	require'../fw/fw.php';
	require'../models/Empleados.php';
	require'../views/ModificarEmpleados.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}



	if (isset($_POST['setSubmit']) && !empty($_POST['ID'])){

		$e = new Empleados();
		$e->modificarEmpleados(
			$_POST['ID'],
			$_POST['nombre'],
			$_POST['apellido'],
			$_POST['telefono'],
			$_POST['direccion'],
			$_POST['dni']
		);
		header('Location: listaEmpleados.php');
	}
	
	$v = new ModificarEmpleados;	
	$v->render();