<?php

// ../controllers/agendaTurnos.php


	require'../fw/fw.php';
	require'../models/Turnos.php';
	require'../views/AgendaTurnos.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}
	
	$t = new Turnos;			// Un modelo
	$v = new AgendaTurnos;		// Vista, se carga con lo obtenido de modelos

	if (isset($_POST["buscar"])){
		var_dump($_POST["filtro"]);
	}
	// Si el usuario eligió filtrado
	if (!empty($_POST["valor"])){
		$todos = $t->getTurnosClientes($_POST["valor"]);		
	}
	// Si el usuario recién ingresa o no eligió nada, se muestran todos los turnos
	else { $todos = $t->getTurnosOcupados(); }

	$v->turnos = $todos;
	$v-> render();
