<?php
    require("../Include/functions.php");

    if(isset($_SESSION['auth'])) header("Location: ../index.php");

    $erreurs = array();

    if(empty($_POST['login'])){
        $erreurs['login'] = "Le login n'est pas valide";
    }

    if(empty($_POST['pass'])){
        $erreurs['pass'] = "Le mot de passe n'est pas valide";
    }
    echo $_POST['login'];
    if(empty($erreurs)){
        $result = $bdd->getData("SELECT * FROM Utilisateur WHERE login='".$_POST['login']."'");
        $data = $result->fetch(PDO::FETCH_OBJ);
        
        if($data){
            if($_POST['pass'] == $data->mdp){
                $_SESSION['auth'] = $data;
                if($_SESSION['auth']->id_metier == 4) header("Location: statistique.php");
                else header("Location: accueil.php");
                exit(); 
            }else{
                $message = new Message("Echec de la connexion","La combinaison adresse mail et mot de passe ne correspond pas.",false);
                $message->afficher();                  
            }
        }else{
            $message = new Message("Echec de la connexion","Ce compte n'existe pas.",false);
            $message->afficher();   
        }
    }else{
        $message = new Message("Echec de la connexion","Les éléments suivants sont incorrects :",true);
        $message->ajouterElements($erreurs);
        $message->afficher();
    }
?>