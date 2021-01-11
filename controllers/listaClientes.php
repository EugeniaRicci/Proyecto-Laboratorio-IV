<?php

// ../controllers/listaClientes.php


	require'../fw/fw.php';
	require'../models/Pacientes.php';
	require'../models/Especies.php';
	require'../models/Clientes.php';
	require'../views/ListadoClientes.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}
	
	$c = new Clientes;			// Un modelo
	$v = new ListadoClientes;		// Vista, se carga con lo obtenido de modelos		

	/* Si el usuario eligió filtrado
	if (!empty($_POST["valor"])){
		$todos = $e->getEmpleadosFiltro($_POST["valor"]);		
	}*

	// Si el usuario recién ingresa o no eligió nada, se muestran todos los empleados
	else { }*/
	$todos = $c->getTodos(); 
	$v->clientes = $todos;
	$v-> render();
