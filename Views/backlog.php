<section id="container">
    <?php if(isset($erreur)){
        echo $erreur;
    } 
    ?>
    <table class="table table-striped">
        <thead>
            <td scope="col"></td>
            <td scope="col">Libellé</td>
            <td scope="col">PC</td>
            <td scope="col">Temps consommé</td>
            <td scope="col">RAF</td>
            <td scope="col">Avancement</td>
        </thead>
        <tbody>
    <?php 
    foreach($listeLots as $lot) {
        ?>
            <tr scope='row' class="ligneLot">
                <td></td>
                <td><h3><?= "Lot " . $lot['libelle']; ?></h3></td>
                <td><h3><?= $lot['pc']; ?>pc</h3></td>
                <td><h3><?= $lot['temps']; ?></h3></td>
                <td><h3><?= $lot['raf']; ?>h</h3></td>
                <td><h3><?= $lot['avancement']; ?>%</h3></td>
            </tr>
        <?php
        foreach($lot['listeUs'] as $us) {
            ?>

            <tr scope='row' class="ligneUs">
                <td></td>
                <td><?= $us['libelle']; ?></td>
                <td><?= $us['pc']; ?>pc</td>
                <td><?= $us['temps']; ?></td>
                <td><?= $us['raf']; ?>h</td>
                <td><?= $us['avancement']; ?>%</td>
            </tr>
    
            <?php
            foreach($us['listeTache'] as $tache) {
                ?>
                <tr scope='row'>
                    <td><?= $tache['id']; ?></td>
                    <td><?= $tache['libelle']; ?></td>
                    <td><?= $tache['pc']; ?></td>
                    <td><?= $tache['temps']; ?></td>
                    <td><?= $tache['raf']; ?>h</td>
                    <td><?= $tache['avancement']; ?>%</td>
                </tr>
                <?php
            }
        }
    }
    ?>
    </tbody>
    </table>

    
</section>