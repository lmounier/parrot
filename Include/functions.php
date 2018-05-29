<?php

require("../Models/ConnexionBD.php");

require("../Models/Message.php");

$bdd = ConnexionBD::getInstance();

session_start();

function getAllLots($bdd) {
    $result = $bdd->getData("SELECT * FROM Lot");
    $lots = $result->fetchAll();
    return $lots;
}

function convertTempsMinuteHeure($bdd, $temps) {
    $heureTotal = floor($temps / 60);
    $minuteTotal = $temps - ($heureTotal * 60);
    $tempsTotal = $heureTotal . "h" . $minuteTotal . "min";
    return $tempsTotal;
}

function getSprintByDate($bdd, $date) {
    $result = $bdd->getData("SELECT * FROM Sprint WHERE date_debut <= '" . $date . "' AND date_fin >= '" . $date . "'");
    $sprint = $result->fetch();
    return $sprint;
}

function getLastImputationsUser($bdd, $userId) {
    $result = $bdd->getData("SELECT i.heure, i.minute, i.raf, t.libelle, t.numero, ty.libelle as type FROM Imputation i LEFT JOIN Tache t ON t.id = i.id_tache LEFT JOIN Tache_type ty ON ty.id = t.id_type_tache WHERE i.id_utilisateur = " . $_SESSION['auth']->id . " ORDER BY date_imput DESC LIMIT 5");
    $liste = $result->fetchAll();

    return $liste;
}

function getSprintRealise($bdd) {
    $date = date("Y-m-d");
    $result = $bdd->getData("SELECT * FROM Sprint WHERE date_fin < '" . $date . "' OR (date_debut <= '" . $date . "' AND date_fin >= '" . $date . "')");
    $liste = $result->fetchAll();

    return $liste;
}

function getTacheRealiseUser($bdd, $userId) {
    $requete = "SELECT (SELECT id FROM Sprint s WHERE s.date_debut <= i.date_imput AND s.date_fin >= i.date_imput ) as sprint, t.id_type_tache as idtype, ty.libelle as type, t.pc AS nbPc, SUM(i.heure) AS heures, SUM(i.minute) AS minutes FROM Tache t LEFT JOIN Imputation i ON t.id = i.id_tache LEFT JOIN Tache_type ty ON t.id_type_tache = ty.id WHERE i.id_utilisateur = " . $userId . " AND RAF = 0 GROUP BY ( SELECT id FROM Sprint s WHERE s.date_debut <= i.date_imput AND s.date_fin >= i.date_imput ), t.id_type_tache";
    $result = $bdd->getData($requete)->fetchAll();

    return $result;
}

function getTacheRealiseSprintUser($bdd, $userId, $sprint) {
    $requete = "SELECT t.*, ty.libelle as type FROM Tache t LEFT JOIN Tache_type ty ON ty.id= t.id_type_tache WHERE ( STATUS = 'Done' OR STATUS = 'Closed' ) ";
    if($userId != -1) $requete .= "AND id_utilisateur LIKE '%" . $userId . "%' ";
    $requete .= "AND t.id IN( SELECT id_tache FROM Imputation WHERE ";
    if($userId != -1) $requete .= "id_utilisateur = " . $userId . " AND ";
    $requete .= "date_imput >= '" . $sprint['date_debut'] . "' AND date_imput <= '" . $sprint['date_fin'] . "')";
    $result = $bdd->getData($requete)->fetchAll();

    return $result;
}

function getPCConsommeByTypeSprint($bdd, $typeId, $sprint = null) {
    $requete = "SELECT SUM(t.pc) as pc FROM Tache t LEFT JOIN Tache_type ty ON ty.id= t.id_type_tache WHERE ( STATUS = 'Done' OR STATUS = 'Closed' ) AND ty.id = " . $typeId;
    if($sprint != null) $requete .= " AND t.id IN( SELECT id_tache FROM Imputation WHERE date_imput >= '" . $sprint['date_debut'] . "' AND date_imput <= '" . $sprint['date_fin'] . "')";
    $result = $bdd->getData($requete)->fetch();

    return $result;
}

function getPcTotalByType($bdd, $typeId) {
    $result = $bdd->getData("SELECT SUM(pc) as pc FROM Tache WHERE id_type_tache = " . $typeId);
    $pc = $result->fetch();
    return $pc;
}

function getTempsImputationTacheUser($bdd, $userId, $idTache) {
    $requete = "SELECT SUM(heure) as heure, SUM(minute) as minute FROM Imputation WHERE";
    if($userId != -1) $requete .= " id_utilisateur = " . $userId . " AND";
    $requete .= " id_tache = " . $idTache . " AND is_main_dev = 1";
    $result = $bdd->getData($requete)->fetch();

    $temps = $result['heure'] * 60 + $result['minute']; 
    return $temps;
}

function getTempsImputationTache($bdd, $idTache) {
    $requete = "SELECT SUM(heure) as heure, SUM(minute) as minute FROM Imputation WHERE id_tache = " . $idTache . " AND is_main_dev = 1";
    $result = $bdd->getData($requete)->fetch();

    $temps = $result['heure'] * 60 + $result['minute']; 
    return $temps;
}

function getRAFFromTache($bdd, $idTache) {
    $result = $bdd->getData("SELECT raf FROM Imputation WHERE id_tache = " . $idTache . "LIMIT 1");
    $raf = $result->fetch();
    return $raf;
}

function getTacheAssigneeSprintUser($bdd, $sprint, $userId) {
    $requete = "SELECT SUM(t.pc) as nbPc FROM Tache t LEFT JOIN Imputation i ON t.id = i.id_tache WHERE t.id_utilisateur = " . $userId .  " AND  t.id_sprint = " . $sprint['id'];
    $result = $bdd->getData($requete)->fetch();
    
    return $result[0];
}

function getTacheEnCoursByUser($bdd, $userId){
    $result = $bdd->getData("SELECT id, libelle, pc, numero FROM Tache  WHERE id_utilisateur = " . $userId . " AND status = 'In Progress'");
    $liste = $result->fetchAll();
    $resultat = array();
    foreach($liste as $tache) {
        $result = $bdd->getData("SELECT (SELECT raf FROM Imputation WHERE id_tache = " . $tache['id'] . " ORDER BY date_imput DESC LIMIT 1) as raf, SUM(heure) as heure, SUM(minute) as minute FROM Imputation WHERE id_tache = " . $tache['id'] . " ORDER BY date_imput DESC");
        $imputations = $result->fetchAll();
        $raf = $imputations[0]['raf'];
        $temps = $imputations[0]['heure'] * 60 + $imputations[0]['minute'];
        if ($raf == 0) $avancement = 100;
        else $avancement = floor((100 * $temps) / ($raf * 60 + $temps));
        $res = array(
            'libelle' => $tache['libelle'],
            'pc' => $tache['pc'],
            'numero' => $tache['numero'],
            'raf' => $raf,
            'avancement' => $avancement,
        );
        array_push($resultat, $res);
    }

    return $resultat;
}

function getImputationTypeMembreSprint($bdd, $membreId, $typeTacheId, $currentSprint) {
    $result = $bdd->getData("SELECT SUM(i.heure) as heure, SUM(i.minute) as minute, ty.libelle as libelle FROM Imputation i LEFT JOIN Tache t ON i.id_tache = t.id LEFT JOIN Tache_type ty ON t.id_type_tache = ty.id WHERE i.id_utilisateur = " . $membreId . " AND ty.id = " . $typeTacheId . " AND i.date_imput >= '" . $currentSprint['date_debut'] . "' AND i.date_imput <= '" . $currentSprint['date_fin'] . "'" );
    $resultat = $result->fetch();
    $temps = $resultat['heure'] * 60 + $resultat['minute'];
    return $temps;
}


function getAllTasks($bdd){
    $result = $bdd->getData("SELECT * FROM Tache ORDER BY numero ASC");
    $liste = $result->fetchAll();
    return $liste;
}

function getTacheFromLot($bdd, $id) {
    $requete = "SELECT t.id, t.libelle, t.numero FROM Tache t";
    if($id != -1 ) $requete .= " LEFT JOIN User_story us ON us.id = t.id_us LEFT JOIN Lot l ON l.id = us.id_lot WHERE l.id = " . $id;
    $requete .= " ORDER BY t.numero ASC";
    $result = $bdd->getData($requete);
    $liste = $result->fetchAll();
    return $liste;
}

function getAllTypeTasks($bdd) {
    $result = $bdd->getData("SELECT * FROM Tache_type");
    $liste = $result->fetchAll();
    return $liste;
}

function getListeImputationsByUser($bdd){
    $result = $bdd->getData("SELECT * FROM Imputation WHERE id_utilisateur = " . $_SESSION['auth']->id . " ORDER BY date_imput DESC");
    $liste = $result->fetchAll();

    return $liste;
}

function getTacheSprint($bdd, $idSprint) {
    $result = $bdd->getData("SELECT t.*, ty.libelle as type FROM Tache t LEFT JOIN Tache_type ty ON ty.id = t.id_type_tache WHERE id_sprint = " . $idSprint . " ORDER BY id_us");
    $liste = $result->fetchAll();

    return $liste;
}

function getTachesRealiseSprint($bdd, $sprint) {
    $result = $bdd->getData("SELECT t.*, ty.libelle as type FROM Tache t LEFT JOIN Tache_type ty ON ty.id = t.id_type_tache WHERE t.id IN (SELECT id_tache FROM Imputation WHERE date_imput >= '" . $sprint['date_debut'] . "' AND date_imput<= '" . $sprint['date_fin'] . "')");
    $liste = $result->fetchAll();

    return $liste;
}

function getImputationFromTache($bdd, $idTache, $sprint) {
    $result = $bdd->getData("SELECT i.*, u.id_metier as metier FROM Imputation i LEFT JOIN Utilisateur u ON u.id = i.id_utilisateur WHERE i.id_tache = " . $idTache . " AND i.date_imput >= '" . $sprint['date_debut'] . "' AND i.date_imput<= '" . $sprint['date_fin'] . "'");
    $liste = $result->fetchAll();

    return $liste;
}

function getSalaireFromMetier($bdd, $idMetier) {
    $result = $bdd->getData("SELECT salaire  FROM Metier WHERE id = " . $idMetier);
    $salaire = $result->fetch();

    return $salaire;
}

function getListeLots($bdd){
    $result = $bdd->getData("SELECT * FROM Lot");
    $liste = $result->fetchAll();
    return $liste;
}

function getUsByLot($bdd, $idLot) {
    $result = $bdd->getData("SELECT * FROM User_story WHERE id_lot = " . $idLot);
    $liste = $result->fetchAll();
    return $liste;
}

function getAllTasksFromUs($bdd, $idUs) {
    $result = $bdd->getData("SELECT * FROM Tache WHERE id_us = " . $idUs);
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
    $result = $bdd->getData("SELECT * FROM Sprint WHERE id != 6");
    $liste = $result->fetchAll();
    return $liste;
}
?>