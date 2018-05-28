<section id="container">
    <?php if(isset($erreur)){
        echo $erreur;
    } ?>


    <h2 style="text-align: center">Ajouter un temps :</h2>
    <div class="row" style="text-align: center">
        <form method="post" action="../Controller/accueil.php" style="width: 100%">
            <div class="row">
                <?php
                if(!empty($type_tache)){
                    ?>
                    <div class="col-md-2">
                        <label class="row">Type de tâche</label>
                        <select class="row" name="type">
                            <option value="">Choisissez un type de tâche</option>
                            <?php
                            foreach($type_tache as $type){
                                echo "<option value='" . $type['id'] . "'";
                                if(isset($_POST['type']) && $_POST['type'] == $type['id']) echo " selected";
                                echo ">" . $type['libelle'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <?php
                }
                if(!empty($uss)){
                    ?>
                    <div class="col-md-3">
                        <label class="row">User story :</label>
                        <select class="row" name="us">
                            <option value="">Choisissez une user story</option>
                            <?php
                            foreach($uss as $us){
                                echo "<option value='" . $us['id'] . "'";
                                if(isset($_POST['us']) && $_POST['us'] == $us['id']) echo " selected";
                                echo ">" . $us['libelle'] . "</option>";
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


    <h2 style="text-align: center">Ma liste des temps</h2>
    <table style="margin-bottom: 100px;" width="100%">
        <thead style="text-align: center; font-weight: bold; border-bottom: 1px solid darkred">
        <tr style="width: 100%; color: darkred; padding : 50px">
            <th style="width: 10%">Date</th>
            <th style="width: 15%">Type tâche</th>
            <th style="width: 15%">Lot</th>
            <th style="width: 50%">User story</th>
            <th style="width: 10%">Temps</th>
            <th style="width: 5%">RAF</th>
        </tr>
        </thead>
        <tbody style="text-align: center; font-weight: 200">
        <?php
        foreach($imputations as $imputation){
            $us = getUserStoryById($bdd, $imputation['id_us']);
            $lot = getLotById($bdd, $us['id_lot']);
            $type = getTypeTacheById($bdd, $imputation['id_tache']);
            if($imputation['minute'] <10) $imputation['minute'] = "0" . $imputation['minute'];
            echo "<tr style='color: dimgrey; border-bottom: 1px solid lightgrey'>";
            echo "<th>" . $imputation['date_imput'] . "</th>";
            echo "<th>" . $type['libelle'] . "</th>";
            echo "<th>" . $lot['libelle'] . "</th>";
            echo "<th>" . $us['libelle'] . "</th>";
            echo "<th>" . $imputation['heure'] . "h" . $imputation['minute'] . "min</th>";
            echo "<th>" . $imputation['raf'] . "h</th>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

</section>