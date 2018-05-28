<?php

require("../Include/functions.php");

$id = $_GET['id'];

$allTasks = getAllTasks($bdd);
$allSprints = getListeSprints($bdd);

$sprints = array();
$listeSprints = array();
$velocites = array();

// Données pour le graphe de pc consommé par type de tache et par sprint
$typeTasks = getAllTypeTasks($bdd);
$listesPcRealiseType = array();
$listesVelociteType = array();

foreach($typeTasks as $typeTask) {
    $name = "velocite_" . $typeTask['libelle'];
    $$name = array(0,0,0,0,0);
    $nameTemps = "temps_" . $typeTask['libelle'];
    $$nameTemps = array(0,0,0,0,0);
    $namePc = "nbPc_" . $typeTask['libelle'];
    $$namePc = array(0,0,0,0,0);
    
}

foreach($allSprints as $sprint) {
    $taches = getTacheRealiseSprintUser($bdd, $id, $sprint);
    foreach($taches as $tache) {
        $temps = getTempsImputationTache($bdd, $tache['id']);
        $tempsUser = getTempsImputationTacheUser($bdd, $id, $tache['id']);
        $namePc = "nbPc_" . $tache['type'];
        $pc = $tache['pc'] * $tempsUser / $temps;
        $$namePc[$sprint['id'] - 1] += $pc;
        $nameTemps = "temps_" . $tache['type'];
        $$nameTemps[$sprint['id'] - 1] += $tempsUser;
    }
}
$listesPc = array();
$listesVelocite = array();
foreach($typeTasks as $typeTask) {
    $namePc = "nbPc_" . $typeTask['libelle'];
    array_push($listesPc, $namePc);
    $nameTemps = "temps_" . $typeTask['libelle'];
    $nameVelocite = "velocite_" . $typeTask['libelle'];
    array_push($listesVelocite, $nameVelocite);
    foreach($allSprints as $sprint) {
        $pc = $$namePc[$sprint['id'] - 1];
        $temps = $$nameTemps[$sprint['id'] - 1];
        $jour = $temps / (7*60);
        if($jour != 0 ) {
            $velocite = $pc / $jour;
        } else $velocite = 0;
        $$nameVelocite[$sprint['id'] - 1] = $velocite;
    }
}

require("../Views/pcEquipe.php");
