<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="Web/CSS/style.css">
    <link rel="stylesheet" type="text/css" href="Web/CSS/index.css">
    <script src="Web/JS/jquery-2.1.4.min.js"></script>
    <script src="Web/JS/functions.js"></script>
    <script src="Web/JS/connexion_inscription.js"></script>
</head>
<body>
<header>
    <h1>Imputations temps projet</h1>
</header>
<section id="formulaires" class="center">
    <section id="form_connexion">
        <h3>Connexion</h3>
        <hr>
        <form method="POST" action="Controller/connexion.php">
            <input type="email" name="login" value="" placeholder="Login">
            <input type="password" name="pass" value="" placeholder="Mot de Passe">
            <div class="index_button_container">
                <div class="button index_sub" onClick="$('#form_connexion form').submit();" style="float:right;">Se Connecter</div>
            </div>
        </form>
    </section>
</section>
</body>
</html>