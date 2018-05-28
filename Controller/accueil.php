<?php

require("../Include/functions.php");

if(!isset($_SESSION['auth'])) header("Location: ../index.php");
if($_SESSION['auth']->id_metier == 4 ) header("Location: statistique.php");
$nomP = strtoupper($_SESSION['auth']->nom);
$prenomP = ucfirst($_SESSION['auth']->prenom);

$dateActuelle = date("d/m/Y");
$currentSprint = getSprintByDate($bdd, date("Y-m-d"));
$allTasks = getAllTasks($bdd);
$allSprints = getListeSprints($bdd);
$titre = "Accueil";
$lastImputations = getLastImputationsUser($bdd, $_SESSION['auth']->id);
$sprintsRealises = getSprintRealise($bdd);
$sprints = array();
$listeSprints = array();
$velocites = array();

// Données pour le graphe de pc consommé par type de tache et par sprint
$taches = getTacheRealiseUser($bdd,$_SESSION['auth']->id );
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

//Deuxième essais

foreach($allSprints as $sprint) {
    $taches = getTacheRealiseSprintUser($bdd, $_SESSION['auth']->id, $sprint);
    foreach($taches as $tache) {
        $temps = getTempsImputationTache($bdd, $tache['id']);
        $tempsUser = getTempsImputationTacheUser($bdd, $_SESSION['auth']->id, $tache['id']);
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

$tachesEnCours = getTacheEnCoursByUser($bdd, $_SESSION['auth']->id);





require("../Include/header.php");
require("../Views/accueil.php");


?>