<?php

require("../Models/ConnexionBD.php");

require("../Models/Message.php");

$bdd = ConnexionBD::getInstance();

session_start();


function getListeImputationsByUser($bdd){
    $result = $bdd->getData("SELECT * FROM Imputation WHERE id_utilisateur = " . $_SESSION['auth']->id . " ORDER BY date_imput DESC");
    $liste = $result->fetchAll();

    return $liste;
}

function getListeLots($bdd){
    $result = $bdd->getData("SELECT * FROM Lot");
    $liste = $result->fetchAll();
    return $liste;
}

function getListeUs($bdd){
    $result = $bdd->getData("SELECT * FROM User_Story ORDER BY libelle ASC");
    $liste = $result->fetchAll();
    return $liste;
}

function getListeTypeTache($bdd){
    $result = $bdd->getData("SELECT * FROM Tache_Type");
    $liste = $result->fetchAll();
    return $liste;
}

function getUserStoryById($bdd, $id){
    $result = $bdd->getData("SELECT * FROM User_Story WHERE id=" . $id);
    $us = $result->fetch();
    return $us;
}

function getLotById($bdd, $id){
    $result = $bdd->getData("SELECT * FROM Lot WHERE id=" . $id);
    $lot = $result->fetch();
    return $lot;
}

function getTypeTacheById($bdd, $id){
    $result = $bdd->getData("SELECT * FROM Tache_Type WHERE id=" . $id);
    $type = $result->fetch();
    return $type;
}


////////////////////////////////////
//          Statistiques          //
////////////////////////////////////

function getListeMetiers($bdd){
    $result = $bdd->getData("SELECT * FROM Metier");
    $liste = $result->fetchAll();
    return $liste;
}

function getListeMembres($bdd){
    $result = $bdd->getData("SELECT * FROM Utilisateur");
    $liste = $result->fetchAll();
    return $liste;
}

function getListeSprints($bdd){
    $result = $bdd->getData("SELECT * FROM Sprint");
    $liste = $result->fetchAll();
    return $liste;
}
?>