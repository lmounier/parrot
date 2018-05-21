<?php
session_start();
echo $_SESSION['auth']->id_metier;
if(isset($_SESSION['auth']) && $_SESSION['auth']->id_metier == 4) header("Location: Controller/statistique.php");
elseif(isset($_SESSION['auth'])) header("Location: Controller/accueil.php");
require("Views/view_index.php");
?>

