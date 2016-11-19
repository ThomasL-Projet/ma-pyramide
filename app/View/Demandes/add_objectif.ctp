<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Suivre l\'état d\'une demande');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Permet aux diététicien d\'analyse les suivis des patients');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Diététicien', ['controller' => 'gestionDieteticien', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Vos suivis patients', ['controller' => 'demandes', 'action' => 'suivis', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Analyse suivi', ['controller' => 'demandes', 'action' => 'analyseSuivi', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Modification objectifs', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Modification des objectifs </div> 
        </div>
    </div>
    <br>
    ﻿<div class="row">
        <div class="small-12 columns text-center">
            <?php if ($modif == 1) : /* PROTENIES */ ?>
                <div id="bloc-editeur">
                    <p>L'objectif en protéine par défaut de votre client est : <?php echo $obPro; ?> g</p>
                    <p>Modifier l'apport en g/kg/j : </p>
                    <select id="liste" name="apport1" onchange="texte1()" class="small-4 centered">
                        <?php
                        for ($i = 0.6; $i <= 2.6; $i = $i + 0.1) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <p id="desc"></p>
                    <div id="bloc2">
                        <input class="button" type="submit" value="Modifier" />
                    </div>
                </div>
            <?php elseif ($modif == 2) : /* LIPIDES */ ?>
                <div id="bloc-editeur">
                    <p>L'objectif en lipide par défaut de votre client est : <?php echo $obLip; ?> g</p>
                    <p>Modifier le pourcentage d’énergie apportée : </p>
                    <select id="liste2" name="apport2" onchange="texte2()" class="small-4 centered">
                        <?php
                        for ($i = 25; $i <= 45; $i++) {
                            echo '<option value="' . ($i / 100) . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <p id="desc2"></p>
                    <div id="bloc2">
                        <input class="button" type="submit" value="Modifier" />
                    </div>
                </div>
            <?php elseif ($modif == 3) : /* FIBRES */ ?>
                <div class="span2"> Modifiez son objectif : </div> 
                <div id="bloc-editeur">
                    <p>L'objectif en fibre par défaut de votre client est : <?php echo $obFib; ?> g</p>

                    <p>Modifier l'apport en g : </p>
                    
                    <div class="small-4 centered text-center">
                        <input style="margin-left:100%" type="text" maxlength="2" id="liste3" name="apport3">
                    </div>
                    
                    <p id="desc3"></p>
                    <div id="bloc2">
                        <input class="button" type="submit" value="Modifier" onclick="return valid3();" />
                    </div>
                </div>
            <?php elseif ($modif == 4) : /* SEL */ ?>
                <div class="span2"> Modifiez son objectif : </div> 
                <div id="bloc-editeur">
                    <p>L'objectif en sel par défaut de votre client est : <?php echo $obSel; ?> mg</p>

                    <p>Modifier l'apport en mg : </p>
                    <div class="small-4 centered">
                        <input style="margin-left:100%" type="text" maxlength="4" id="liste4" name="apport4">
                    </div>
                    

                    <p id="desc4"></p>
                    <div id="bloc2">
                        <input class="button" type="submit" value="Modifier" onclick="return valid4();" />
                    </div>
                </div>
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