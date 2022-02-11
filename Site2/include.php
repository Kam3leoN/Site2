<?php
	
	setlocale(LC_TIME, "fr_FR.UTF-8");
	date_default_timezone_set('Europe/Paris');
	
	session_start();

	include_once('_db/connexionDB.php');
	include_once('_class/inscription.php');
	include_once('_class/connexion.php');
	
	
	// Déclaration des classes sous forme de variables
	$_Inscription = new Inscription;
	$_Connexion = new Connexion;

?>