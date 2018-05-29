<?php

require("../Include/functions.php");

if(!isset($_SESSION['auth'])) header("Location: ../index.php");

$nomP = strtoupper($_SESSION['auth']->nom);
$prenomP = ucfirst($_SESSION['auth']->prenom);

$metiers = getListeMetiers($bdd);
$membres = getListeMembres($bdd);
$sprints = getListeSprints($bdd);
$lots = getListeLots($bdd);
$uss = getListeUs($bdd);

if(!empty($_POST['valider'])){
    $requete = "SELECT * FROM Imputation2";
    if(!empty($_POST['lot']) || !empty($_POST['us']) || !empty($_POST['sprint']) || !empty($_POST['semaine']) || !empty($_POST['jour']) || !empty($_POST['metier']) || !empty($_POST['membre'])):
        $requete .= " WHERE ";
        $index = 0;

        /*************************/
        /*      Fonctionnel      */
        /*************************/

        // Lot
        if(!empty($_POST['lot'])):
            $lotSave = $_POST['lot'];
            if($index == 1) $requete .= " AND ";
            $requete .= "id_us IN (SELECT id FROM User_Story2 WHERE id_lot =" . $_POST['lot'] . ")";
            $index = 1;
        endif;

        // US
        if(!empty($_POST['us'])):
            $usSave = $_POST['us'];
            if($index == 1) $requete .= " AND ";
            $requete .= "id_us = " . $_POST['us'];
            $index = 1;
        endif;

        /*************************/
        /*       Temporel        */
        /*************************/

        // Jour
        if(!empty($_POST['jour'])):
            $jourSave = $_POST['jour'];
            if($index == 1) $requete .= " AND ";
            $requete .= "date_imput = '" . $_POST['jour'] . "'";
            $index = 1;
        endif;

        // Semaine
        if(!empty($_POST['semaine'])):
            $semaineSave = $_POST['semaine'];
            switch($_POST['semaine']){
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
            if($index == 1) $requete .= " AND ";
            $requete .= "date_imput BETWEEN '" . $date_deb . "' AND '" . $date_fin . "'";
            $index = 1;
        endif;

        // Sprint
        if(!empty($_POST['sprint'])):
            $sprintSave = $_POST['sprint'];
            switch($_POST['sprint']) {
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
            if($index == 1) $requete .= " AND ";
            $requete .= "date_imput BETWEEN '" . $date_deb . "' AND '" . $date_fin . "'";
            $index = 1;
        endif;


        /*****************************/
        /*      Organisationnel      */
        /*****************************/

        // Métier
        if(!empty($_POST['metier'])):
            $metierSave = $_POST['metier'];
            if($index == 1) $requete .= " AND ";
            $requete .= "id_utilisateur IN (SELECT id FROM Utilisateur WHERE id_metier = " . $_POST['metier'] . ")";
            $index = 1;
        endif;

        // Membre
        if(!empty($_POST['membre'])):
            $membreSave = $_POST['membre'];
            if($index == 1) $requete .= " AND ";
            $requete .= "id_utilisateur =" . $_POST['membre'];
            $index = 1;
        endif;


    endif;
    unset($_POST);

    $imputations = $bdd->getData($requete)->fetchAll();

    ////////////////////////////////////
    //          Cas Lot               //
    ////////////////////////////////////

    if (isset($lotSave))
    {
        require("StatistiquesLot.php");

    }

    ////////////////////////////////////
    //          Cas US                //
    ////////////////////////////////////

    if (isset($usSave))
    {

        require("StatistiquesUs.php");
    }

    ////////////////////////////////////
    //          Projet                //
    ////////////////////////////////////

    if(!isset($lotSave) && !isset($usSave)) {
        require("StatistiquesProjet.php");
    }

}else{
    require("StatistiquesProjet.php");
}

