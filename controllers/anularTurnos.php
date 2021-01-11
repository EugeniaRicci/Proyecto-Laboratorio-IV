<?php

// ../controllers/anularTurnos.php

	require'../fw/fw.php';
	require'../models/Turnos.php';
	require'../views/AgendaTurnos.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}
	$t = new Turnos;			//Modelo
	
	if (!empty($_POST["ID"])){
		$t->anularTurnos($_POST["ID"]);
		header('Location: AgendaTurnos.php');
	}

	$v = new AgendaTurnos;	//Vista
	$todos = $t->getTurnosOcupados();
 	$v->empleados = $todos;		
	$v->render();