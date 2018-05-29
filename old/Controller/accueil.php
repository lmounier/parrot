<?php

require("../Include/functions.php");

if(!isset($_SESSION['auth'])) header("Location: ../index.php");
if($_SESSION['auth']->id_metier == 4 ) header("Location: statistique.php");
$nomP = strtoupper($_SESSION['auth']->nom);
$prenomP = ucfirst($_SESSION['auth']->prenom);

$titre = "Accueil";
$imputations = getListeImputationsByUser($bdd);
$lots = getListeLots($bdd);
$uss = getListeUs($bdd);
$type_tache = getListeTypeTache($bdd);

if(!empty($_POST['ajouter'])){
    if (empty($_POST['type']) || empty($_POST['dateImput']) || (empty($_POST['heure']) && empty($_POST['minute']))){
        $erreur = "Vous devez remplir au minimum le type de tâche, la date et l'heure<br>";
    }else {
        if(($_POST['type'] == 4 || $_POST['type'] == 1) && ($_POST['us'] == "" || $_POST['raf'] == "")) {
            echo 'la';
            $erreur = "Vous devez sélectionner une us et entrer un reste à faire pour ce type de tâche";
        }else {
            if($_POST['heure'] < 0 ) $erreur = "Vous devez entrer une heure supérieure ou égale à 0";
            elseif($_POST['minute'] < 0 ) $erreur = "Le champ des minutes ne peut être négatif";
            elseif($_POST['raf'] < 0 ) $erreur = "Vous devez entrer un RAF supérieur ou égal à 0";
            else {
                if(empty($_POST['minute'])) $_POST['minute'] = 0;
                if(empty($_POST['raf'])) $_POST['raf'] = 0;
                $requete = 'INSERT INTO Imputation2 (id_utilisateur, id_us, id_tache, date_imput, heure, minute, raf) VALUES(' . $_SESSION['auth']->id . ', ' . $_POST['us'] . ', ' . $_POST['type'] . ', "' . $_POST['dateImput']. '", ' . $_POST['heure'] . ', ' . $_POST['minute'] . ', ' . $_POST['raf'] .')';
                try{
                    $bdd->setData($requete);
                }catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                unset($_POST);
                unset($erreur);
                header("Location: accueil.php");
            }
        }
    }
}

require("../Include/header.php");
require("../Views/accueil.php");


?>