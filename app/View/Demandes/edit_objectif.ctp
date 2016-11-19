<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Éditer l\'objectif d\'une demande');
?>
<div class="row">
    <div class="small-12 columns">

        <?php echo $this->Form->create('Constsuivialimentaire');
        ?>
        <div id="presentation">
            <?php if (!$affichage) : ?>
                <!-- Accès seulement aux diététiciens et interdit aux modifications de l'url -->
                <?php echo $this->Html->link('<< Retour', '/pages/home/'); ?>
                <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
            <?php else : ?>
                <?php echo $this->Html->link('<< Retour', '/demandes/suivis/'); ?>
                <?php if ($modif == 1) : /* PROTENIES */ ?>
                    <div class="span2"> Modifiez l'objectif : </div> 
                    <div id="bloc-editeur">
                        <p style="color:green;">L'objectif actuel du client est : <?php echo intval($poids * $fixPro); ?> g (avec <?php echo $fixPro; ?> g/kg/j)</p>
                        <p>L'objectif par défaut de votre client est : <?php echo $obPro; ?> g</p>
                        <br>
                        <p>Modifier l'apport en g/kg/j : </p>
                        <select id="liste" name="apport1" onchange="texte1()">
                            <?php
                            for ($i = 0.6; $i <= 2.6; $i = $i + 0.1) {
                                if (round($i, 2) == round($fixPro, 2)) {
                                    echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                } else {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <p id="desc"></p><br>
                        <div id="bloc2">
                            <input type="submit" class="button" value="Modifier" />

                        </div>
                    </div>
                <?php elseif ($modif == 2) : /* LIPIDES */ ?>
                    <div class="span2"> Modifiez l'objectif : </div> 
                    <div id="bloc-editeur">
                        <p style="color:green;">L'objectif actuel du client est : <?php echo intval(($obEnKcal * $fixLip) / 9); ?> g (avec <?php echo $fixLip * 100; ?>% comme pourcentage d’énergie apportée)</p>
                        <p>L'objectif par défaut de votre client est : <?php echo $obLip; ?> g</p>
                        <br>
                        <p>Modifier le pourcentage d’énergie apportée : </p>
                        <select id="liste2" name="apport2" onchange="texte2()">
                            <?php
                            for ($i = 25; $i <= 45; $i++) {
                                if (round($i / 100, 2) == round($fixLip, 2)) {
                                    echo '<option value="' . ($i / 100) . '" selected>' . $i . '</option>';
                                } else {
                                    echo '<option value="' . ($i / 100) . '">' . $i . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <p id="desc2"></p><br>
                        <div id="bloc2">
                            <input type="submit" class="button" value="Modifier" />
                        </div>
                    </div>
                <?php elseif ($modif == 3) : /* FIBRES */ ?>
                    <div class="span2"> Modifiez l'objectif : </div> 
                    <div id="bloc-editeur">
                        <p style="color:green;">L'objectif actuel du client est : <?php echo $fixFib; ?> g</p>
                        <p>L'objectif par défaut de votre client est : <?php echo $obFib; ?> g</p>
                        <br>
                        <p>Modifier l'apport en g : </p>
                        <input type="text" maxlength="2" id="liste3" name="apport3" value="<?php echo $fixFib; ?>">

                        <p id="desc3"></p><br>
                        <div id="bloc2">
                            <input type="submit" class="button" value="Modifier" onclick="return valid3();" />
                        </div>
                    </div>
                <?php elseif ($modif == 4) : /* SEL */ ?>
                    <div class="span2"> Modifiez l'objectif : </div> 
                    <div id="bloc-editeur">
                        <p style="color:green;">L'objectif actuel du client est : <?php echo $fixSel; ?> mg</p>
                        <p>L'objectif par défaut de votre client est : <?php echo $obSel; ?> mg</p>
                        <br>
                        <p>Modifier l'apport en mg : </p>
                        <input type="text" maxlength="4" id="liste4" name="apport4" value="<?php echo $fixSel; ?>">

                        <p id="desc4"></p><br>
                        <div id="bloc2">
                            <input type="submit" class="button" value="Modifier" onclick="return valid4();" />
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function texte1() {
        var valeur = document.getElementById('liste').value;
        var res = valeur * <?php
            if (isset($poids)) {
                echo $poids;
            } else {
                echo 1;
            }
            ?>;
        document.getElementById('desc').innerHTML = "En modifiant par cette valeur, l'objectif de votre client sera : " + res + " g";
    }
    function texte2() {
        var valeur = document.getElementById('liste2').value;
        var res = parseInt((valeur * <?php
            if (isset($obEnKcal)) {
                echo $obEnKcal;
            } else {
                echo 1;
            }
            ?>) / 9);
        document.getElementById('desc2').innerHTML = "En modifiant par cette valeur, l'objectif de votre client sera : " + res + " g";
    }

    function valid3() {
        regex = /^[0-9]{1,2}$/;
        if (!(regex.test(document.getElementById("liste3").value))) {
            alert("La quantitée de fibres doit être un chiffre");
            return false;
        }
        if (document.getElementById("liste3").value < 1 || document.getElementById("liste3").value > 99) {
            alert("La quantitée de fibres doit être comprise entre 1 et 99");
            return false;
        }
        return true;
    }
    function valid4() {
        regex = /^[0-9]{1,4}$/;
        if (!(regex.test(document.getElementById("liste4").value))) {
            alert("La quantitée de sel doit être un chiffre");
            return false;
        }
        if (document.getElementById("liste4").value < 1 || document.getElementById("liste4").value > 9999) {
            alert("La quantitée de sel doit être comprise entre 1 et 9999");
            return false;
        }
        return true;
    }
</script>