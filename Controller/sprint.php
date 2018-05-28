<?php

require("../Include/functions.php");

if(!isset($_SESSION['auth'])) header("Location: ../index.php");
if($_SESSION['auth']->id_metier == 4 ) header("Location: statistique.php");
$nomP = strtoupper($_SESSION['auth']->nom);
$prenomP = ucfirst($_SESSION['auth']->prenom);

$dateActuelle = date("d/m/Y");
$currentSprint = getSprintByDate($bdd, date("Y-m-d"));

$tachesPrevues = getTacheSprint($bdd, $currentSprint['id']);

$listeTaches = array();
$tachesRealises = getTachesRealiseSprint($bdd, $currentSprint);
foreach($tachesRealises as $tache) {
    $coutTache = 0;
    $imputations = getImputationFromTache($bdd, $tache['id'], $currentSprint);
    foreach($imputations as $imputation) {
        $salaire = getSalaireFromMetier($bdd, $imputation['metier']);
        $temps = $imputation['heure'] * 60 + $imputation['minute'];
        $cout = $temps * $salaire[0] / 420;
        $coutTache += $cout;
    }
    $infoTache = array(
        'libelle' => $tache['libelle'],
        'cout' => $coutTache,
        'type' => $tache['type']
    );
    array_push($listeTaches, $infoTache);
}


require("../Include/header.php");
require("../Views/sprint.php");

