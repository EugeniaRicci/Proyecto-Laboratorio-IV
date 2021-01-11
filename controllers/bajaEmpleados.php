<?php

// ../controllers/bajaEmpleados.php

	require'../fw/fw.php';
	require'../models/Empleados.php';
	require'../views/ListadoEmpleados.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$e = new Empleados;			//Modelo
	
	if (!empty($_POST["ID"])){
		$e->borrarEmpleados($_POST["ID"]);
		header('Location: ListaEmpleados.php');
	}

	$v = new ListadoEmpleados;	//Vista
	$todos = $e->getTodos();
 	$v->empleados = $todos;		
	$v->render();