<?php

// ../controllers/bajaPacientes.php

	require'../fw/fw.php';
	require'../models/Clientes.php';
	require'../views/ListadoClientes.php';

	session_start();
	if(!($_SESSION['login']==true)){
		header("Location: login.php");
		exit;
	}

	$c = new Clientes;			//Modelo
	
	if (!empty($_POST["ID"])){
		$p->borrarClientes($_POST["ID"]);
		header('Location: listaClientes.php');
	}

	$v = new ListadoClientes;	//Vista
	$todos = $c->getTodos();
 	$v->clientes = $todos;		
	$v->render();