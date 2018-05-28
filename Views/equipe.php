<section id="container">
    <?php if(isset($erreur)){
        echo $erreur;
    } 
    ?>

    <div>
        <ul>
            <li class='linkMembre' id='-1'>Equipe</li>
            <?php 
                foreach($listeMembres as $membre) {
                    echo "<li class='linkMembre' id='" . $membre['id'] . "'>" . $membre['prenom'] . "</li>";
                }
            ?>
        </ul>
    </div>
    <div id="graphe">
        
    </div>
</section>

