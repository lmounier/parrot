<?php
$listeHeure = array();
$listeUs = array();
$listIdUs = array();
$totalSalaire = 0;
$totalPc = 0;
$totalTemps = 0;
$listeImputationSalaire = array();

foreach ($imputations as $imputation){

    //Users stories
    $libelleUs = $bdd->getData('SELECT libelle FROM User_Story2 INNER JOIN Imputation2 ON User_Story2.id = Imputation2.id_us WHERE Imputation2.id = ' . $imputation['id'])->fetch();

    //Temps
    $temps = $imputation['heure']*60 + $imputation['minute'];
    $totalTemps += $temps;

    //Salaire
    $salaire = $bdd->getData('SELECT salaire FROM Metier INNER JOIN Utilisateur ON Metier.id = Utilisateur.id_metier WHERE Utilisateur.id = ' . $imputation['id_utilisateur'])->fetch();
    $totalSalaire += round($salaire[0] * $temps / 420);

    //Point complexité
    $pc = $bdd->getData('SELECT pc FROM User_Story2 INNER JOIN Imputation2 ON User_Story2.id = Imputation2.id_us WHERE Imputation2.id = ' . $imputation['id'])->fetch();
    $totalPc += $pc[0];

    $index = array_search( "" . $imputation['id_us'], $listIdUs);

    if( in_array($imputation['id_us'], $listIdUs)){
        $listeHeure[$index] += $temps;
        $listeImputationSalaire[$index] += round($salaire[0] * $temps / 420);
    }else{
        array_push($listIdUs, $imputation['id_us']);
        array_push($listeUs, $libelleUs[0]);
        array_push($listeHeure, $temps);
        array_push($listeImputationSalaire, round($salaire[0] * $temps / 420));
    }


}
$heureTotal = floor($totalTemps / 60);
$minuteTotal = $totalTemps - ($heureTotal * 60);
$tempsTotal = $heureTotal . "h" . $minuteTotal . "min";

$tempsJH = round($totalTemps/420, 2);

require("../Include/header.php");
require("../Views/statistiques.php");
include('../Views/statistiquesMembre.php');
?>