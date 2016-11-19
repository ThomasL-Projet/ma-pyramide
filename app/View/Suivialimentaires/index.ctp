<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon Suivi Alimentaire');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Un suivi de votre nutrition dans le temps.');
$this->end();
?>

<?php
// nécessaire pour que la sélection des élèments s'actualise bien en temps réel
echo $this->Html->script('https://cdn.jsdelivr.net/jquery.chained/0.9.9/jquery.chained.min.js');
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.8/jquery.jqplot.min.js');
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mon suivi alimentaire', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">


        <div class="small-12 small-centered columns">
            <!-- Cette page est accessible à partir du supertracker : Cliquez sur "Ressources" -> "Super Traqueur" -> "Suivi Alimentaire" -->

            <div class="title-area"> Suivi de votre alimentation </div> 


            <div class="textarea">
                <p class="text-justify">Recherchez dans l'encyclopédie et ajoutez les aliments afin de vérifier si vos choix correspondent aux valeurs personnalisées des groupes alimentaires.
                    Simplifiez cette étape en utilisant « mes aliments favoris » . <br><br>
                    Si vous voulez voir, modifier ou supprimer vos aliments consommés dans la journée <strong><?php echo $this->Html->link('Cliquez ici', '/suivialimentaires/edit/', array('escape' => false, 'title' => 'Voir mes aliments')); ?></strong>
                </p>
            </div>
        </div>

        <div class="small-12 columns">
            <!-- Titre -->
            <center><h1 style="color:#A6BC2A;">Navigation</h1></center><br /><hr /><br />
            <!-- Groupe bouton -->

            <div class="centered button-group  ">
                <input class="button small"  value="Suivi alimentaire" onclick="clicBouton1()" />
                <input class="button small"  value="Rechercher un aliment" onclick="clicBouton2()" />
                <input class="button small"  value="Mes aliments" onclick="clicBouton3()" />
                <input class="button small"  value="Récapitulatif repas" onclick="clicBouton4()" />
            </div>

        </div>

        <div class = "small-12 columns">
            <table>
                <thead>
                    <tr>
                        <th>Aujourd'hui</th>
                        <th>Bilan énergétique (Kcal)</th>
                        <th>Bilan énergétique (KJ)</th>
                        <th><a href="#" id="msaprot1" onclick="openWin(this.id + '.jpg')">Protéines (g)</a></th>
                        <th><a href="#" id="msalip1" onclick="openWin(this.id + '.jpg')">Lipides (g)</a></th>
                        <th><a href="#" id="msaglu1" onclick="openWin(this.id + '.jpg')">Glucides (g)</a></th>
                        <th>Eau (ml)</th>
                        <th><a href="#" id="msafib1" onclick="openWin(this.id + '.jpg')">Fibres (g)</a></th>
                        <th>Sel (mg)</th>
                        <th>Poids (Kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php
                            // Affichage de quelque chose comme : Monday 8th of August 2005 03:12:46 PM
                            setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                            echo (strftime("%A %d"));
                            ?></td>
                        <td><?php echo $obEnKcal ?></td>
                        <td><?php echo $obEnKJ ?></td>
                        <td><?php echo $obPro ?></td>
                        <td><?php echo $obLip ?></td>
                        <td><?php echo $obGlu ?></td>
                        <td><?php echo $obEau ?></td>
                        <td><?php echo $obFib ?></td>
                        <td><?php echo $obSel ?></td>
                        <td><?php echo $obPoi ?></td>
                    </tr>

                    <tr>
                        <td>Consommés :</td>
                        <td><?php echo $coEnKcal ?></td>
                        <td><?php echo $coEnKcal ?></td>
                        <td><?php echo $coEnKJ ?></td>
                        <td><?php echo $coPro ?></td>
                        <td><?php echo $coLip ?></td>
                        <td><?php echo $coGlu ?></td>
                        <td><?php echo $coEau ?></td>
                        <td><?php echo $coFib ?></td>
                    </tr>

                    <tr>
                        <td>Reste :</td>
                        <td><?php echo $restecal ?></td>
                        <td><?php echo $resteJ ?></td>
                        <td><?php echo $restepro ?></td>
                        <td><?php echo $restelip ?></td>
                        <td><?php echo $resteglu ?></td>
                        <td><?php echo $resteeau ?></td>
                        <td><?php echo $restefib ?></td>
                        <td><?php echo $restesel ?></td>
                    </tr>
                </tbody>
            </table>    

            <div class="jump"></div>


            <div class="graphe">
                <div id="chart2" style="margin-left: 10px; margin-top: 50px; width: 1260px; height: 300px; "></div>
                <script class="code" type="text/javascript" language="javascript">
                    $(document).ready(function () {
                        $.jqplot.config.enablePlugins = true;

                        // Coordonnées x du repère
                        var points = [<?php echo $grEnKcal ?>,
<?php echo $grpro ?>,
<?php echo $grlip ?>,
<?php echo $grglu ?>,
<?php echo $greau ?>,
<?php echo $grfib ?>,
<?php echo $grsel ?>];

                        // Coordonnées y du repère
                        var nutriment = ['Bilan énergétique', 'Protéines', 'Lipides', 'Glucides', 'Eau', 'Fibres', 'Sel'];

                        plot1 = $.jqplot('chart2', [points], {
                            title: '% objectif',
                            seriesDefaults: {
                                // Plugin permettant de créer un histogramme
                                renderer: $.jqplot.BarRenderer,
                                pointLabels: {show: true}
                            },
                            // Cette fonction permet de faire tourner le label de l'axe des ordonnées 
                            axesDefaults: {
                                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
                            },
                            axes: {
                                xaxis: {
                                    label: "",
                                    renderer: $.jqplot.CategoryAxisRenderer,
                                    ticks: nutriment,
                                    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                                    tickOptions: {
                                    }
                                },
                                yaxis: {
                                    label: "Objectif (%)"
                                }
                            },
                            highlighter: {show: false}
                        });

                    });
                </script>
            </div>


            <div class ="small-12 columns">
                <table summary="Objectifs">
                    <thead>
                        <tr>
                            <th><a href="#" id="msabilan1" onclick="openWin(this.id + '.jpg')">Bilan énergétique</a></th>
                            <th><a href="#" id="msaprot2" onclick="openWin(this.id + '.jpg')">Protéines</a></th>
                            <th><a href="#" id="msalip2" onclick="openWin(this.id + '.jpg')">Lipides</a></th>
                            <th><a href="#" id="msaglu3" onclick="openWin(this.id + '.jpg')">Glucides</a></th>
                            <th><a href="#" id="msaeau1" onclick="openWin(this.id + '.jpg')">Eau</a></th>
                            <th><a href="#" id="msafib2" onclick="openWin(this.id + '.jpg')">Fibre</a></th>
                            <th><a href="#" id="msasel1" onclick="openWin(this.id + '.jpg')">Sel</a></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php
                                if ($grEnKcal < 93) {
                                    echo '<i class = "objectifetat" style="color : darkred;">Pas atteint !</i>';
                                } else if ($grEnKcal > 107) {
                                    echo '<i class = "objectifetat" style="color : darkgreen;">Dépassé !</i>';
                                } else {
                                    echo '<i class = "objectifetat" style="color : black;">Normal</i>';
                                }
                                ?></td>
                            <td><?php
                                if ($grpro < 93) {
                                    echo '<i class = "objectifetat" style="color : darkred;">Pas atteint !</i>';
                                } else if ($grpro > 107) {
                                    echo '<i class = "objectifetat" style="color : darkgreen;">Dépassé !</i>';
                                } else {
                                    echo '<i class = "objectifetat" style="color : black;">Normal</i>';
                                }
                                ?></td>
                            <td> <?php
                                if ($grlip < 93) {
                                    echo '<i class = "objectifetat" style="color : darkred;">Pas atteint !</i>';
                                } else if ($grlip > 107) {
                                    echo '<i class = "objectifetat" style="color : darkgreen;">Dépassé !</i>';
                                } else {
                                    echo '<i class = "objectifetat" style="color : black;">Normal</i>';
                                }
                                ?></td>
                            <td><?php
                                if ($grglu < 93) {
                                    echo '<i class = "objectifetat" style="color : darkred;">Pas atteint !</i>';
                                } else if ($grglu > 107) {
                                    echo '<i class = "objectifetat" style="color : darkgreen;">Dépassé !</i>';
                                } else {
                                    echo '<i class = "objectifetat" style="color : black;">Normal</i>';
                                }
                                ?></td>
                            <td><?php
                                if ($greau < 93) {
                                    echo '<i class = "objectifetat" style="color : darkred;">Pas atteint !</i>';
                                } else if ($greau > 107) {
                                    echo '<i class = "objectifetat" style="color : darkgreen;">Dépassé !</i>';
                                } else {
                                    echo '<i class = "objectifetat" style="color : black;">Normal</i>';
                                }
                                ?></td>
                            <td> <?php
                                if ($grfib < 93) {
                                    echo '<i class = "objectifetat" style="color : darkred;">Pas atteint !</i>';
                                } else if ($grfib > 107) {
                                    echo '<i class = "objectifetat" style="color : darkgreen;">Dépassé !</i>';
                                } else {
                                    echo '<i class = "objectifetat" style="color : black;">Normal</i>';
                                }
                                ?></td>
                            <td><?php
                                if ($grsel < 93) {
                                    echo '<i class = "objectifetat" style="color : darkred;">Pas atteint !</i>';
                                } else if ($grsel > 107) {
                                    echo '<i class = "objectifetat" style="color : darkgreen;">Dépassé !</i>';
                                } else {
                                    echo '<i class = "objectifetat" style="color : black;">Normal</i>';
                                }
                                ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>



            <?php
            if (isset($aliment1)) {
                $lien = 'index/' . $aliment1['Aliment']['id'] . '#encyclo';
            } else {
                $lien = 'index#encyclo';
            }
            echo $this->Form->create('Aliment', array(
                'url' => array('controller' => 'suivialimentaires', 'action' => $lien)));
            ?>
            <br/>

            <div class="row">
                <div class="small-12 small-centered column">

                    <!-- Cette page est accessible depuis le menu situé en haut de page. Cliquez sur "Ressources" -> "SuperTracker" -> "Encyclopédie" -->
                    <div class="small-12 columns text-center">
                        <h2> Ajoutez des aliments à votre suivi</h2>
                    </div>                  

                    <!-- Liste déroulante permettant à l'utilisateur de choisir dans quelle catégorie d'aliments, se trouve l'aliment qu'il recherche.
                         Cette dernière a pour but de faciliter la recherche. -->
                    <!-- type -->
                    <div class="row">
                        <div class="large-12 columns">
                            <label id="lab1">TYPE :
                                <select name = "rech" id="rech" class="target1">
                                    <option selected>Choisissez un type</option>
                                    <?php
                                    foreach ($familles as $fam) {
                                        echo '<option style="font-weight: bold;" value="' . $fam['Alimentsdetaille']['type'] . '">' . $fam['Alimentsdetaille']['type'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="large-12 columns">
                            <label id="lab2">SOUS-TYPE :
                                <select name = "rech2" id="rech2" class="target">
                                    <?php
                                    foreach ($sous_types as $sous_type) {
                                        echo '<option value="' . $sous_type['Alimentsdetaille']['sous_type'] . '" class = "' . $sous_type['Alimentsdetaille']['type'] . '">' . $sous_type['Alimentsdetaille']['sous_type'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="large-12 columns">
                            <label id="lab3">CLASSE :
                                <select name = "rech3" id="rech3" class="target3">
                                    <?php
                                    foreach ($classes as $classe) {
                                        echo '<option value="' . $classe['Alimentsdetaille']['classe'] . '" class = "' . $classe['Alimentsdetaille']['sous_type'] . '">' . $classe['Alimentsdetaille']['classe'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>


                    <!-- sous_classe (possible qu'il n'y en ai pas) -->
                    <div class="row">
                        <div class="large-12 columns">
                            <label id="lab4">SOUS-CLASSE :
                                <select name = "rech4" id="rech4">
                                    <?php
                                    foreach ($sous_classes as $sous_classe) {
                                        echo '<option value="' . $sous_classe['Alimentsdetaille']['sous_classe'] . '" class = "' . $sous_classe['Alimentsdetaille']['classe'] . '">' . $sous_classe['Alimentsdetaille']['sous_classe'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>



                    <!-- BOUTONS valider, refaire une recherche, mes aliments favoris -->
                    <input class="button" type="submit" name="rechbtn" value="Valider" />
                    <br/>
                    <?php
                    $link = '/suivialimentaires/index/';
                    if (isset($aliment1))
                        $link = $link . $aliment1['Aliment']['id'] . '/';
                    echo $this->Html->link('<input class="button small" type="button" name="refaire" value="Refaire une recherche" />', $link, array('escape' => false));
                    ?>
                    <?php if (isset($user) AND ! empty($user['Alimentfavori'])) : ?>
                        <input class="button small" type="submit" name="alifav" value="Mes aliments favoris" />	
                    <?php endif; ?>
                    <script language="JavaScript" type="text/javascript">
                        $("#rech2").chained("#rech");
                        $("#rech3").chained("#rech2");
                        $("#rech4").chained("#rech3");
                    </script>
                    <!-- Zone de texte permettant à l'utilisateur de saisir le nom de l'aliment recherché -->
                    <!-- <input type="text" name="zone-aliment" value="" id="zone-aliment" /> <br><br><br> -->

                        <!--<input type="submit" value="Rechercher" onClick='return validRecherche();' /> -->
                </div>

                <!-- <div id="lien-accueil">
                        <a href="?page=supertracker"> Retourner à l'accueil du SuperTracker </a>
                </div> -->



                <?php if (isset($aliment1) OR isset($resultats)) : ?>

                    <div class="large-12 columns">
                        <?php
                        if (isset($alimentfavori)) {
                            echo '<span> Vos aliments favoris </span>';
                        } else {
                            echo '<span> Résultats </span>';
                        }
                        ?>

                        <!-- On affiche ici les caractéristique du premier aliment pour lequel l'utilisateur souhaite effectuer une comparaison avec un autre aliment -->


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
                                        echo $this->Html->link($resultat['Alimentsdetaille']['nom'], '/suivialimentaires/index/' . $resultat['Aliment'][0]['id'] . '#encyclo');
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

                        <div class="row" data-equalizer>
                            <?php if (isset($aliment1)): ?>
                                <!-- On affiche ici les caractéristique du second aliment pour lequel l'utilisateur souhaite effectuer une comparaison avec un autre aliment -->
                                <div class="large-6 columns panel" data-equalizer-watch> 

                                    <?php
                                    echo $this->Html->link('<div class="supprimer"></div>', '/suivialimentaires/index/', array('escape' => false));
                                    ?>


                                    <div class="titre">
                                        <?php
                                        $fichier = $aliment1['Aliment']['chemin'];
                                        if ($fichier == '') {
                                            $fichier = 'noimage.jpg';
                                        }
                                        if (strlen($aliment1['Alimentsdetaille']['nom']) > 60) {
                                            echo "<h4><center>" . substr($aliment1['Alimentsdetaille']['nom'], 0, 57) . "...</center></h4>";
                                        } else {
                                            echo "<h4><center>" . $aliment1['Alimentsdetaille']['nom'] . "</center></h4>";
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

                                        <input class="button" type="submit" name="valider" value="Valider" />		
                                    </div>
                                    <!-- L'utilisateur peut afficher des informations concernant l'aliment mais aussi les caractéristiques nutritionelles de ce dernier -->
                                    <div class="onglets-encyclo">
                                        <a>Informations nutritionnelles</a>
                                    </div>

                                    <div class="info-aliment" id='info-aliment1'>
                                        <div class="scroller">

                                            <table>
                                                <tr>
                                                    <th width=45%> Nutriment </th>
                                                    <th width=10%> Quantité </th>
                                                    <th width=45%> % Valeur quoti-dienne </th>
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
                                                                    Lipides
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    AG saturés
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    AG mono insaturés
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    AG polyinsaturés
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    A linoléique
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    A alpha - linolénique
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Omega-3 (DHA)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Omega-3 (EPA)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Cholestérol
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
                                                                    echo $aliment1['Donneesaliment'][23]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> g
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][24]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> g
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][25]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> g
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][26]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> g
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][36]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> g
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][37]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> g
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][40]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> g
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][39]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
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
                                                                    if (isset($obGlu))
                                                                        echo round((($aliment1['Donneesaliment'][18]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obGlu) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>

                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    /* ND if(isset($obEnKcal)) echo 'ND'; */
                                                                    if (isset($obFib))
                                                                        echo round((($aliment1['Donneesaliment'][22]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obFib) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>

                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obEnKcal))
                                                                        echo 'ND'; /* sucres */
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
                                                                    if (isset($obEnKcal))
                                                                        echo round((($aliment1['Donneesaliment'][24]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / ($obEnKcal * 12 / 100) / 9) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obEnKcal))
                                                                        echo 'ND';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obEnKcal))
                                                                        echo 'ND'; /* ag p */
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obEnKcal))
                                                                        echo round((($aliment1['Donneesaliment'][36]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / ($obEnKcal * 4 / 100) / 9) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obEnKcal))
                                                                        echo round((($aliment1['Donneesaliment'][37]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / ($obEnKcal * 1 / 100) / 9) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obEnKcal))
                                                                        echo round((($aliment1['Donneesaliment'][40]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / 0.25) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obEnKcal))
                                                                        echo round((($aliment1['Donneesaliment'][39]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / 0.25) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obEnKcal))
                                                                        echo 'ND';
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
                                                                    Calcium
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Potassium
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Sodium
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Cuivre
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Fer
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Magnésium
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Phosphore
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Sélénium
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Zinc
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Iode
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td> 
                                                        <ul>
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
                                                                    echo $aliment1['Donneesaliment'][8]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> mg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][5]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> mg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][12]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
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
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][10]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> mg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][7]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> mg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][14]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> µg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][13]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> mg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][15]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> µg
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td> 
                                                        <ul>
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
                                                                    if (isset($obPotass))
                                                                        echo round((($aliment1['Donneesaliment'][8]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obPotass) * 100, 2) . ' %';
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
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obCui))
                                                                        echo round((($aliment1['Donneesaliment'][12]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obCui) * 100, 2) . ' %';
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
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obMagn))
                                                                        echo round((($aliment1['Donneesaliment'][10]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obMagn) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obPhos))
                                                                        echo round((($aliment1['Donneesaliment'][7]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obPhos) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obSelenium))
                                                                        echo round((($aliment1['Donneesaliment'][14]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obSelenium) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obZinc))
                                                                        echo round((($aliment1['Donneesaliment'][13]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obZinc) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obIod))
                                                                        echo round((($aliment1['Donneesaliment'][15]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obIod) * 100, 2) . ' %';
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
                                                                    Vitamine B6
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Vitamine B12
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Vitamine C
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Vitamine D
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Vitamine E
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Vitamine K
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Folate (B9)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Thiamine (B1)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Riboflavine (B2)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    Niacine (B3, PP)
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td> 
                                                        <ul>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][42]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> µg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][51]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> mg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][52]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> µg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][46]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> mg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][43]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> µg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][44]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> mg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][45]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> µg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][53]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> µg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][47]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> mg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][48]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> mg
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][49]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
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
                                                                        echo round((($aliment1['Donneesaliment'][42]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitA) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obVitB6))
                                                                        echo round((($aliment1['Donneesaliment'][51]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitB6) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obVitB12))
                                                                        echo round((($aliment1['Donneesaliment'][52]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitB12) * 100, 2) . ' %';
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
                                                                    if (isset($obVitD))
                                                                        echo round((($aliment1['Donneesaliment'][43]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitD) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obVitE))
                                                                        echo round((($aliment1['Donneesaliment'][44]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitE) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obVitK))
                                                                        echo round((($aliment1['Donneesaliment'][45]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitK) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obVitB9))
                                                                        echo round((($aliment1['Donneesaliment'][53]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitB9) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obVitB1))
                                                                        echo round((($aliment1['Donneesaliment'][47]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitB1) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obVitB2))
                                                                        echo round((($aliment1['Donneesaliment'][48]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitB2) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    if (isset($obVitB3))
                                                                        echo round((($aliment1['Donneesaliment'][49]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / $obVitB3) * 100, 2) . ' %';
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
                                                                    Alcool
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td> 
                                                        <ul>
                                                            <li>
                                                                <p class='groupeAlimentaire'>
                                                                    <?php
                                                                    echo $aliment1['Donneesaliment'][54]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
                                                                    ?> g
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
                                                                        echo round((($aliment1['Donneesaliment'][54]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100) / 8.8) * 100, 2) . ' %';
                                                                    ?> 
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div> 
                                        <div class="onglets-encyclo" style="margin-top:3px;">
                                            <a>Ajouter au repas :</a>
                                        </div>  
                                        <div class="choix-portion">
                                            <!--Ajout aliment-->
                                            <input type="checkbox" name="group1" id="group1" value="Petit d&eacute;jeuner"> Petit d&eacute;jeuner<br>
                                            <input type="checkbox" name="group2" id="group2" value="D&eacute;jeuner"> D&eacute;jeuner<br>
                                            <input type="checkbox" name="group3" id="group3" value="Go&ucirc;ter"> Go&ucirc;ter<br>
                                            <input type="checkbox" name="group4" id="group4" value="D&icirc;ner"> D&icirc;ner<br>
                                            <input class="button small" type="submit" name="repas1" value="Ajouter au repas" onclick="return confirm_ajout_gauche();" />	
                                            <?php
                                            if (!isset($user)) {
                                                echo '<input class="button small" type="submit" name="ajouterfav1" value="Ajouter aux favoris" onclick="return confirm_ajout_fav_gauche();" />';
                                            } else {
                                                $estPresent = false;
                                                foreach ($user['Alimentfavori'] as $fav) {
                                                    if ($aliment1['Aliment'] ['id'] == $fav['idali']) {
                                                        $estPresent = true;
                                                    }
                                                }
                                                if ($estPresent) {
                                                    echo '<input class="button small" type="submit" name="retirerfav1" value="Retirer des favoris" onclick="return confirm_retirer_fav_gauche();" />';
                                                } else {
                                                    echo '<input class="button small" type="submit" name="ajouterfav1" value="Ajouter aux favoris" onclick="return confirm_ajout_fav_gauche();" />';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>	   


                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div id="recapRepas">
                <div id="bloc-editeur">
                    <center><h2>Récapitulatif repas</h2></center><br /><hr /><br />
                    <div style="color:green; font-size:1.3em">Petit déjeuner :</div>
                    <?php
                    $rien = true;
                    for ($i = 0; $i < count($infosSuivi) AND $i < 10; $i++) {
                        $split = explode("@", $infosSuivi[$i]['Suivialimentaire']['nomSA']);
                        for ($j = 0; $j < count($split); $j++) {
                            if ($split[$j] == 'Petit déjeuner') {
                                /* Affichage des infos */
                                $rien = false;
                                if (isset($infosAliment[$i][0]['Alimhorsclassification']))
                                    echo $infosAliment[$i][0]['Alimhorsclassification']['nom'] . ', quantité : ' . $infosSuivi[$i]['Suivialimentaire']['quantite'] . ', portion : ' . $infosSuivi[$i]['Suivialimentaire']['nomPortion'] . '<br />';
                                else
                                    echo $infosAliment[$i][0]['Alimentsdetaille']['nom'] . ', quantité : ' . $infosSuivi[$i]['Suivialimentaire']['quantite'] . ', portion : ' . $infosSuivi[$i]['Suivialimentaire']['nomPortion'] . '<br />';
                            }
                        }
                        if ($i == 9 AND count($infosSuivi) > 10) {
                            echo '...';
                        }
                    }
                    if ($rien) {
                        echo '--------------';
                    }
                    ?>
                    
                    <br /><hr /><br /><div style="color:green; font-size:1.3em">Déjeuner :</div>		
                    <?php
                    $rien = true;
                    for ($i = 0; $i < count($infosSuivi) AND $i < 10; $i++) {
                        $split = explode("@", $infosSuivi[$i]['Suivialimentaire']['nomSA']);
                        for ($j = 0; $j < count($split); $j++) {
                            if ($split[$j] == 'Déjeuner') {
                                /* Affichage des infos */
                                $rien = false;
                                if (isset($infosAliment[$i][0]['Alimhorsclassification']))
                                    echo $infosAliment[$i][0]['Alimhorsclassification']['nom'] . ', quantité : ' . $infosSuivi[$i]['Suivialimentaire']['quantite'] . ', portion : ' . $infosSuivi[$i]['Suivialimentaire']['nomPortion'] . '<br />';
                                else
                                    echo $infosAliment[$i][0]['Alimentsdetaille']['nom'] . ', quantité : ' . $infosSuivi[$i]['Suivialimentaire']['quantite'] . ', portion : ' . $infosSuivi[$i]['Suivialimentaire']['nomPortion'] . '<br />';
                            }
                        }
                        if ($i == 9 AND count($infosSuivi) > 10) {
                            echo '...';
                        }
                    }
                    if ($rien) {
                        echo '--------------';
                    }
                    ?>
                    <br /><hr /><br /><div style="color:green; font-size:1.3em">Goûter :</div>			
                    <?php
                    $rien = true;
                    for ($i = 0; $i < count($infosSuivi) AND $i < 10; $i++) {
                        $split = explode("@", $infosSuivi[$i]['Suivialimentaire']['nomSA']);
                        for ($j = 0; $j < count($split); $j++) {
                            if ($split[$j] == 'Goûter') {
                                /* Affichage des infos */
                                $rien = false;
                                if (isset($infosAliment[$i][0]['Alimhorsclassification']))
                                    echo $infosAliment[$i][0]['Alimhorsclassification']['nom'] . ', quantité : ' . $infosSuivi[$i]['Suivialimentaire']['quantite'] . ', portion : ' . $infosSuivi[$i]['Suivialimentaire']['nomPortion'] . '<br />';
                                else
                                    echo $infosAliment[$i][0]['Alimentsdetaille']['nom'] . ', quantité : ' . $infosSuivi[$i]['Suivialimentaire']['quantite'] . ', portion : ' . $infosSuivi[$i]['Suivialimentaire']['nomPortion'] . '<br />';
                            }
                        }

                        if ($i == 9 AND count($infosSuivi) > 10) {
                            echo '...';
                        }
                    }
                    if ($rien) {
                        echo '--------------';
                    }
                    ?>
                    <br /><hr /><br /><div style="color:green; font-size:1.3em">Dîner :</div>				
                    <?php
                    $rien = true;
                    for ($i = 0; $i < count($infosSuivi) AND $i < 5; $i++) {
                        $split = explode("@", $infosSuivi[$i]['Suivialimentaire']['nomSA']);
                        for ($j = 0; $j < count($split); $j++) {
                            if ($split[$j] == 'Dîner') {
                                /* Affichage des infos */
                                $rien = false;
                                if (isset($infosAliment[$i][0]['Alimhorsclassification']))
                                    echo $infosAliment[$i][0]['Alimhorsclassification']['nom'] . ', quantité : ' . $infosSuivi[$i]['Suivialimentaire']['quantite'] . ', portion : ' . $infosSuivi[$i]['Suivialimentaire']['nomPortion'] . '<br />';
                                else
                                    echo $infosAliment[$i][0]['Alimentsdetaille']['nom'] . ', quantité : ' . $infosSuivi[$i]['Suivialimentaire']['quantite'] . ', portion : ' . $infosSuivi[$i]['Suivialimentaire']['nomPortion'] . '<br />';
                            }
                        }
                        if ($i == 4 AND count($infosSuivi) > 5) {
                            echo '...';
                        }
                    }
                    if ($rien) {
                        echo '--------------';
                    }
                    ?>
                </div>
            </div>
            <div id="mesAli">
                <div id="bloc-editeur">
                    <center><h2>Mes aliments</h2><br />
                        <div style="font-style:italic;color:green">Cliquez sur le bouton "Gérer mes aliments" pour modifier/supprimer vos aliments consommés dans la journée</div><br />
                        <?php echo $this->Html->link('<input type="button" class="button" name="modif" value="Gérer mes aliments" >', '/suivialimentaires/edit/', array('escape' => false, 'title' => 'Gérer mes aliments')); ?>
                    </center>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
    <?php echo $this->Html->script('zoombox/zoombox.js'); ?>
    <?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
    <script type="text/javascript">
        $(".suiviresume").show();

<?php if (isset($resultats) OR isset($aliment1)) : ?>
            setTimeout(function () {
                $(".suiviresume").hide();
            }, 500);
            $("#deuxiemeencyclo").show();
<?php endif ?>

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
        function openWin(nomimg) {
            var conseil = window.open("http://mapyramide.fr/app/webroot/img/"
                    + nomimg, 'Image', "top=100, left=450, width=636, height=480");
        }

        function openImg(nomimg) {
            var conseil = window.open("http://mapyramide.fr/app/webroot/img/imagesAliment"
                    + nomimg, 'Image', "top=100, left=450, width=636, height=480");
        }

        function clicBouton1() {
            $(".suiviresume").show();
            $("#deuxiemeencyclo").hide();
            $("#mesAli").hide();
            $("#recapRepas").hide();
        }
        function clicBouton2() {
            $(".suiviresume").hide();
            $("#deuxiemeencyclo").show();
            $("#mesAli").hide();
            $("#recapRepas").hide();
        }
        function clicBouton3() {
            $(".suiviresume").hide();
            $("#deuxiemeencyclo").hide();
            $("#mesAli").show();
            $("#recapRepas").hide();
        }
        function clicBouton4() {
            $(".suiviresume").hide();
            $("#deuxiemeencyclo").hide();
            $("#mesAli").hide();
            $("#recapRepas").show();
        }

        function confirm_ajout_gauche() {
            var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>');
            if (isNaN(id_user)) {
                /* Utilisateur non connecté */
                alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
                return false;
            }
            /* else : utilisateur connecté */
            var res = "";
            if (document.getElementById('group1').checked) {
                res += document.getElementById('group1').value + ", ";
            }
            if (document.getElementById('group2').checked) {
                res += document.getElementById('group2').value + ", ";
            }
            if (document.getElementById('group3').checked) {
                res += document.getElementById('group3').value + ", ";
            }
            if (document.getElementById('group4').checked) {
                res += document.getElementById('group4').value + ", ";
            }

            res = res.substring(0, res.length - 2);
            res = res + "?";
            if (res.length == 1) {
                alert("Vous n'avez pas sélectionné de repas");
                return false;
            }
            var q = document.getElementById('quantite').value;
            switch (q) {
                case '0.5' :
                    q = '1/2';
                    break;
                case '1.5' :
                    q = '1 et demis';
                    break;
                case '2.5' :
                    q = '2 et demis';
                    break;
                case '3.5' :
                    q = '3 et demis';
                    break;
            }
<?php if (isset($aliment1)) : ?>
                if (confirm("Confirmez-vous l'ajout de " + q + "x <?php echo str_replace('"', '\'', $aliment1['Alimentsdetaille']['nom']); ?> lors du " + res)) {
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

        function afficherNutriment() {
            document.getElementById("info-nutriment-aliment").style.display = "block";
            document.getElementById("info-aliment").style.display = "none";
        }

        function afficherAliment() {
            document.getElementById("info-aliment").style.display = "block";
            document.getElementById("info-nutriment-aliment").style.display = "none";
        }

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
    </script>
