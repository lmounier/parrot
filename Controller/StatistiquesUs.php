<?php
$listeLibelleUS = array();
$listeLibelleTypeTache = array();
$listeTempsLot = array();
$listeTempsTypeTache = array();
$listePrixLot = array();
$listePrixTypeTache = array();
$totalTemps = 0;
$prixTotalLot = 0;

$whereClause = "WHERE i.id_us = " . $usSave;
if (isset($jourSave)) {
    $whereClause .= " AND i.date_imput = '" . $jourSave . "'";
}elseif (isset($semaineSave)) {
    switch($semaineSave){
        case 1 :
            $date_deb = "2018-01-22";
            $date_fin = "2018-01-28";
            break;
        case 2 :
            $date_deb = "2018-01-29";
            $date_fin = "2018-02-04";
            break;
        case 3 :
            $date_deb = "2018-02-26";
            $date_fin = "2018-03-04";
            break;
        case 4 :
            $date_deb = "2018-03-05";
            $date_fin = "2018-03-11";
            break;
        case 5 :
            $date_deb = "2018-04-16";
            $date_fin = "2018-04-22";
            break;
        case 6 :
            $date_deb = "2018-04-23";
            $date_fin = "2018-04-29";
            break;
        case 7 :
            $date_deb = "2018-05-21";
            $date_fin = "2018-05-27";
            break;
        case 8 :
            $date_deb = "2018-05-28";
            $date_fin = "2018-06-03";
            break;
        case 9 :
            $date_deb = "2018-06-25";
            $date_fin = "2018-07-01";
            break;
        case 10 :
            $date_deb = "2018-07-02";
            $date_fin = "2018-07-08";
            break;
    }
    $whereClause .= " AND i.date_imput BETWEEN '" . $date_deb . "' AND '" . $date_fin . "'";

} elseif (isset($sprintSave)) {
    switch($sprintSave) {
        case 1 :
            $date_deb = "2018-01-22";
            $date_fin = "2018-02-02";
            break;
        case 2 :
            $date_deb = "2018-02-26";
            $date_fin = "2018-03-09";
            break;
        case 3 :
            $date_deb = "2018-04-16";
            $date_fin = "2018-04-27";
            break;
        case 4 :
            $date_deb = "2018-05-21";
            $date_fin = "2018-06-01";
            break;
        case 5 :
            $date_deb = "2018-06-25";
            $date_fin = "2018-07-06";
            break;
    }
    $whereClause .= " AND i.date_imput BETWEEN '" . $date_deb . "' AND '" . $date_fin . "'";
}

// Libelle de la US
$requete = "SELECT libelle FROM User_Story WHERE id = " . $usSave;
$libelleUs = $bdd->getData($requete)->fetch()[0];

// Temps par US du lot
$requete = "SELECT us.libelle, SUM(i.heure) as heure, SUM(i.minute) as minute FROM Imputation i INNER JOIN User_Story us ON i.id_us = us.id " . $whereClause;
$tmpLot = $bdd->getData($requete)->fetchAll();
//var_dump($tmpLot);
foreach ($tmpLot as $tmp) {
    $tmp2 = $tmp['heure'] * 60 + $tmp['minute'];
    array_push($listeLibelleUS, $tmp['libelle']);
    array_push($listeTempsLot, $tmp2);
    $totalTemps += $tmp2;
}

$heureTotal = floor($totalTemps / 60);
$minuteTotal = $totalTemps - ($heureTotal * 60);
$tempsTotal = $heureTotal . "h" . $minuteTotal . "min";

$tempsJH = round($totalTemps/420, 2);

// Coût par US du lot
$requete = "SELECT us.libelle, SUM(i.heure* 60 + i.minute * (m.salaire/420)) as cout FROM Imputation i LEFT JOIN Utilisateur u ON i.id_utilisateur = u.id LEFT JOIN Metier m ON u.id_metier = m.id LEFT JOIN User_Story us ON i.id_us = us.id " . $whereClause;
$prixLot = $bdd->getData($requete)->fetchAll();
foreach ($prixLot as $prix) {
    array_push($listePrixLot, round($prix['cout'], 2));
    $prixTotalLot += $prix['cout'];
}
$prixTotal = round($prixTotalLot, 2) . "€";

// Temps par type de tache pour le lot
$requete = "SELECT SUM(i.heure) as heure, SUM(i.minute) as minute, t.libelle FROM `Imputation` i LEFT JOIN Tache_Type t ON i.id_tache = t.id LEFT JOIN User_Story us ON i.id_us = us.id " . $whereClause . " GROUP BY t.libelle";
$tmpTypeTache = $bdd->getData($requete)->fetchAll();
foreach ($tmpTypeTache as $tmpTache) {
    array_push($listeLibelleTypeTache, $tmpTache['libelle']);
    $tmp = $tmpTache['heure'] * 60 + $tmpTache['minute'];
    array_push($listeTempsTypeTache, $tmp);
}

// Coût par type de tache pour le lot
$requete = "SELECT t.libelle, SUM(i.heure* 60 + i.minute * (m.salaire/420)) as cout FROM Imputation i LEFT JOIN Utilisateur u ON i.id_utilisateur = u.id LEFT JOIN Metier m ON u.id_metier = m.id LEFT JOIN User_Story us ON i.id_us = us.id LEFT JOIN Tache_Type t ON i.id_tache = t.id " . $whereClause . " GROUP BY t.libelle";
$prixTypeTache = $bdd->getData($requete)->fetchAll();
foreach ($prixTypeTache as $prixTache) {
    array_push($listePrixTypeTache, round($prixTache['cout'], 2));
}

require("../Include/header.php");
require("../Views/statistiques.php");
include('../Views/statistiquesUs.php');

?>