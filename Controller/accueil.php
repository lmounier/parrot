<?php

require("../Include/functions.php");

if(!empty($_POST['ajouter'])){
    if (empty($_POST['tache']) || empty($_POST['dateImput']) || (empty($_POST['heure']) && empty($_POST['minute']))){
        $erreur = "Veuillez sélectionner une tâche, une date et une heure pour cette imputation<br>";
    }else {
        if($_POST['heure'] < 0 ) $erreur = "Vous devez entrer une heure supérieure ou égale à 0";
        elseif($_POST['minute'] < 0 ) $erreur = "Le champ des minutes ne peut être négatif";
        elseif($_POST['raf'] < 0 ) $erreur = "Vous devez entrer un RAF supérieur ou égal à 0";
        else {
            if(empty($_POST['minute'])) $_POST['minute'] = 0;
            if(empty($_POST['heure'])) $_POST['heure'] = 0;
            if(empty($_POST['raf'])) $_POST['raf'] = 0;
            if(empty($_POST['mainDev'])) $_POST['mainDev'] = 0;
            $requete = 'INSERT INTO Imputation (id_utilisateur, id_tache, date_imput, heure, minute, raf, is_main_dev) VALUES(' . $_SESSION['auth']->id . ', ' . $_POST['tache'] . ', "' . $_POST['dateImput']. '", ' . $_POST['heure'] . ', ' . $_POST['minute'] . ', ' . $_POST['raf'] .', ' . $_POST['mainDev'] . ')';
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

if(!isset($_SESSION['auth'])) header("Location: ../index.php");
if($_SESSION['auth']->id_metier == 4 ) header("Location: statistique.php");
$nomP = strtoupper($_SESSION['auth']->nom);
$prenomP = ucfirst($_SESSION['auth']->prenom);

$dateActuelle = date("d/m/Y");
$currentSprint = getSprintByDate($bdd, date("Y-m-d"));
$allTasks = getAllTasks($bdd);
$allLots = getAllLots($bdd);
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