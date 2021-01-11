<?php

// ../controllers/listaPacientes.php


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
	
	$p = new Pacientes;			// Un modelo
	$v = new ListadoPacientes;		// Vista, se carga con lo obtenido de modelos
			

	// Si el usuario eligió filtrado
	if (!empty($_POST["valor"])){
		$todos = $p->getPacientesFiltro($_POST["valor"]);		
	}
	// Si el usuario recién ingresa o no eligió nada, se muestran todos los empleados
	else { $todos = $p->getTodos();  }
	
	$v->pacientes = $todos;
	$v-> render();

