<?php

require("../Include/functions.php");

if(!isset($_SESSION['auth'])) header("Location: ../index.php");
$nomP = strtoupper($_SESSION['auth']->nom);
$prenomP = ucfirst($_SESSION['auth']->prenom);

$lots = getListeLots($bdd);
$listeLots = array();
foreach ($lots as $lot) {
    $nomListe = "listeUsLot" . $lot['libelle'];
    $uss = getUsByLot($bdd, $lot['id']);
    $listeUs = array();
    $tempsLot = 0;
    $rafLot = 0;
    $pcLot = 0;
    foreach($uss as $us) {
        $taches = getAllTasksFromUs($bdd, $us['id']);
        $listeTache = array();
        $tempsUs = 0;
        $rafUs = 0;
        $pcUs = 0;
        foreach($taches as $tache) {
            $tempsTache = getTempsImputationTache ($bdd, $tache['id']);
            $tempsUs += $tempsTache;
            if($tache['status'] == "Done" || $tache['status'] == "Closed" ) {
                $avancement = 100;
                $rafTache = 0;
            } elseif($tempsTache == 0) {
                $rafTache = "?";
                $avancement = 0;
            } else {
                $rafTache = getRAFFromTache($bdd, $tache['id']);
                $avancement = 100 * $tempsTache / ($rafTache + $tempsTache);
            }
            $rafUs += $rafTache;
            $pcUs += $tache['pc'];
            $tacheInfos = array(
                'id' => $tache['numero'],
                'libelle' => $tache['libelle'],
                'pc' => $tache['pc'],
                'status' => $tache['status'],
                'temps' => convertTempsMinuteHeure($bdd, $tempsTache),
                'raf' => $rafTache,
                'avancement' => $avancement,
                'assignee' => $tache['id_utilisateur']
            );
            array_push($listeTache, $tacheInfos);
        }
        if($rafUs == 0 && $tempsUs == 0 ) $avancementUs = 0;
        else $avancementUs = 100 * $tempsUs / ($rafUs + $tempsUs);
        $usInfos = array(
            'libelle' => $us['libelle'],
            'listeTache' => $listeTache,
            'temps' => convertTempsMinuteHeure($bdd, $tempsUs),
            'raf' => $rafUs,
            'avancement' => $avancementUs,
            'pc' => $pcUs
        );
        array_push($listeUs, $usInfos);

        $tempsLot += $tempsUs;
        $rafLot += $rafUs;
        $pcLot += $pcUs;
    }
    if($rafLot == 0 && $tempsLot == 0 ) $avancementLot = 0;
    else  $avancementLot = 100 * $tempsLot / ($rafLot + $tempsLot);

    $lotInfos = array(
        'libelle' => $lot['libelle'],
        'listeUs' => $listeUs,
        'temps' => convertTempsMinuteHeure($bdd, $tempsLot),
        'raf' => $rafLot,
        'avancement' => $avancementLot,
        'pc' => $pcLot
    );
    array_push($listeLots, $lotInfos);
}



require("../Include/header.php");
require("../Views/backlog.php");


?>