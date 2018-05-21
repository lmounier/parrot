<section id="container">
    <h2><?= $titre; ?></h2>
    <div id="lots" style="visibility: hidden"><?= json_encode($listeLibelleLot); ?></div>
    <div id="typeTache" style="visibility: hidden"><?= json_encode($listeLibelleTypeTache); ?></div>
    <div id="Uss" style="visibility: hidden"><?= json_encode($listeLibelleUs); ?></div>
    <div class="row">
        <div class="col-md-6">
            <h4>Temps passé sur chaque lot</h4>
            <canvas id="ChartTempsLot" style="width: 80%;"></canvas>
            <input type="hidden" id="temps" value="<?= json_encode($listeTempsLot); ?>"/>
        </div>
        <div class="col-md-6">
            <h4>Coût de chaque lot</h4>
            <canvas id="ChartCoutLot" style="width: 80%;"></canvas>
            <input type="hidden" id="couts" value="<?= json_encode($listePrixLot); ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4>Temps passé sur chaque us</h4>
            <canvas id="ChartTempsUs" style="width: 80%;"></canvas>
            <input type="hidden" id="tempsUs" value="<?= json_encode($listeTempsUs); ?>"/>
        </div>
        <div class="col-md-6">
            <h4>Coût par Us</h4>
            <canvas id="ChartCoutUs" style="width: 80%;"></canvas>
            <input type="hidden" id="coutsUs" value="<?= json_encode($listePrixUs); ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4>Temps passé par type de tâche</h4>
            <canvas id="ChartTempsTache" style="width: 80%;"></canvas>
            <input type="hidden" id="tempsTache" value="<?= json_encode($listeTempsTypeTache); ?>"/>
        </div>
        <div class="col-md-6">
            <h4>Coût par type de tâche</h4>
            <canvas id="ChartCoutTache" style="width: 80%;"></canvas>
            <input type="hidden" id="coutsTache" value="<?= json_encode($listePrixTypeTache); ?>"/>
        </div>
    </div>
    <div class="row">
        Temps total : <?= $tempsTotal; ?><br/>
        Coût total : <?= $prixTotal; ?><br/>
    </div>
</section>
<script>
    var ctx = document.getElementById("ChartTempsLot");
    var ctx2 = document.getElementById("ChartCoutLot");
    var ctx3 = document.getElementById("ChartTempsTache");
    var ctx4 = document.getElementById("ChartCoutTache");
    var ctx5 = document.getElementById("ChartTempsUs");
    var ctx6 = document.getElementById("ChartCoutUs");
    var listeTemps = document.getElementById("temps").value;
    var listeCout = document.getElementById("couts").value;
    var listeTempsUs = document.getElementById("tempsUs").value;
    var listeCoutUs = document.getElementById("coutsUs").value;
    var listeTempsTaches = document.getElementById("tempsTache").value;
    var listeCoutTache = document.getElementById("coutsTache").value;
    var lots = document.getElementById("lots").innerHTML;
    var Uss = document.getElementById("Uss").innerHTML;
    var typeTache = document.getElementById("typeTache").innerHTML;

    var resultTemps = JSON.parse(listeTemps);
    var resultCout = JSON.parse(listeCout);
    var resultTempsUs = JSON.parse(listeTempsUs);
    var resultCoutUs = JSON.parse(listeCoutUs);
    var resultTempsTache = JSON.parse(listeTempsTaches);
    var resultCoutTache = JSON.parse(listeCoutTache);
    var resultLots = JSON.parse(lots);
    var resultUss = JSON.parse(Uss);
    var resultTypeTache = JSON.parse(typeTache);

    var ChartTempsLot = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: resultLots,
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
    var ChartCoutLot = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: resultLots,
            datasets: [{
                data: resultCout,
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
    var ChartTempsLot = new Chart(ctx5, {
        type: 'pie',
        data: {
            labels: resultUss,
            datasets: [{
                data: resultTempsUs,
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
    var ChartCoutUs = new Chart(ctx6, {
        type: 'pie',
        data: {
            labels: resultUss,
            datasets: [{
                data: resultCoutUs,
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
    var ChartTempsLot = new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: resultTypeTache,
            datasets: [{
                data: resultTempsTache,
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
    var ChartCoutLot = new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: resultTypeTache,
            datasets: [{
                data: resultCoutTache,
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

</script>
