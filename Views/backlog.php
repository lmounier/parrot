<section id="container">
    <?php if(isset($erreur)){
        echo $erreur;
    } 

    foreach($listeLots as $lot) {
        ?>
            <h2>
                <table>
                    <thead>
                        <td></td>
                        <td><?= $lot['libelle']; ?></td>
                        <td><?= $lot['pc']; ?>pc</td>
                        <td><?= $lot['temps']; ?></td>
                        <td><?= $lot['raf']; ?>h</td>
                        <td><?= $lot['avancement']; ?>%</td>
                    </thead>
                </table>
            </h2>
        <?php
        foreach($lot['listeUs'] as $us) {
            ?>
            <table>
                <thead>
                    <td></td>
                    <td><?= $us['libelle']; ?></td>
                    <td><?= $us['pc']; ?></td>
                    <td><?= $us['temps']; ?></td>
                    <td><?= $us['raf']; ?>h</td>
                    <td><?= $us['avancement']; ?>%</td>
                </thead>
                <tbody>
                <?php
                foreach($us['listeTache'] as $tache) {
                    ?>
                    <td><?= $tache['id']; ?></td>
                    <td><?= $tache['libelle']; ?></td>
                    <td><?= $tache['pc']; ?></td>
                    <td><?= $tache['temps']; ?></td>
                    <td><?= $tache['raf']; ?></td>
                    <td><?= $tache['avancement']; ?></td>
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