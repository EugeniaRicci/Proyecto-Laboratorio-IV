<?php

	// ../controllers/modificarPacientes.php

	require'../fw/fw.php';
	require'../models/Pacientes.php';
	require'../models/Especies.php';
	require'../models/Clientes.php';
	require'../views/ModificarPacientes.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$e = new Especies;
	$c = new Clientes;

		
	if (isset($_POST['setSubmit']) && !empty($_POST['ID'])){

		$p = new Pacientes;
		$p->modificarPacientes(
			$_POST['ID'],
			$_POST['nombre'],
			$_POST['edad'],
			$_POST['peso'],
			$_POST['sexo'],
			$_POST['especie'],
			$_POST['raza'],
			$_POST['dueño']
		);
		header('Location: listaPacientes.php');
	}
	
	$v = new ModificarPacientes;	//Vista		
	$clientes = $c->getTodos();
	$especies = $e->getTodos();
	$v->especies = $especies;
	$v->clientes = $clientes;
	$v->render();