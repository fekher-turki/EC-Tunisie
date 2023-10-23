<?php
	$bd_host = "localhost";
	$bd_utilisateur = "root";
	$bd_pass = "";
	$bd_nom = "ectunisie";
	$con = new mysqli ("$bd_host","$bd_utilisateur","$bd_pass", "$bd_nom") or die ("Connexion impossible !");
?>