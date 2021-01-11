<?php

// ,,/controllers/inicio.php
session_start();

if(!($_SESSION['login']==true)){
	header("Location: login.php");
	exit;
}

  require '../fw/fw.php';
  require '../views/Inicio.php';
  $v = new inicio;
  $v->render();






    
