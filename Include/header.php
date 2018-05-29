<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Imputation</title>
    <noscript><meta http-equiv="refresh" content="0, URL=nojavascript.php"></noscript>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Web/CSS/style.css">
    <link rel="stylesheet" type="text/css" href="../Web/CSS/header.css">
    <script type="text/javascript" src="../Web/JS/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../Web/JS/functions.js"></script>
    <script type="text/javascript" src="../Web/JS/header.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

</head>
<body>
    <header>
        <div id="top">
            <div id="left"> 
                <h1>Imputation temps projet</h1>
            </div><!--@whitespace
         --><div id="right">
                <span>
                    <p><?php echo "$prenomP $nomP"; ?></p>
                    <a href="deconnexion.php">Se déconnecter</a> 
                </span>
            </div>
        </div>
        <?php
            if(isset($_SESSION['auth']) && ($_SESSION['auth']->id_metier == 1 || $_SESSION['auth']->id_metier == 2)) :
                ?>
                <nav>
                    <ul>
                        <li link="accueil.php">Accueil</li>
                        <li link="backlog.php">Backlog</li>
                        <li link="equipe.php">Equipe</li>
                        <li link="sprint.php">Sprint</li>
                    </ul>
                </nav>
            <?php
            endif;
        if(isset($_SESSION['auth']) && ($_SESSION['auth']->id_metier == 4)  ) :
            ?>
            <nav>
                <ul>
                    <li link="backlog.php">Backlog</li>
                    <li link="equipe.php">Equipe</li>
                    <li link="sprint.php">Sprint</li>
                </ul>
            </nav>
            <?php
        endif;
            ?>
    </header>