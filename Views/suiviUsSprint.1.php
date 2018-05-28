<section id="container">
    <div class="row">
        <a class="btn btn-secondary col-md-6" href="SuiviUs.php">Par lot</a>
        <a class="btn btn-primary col-md-6" href="#">Par Sprint</a>
    </div>


    <h2>Suivi des tâches par sprint</h2>

    <br/><br/>

    <h3>Sprint 1</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">Libelle</th>
            <th style="width: 10%">Lot</th>
            <th style="width: 5%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 5%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsSprint12 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
            echo "<th>" . $us['lot'] . "</th>";
            echo "<th>" . $us['pc'] . "</th>";
            echo "<th>" . $us['temps'] . "</th>";
            echo "<th>" . $us['raf'] . "</th>";
            echo "<th class='$class'>" . $us['pourcentage'] . "%</th>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <br/><br/>

    <h3>Sprint 2</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">Libelle</th>
            <th style="width: 10%">Lot</th>
            <th style="width: 5%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 5%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsSprint22 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] == 0) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
            echo "<th>" . $us['lot'] . "</th>";
            echo "<th>" . $us['pc'] . "</th>";
            echo "<th>" . $us['temps'] . "</th>";
            echo "<th>" . $us['raf'] . "</th>";
            echo "<th class='$class'>" . $us['pourcentage'] . "%</th>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <br/><br/>

    <h3>Sprint 3</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">Libelle</th>
            <th style="width: 10%">Lot</th>
            <th style="width: 5%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 5%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsSprint32 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] == 0) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
            echo "<th>" . $us['lot'] . "</th>";
            echo "<th>" . $us['pc'] . "</th>";
            echo "<th>" . $us['temps'] . "</th>";
            echo "<th>" . $us['raf'] . "</th>";
            echo "<th class='$class'>" . $us['pourcentage'] . "%</th>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <br/><br/>

    <h3>Sprint 4</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">Libelle</th>
            <th style="width: 10%">Lot</th>
            <th style="width: 5%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 5%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsSprint42 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] == 0) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
            echo "<th>" . $us['lot'] . "</th>";
            echo "<th>" . $us['pc'] . "</th>";
            echo "<th>" . $us['temps'] . "</th>";
            echo "<th>" . $us['raf'] . "</th>";
            echo "<th class='$class'>" . $us['pourcentage'] . "%</th>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <br/><br/>

    <h3>Sprint 5</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">Libelle</th>
            <th style="width: 10%">Lot</th>
            <th style="width: 5%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 5%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsSprint52 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] == 0) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
            echo "<th>" . $us['lot'] . "</th>";
            echo "<th>" . $us['pc'] . "</th>";
            echo "<th>" . $us['temps'] . "</th>";
            echo "<th>" . $us['raf'] . "</th>";
            echo "<th class='$class'>" . $us['pourcentage'] . "%</th>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</section>