<section id="container">
    <div id="us" style="visibility: hidden"><?= json_encode($listeUs); ?></div>
    <div class="row">
        <div class="col-md-6">
            <h4>Temps passé sur chaque us</h4>
            <canvas id="ChartTempsUS" style="width: 80%;"></canvas>
            Temps total : <?= $tempsTotal; ?><br/>
            Temps total en jour homme : <?= $tempsJH; ?> j.H
            <input type="hidden" id="temps" value="<?= json_encode($listeHeure); ?>"/>
        </div>
        <div class="col-md-6">
            <h4>Salaire pour chaque us</h4>
            <canvas id="ChartSalaireUs" style="width: 100%;"></canvas>
            Salaire total : <?= round($totalSalaire) . "€"; ?>
            <input type="hidden" id="listeSalaire" value="<?= json_encode($listeImputationSalaire); ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            Total des points de complexité : <?= $totalPc; ?>
        </div>
    </div>
</section>
<script>
    var ctx = document.getElementById("ChartTempsUS");
    var ctx2 = document.getElementById("ChartSalaireUs");
    var listeTemps = document.getElementById("temps").value;
    var listeSalaire = document.getElementById("listeSalaire").value;
    var userst = document.getElementById("us").innerHTML;

    var resultTemps = JSON.parse(listeTemps);
    var resultSalaire = JSON.parse(listeSalaire);
    var resultUs = JSON.parse(userst);

    var ChartTempsUS = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: resultUs,
            datasets: [{
                data: resultTemps,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            legend : {display: false}
        }

    });


    var ChartSalaireUs = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: resultUs,
            datasets: [{
                data: resultSalaire,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: false
            }
        }

    });


</script>