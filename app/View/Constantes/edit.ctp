<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Éditer les constantes');
?>


<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Gestion des constantes alimentaires', ['controller' => 'constantes', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Modification d\'une constante alimentaire', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <?php if (!$affichage) : ?>
                <!-- Accès seulement aux admins et interdit aux modifications de l'url -->
                <?php echo '<h3 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h3>'; ?>
            <?php else : ?>
                <?php echo $this->Form->create('Constante'); ?>


                <?php if ($constantes[0]['Constante']['categorie'] == 2) : /* PROTENIES */ ?>
                    <?php
                    $tab = array();
                    for ($i = 0; $i <= 9; $i++) {
                        $tab[$i] = $constantes[$i]['Constante']['description'];
                    }
                    ?>	
                    <div class="title-area">Modification des constantes des <strong>protéines</strong></div> 
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">             
                    <div id="bloc-editeur">
                        <label for="descpro">Modifier l'apport en g/kg/j</label>
                        <select id="liste" name="descpro" >
                            <?php
                            foreach ($tab as $ta) {
                                echo '<option value="' . $ta . '">' . $ta . '</option>';
                            }
                            ?>
                        </select>
                        <label for="valeurpro">Selectionner la nouvelle valeur</label>
                        <select name="valeurpro">
                            <?php
                            for ($i = 0.6; $i <= 2.6; $i = $i + 0.1) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            ?>
                        </select>
                        <div id="bloc2">
                            <input type="submit" class="button" value="Modifier" name="pro" />	
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($constantes[0]['Constante']['categorie'] == 3) : /* LIPIDES */ ?>   
            <div class="title-area">Modification du pourcentage d’énergie apportée par les <strong>lipides</strong></div> 
        </div>
        </div>
        <div class="row">
            <div class="small-12 columns">             
                <div id="bloc-editeur">
                    <label for="valeurlip">Selectionnez le nouveau pourcentage du total énergétique qui donnera le nombre de calories qu’apporteront les lipides</label>
                    <select id="liste2" name="valeurlip" >
                        <?php
                        for ($i = 25; $i <= 45; $i++) {
                            if (round($i / 100, 2) == round($constantes['valeur'], 2)) {
                                echo '<option value="' . ($i / 100) . '" selected>' . $i . '</option>';
                            } else {
                                echo '<option value="' . ($i / 100) . '">' . $i . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <p id="desc2"></p>
                    <div id="bloc2">
                        <input type="submit" class="button" value="Modifier" />
                    </div>
                </div>
            </div>
        </div>


    <?php elseif ($constantes[0]['Constante']['categorie'] == 1) : /* FIBRES */ ?>
        <?php
        $tab = array();
        for ($i = 0; $i <= 11; $i++) {
            $tab[$i] = $constantes[$i]['Constante']['description'];
        }
        ?>
        <div class="title-area">Modification des constantes des <strong>fibres</strong></div>
        </div>
        </div>
        <div class="row">
            <div class="small-12 columns">              
                <div id="bloc-editeur">
                    <label for="valeurlip">Modifier l'apport en g</label>    
                    <select id="liste" name="valeurlip" >
                        <?php
                        foreach ($tab as $ta) {
                            echo '<option value="' . $ta . '">' . $ta . '</option>';
                        }
                        ?>
                    </select>
                    <label for="valeurfibre">Saisissez la nouvelle valeur</label>
                    <input name="valeurfibre" maxlength="2" type="text" id="liste3">	                                          
                    <p id="desc3"></p><br>
                    <div id="bloc2">
                        <input type="submit" class="button" value="Modifier"  />
                    </div>
                </div>
            </div>
        </div>




    <?php elseif ($constantes[0]['Constante']['categorie'] == 4) : /* SEL */ ?>
        <?php
        $tab = array();
        for ($i = 0; $i <= 9; $i++) {
            $tab[$i] = $constantes[$i]['Constante']['description'];
        }
        ?>	
        <div class="title-area">Modification des constantes du <strong>sel</strong></div>
        </div>
        </div>
        <div class="row">
            <div class="small-12 columns">              
                <div id="bloc-editeur">
                    <label for="descsel">Modifier l'apport en mg</label>
                    <select id="liste" name="descsel" >
                        <?php
                        foreach ($tab as $ta) {
                            echo '<option value="' . $ta . '">' . $ta . '</option>';
                        }
                        ?>
                    </select>
                    <label for="valeursel">Saisissez la nouvelle constante de sel</label>
                    <input type="text" maxlength="4" id="liste4" name="valeursel">

                    <p id="desc4"></p><br>
                    <div id="bloc2">
                        <input type="submit" class="button" value="Modifier" onclick="return valid4();" />
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
    </form>
    </div>

    <script type="text/javascript">


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





        // Fin -->

    </script>
<?php endif; ?>