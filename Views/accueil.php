<section id="container">
    <?php if(isset($erreur)){
        echo $erreur;
    } ?>


    <h2 style="text-align: center">Ajouter un temps :</h2>
    <div class="row" style="text-align: center">
        <form method="post" action="../Controller/accueil.php" style="width: 100%">
            <div class="row">
                <?php
                if(!empty($allLots)){
                    ?>
                    <div class="col-md-3">
                        <label class="row">Lot :</label>
                        <select class="row" name="lot">
                            <option value="">Choisissez un lot</option>
                            <?php
                            foreach($allLots as $lot){
                                echo "<option value='" . $lot['id'] . "'";
                                if(isset($_POST['lot']) && $_POST['lot'] == $lot['id']) echo " selected";
                                echo ">" . $lot['libelle'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                }
                if(!empty($allTasks)){
                    ?>
                    <div class="col-md-3">
                        <label class="row">Tâche :</label>
                        <select class="row" id="tache" name="tache">
                            <option value="">Choisissez une tâche</option>
                            <?php
                            foreach($allTasks as $tache){
                                echo "<option value='" . $tache['id'] . "'";
                                if(isset($_POST['tache']) && $_POST['tache'] == $tache['id']) echo " selected";
                                echo ">" . $tache['libelle'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                }
                $date = date("Y-m-d");
                ?>
                <div class="col-md-2">
                    <label class="row">Date :</label>
                    <input class="col-md-12" type="date" name="dateImput" value="<?= $date; ?>"/>
                </div>
                <div class="col-md-3">
                    <label class="row">Temps passé :</label>
                    <?php
                    echo '<input type="number" class="col-md-5" min="0" name="heure"';
                    if(isset($_POST['heure']) && $_POST['heure'] != "") echo ' value="' . $_POST['heure'] . '"';
                    echo ' />h';
                    echo '<input type="number" min="0" class="col-md-5" name="minute"';
                    if(isset($_POST['minute']) && $_POST['minute'] != "") echo ' value="' . $_POST['minute'] . '"';
                    echo ' />min';
                    ?>
                </div>
                <div class="col-md-1">
                    <label class="row">RAF :</label>
                    <?php
                    echo '<input class="col-md-10" type="number" name="raf"';
                    if(isset($_POST['raf']) && $_POST['raf'] != "") echo ' value="' . $_POST['raf'] . '"';
                    echo ' />h';
                    ?>
                </div>

            </div>

            <div class="row">
                <input type="submit" value="Ajouter" name="ajouter" class="col-md-offset-2 col-md-2">
            </div>

        </form>
    </div>
    <div class="row">
        <h2>Dernières imputations</h2>
        <table class="table table-striped">
            <thead>
                <td scope="col">Type</td>
                <td scope="col">Numéro</td>
                <td scope="col">Tâche</td>
                <td scope="col">temps</td>
                <td scope="col">RAF</td>
            </thead>
            <tbody>
                <?php foreach ($lastImputations as $imputation) {
                    ?>
                    <tr scope='row'>
                        <td><?= $imputation['type']; ?></td>
                        <td><?= $imputation['numero']; ?></td>
                        <td><?= $imputation['libelle']; ?></td>
                        <td><?= $imputation['heure'] . "h" . $imputation['minute']; ?></td>
                        <td><?= $imputation['raf']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
         </table>
        </div>
    <div class="row">
        <div class="col-md-6">
        Date actuelle : <?= $dateActuelle; ?><br/>
        Sprint actuel : <?= $currentSprint['libelle']; ?><br/><br/>
        <h2>Tâche(s) en cours : </h2>
        <?php 
        if(count($tachesEnCours) == 0 ) echo "Aucune tâche en cours"; 
        else {
            ?>
            <table class="table table-striped">
                <thead>
                    <td scope="col">numero</td>
                    <td scope="col">libelle</td>
                    <td scope="col">pc</td>
                    <td scope="col">raf</td>
                    <td scope="col">avancement</td>
                </thead>
                <tbody>
                    <?php
                    foreach($tachesEnCours as $tache){
                        ?>
                        <tr scope='row'>
                            <td><?= $tache['numero']; ?></td>
                            <td><?= $tache['libelle']; ?></td>
                            <td><?= $tache['pc']; ?></td>
                            <td><?= $tache['raf'] . "h"; ?></td>
                            <td><?= $tache['avancement'] . "%"; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } ?>
        </div>
        <div class="col-md-6">
            <input type="hidden" id="listesPc" value='<?= json_encode($listesPc); ?>'/>
            <input type="hidden" id="listesVelocite" value='<?= json_encode($listesVelocite); ?>'/>
            <input type="hidden" id="sprints" value='<?= json_encode($listeSprints); ?>'/>
            <?php
                foreach($listesPc as $liste) {
                    ?>
                    <input type="hidden" id="<?= $liste; ?>" value='<?= json_encode($$liste); ?>'/>
                    <?php
                }
                foreach($listesVelocite as $liste) {
                    ?>
                    <input type="hidden" id="<?= $liste; ?>" value='<?= json_encode($$liste); ?>'/>
                    <?php
                }
                ?>
            <div>
                <canvas id="ChartVelocite" style="width: 100%;"></canvas>
            </div>
            <div>
                <canvas id="ChartPcRealise" style="width: 100%;"></canvas>
            </div>
        </div>
    </div>
</section>

<script>
    var ctx = document.getElementById("ChartVelocite");
    var ctx2 = document.getElementById("ChartPcRealise");
    var listeSprints = document.getElementById("sprints").value;
    var resultSprints = JSON.parse(listeSprints);

    var resultPcRealise = JSON.parse(document.getElementById("listesPc").value);
    var resultVelocite = JSON.parse(document.getElementById("listesVelocite").value);
    var datasets = [];
    resultPcRealise.forEach(function(element, key) {
        var name = "result" + element;
        var color = getRandomColor();
        var item = {
            data: JSON.parse(document.getElementById(element).value),
            label: element,
            backgroundColor: color,
            borderColor: color,
            fill: [false]
        }
        datasets.push(item);
    })

    var datasetsVelocite = [];
    resultVelocite.forEach(function(element, key) {
        var name = "result" + element;
        var color = getRandomColor();
        var item = {
            data: JSON.parse(document.getElementById(element).value),
            label: element,
            backgroundColor: color,
            borderColor: color,
            fill: [false]
        }
        datasetsVelocite.push(item);
    })

    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["sprint 1", "sprint 2", "sprint 3", "sprint 4", "sprint 5"],
            datasets: datasetsVelocite
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Suivi de ma vélocité'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Sprint'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'vélocité (pc/j-h)'
                    }
                }]
            }
        }
    });

    var myLineChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ["sprint 1", "sprint 2", "sprint 3", "sprint 4", "sprint 5"],
            datasets: datasets
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Suivi des pc consommés'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Sprint'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'pc'
                    }
                }]
            }
        }
    });


    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>