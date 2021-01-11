<?php

	// ../controllers/altaPacientes.php

	require'../fw/fw.php';
	require'../models/Pacientes.php';
	require'../models/Especies.php';
	require'../models/Clientes.php';
	require'../views/AltaPacientes.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$e = new Especies;
	$c = new Clientes;
	
	if (isset($_POST['setSubmit'])){

		//VALIDACIONES DEL INPUT
		if (empty($_POST['nombre']))die("Debe ingresar el nombre del paciente.");
		if (empty($_POST['edad']))die("Debe ingresar edad aproximada del paciente.");
		if (empty($_POST['peso']))die("Debe ingresar peso aproximado del paciente.");
		if (empty($_POST['raza']))die("Debe ingresar alguna descripcion sobre la raza del paciente.");

		$e = new Pacientes;
		$e->cargarPacientes(
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

	$v = new AltaPacientes;

	$clientes = $c->getTodos();
	$especies = $e->getTodos();
	$v->especies = $especies;
	$v->clientes = $clientes;
 	
	$v->render();
