<?php
$listeLibelleLot = array();
$listeLibelleTypeTache = array();
$listeTempsLot = array();
$listeTempsTypeTache = array();
$listePrixLot = array();
$listePrixTypeTache = array();
$totalTemps = 0;
$prixTotal = 0;

// Temps par lot
$requete = "SELECT SUM(i.heure) as heure, SUM(i.minute) as minute, l.libelle FROM `Imputation2` i LEFT JOIN User_Story2 u ON i.id_us = u.id LEFT JOIN Lot2 l ON u.id_lot = l.id GROUP BY l.libelle";
$tmpLots = $bdd->getData($requete)->fetchAll();
foreach ($tmpLots as $tmpLot) {
    $tmp = $tmpLot['heure'] * 60 + $tmpLot['minute'];
    array_push($listeLibelleLot, $tmpLot['libelle']);
    array_push($listeTempsLot, $tmp);
    $totalTemps += $tmp;
}

$heureTotal = floor($totalTemps / 60);
$minuteTotal = $totalTemps - ($heureTotal * 60);
$tempsTotal = $heureTotal . "h" . $minuteTotal . "min";

$tempsJH = round($totalTemps/420, 2);

// Coût par lot
$requete = "SELECT l.libelle, SUM(i.heure* 60 + i.minute * (m.salaire/420)) as cout FROM Imputation2 i LEFT JOIN Utilisateur u ON i.id_utilisateur = u.id LEFT JOIN Metier m ON u.id_metier = m.id LEFT JOIN User_Story2 us ON i.id_us = us.id LEFT JOIN Lot2 l ON us.id_lot = l.id GROUP BY l.libelle";
$prixLots = $bdd->getData($requete)->fetchAll();
foreach ($prixLots as $prixLot) {
    array_push($listePrixLot, round($prixLot['cout'], 2));
    $prixTotal += $prixLot['cout'];
}
$prixTotal = round($prixTotal, 2) . "€";


//Temps par type de tâche
$requete = "SELECT SUM(i.heure) as heure, SUM(i.minute) as minute, t.libelle FROM `Imputation2` i LEFT JOIN Tache_Type2 t ON i.id_tache = t.id GROUP BY t.libelle";
$tmpTypeTache = $bdd->getData($requete)->fetchAll();
foreach ($tmpTypeTache as $tmpTache) {
    array_push($listeLibelleTypeTache, $tmpTache['libelle']);
    $tmp = $tmpTache['heure'] * 60 + $tmpTache['minute'];
    array_push($listeTempsTypeTache, $tmp);
}

// Coût par type de tâche
$requete = "SELECT t.libelle, SUM(i.heure* 60 + i.minute * (m.salaire/420)) as cout FROM Imputation2 i LEFT JOIN Utilisateur u ON i.id_utilisateur = u.id LEFT JOIN Metier m ON u.id_metier = m.id LEFT JOIN User_Story2 us ON i.id_us = us.id LEFT JOIN Tache_Type2 t ON i.id_tache = t.id GROUP BY t.libelle";
$prixTypeTache = $bdd->getData($requete)->fetchAll();
foreach ($prixTypeTache as $prixTache) {
    array_push($listePrixTypeTache, round($prixTache['cout'], 2));
}

require("../Include/header.php");
require("../Views/statistiques.php");
include('../Views/statistiquesProjet.php');
?>