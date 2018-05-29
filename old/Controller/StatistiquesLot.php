<?php
    $listeLibelleUS = array();
    $listeLibelleTypeTache = array();
    $listeTempsLot = array();
    $listeTempsTypeTache = array();
    $listePrixLot = array();
    $listePrixTypeTache = array();
    $totalTemps = 0;
    $prixTotalLot = 0;

    // Libelle du lot
    $requete = "SELECT libelle FROM Lot2 WHERE id = " . $lotSave;
    $libelleLot = $bdd->getData($requete)->fetch()[0];

    $titre = "Statistiques du lot " . $libelleLot;
    $whereClause = "WHERE l.id = " . $lotSave;
    if (isset($jourSave)) {
        $whereClause .= " AND i.date_imput = '" . $jourSave . "'";
        $titre .= " le " . $jourSave;
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
        $titre .= " la semaine " . $semaineSave;

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
        $titre .= " au cours du sprint " . $sprintSave;
    }

    if (isset($membreSave)) {
        $whereClause .= " AND i.id_utilisateur = " . $membreSave;
        $requete = "SELECT prenom FROM Utilisateur WHERE id = " . $membreSave;
        $prenom = $bdd->getData($requete)->fetch()[0];
        $titre .= " réalisé par " . $prenom;
    }
    elseif (isset($metierSave)) {
        $whereClause .= " AND m.id = " . $metierSave;
        $requete = "SELECT libelle FROM Metier WHERE id = " . $metierSave;
        $metier = $bdd->getData($requete)->fetch()[0];
        $titre .= " réalisé par les " . $metier;
    }



    // Temps par US du lot
    $requete = "SELECT us.libelle, SUM(i.heure) as heure, SUM(i.minute) as minute FROM Imputation2 i INNER JOIN User_Story2 us ON i.id_us = us.id LEFT JOIN Lot2 l ON us.id_lot = l.id LEFT JOIN Utilisateur u ON i.id_utilisateur = u.id LEFT JOIN Metier m ON u.id_metier = m.id " . $whereClause . " GROUP BY id_us";
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
    $requete = "SELECT us.libelle, SUM(i.heure* 60 + i.minute * (m.salaire/420)) as cout FROM Imputation2 i LEFT JOIN Utilisateur u ON i.id_utilisateur = u.id LEFT JOIN Metier m ON u.id_metier = m.id LEFT JOIN User_Story2 us ON i.id_us = us.id LEFT JOIN Lot2 l ON us.id_lot = l.id " . $whereClause . " GROUP BY us.libelle";
    $prixLot = $bdd->getData($requete)->fetchAll();
    foreach ($prixLot as $prix) {
        array_push($listePrixLot, round($prix['cout'], 2));
        $prixTotalLot += $prix['cout'];
    }
    $prixTotal = round($prixTotalLot, 2) . "€";

    // Temps par type de tache pour le lot
    $requete = "SELECT SUM(i.heure) as heure, SUM(i.minute) as minute, t.libelle FROM `Imputation2` i LEFT JOIN Tache_Type2 t ON i.id_tache = t.id LEFT JOIN User_Story2 us ON i.id_us = us.id LEFT JOIN Lot2 l ON us.id_lot = l.id LEFT JOIN Utilisateur u ON i.id_utilisateur = u.id LEFT JOIN Metier m ON u.id_metier = m.id " . $whereClause . " GROUP BY t.libelle";
    $tmpTypeTache = $bdd->getData($requete)->fetchAll();
    foreach ($tmpTypeTache as $tmpTache) {
        array_push($listeLibelleTypeTache, $tmpTache['libelle']);
        $tmp = $tmpTache['heure'] * 60 + $tmpTache['minute'];
        array_push($listeTempsTypeTache, $tmp);
    }

    // Coût par type de tache pour le lot
    $requete = "SELECT t.libelle, SUM(i.heure* 60 + i.minute * (m.salaire/420)) as cout FROM Imputation2 i LEFT JOIN Utilisateur u ON i.id_utilisateur = u.id LEFT JOIN Metier m ON u.id_metier = m.id LEFT JOIN User_Story2 us ON i.id_us = us.id LEFT JOIN Tache_Type2 t ON i.id_tache = t.id LEFT JOIN Lot2 l ON us.id_lot = l.id " . $whereClause . " GROUP BY t.libelle";
    $prixTypeTache = $bdd->getData($requete)->fetchAll();
    foreach ($prixTypeTache as $prixTache) {
        array_push($listePrixTypeTache, round($prixTache['cout'], 2));
    }

    require("../Include/header.php");
    require("../Views/statistiques.php");
    include('../Views/statistiquesLot.php');

?>