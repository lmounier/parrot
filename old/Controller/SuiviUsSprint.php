<?php
require("../Include/functions.php");

if(!isset($_SESSION['auth'])) header("Location: ../index.php");

$nomP = strtoupper($_SESSION['auth']->nom);
$prenomP = ucfirst($_SESSION['auth']->prenom);

$requete = "SELECT id, date_debut as dateDeb, date_fin as dateFin FROM Sprint";
$sprints = $bdd->getData($requete)->fetchAll();
$nomListes = array();
foreach ($sprints as $sprint) {
    $nomListe = "listeUsSprint" . $sprint['id'];
    $requete = "SELECT us.libelle, us.pc, us.id, l.libelle as lot FROM User_Story2 us LEFT JOIN Lot l ON us.id_lot = l.id WHERE us.id_sprint = " . $sprint['id'];
    $$nomListe = $bdd->getData($requete)->fetchAll();
    array_push($nomListes, $nomListe);
}
// Pour chaque liste de lot
foreach($nomListes as $nomLi) {
    $listeListes = array();
    $nomListe2 = $nomLi . "2";
    $$nomListe2 = array();

    // Pour chaque Us du lot
    foreach ($$nomLi as $us) {
        $libelle =  $us['libelle'];
        $pc = $us['pc'];
        $lot = $us['lot'];
        $nomListe = "listeImputationsUs" . $us['id'];
        array_push($listeListes, $nomListe);
        $requete = "SELECT i.heure, i.minute, i.raf, us.pc, us.libelle FROM Imputation2 i LEFT JOIN User_Story2 us ON i.id_us = us.id WHERE i.id_us = " . $us['id'] . " ORDER BY i.id DESC";
        $$nomListe = $bdd->getData($requete)->fetchAll();

        if(count($$nomListe) == 0 ) {
            $tempsTotal = 0;
            $raf = '?';
            $pourcentage = 0;
        } else {
            $raf = $$nomListe[0]['raf'] . "h";
            $totalTemps = 0;
            // Pour chaque imputation correspondant à l'us
            foreach($$nomListe as $listeImputation) {
                $totalTemps += $listeImputation['heure'] * 60 + $listeImputation['minute'];
            }

            $heureTotal = floor($totalTemps / 60);
            $minuteTotal = $totalTemps - ($heureTotal * 60);
            $tempsTotal = $heureTotal . "h" . $minuteTotal . "min";

            if ($raf == 0 ){
                $pourcentage = 100;
            } else {
                $pourcentage = $totalTemps * 100 / ($raf * 60 + $totalTemps );
                $pourcentage = round($pourcentage);
            }
        }

        $usFinale = array(
            'libelle' => $libelle,
            'pc' => $pc,
            'temps' => $tempsTotal,
            'raf' => $raf,
            'pourcentage' => $pourcentage,
            'lot' => $lot
        );

        array_push($$nomListe2, $usFinale);

    }

}

require("../Include/header.php");
include('../Views/suiviUsSprint.php');

