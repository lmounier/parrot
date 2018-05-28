<section id="container">
    <div class="row"">
        <a class="btn btn-primary col-md-6" href="#">Par lot</a>
        <a class="btn btn-secondary col-md-6" href="SuiviUsSprint.php">Par Sprint</a>
    </div>

    <h2>Suivi des tâches par lot</h2>

    <br/><br/>

    <h3>Lot Authentification</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">libelle</th>
            <th style="width: 10%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 10%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsLotAuthentification2 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
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

    <h3>Lot Budget</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">libelle</th>
            <th style="width: 10%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 10%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsLotBudget2 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
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

    <h3>Lot Voyage</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">libelle</th>
            <th style="width: 10%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 10%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsLotVoyage2 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
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

    <h3>Lot Transport</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">libelle</th>
            <th style="width: 10%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 10%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsLotTransport2 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
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

    <h3>Lot Logement</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">libelle</th>
            <th style="width: 10%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 10%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsLotLogement2 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
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

    <h3>Lot Activité</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">libelle</th>
            <th style="width: 10%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 10%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsLotActivité2 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
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

    <h3>Lot Liste</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">libelle</th>
            <th style="width: 10%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 10%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsLotListe2 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
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

    <h3>Lot PDF</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">libelle</th>
            <th style="width: 10%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 10%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsLotPDF2 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
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

    <h3>Lot Tests</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">libelle</th>
            <th style="width: 10%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 10%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsLotTests2 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
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

    <h3>Lot Site</h3>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 40%">libelle</th>
            <th style="width: 10%">PC</th>
            <th style="width: 10%">Temps passé</th>
            <th style="width: 10%">RAF</th>
            <th style="width: 10%">Pourcentage</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($listeUsLotSite2 as $us){
            if($us['pourcentage'] == 0) $class = "noStart";
            elseif ($us['pourcentage'] < 100) $class = "inProgress";
            else $class = "finish";
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $us['libelle'] . "</th>";
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