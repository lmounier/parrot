<section id="container">
    <?php if(isset($erreur)){
        echo $erreur;
    } 

    foreach($listeLots as $lot) {
        ?>
            <h2>
                <table class="table table-striped">
                    <thead>
                        <td scope="col"></td>
                        <td scope="col"><?= $lot['libelle']; ?></td>
                        <td scope="col"><?= $lot['pc']; ?>pc</td>
                        <td scope="col"><?= $lot['temps']; ?></td>
                        <td scope="col"><?= $lot['raf']; ?>h</td>
                        <td scope="col"><?= $lot['avancement']; ?>%</td>
                    </thead>
                </table>
            </h2>
        <?php
        foreach($lot['listeUs'] as $us) {
            ?>
            <table class="table table-striped">
                <thead>
                    <td scope="col"></td>
                    <td scope="col"><?= $us['libelle']; ?></td>
                    <td scope="col"><?= $us['pc']; ?></td>
                    <td scope="col"><?= $us['temps']; ?></td>
                    <td scope="col"><?= $us['raf']; ?>h</td>
                    <td scope="col"><?= $us['avancement']; ?>%</td>
                </thead>
                <tbody>
                <?php
                foreach($us['listeTache'] as $tache) {
                    ?>
                    <tr scope='row'>
                        <td><?= $tache['id']; ?></td>
                        <td><?= $tache['libelle']; ?></td>
                        <td><?= $tache['pc']; ?></td>
                        <td><?= $tache['temps']; ?></td>
                        <td><?= $tache['raf']; ?></td>
                        <td><?= $tache['avancement']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <?php
        }
    }
    ?>

    
</section>