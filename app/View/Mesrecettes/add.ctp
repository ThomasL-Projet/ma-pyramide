<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Ajouter une recette');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<?php
echo $this->Form->create('Mesrecette');
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes simulations', ['controller' => 'pages', 'action' => 'jackpotsante', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes recettes', ['controller' => 'mesrecettes', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Ajouter une recette', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Ajouter une nouvelle recette</div> 
            <div class="textarea">
                <p class="text-justify">
                    Personnalisez votre nouvelle recette
                </p>			
            </div>
        </div>  
    </div>
    <div class="row">
        <div class="small-12 columns">
            <div class="small-6 columns">
                <label for="nomRecette" > Nom de la recette
                    <input type="text" maxlength="50" id="nomRecette" required="required"  value="<?php if (isset($recette['Mesrecette']['nom'])) echo $recette['Mesrecette']['nom']; ?>" name="data[Mesrecette][nom]" placeholder="Entrez le nom de votre recette" />
                </label>
            </div>
            <div class="small-6 columns">
                <label for="typeRecette"> Type de recette
                    <select name="data[Mesrecette][type_id]" id="typeRecette">
                        <?php
                        foreach ($fams as $famille) {
                            if (isset($recette['Mesrecette']['type_id']) AND $recette['Mesrecette']['type_id'] == $famille['id']) {
                                echo '<option value="' . $famille['id'] . '" selected>' . $famille['famille'] . '</option>';
                            } else {
                                echo '<option value="' . $famille['id'] . '">' . $famille['famille'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <label for="descRecette" > Description de la recette     
                <textarea id="descRecette" rows="6" name="data[Mesrecette][description]" title="Entrez la description de votre recette, elle doit faire entre 1 et 500 caractètres" maxlength="500"><?php if (isset($recette['Mesrecette']['description'])) echo $recette['Mesrecette']['description']; ?></textarea>               
            </label>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <div class="small-4 columns">
                <label for="tpsCuiss" > Temps de cuisson
                    <input id="tpsCuiss" type="text" maxlength="3" name="data[Mesrecette][temps_cui]" 
                           value="<?php if (isset($recette['Mesrecette']['temps_cui'])) echo $recette['Mesrecette']['temps_cui']; ?>" />
                </label>
            </div>  
            <div class="small-4 columns">
                <label for="tpsPrep" > Temps de préparation
                    <input id="tpsPrep" type="text" maxlength="3" name="data[Mesrecette][temps_prepa]"
                           value="<?php if (isset($recette['Mesrecette']['temps_prepa'])) echo $recette['Mesrecette']['temps_prepa']; ?>"  />
                </label>
            </div>
            <div class="small-4 columns">
                <label for="quantiteRecette"> Nombre de portion
                    <select name="data[Mesrecette][quantite]" id="quantiteRecette">
                        <?php
                        if (isset($recette['Mesrecette']['quantite']) AND $recette['Mesrecette']['quantite'] == 0.5) {
                            echo "<option value='0.5' selected='selected'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif (isset($recette['Mesrecette']['quantite']) AND $recette['Mesrecette']['quantite'] == 1) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1' selected='selected'>1</option>";
                            echo "<option value='1.5'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif (isset($recette['Mesrecette']['quantite']) AND $recette['Mesrecette']['quantite'] == 1.5) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5' selected='selected'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif (isset($recette['Mesrecette']['quantite']) AND $recette['Mesrecette']['quantite'] == 2) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5' >1 &frac12;</option>";
                            echo "<option value='2' selected='selected'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif (isset($recette['Mesrecette']['quantite']) AND $recette['Mesrecette']['quantite'] == 2.5) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5' >1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5' selected='selected'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif (isset($recette['Mesrecette']['quantite']) AND $recette['Mesrecette']['quantite'] == 3) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5' >1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3' selected='selected'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif (isset($recette['Mesrecette']['quantite']) AND $recette['Mesrecette']['quantite'] == 3.5) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5' selected='selected'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif (isset($recette['Mesrecette']['quantite']) AND $recette['Mesrecette']['quantite'] == 4) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4' selected='selected'>4</option>";
                        } else {
                            echo "<option value='0.5' selected='selected'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        }
                        ?>
                    </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <p class="text-center text-warning">Vous devez remplir les champs précédents avant d'ajouter des ingrédients ou des modes de préparation.</p>
        </div>
    </div>      
    <div class="row">
        <div class="small-12 columns">
            <div class="small-6 columns">
                <h3>Les ingrédients</h3>
                <?php foreach ($aliments as $aliment) { ?>
                    <div class="row">
                        <div class="small-6 columns">
                            <h6> Nom : "   <?php echo $aliment['aliment']['Alimentsdetaille']['nom'] ?> "</h6>";
                            <p> Nom Portion : "  <?php echo rech_portion($aliment['aliment']['Aliment'], $aliment['portion']) ?> </p>
                            <p> Nom Portion : "  <?php echo $aliment['quantite'] ?> </p>
                            <input type="hidden" name="Ingred[' . $i . ']" value="' . $aliment['aliment']['Aliment']['id'] . '@' . $aliment['portion'] . '@' . $aliment['quantite'] . '" />';
                        </div>
                        <div class="small-6 columns">
                            <?php echo $this->Html->link('Supprimer cet ingrédient', ['class' => 'button']); ?>
                            <!--echo $this->Html->link(  array('onclick' => 'supprimeElement('.$i.',\''.addslashes($aliment['aliment']['Alimentsdetaille']['nom']).'\')','escape' => false));
                            --></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <a href="#top2"><input style="margin:0px; width:180px; margin-left:220px" type="button" id="ajoutali" value="Ajouter des ingrédients" /></a><br><br><br>
    <hr />
    <p> Modes de préparation : </p><br />
    <?php
    $i = 0;
    if (!empty($recette)) {
        foreach ($recette['Modespreparation'] as $mode) {
            echo '<div id="mode' . $i . '">';
            echo "<div style=\"margin-left:220px\" id=\"numetape" . $i . "\"> &bull; Etape " . $mode['etape'] . "</div>";
            if (strlen($mode['descri']) > 60) {
                echo "<div style=\"margin-left:220px\"> &nbsp;&nbsp; Description : " . substr($mode['descri'], 0, 57) . "...</div>";
            } else {
                echo "<div style=\"margin-left:220px\"> &nbsp;&nbsp; Description : " . $mode['descri'] . "</div>";
            }

            echo '<input class="modes' . $i . '" type="hidden" name="Mode[' . $i . ']" value="' . $mode['descri'] . '" />';
            echo $this->Html->link($this->Html->image('DeleteUser.png', array('style' => 'margin-left:60px; margin-bottom:40px;margin-top:-40px')), 'javascript:void(0)', array('onclick' => 'supprimeMode(' . $i . ',\'' . addslashes($mode['descri']) . '\')', 'escape' => false));

            echo '<br />';
            echo '</div>';
            $i++;
        }
    }
    ?>
    <a href="#top"><input style="margin:0px; width:180px; margin-left:220px" type="button" id="ajoutinstru" value="Ajouter une instruction" /></a><br><br><br>

    <hr />
    <br /><br />
    <input style="margin:0px;alter:left; width:180px; margin-left:70px" type="submit" id="endform" name="endform" value="Ajouter la recette" onclick="return validForm();" /><br>
    <input style="margin:0px; margin-top:-30px; width:180px; margin-left:280px;" type="button" id="reset" value="Réinitialiser les champs" onclick="resetChamps();" /></a>
<?php echo $this->Html->link('<input style="margin:0px; margin-top:-30px; margin-left:490px; width:180px" type="button" value="Annuler" />', '/mesrecettes', array('escape' => false)); ?>
</div>

<div id="blocIMC">
    <!-- Fader -->
</div>
<?php if (isset($fin)) : ?>
    <div id ="validation">
        <div style="text-align:center;color : #A6BC2A;"><h1>Récapitulatif de la recette :</h1></div><br><br><br>
        <table style="width:650px">
            <tr>
                <td width=50%>Nom de la recette</td>
                <td width=50%><?php echo $_POST['data']['Mesrecette']['nom']; ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo $_POST['data']['Mesrecette']['description']; ?></td>
            </tr>
            <tr>
                <td>Temps de cuisson</td>
                <td><?php echo $_POST['data']['Mesrecette']['temps_cui'] . ' minute(s)'; ?></td>
            </tr>
            <tr>
                <td>Temps de préparation</td>
                <td><?php echo $_POST['data']['Mesrecette']['temps_prepa'] . ' minute(s)'; ?></td>
            </tr>
            <tr>
                <td>Nombre de portions</td>
                <td><?php echo $_POST['data']['Mesrecette']['quantite']; ?></td>
            </tr>
            <tr>
                <td>Ingrédients</td>
                <td><?php
    foreach ($aliments as $alim) {
        echo '<strong>Nom : ' . $alim['aliment']['Alimentsdetaille']['nom'] . '</strong><br />';
        echo 'portion : ' . rech_portion($alim['aliment']['Aliment'], $alim['portion']) . '<br />';
        echo 'quantite : ' . $alim['quantite'] . '<br />';
        echo '<br />';
    }
    ?></td>
            </tr>
            <tr>
                <td>Modes de préparation</td>
                <td><?php
                foreach ($recette['Modespreparation'] as $mode) {
                    echo '<strong>Etape ' . $mode['etape'] . ' :</strong><br />';
                    echo $mode['descri'] . '<br />';
                    echo '<br />';
                }
    ?></td>
            </tr>
        </table><br />
        <center><a id="linkcache" style="color:green;font-style:italic;" href="javascript:void(0)">Cliquez ici pour afficher les éléments nutritifs pour chaque aliment et en fonction de la quantité</a></center>
        <br />
        <div id="cache" style="height: 400px;overflow: scroll;">
            <table style="width:650px;" >
                <tr>
                    <td width=50%><strong><?php echo $nutriments[0]['nom']; ?></strong></td>
                    <td width=50%><?php echo $nutriments[0]['valeur']; ?></td>
                </tr>
                <?php
                $i = 0;
                foreach ($nutriments as $nut) {
                    $i++;
                    if ($nut['valeur'] == 0 OR $i == 1)
                        continue;
                    echo '<tr>';
                    echo '<td><strong>' . str_replace("100g", $portiontotale . 'g', $nut['nom']) . '</strong></td>';
                    echo '<td>' . $nut['valeur'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
            <br />
            <center><a id="linkcache2" style="color:green;font-style:italic;" href="javascript:void(0)">Masquer</a></center>
        </div>
        <br />
        <input type="submit" name="enregistrer" value="Enregistrer la recette" style="width:180px; margin-left:140px"><br />
        <input type="button" id="quitter1" value="Annuler" style="width:180px;margin:0px;margin-top:-30px;margin-left :330px">
        <br />
    </div>
<?php endif; ?>
<div id="choixinstru">
    <a name="top"></a>
    <div id="titre-accueil">
        <input style="margin-left:500px; position:absolute; height:35px;width:169px " id="quitter" type="button" name="refaire" value="Quitter cette fenêtre" /><br /><br />
        <div style="text-align:center;color : #A6BC2A;"><h1>Ajouter une instruction :</h1></div><br><br><br>
        <div style="margin-bottom:-70px"> Choisissez l'étape :</div>
        <div style="margin-left:180px"><select name="instru[etape]" id="instruetape">

            </select></div><br /><br /><br /><br /><br />
        <div style="margin-bottom:-30px;"> Description :</div>
        <textarea style="margin-left:220px; width:430px" id="instrudescr" rows="6" cols="70" name="instru[descri]" title="La description doit faire entre 1 et 500 caractètres" maxlength="500"></textarea><br>
        <input style="margin-left:220px; width:200px" type="submit" name="ajoutinstru" value="Ajouter l'instruction" onclick="return validdecri();" />
    </div>
</div>
<div id="choixali">
    <a name="top2"></a>
    <div id="titre-accueil">
        <div style="text-align:center;color : #A6BC2A;"><h1>Rechercher et ajouter des aliments  :</h1></div><br><br><br>

        <p id="lab1">type :</p>

        <!-- Liste déroulante permettant à l'utilisateur de choisir dans quelle catégorie d'aliments, se trouve l'aliment qu'il recherche.
             Cette dernière a pour but de faciliter la recherche. -->
        <!-- type -->

        <select name = "rech" id="rech" class="target1">
            <option selected>- Choisissez un type -</option>
            <?php
            foreach ($familles as $fam) {
                echo '<option style="font-weight: bold;" value="' . $fam['Alimentsdetaille']['type'] . '">' . $fam['Alimentsdetaille']['type'] . '</option>';
            }
            ?>
        </select> 

        <!-- sous-type -->
        <p id="lab2">sous-type :</p>
        <select name = "rech2" id="rech2" class="target">
            <option></option>
            <?php
            foreach ($sous_types as $sous_type) {
                echo '<option value="' . $sous_type['Alimentsdetaille']['sous_type'] . '" class = "' . $sous_type['Alimentsdetaille']['type'] . '">' . $sous_type['Alimentsdetaille']['sous_type'] . '</option>';
            }
            ?>
        </select> 

        <!-- classe -->
        <p id="lab3">classe :</p>
        <select name = "rech3" id="rech3" style = "margin-left:30px" class="target3">
            <?php
            foreach ($classes as $classe) {
                echo '<option value="' . $classe['Alimentsdetaille']['classe'] . '" class = "' . $classe['Alimentsdetaille']['sous_type'] . '">' . $classe['Alimentsdetaille']['classe'] . '</option>';
            }
            ?>
        </select> 
        <!-- sous_classe (possible qu'il n'y en ai pas) -->
        <p id="lab4">sous-classe :</p>
        <select name = "rech4" id="rech4" style = "margin-left:446px; margin-top: -40px" >
            <?php
            foreach ($sous_classes as $sous_classe) {
                echo '<option value="' . $sous_classe['Alimentsdetaille']['sous_classe'] . '" class = "' . $sous_classe['Alimentsdetaille']['classe'] . '">' . $sous_classe['Alimentsdetaille']['sous_classe'] . '</option>';
            }
            ?>
        </select> 

    </div>
    <!-- BOUTONS valider, quitter fenêtre, mes aliments favoris -->
    <input style="margin-left:100px; margin-top: 125px;position:absolute; width:169px" type="submit" name="rechbtn" value="Valider" />	
    <input style="margin-left:100px; margin-top: 165px;position:absolute; height:35px;width:169px " id="quitter" type="button" name="refaire" value="Quitter cette fenêtre" />


    <script language="JavaScript" type="text/javascript">
        $("#rech2").chained("#rech");
        $("#rech3").chained("#rech2");
        $("#rech4").chained("#rech3");
    </script>
    <!-- Zone de texte permettant à l'utilisateur de saisir le nom de l'aliment recherché -->
    <!-- <input type="text" name="zone-aliment" value="" id="zone-aliment" /> <br><br><br> -->

                        <!--<input type="submit" value="Rechercher" onClick='return valrecidherche();' /> -->
    <div id="encyclo">
        <?php
        echo '<span> Résultats </span>';
        ?>

        <!-- On affiche ici les caractéristique du premier aliment pour lequel l'utilisateur souhaite effectuer une comparaison avec un autre aliment -->
        <div class="bloc-gauche">
            <?php
            if (isset($resultats)) :
                if (sizeof($resultats) >= 1) {
                    echo "<ul>";
                    $compteurResultats = 0;
                    // Ici on peut modifier le nombre de résultats affichés
                    foreach ($resultats as $resultat) {
                        $compteurResultats++;
                        if ($compteurResultats > 100) {
                            break;
                        }
                        ?>

                        <li>
                            <?php
                            echo $this->Html->link($resultat['Alimentsdetaille']['nom'], 'javascript:void(0)', array('onclick' => 'return resultatsub(' . $resultat['Aliment'][0]['id'] . ');'));
                            ?>

                        </li>
                        <?php
                    }

                    echo "</ul>";
                } else {
                    echo "Aucun résultat n'est encore disponible pour cette recherche";
                }
            endif;
            ?>	
            <div style="visibility:hidden;">
                <input type="text" value="<?php if (isset($aliment1)) echo $aliment1['Aliment']['id']; ?>" name="postresult" />
            </div>
        </div>

        <?php if (isset($aliment1)): ?>
            <!-- On affiche ici les caractéristique du second aliment pour lequel l'utilisateur souhaite effectuer une comparaison avec un autre aliment -->
            <div class="bloc-droit"> 




                <div class="titre">
                    <?php
                    $fichier = $aliment1['Aliment']['chemin'];
                    if ($fichier == '') {
                        $fichier = 'noimage.jpg';
                    }
                    if (strlen($aliment1['Alimentsdetaille']['nom']) > 60) {
                        echo "<h2>" . substr($aliment1['Alimentsdetaille']['nom'], 0, 57) . "...</h2>";
                    } else {
                        echo "<h2>" . $aliment1['Alimentsdetaille']['nom'] . "</h2>";
                    }
                    ?>			
                    <div id="clickiciency">
                        <?php echo $this->Html->link('Cliquez ici pour voir l\'image', '../app/webroot/img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $aliment1['Alimentsdetaille']['nom'], 'escape' => true)); ?>

                    </div>
                    <?php
                    echo "<p> ____________________________ </p>";
                    ?>	
                </div>

                <div class="choix-portion">
                    <!-- Ici, l'utilisateur peut chosir la quantité pour laquelle il souhaite effectuer la comparaison -->
                    <p> Choisissez une quantité </p>
                    <select class="quantite" name="quantite" id="quantite">
                        <?php
                        if ($quantiteAliment1 == 0.5) {
                            echo "<option value='0.5' selected='selected'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif ($quantiteAliment1 == 1) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1' selected='selected'>1</option>";
                            echo "<option value='1.5'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif ($quantiteAliment1 == 1.5) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5' selected='selected'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif ($quantiteAliment1 == 2) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5' >1 &frac12;</option>";
                            echo "<option value='2' selected='selected'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif ($quantiteAliment1 == 2.5) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5' >1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5' selected='selected'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif ($quantiteAliment1 == 3) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5' >1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3' selected='selected'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } elseif ($quantiteAliment1 == 3.5) {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5' selected='selected'>3 &frac12;</option>";
                            echo "<option value='4'>4</option>";
                        } else {
                            echo "<option value='0.5'>&frac12;</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='1.5'>1 &frac12;</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='2.5'>2 &frac12;</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='3.5'>3 &frac12;</option>";
                            echo "<option value='4' selected='selected'>4</option>";
                        }
                        ?>
                    </select>
                    <!-- L'utilisateur choisi ici la taille de la portion : "petites portions", "moyennes portions" ou "grandes portions" -->
                    <select class="portion" name="portion" id="portion">
                        <?php
                        $split = explode("@", $_POST['portion']);
                        $aComparer = $split[0];
                        if ($aliment1['Aliment']['P1TypePortion'] != NULL) {
                            if ($aliment1['Aliment']['P1Quantite'] == $aComparer) {
                                echo '<option value="' . $aliment1['Aliment']['P1Quantite'] . '@' . $aliment1['Aliment']['P1TypePortion'] . '" selected=\'selected\'>' . $aliment1['Aliment']['P1TypePortion'] . '</option>';
                            } else {
                                echo '<option value="' . $aliment1['Aliment']['P1Quantite'] . '@' . $aliment1['Aliment']['P1TypePortion'] . '" >' . $aliment1['Aliment']['P1TypePortion'] . '</option>';
                            }
                        }
                        if ($aliment1['Aliment']['P2TypePortion'] != NULL) {
                            if ($aliment1['Aliment']['P2Quantite'] == $aComparer) {
                                echo '<option value="' . $aliment1['Aliment']['P2Quantite'] . '@' . $aliment1['Aliment']['P2TypePortion'] . '" selected=\'selected\'>' . $aliment1['Aliment']['P2TypePortion'] . '</option>';
                            } else {
                                echo '<option value="' . $aliment1['Aliment']['P2Quantite'] . '@' . $aliment1['Aliment']['P2TypePortion'] . '" >' . $aliment1['Aliment']['P2TypePortion'] . '</option>';
                            }
                        }
                        if ($aliment1['Aliment']['P3TypePortion'] != NULL) {
                            if ($aliment1['Aliment']['P3Quantite'] == $aComparer) {
                                echo '<option value="' . $aliment1['Aliment']['P3Quantite'] . '@' . $aliment1['Aliment']['P3TypePortion'] . '" selected=\'selected\'>' . $aliment1['Aliment']['P3TypePortion'] . '</option>';
                            } else {
                                echo '<option value="' . $aliment1['Aliment']['P3Quantite'] . '@' . $aliment1['Aliment']['P3TypePortion'] . '" >' . $aliment1['Aliment']['P3TypePortion'] . '</option>';
                            }
                        }
                        if ($aliment1['Aliment']['P4TypePortion'] != NULL) {
                            if ($aliment1['Aliment']['P4Quantite'] == $aComparer) {
                                echo '<option value="' . $aliment1['Aliment']['P4Quantite'] . '@' . $aliment1['Aliment']['P4TypePortion'] . '" selected=\'selected\'>' . $aliment1['Aliment']['P4TypePortion'] . '</option>';
                            } else {
                                echo '<option value="' . $aliment1['Aliment']['P4Quantite'] . '@' . $aliment1['Aliment']['P4TypePortion'] . '" >' . $aliment1['Aliment']['P4TypePortion'] . '</option>';
                            }
                        }
                        if ($aliment1['Aliment']['P5TypePortion'] != NULL) {
                            if ($aliment1['Aliment']['P5Quantite'] == $aComparer) {
                                echo '<option value="' . $aliment1['Aliment']['P5Quantite'] . '@' . $aliment1['Aliment']['P5TypePortion'] . '" selected=\'selected\'>' . $aliment1['Aliment']['P5TypePortion'] . '</option>';
                            } else {
                                echo '<option value="' . $aliment1['Aliment']['P5Quantite'] . '@' . $aliment1['Aliment']['P5TypePortion'] . '" >' . $aliment1['Aliment']['P5TypePortion'] . '</option>';
                            }
                        }
                        if ($aliment1['Aliment']['P6TypePortion'] != NULL) {
                            if ($aliment1['Aliment']['P6Quantite'] == $aComparer) {
                                echo '<option value="' . $aliment1['Aliment']['P6Quantite'] . '@' . $aliment1['Aliment']['P6TypePortion'] . '" selected=\'selected\'>' . $aliment1['Aliment']['P6TypePortion'] . '</option>';
                            } else {
                                echo '<option value="' . $aliment1['Aliment']['P6Quantite'] . '@' . $aliment1['Aliment']['P6TypePortion'] . '" >' . $aliment1['Aliment']['P6TypePortion'] . '</option>';
                            }
                        }
                        if ($aliment1['Aliment']['P7TypePortion'] != NULL) {
                            if ($aliment1['Aliment']['P7Quantite'] == $aComparer) {
                                echo '<option value="' . $aliment1['Aliment']['P7Quantite'] . '@' . $aliment1['Aliment']['P7TypePortion'] . '" selected=\'selected\'>' . $aliment1['Aliment']['P7TypePortion'] . '</option>';
                            } else {
                                echo '<option value="' . $aliment1['Aliment']['P7Quantite'] . '@' . $aliment1['Aliment']['P7TypePortion'] . '" >' . $aliment1['Aliment']['P7TypePortion'] . '</option>';
                            }
                        }
                        if ($aliment1['Aliment']['P8TypePortion'] != NULL) {
                            if ($aliment1['Aliment']['P8Quantite'] == $aComparer) {
                                echo '<option value="' . $aliment1['Aliment']['P8Quantite'] . '@' . $aliment1['Aliment']['P8TypePortion'] . '" selected=\'selected\'>' . $aliment1['Aliment']['P8TypePortion'] . '</option>';
                            } else {
                                echo '<option value="' . $aliment1['Aliment']['P8Quantite'] . '@' . $aliment1['Aliment']['P8TypePortion'] . '" >' . $aliment1['Aliment']['P8TypePortion'] . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <input style="right:-90px" type="submit" name="valider" value="Valider" />		
                </div>
                <!-- L'utilisateur peut afficher des informations concernant l'aliment mais aussi les caractéristiques nutritionelles de ce dernier -->
                <div class="onglets-encyclo">
                    <a>Informations nutritionnelles</a>
                </div>

                <div class="info-aliment" id='info-aliment1'>

                    <div class="scroller">
                        <table>
                            <tr>
                                <th> Nutriment </th>
                                <th> Quantité </th>
                                <th> % Valeur quotidienne </th>
                            </tr>
                            <tr>
                                <td> 
                                    <ul>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Calories
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Protéines
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Lipides
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Cholestérol
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Glucides
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Fibres
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Sucres
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Sodium
                                            </p>
                                        </li>
                                    </ul>
                                </td>
                                <td>  
                                    <ul>
                                        <li> 
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][1]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> kcal
                                            </p>
                                        </li>

                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][16]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> g
                                            </p>
                                        </li>

                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][23]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> g
                                            </p>
                                        </li>

                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][56]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> mg
                                            </p>
                                        </li>

                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][18]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> g
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][22]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> g
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][19]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> g
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][5]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> mg
                                            </p>
                                        </li>
                                    </ul>
                                </td>
                                <td>  
                                    <ul>
                                        <li> 
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                if (isset($obEnKcal))
                                                    echo round((($aliment1['Donneesaliment'][1]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obEnKcal) * 100, 2) . ' %';
                                                ?> 
                                            </p>
                                        </li>

                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                if (isset($obPro))
                                                    echo round((($aliment1['Donneesaliment'][16]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obPro) * 100, 2) . ' %';
                                                ?> 
                                            </p>
                                        </li>

                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                if (isset($obLip))
                                                    echo round((($aliment1['Donneesaliment'][23]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obLip) * 100, 2) . ' %';
                                                ?> 
                                            </p>
                                        </li>

                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                /* ND */ if (isset($obEnKcal))
                                                    echo 'Non définie';
                                                ?> 
                                            </p>
                                        </li>

                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                if (isset($obGlu))
                                                    echo round((($aliment1['Donneesaliment'][18]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obGlu) * 100, 2) . ' %';
                                                ?> 
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                if (isset($obFib))
                                                    echo round((($aliment1['Donneesaliment'][22]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obFib) * 100, 2) . ' %';
                                                ?> 
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                /* ND */ if (isset($obEnKcal))
                                                    echo 'Non définie';
                                                ?> 
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                if (isset($obSel))
                                                    echo round((($aliment1['Donneesaliment'][5]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obSel) * 100, 2) . ' %';
                                                ?> 
                                            </p>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <ul>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Vitamine A
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Vitamine C
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Calcium
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                Fer
                                            </p>
                                        </li>
                                    </ul>
                                </td>
                                <td> 
                                    <ul>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][41]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> µg
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][46]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> µg
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][9]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> mg
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                echo $aliment1['Donneesaliment'][11]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                ?> mg
                                            </p>
                                        </li>
                                    </ul>
                                </td>
                                <td> 
                                    <ul>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                if (isset($obVitA))
                                                    echo round((($aliment1['Donneesaliment'][41]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitA) * 100, 2) . ' %';
                                                ?> 
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                if (isset($obVitC))
                                                    echo round((($aliment1['Donneesaliment'][46]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitC) * 100, 2) . ' %';
                                                ?> 
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                if (isset($obCal))
                                                    echo round((($aliment1['Donneesaliment'][9]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obCal) * 100, 2) . ' %';
                                                ?> 
                                            </p>
                                        </li>
                                        <li>
                                            <p class='groupeAlimentaire'>
                                                <?php
                                                if (isset($obFer))
                                                    echo round((($aliment1['Donneesaliment'][11]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obFer) * 100, 2) . ' %';
                                                ?> 
                                            </p>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="onglets-encyclo" style="margin-top:3px;">
                        <a>Ajouter aux ingrédients :</a>
                    </div>  
                    <div class="choix-portion">
                        <!--Ajout aliment-->

                        <input style="left:50px;width:120px;" type="submit" id="fin" name="repas1" value="Ajouter" onclick="return confirm_ajout_gauche();" />	

                    </div>
                </div>	   


            </div>


        <?php endif; ?>
    </div>

    <div id="confirmation">
    </div>

    <?php echo $this->Html->script('zoombox/zoombox.js'); ?>
    <?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>

    <script type="text/javascript">

        document.getElementById("rech2").style.display = "none";
        document.getElementById("rech3").style.display = "none";
        document.getElementById("rech4").style.display = "none";
        document.getElementById("lab2").style.display = "none";
        document.getElementById("lab3").style.display = "none";
        document.getElementById("lab4").style.display = "none";



        $(".target1").change(function () {
            setTimeout(function () {
                if ($('#rech2>option').length != 1) {
                    document.getElementById("rech2").style.display = "block";
                    document.getElementById("lab2").style.display = "block";
                    $(".target").change(function () {
                        setTimeout(function () {
                            if ($('#rech3>option').length != 1) {
                                document.getElementById("rech3").style.display = "block";
                                document.getElementById("lab3").style.display = "block";
                                $(".target3").change(function () {
                                    setTimeout(function () {
                                        if ($('#rech4>option').length != 1) {
                                            document.getElementById("rech4").style.display = "block";
                                            document.getElementById("lab4").style.display = "block";
                                        } else {
                                            document.getElementById("rech4").style.display = "none";
                                            document.getElementById("lab4").style.display = "none";
                                        }
                                    }, 500);
                                });
                            } else {
                                document.getElementById("rech3").style.display = "none";
                                document.getElementById("lab3").style.display = "none";
                            }
                        }, 500);
                        document.getElementById("rech4").style.display = "none";
                        document.getElementById("lab4").style.display = "none";
                    });
                }
            }, 500);
            document.getElementById("rech3").style.display = "none";
            document.getElementById("rech4").style.display = "none";
            document.getElementById("lab3").style.display = "none";
            document.getElementById("lab4").style.display = "none";
        });


        jQuery(document).ready(function ($) {
<?php if (isset($aliment1) OR isset($resultats) OR isset($favorisjquery)) : ?>
                $('#choixali').show();
                $('#blocIMC').show();
<?php elseif (isset($fin)) : ?>
                document.getElementById("cache").style.display = "none";
                $('#validation').show();
                $('#blocIMC').show();
                $('#validation').fadeIn();
                $('#blocIMC').fadeIn();
<?php endif; ?>
            $('#confirmation').hide();
            $('#bloc-editeur #ajoutali').click(function (e) {
                $('#choixali').fadeIn();
                $('#blocIMC').fadeIn();
            });
            $('#choixali #quitter').click(function (e) {
                $('#choixali').fadeOut();
                $('#blocIMC').fadeOut();
            });
            $('#bloc-editeur #ajoutinstru').click(function (e) {
                $('#choixinstru').fadeIn();
                $('#blocIMC').fadeIn();
                calculEtape();
            });
            $('#choixinstru #quitter').click(function (e) {
                $('#choixinstru').fadeOut();
                $('#blocIMC').fadeOut();
            });
            $('#validation #linkcache').click(function (e) {
                $('#validation #cache').show();
            });
            $('#validation #linkcache2').click(function (e) {
                $('#validation #cache').hide();
            });
            $('#validation #quitter1').click(function (e) {
                $('#validation ').fadeOut();
                $('#blocIMC').fadeOut();
            });



        });

        jQuery(function ($) {
            $('a.zoombox').zoombox();

            /**
             * Or You can also use specific options
             $('a.zoombox').zoombox({
             theme       : 'zoombox',        //available themes : zoombox,lightbox, prettyphoto, darkprettyphoto, simple
             opacity     : 0.8,              // Black overlay opacity
             duration    : 800,              // Animation duration
             animation   : true,             // Do we have to animate the box ?
             width       : 500,              // Default width
             height      : 500,              // Default height
             gallery     : true,             // Allow gallery thumb view
             autoplay : false                // Autoplay for video
             });
             */
        });

        function confirm_ajout_gauche() {
            var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>');
            if (isNaN(id_user)) {
                /* Utilisateur non connecté */
                alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
                return false;
            }
            /* else : utilisateur connecté */
            var q = document.getElementById('quantite').value;
            var quant;
            switch (q) {
                case '0.5' :
                    quant = '1/2';
                    break;
                case '1.5' :
                    quant = '1 et demis';
                    break;
                case '2.5' :
                    quant = '2 et demis';
                    break;
                case '3.5' :
                    quant = '3 et demis';
                    break;
            }
<?php if (isset($aliment1)) : ?>
                if (confirm("Confirmez-vous l'ajout de " + q + "x <?php echo str_replace('"', '\'', $aliment1['Alimentsdetaille']['nom']); ?> ?")) {
                    var e = document.getElementById("portion");
                    var po = e.options[e.selectedIndex].value;
                    var portion = po.split("@")[0];
                    document.getElementById("fin").value = <?php echo $aliment1['Aliment']['id']; ?> + "@" + portion + "@" + q;
                    return true;
                } else {
                    return false;
                }
<?php endif; ?>
        }

        function confirm_ajout_fav_gauche() {
            var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>');
            if (isNaN(id_user)) {
                /* Utilisateur non connecté */
                alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
                return false;
            }
            /* else : utilisateur connecté */
<?php if (isset($aliment1)) : ?>
                if (confirm("Confirmez-vous l'ajout de l'aliment <?php echo str_replace('"', '\'', $aliment1['Alimentsdetaille']['nom']); ?> à vos aliments favoris ?")) {
                    return true;
                } else {
                    return false;
                }
<?php endif; ?>
        }

        function confirm_retirer_fav_gauche() {
            var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>');
            if (isNaN(id_user)) {
                /* Utilisateur non connecté */
                alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
                return false;
            }
            /* else : utilisateur connecté */
<?php if (isset($aliment1)) : ?>
                if (confirm("Confirmez-vous le retrait de l'aliment <?php echo str_replace('"', '\'', $aliment1['Alimentsdetaille']['nom']); ?> de vos aliments favoris ?")) {
                    return true;
                } else {
                    return false;
                }
<?php endif; ?>
        }

        function resultatsub(id) {
            document.forms['MesrecetteAddForm'].postresult.value = id;
            document.forms['MesrecetteAddForm'].submit();
        }

        function supprimeElement(id, nom) {
            if (confirm("Confirmez-vous de vouloir supprimer l'ingrédient " + nom + " ?")) {
                document.getElementById("ingred" + id).style.display = 'none';
                $(".valeurs" + id).remove();
            }

        }
        function supprimeMode(id, nom) {
            if (confirm("Confirmez-vous de vouloir supprimer le mode de préparation " + nom + " ?")) {
                var i;
                $(".modes" + id).remove();
                var nb_modes = <?php
if (!isset($recette['Modespreparation'])) {
    echo '0';
} else {
    echo count($recette['Modespreparation']);
}
?>;
                document.getElementById("mode" + id).style.display = 'none';
                var comp = 1;
                for (i = 1; i <= (nb_modes); i = i + 1) {
                    if (document.getElementById("mode" + (i - 1)).style.display == "none")
                        continue;
                    document.getElementById("numetape" + (i - 1)).innerHTML = "&bull; Etape " + (comp);
                    comp++;
                }
            }
        }

        function calculEtape() {
            var i;
            var comp = 0;
            var nb_modes = <?php
if (!isset($recette['Modespreparation'])) {
    echo '0';
} else {
    echo count($recette['Modespreparation']);
}
?>;
            for (i = 1; i <= (nb_modes); i = i + 1) {
                if (document.getElementById("mode" + (i - 1)).style.display == "none")
                    continue;
                comp++;
            }
            comp++;
            var result = "";
            i = 0;
            for (i = 1; i <= comp; i = i + 1) {
                result = result + "<option value=\"" + i + "\">" + i + "</option>";
            }
            document.getElementById("instruetape").innerHTML = result;
        }

        function validdecri() {
            if (document.getElementById("instrudescr").value.length == 0) {
                alert("La description ne doit pas être vide !");
                return false;
            }
            return true;
        }

        function resetChamps() {
            if (confirm("Confirmez-vous de vouloir réinitialiser les champs ? Les aliments et modes de préparation ne seront pas supprimés.")) {
                document.getElementById("nomRecette").value = "";
                document.getElementById("descRecette").value = "";
                document.getElementById("tpsCuiss").value = "";
                document.getElementById("tpsPrep").value = "";
            }
        }

        function validForm() {
            regex = /^[0-9]{1,3}$/;
            if (!(regex.test(document.getElementById("tpsCuiss").value))) {
                alert("Le temps de cuisson est invalide !");
                return false;
            }
            if (!(regex.test(document.getElementById("tpsPrep").value))) {
                alert("Le temps de préparation est invalide !");
                return false;
            }
            return true;
        }
    </script>
</div>









