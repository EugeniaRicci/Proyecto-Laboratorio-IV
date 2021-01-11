<?php

// ../controllers/listaEmpleados.php
	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	require'../fw/fw.php';
	require'../models/Empleados.php';
	require'../views/ListadoEmpleados.php';

	$e = new Empleados;			// Un modelo
	$v = new ListadoEmpleados;		// Vista, se carga con lo obtenido de modelos
			

	// Si el usuario eligió filtrado
	if (!empty($_POST["valor"])){
		$todos = $e->getEmpleadosFiltro($_POST["valor"]);		
	}
	// Si el usuario recién ingresa o no eligió nada, se muestran todos los empleados
	else { $todos = $e->getTodos(); }

	$v->empleados = $todos;
	$v-> render();


