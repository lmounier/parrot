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
$listeCout = array(
    "Management" => 0,
    "Back" => 0,
    "Front" => 0,
    "Bug" => 0,
    "Design" => 0
);
$tachesRealises = getTachesRealiseSprint($bdd, $currentSprint);
foreach($tachesRealises as $tache) {
    $coutTache = 0;
    $imputations = getImputationFromTache($bdd, $tache['id'], $currentSprint);
    foreach($imputations as $imputation) {
        $salaire = getSalaireFromMetier($bdd, $imputation['metier']);
        $temps = $imputation['heure'] * 60 + $imputation['minute'];
        $cout = $temps * $salaire[0] / 420;
        $coutTache += $cout;
        $listeCout[$tache['type']] += $cout;
    }
    $infoTache = array(
        'libelle' => $tache['libelle'],
        'cout' => $coutTache,
        'type' => $tache['type']
    );
    array_push($listeTaches, $infoTache);
}

$membres = getListeMembres($bdd);
$listeMembres = array();
foreach($membres as $membre) {
    $typeTaches = getListeTypeTache($bdd);
    $infoMembreTemps = array();
    $infoMembreCout = array();
    foreach($typeTaches as $typeTache) {
        $minutes = getImputationTypeMembreSprint($bdd, $membre['id'], $typeTache['id'], $currentSprint);
        $salaire = getSalaireFromMetier($bdd, $membre['id_metier']);
        $cout = $minutes * $salaire[0] / 420;
        $temps = convertTempsMinuteHeure($bdd, $minutes);
        array_push($infoMembreTemps, $temps);
        array_push($infoMembreCout, $cout);
    }
    $infoMembre = array(
        "nom" => $membre['prenom'],
        "temps" => $infoMembreTemps,
        "cout" => $infoMembreCout
    );
    array_push($listeMembres, $infoMembre);
}

$listePC = array();
foreach($typeTaches as $typeTache) {
    $pcSprint = getPCConsommeByTypeSprint($bdd, $typeTache['id'], $currentSprint);
    $pcProjet = getPCConsommeByTypeSprint($bdd, $typeTache['id']);
    $pcTotal = getPcTotalByType($bdd, $typeTache['id']);
    if($pcTotal['pc'] == 0) {
        $avancementSprint = 0;
        $avancementProjet = 0;
    } else {
        $avancementSprint = floor($pcSprint['pc'] * 100 / $pcTotal['pc']);
        $avancementProjet = floor($pcProjet['pc'] * 100 / $pcTotal['pc']);
    }
    $info = array(
        'type' => $typeTache['libelle'],
        'pcRealiseSprint' => $pcSprint['pc'],
        'pcRealiseProjet' => $pcProjet['pc'],
        'pcARealiser' => $pcTotal['pc'],
        'avancementSprint' => $avancementSprint,
        'avancementProjet' => $avancementProjet
    );
    array_push($listePC, $info);
}

/*echo "<pre>";
var_dump($listePC);
echo "</pre>";*/

require("../Include/header.php");
require("../Views/sprint.php");

