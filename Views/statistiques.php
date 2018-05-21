<section id="container">
    <form method="post" action="../Controller/statistique.php">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    Fonctionnel :
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <select name="lot">
                            <option value="">lot</option>
                            <?php foreach ($lots as $lot) {
                                echo "<option value=" . $lot['id'];
                                if(isset($lotSave) && $lotSave == $lot['id']) echo " selected";
                                echo " >" . $lot['libelle'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-7">
                        <select name="us">
                            <option value="">US</option>
                            <?php foreach ($uss as $us) {
                                echo "<option value=" . $us['id'];
                                if(isset($usSave) && $usSave == $us['id']) echo " selected";
                                echo " >" . $us['libelle'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    Temporel :
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <select name="sprint">
                            <option value="">Sprint</option>
                            <?php foreach ($sprints as $sprint) {
                                echo "<option value=" . $sprint['id'];
                                if(isset($sprintSave) && $sprintSave == $sprint['id']) echo " selected";
                                echo " > Sprint " . $sprint['id'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="semaine">
                            <option value="">Semaine</option>
                            <?php
                            for($i=1; $i<=10; $i++){
                                echo "<option value=" . $i;
                                if(isset($semaineSave) && $semaineSave == $i) echo " selected";
                                echo " >Semaine " . $i . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="jour" <?php if(isset($jourSave)) echo "value='" .  $jourSave . "'"; ?>/>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    Organisationnel :
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <select name="metier">
                            <option value="">Métier</option>
                            <?php foreach ($metiers as $metier) {
                                echo "<option value=" . $metier['id'];
                                if(isset($metierSave) && $metierSave == $metier['id']) echo " selected";
                                echo " >" . $metier['libelle'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="membre">
                            <option value="">Membre</option>
                            <?php foreach ($membres as $membre) {
                                echo "<option value=" . $membre['id'];
                                if(isset($membreSave) && $membreSave == $membre['id']) echo " selected";
                                echo " >" . $membre['prenom'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="submit" value="Valider" name="valider">
        </div>
    </form>

</section>