<?php

	// ../controllers/reservarTurnos.php

	require'../fw/fw.php';
	require'../models/Clientes.php';
	require'../models/Pacientes.php';
	require'../models/Turnos.php';
	require'../views/ReservaTurnos.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$t = new Turnos; 
	$v = new ReservaTurnos;
	$c = new Clientes;
	


	if(!empty($_POST['ID']) && !empty($_POST['cliente'])){
		$t->reservarTurnos($_POST['ID'], $_POST['cliente']);
		header('Location: AgendaTurnos.php');
	}

	// Si el usuario eligió filtrar
	
	if (isset($_POST['buscar'])){
		if (($_POST["filtro"]) == 'dia') {$turnos = $t->getTurnosDisponibles(1);}
		if (($_POST["filtro"]) == 'mes') {$turnos = $t->getTurnosDisponibles(2);}		
	}
	//Y si no eligió filtrar, cae por default en dias
	else{ $turnos = $t->getTurnosDisponibles(1); }

	$clientes = $c->getTodos();
	$v->clientes = $clientes;
	$v->turnos = $turnos;
	$v->render();
