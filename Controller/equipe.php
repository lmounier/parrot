<?php

require("../Include/functions.php");

if(!isset($_SESSION['auth'])) header("Location: ../index.php");
if($_SESSION['auth']->id_metier == 4 ) header("Location: statistique.php");
$nomP = strtoupper($_SESSION['auth']->nom);
$prenomP = ucfirst($_SESSION['auth']->prenom);

$listeMembres = getListeMembres($bdd);

//$listeTaches = getListeTachesTerminees($bdd);

require("../Include/header.php");
require("../Views/equipe.php");