<?php

	// ../controllers/modificarClientes.php

	require'../fw/fw.php';
	require'../models/Pacientes.php';
	require'../models/Clientes.php';
	require'../views/ModificarClientes.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$c = new Clientes;
		
	if (isset($_POST['setSubmit']) && !empty($_POST['ID'])){
		$p->modificarClientes(
			$_POST['ID'],
			$_POST['nombre'],
			$_POST['apellido'],
			$_POST['telefono'],
			$_POST['direccion'],
			$_POST['dni'],
			$_POST['email']
		);
		header('Location: ListaClientes.php');
	}
	
	$v = new ModificarClientes;	//Vista		
	$clientes = $c->getTodos();
	//$pacientes = $p->getTodos();
	//$v->pacientes = $pacientes;
	$v->clientes = $clientes;
	$v->render();