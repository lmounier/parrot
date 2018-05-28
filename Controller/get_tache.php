<?php 
require("../Include/functions.php");

$id = $_GET['id'];
$taches = getTacheFromLot($bdd, $id);
foreach($taches as $tache) {
    echo "<option value='" . $tache['id'] . "'>#" . $tache['numero'] . " - " . $tache['libelle'] . "</option>";
}

?>