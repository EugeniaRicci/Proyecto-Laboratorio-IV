<?php

// ../controllers/bajaPacientes.php

	require'../fw/fw.php';
	require'../models/Pacientes.php';
	require'../models/Especies.php';
	require'../models/Clientes.php';
	require'../views/ListadoPacientes.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$p = new Pacientes;			//Modelo
	
	if (!empty($_POST["ID"])){
		$p->borrarPacientes($_POST["ID"]);
		header('Location: listaPacientes.php');
	}

	$v = new ListadoPacientes;	//Vista
	$todos = $p->getTodos();
 	$v->pacientes = $todos;		
	$v->render();