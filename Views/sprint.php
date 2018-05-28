<section id="container">
    <?php if(isset($erreur)){
        echo $erreur;
    } ?>
    <h2>Coût du sprint par tâche</h2>
    <table class="table table-striped">
        <thead>
            <td scope="col">Tâche</td>
            <td scope="col">Management</td>
            <td scope="col">Back</td>
            <td scope="col">Front</td>
            <td scope="col">Bug</td>
            <td scope="col">Design</td>
        </thead>
        <tbody>
            <?php 
            if(count($listeTaches) != 0) {
                foreach($listeTaches as $tache){
                    echo "<tr scope='row'>";
                    echo "<td>" . $tache['libelle'] . "</td>";
                    if($tache['type'] == "Management" ) echo "<td>" . $tache['cout'] . "</td><td>0</td><td>0</td><td>0</td><td>0</td>";
                    elseif($tache['type'] == "Back" ) echo "<td>0</td><td>" . $tache['cout'] . "</td><td>0</td><td>0</td><td>0</td>";
                    elseif($tache['type'] == "Front" ) echo "<td>0</td><td>0</td><td>" . $tache['cout'] . "</td><td>0</td><td>0</td>";
                    elseif($tache['type'] == "Bug" ) echo "<td>0</td><td>0</td><td>0</td><td>" . $tache['cout'] . "</td><td>0</td>";
                    elseif($tache['type'] == "Design" ) echo "<td>0</td></td><td>0</td><td>0</td><td>0</td><td>" . $tache['cout'] . "</td>";
                    echo "</tr>";
                }
                echo "<tr scope='row'><td>Total Coûts</td><td>" . $listeCout['Management'] . "</td><td>" . $listeCout['Back'] . "</td><td>" . $listeCout['Front'] . "</td><td>" . $listeCout['Bug'] . "</td><td>" . $listeCout['Design'] . "</td></tr>";    
            } else echo "<tr scope='row'><td>Total Coûts</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
            ?>
        </tbody>
    </table>
    <h2>Temps par membre</h2>
    <table class="table table-striped">
        <thead>
            <td scope="col">Membre</td>
            <?php 
            foreach($typeTaches as $typeTache) {
                echo "<td scope='col'>" . $typeTache['libelle'] . "</td>";
            } 
            ?>
        </thead>
        <tbody>
            <?php 
                foreach($listeMembres as $membre){
                    echo "<tr scope='row'>";
                    echo "<td>" . $membre['nom'] . "</td>";
                    foreach($membre['temps'] as $temps) {
                        echo "<td>" . $temps . "</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <h2>Coût par membre par type de tâche</h2>
    <table class="table table-striped">
        <thead>
            <td>Membre</td>
            <?php 
            foreach($typeTaches as $typeTache) {
                echo "<td scope='col'>" . $typeTache['libelle'] . "</td>";
            } 
            ?>
        </thead>
        <tbody>
            <?php 
                foreach($listeMembres as $membre){
                    echo "<tr scope='row'>";
                    echo "<td>" . $membre['nom'] . "</td>";
                    foreach($membre['cout'] as $cout) {
                        echo "<td>" . $cout . "</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <h2>Avancement Sprint et Projet</h2>
    <table class="table table-striped">
        <thead>
            <td scope='col'>Type de tâche</td>
            <td scope='col'>PC réalisés sur le sprint</td>
            <td scope='col'>PC réalisés sur le projet</td>
            <td scope='col'>PC total à réaliser</td>
            <td scope='col'>Avancement sur le sprint</td>
            <td scope='col'>Avancement sur le projet</td>
        </thead>
        <tbody>
            <?php 
                foreach($listePC as $pc){
                    echo "<tr scope='row'>";
                    echo "<td>" . $pc['type'] . "</td>";
                    echo "<td>" . $pc['pcRealiseSprint'] . "</td>";
                    echo "<td>" . $pc['pcRealiseProjet'] . "</td>";
                    echo "<td>" . $pc['pcARealiser'] . "</td>";
                    echo "<td>" . $pc['avancementSprint'] . "%</td>";
                    echo "<td>" . $pc['avancementProjet'] . "%</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>


