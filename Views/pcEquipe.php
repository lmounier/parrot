<div>
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