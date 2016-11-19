<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mes données santé');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Votre suivi alimentaire ou physique, catégorisé par période pour suivre vos tendances.');
$this->end();
// intégration des fichiers js nécessaire
echo $this->Html->script('amcharts.js');
echo $this->Html->script('amcharts.dataloader.js');
echo $this->Html->script('amcharts.serial.js');

// Todo :
// - créer des bouttons pour choisir les durées, le type de durée doit etre passé directement avec le bouton dans le controller (envoyer jour, semaine, mois)
// if(
echo "";

echo $styleCssSup;

?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon Dossier', ['controller' => 'monDossier', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mes données santé', 'Javascript:void(0);'); ?></li>
</nav>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<div id="presentation">
<div class="row">
    <div class="small-12 columns">
        <center><h1> Mes données santé</h1></center>
        <br/><br/>
        <p class="text-center">Grâce à Mes données santé vous pouvez suivre toutes vos données médicales, sportives ou alimentaires. </p>
        <br/>
        <h2> Mes suivis physiques <small><?php echo $this->Html->link('Ajouter une activité', ['controller' => 'activitephysiques',
                'action' => 'index',
                'full_base' => true,],
                ['class' => "button small"]
                ) ?></small>
        </h2>
        
        <form method="POST">
            <input id="physjour" name="dureePhysique" value="jour" type="submit" class="button" />
            <input id="physsem" name="dureePhysique" value="semaine" type="submit" class="button" />
            <input id="physmois" name="dureePhysique" value="mois" type="submit" class="button" />
        </form>
        
        <?php
        if (count($suiviPhys) == 0) {
            echo "<h5 style='margin-left:40px'>Vous n'avez pas de donnée pour cette période. Vous pouvez en ajouter via " .
            $this->Html->link('le gestionnaire d\'activité physique', ['controller' => 'activitephysiques',
                'action' => 'index',
                'full_base' => true]
            )
            . " ou choisir une autre période. </h5>";
        } else {
            ?>
            <script>
    <?php
    $i = 0; // suivi physique
    foreach ($suiviPhys as $suivi) { // création des x javascript pour AmChart (x = nombre de sport spécifié dans la durée)
        echo '
            AmCharts.makeChart("chartdiv' . $i . '", {
                "type": "serial",
                "startDuration": 1,
                "dataProvider": ' . $suivi[1] . ',
                "categoryField": "date",
                "trendLines": [],
                "theme": "light",
                "categoryAxis": {
                    "gridAlpha": 0.07,
                    "title": "' . $suivi[0] . '",
                    "labelRotation": 55,
                    "gridPosition": "start"
                },
                "valueAxes": [{
                        "stackType": "regular",
                        "title": "kcal",
                        "gridAlpha": 0.07,
                    }],
                "guides": [],
                "balloon": {},
                "graphs": [{
                        "type": "line",
                        "title": "kcal",
                        "valueField": "kcal",
                        "lineAlpha": 0,
                        "fillAlphas": 0.6
                    }],
                "autoGridCount": true,
                //"rotate": true
            });
        ';
        $i++;
    }
    ?>
            </script>
            <div class="suiviPhysique" style="padding:50px;">
                <?php
                $a = 0;
                foreach ($suiviPhys as $suivi) { // div lié à chaque code javascript
                    echo '<div id="chartdiv' . $a . '"  style="height: 60vh !important;"></div>';
                    $a++;
                }
                ?>
            </div>
        <?php } //fermeture du else ?>
        <h2> Mes suivis alimentaires <small><?php echo $this->Html->link('Ajouter un repas', ['controller' => 'suivialimentaires',
                'action' => 'index',
                'full_base' => true,],
                ['class' => "button small"]
                ) ?></small></h2>
        
        <form method="POST">
            <input id="alimjour" name="dureeAliment" value="jour" type="submit" class="button" />
            <input id="alimsem" name="dureeAliment" value="semaine" type="submit" class="button" />
            <input id="alimmois" name="dureeAliment" value="mois" type="submit" class="button" />
        </form>
        
        
        <?php
        if ($suiviAlim == null) {
            echo "<h5 style='margin-left:40px'>Vous n'avez pas de donnée pour cette période. Vous pouvez en ajouter via " .
            $this->Html->link('le gestionnaire alimentaire', ['controller' => 'suivialimentaires',
                'action' => 'index',
                'full_base' => true]
            )
            . " ou choisir une autre période. </h5>";
        } else {
            ?>
            <script>
    <?php
    $i = 0;

    foreach ($suiviAlim as $suivi) { // création des x javascript pour AmChart (x = nombre de sport spécifié dans la durée)
        // aide avec la function VAR_DUMP pour faire du débuging
        echo '
            AmCharts.makeChart("chartdivAli' . $i . '", {
                "type": "serial",
                "startDuration": 1,
                "dataDateFormat": "DD/MM/YYYY",
                "dataProvider": ' . $suivi[1] . ',
                "categoryField": "date",
                "trendLines": [{
                    "finalDate": "01/01/2000",
                    "finalValue": '.explode("-", $suivi[0])[2].',
                    "initialDate": "12/12/2020",
                    "initialValue": '.explode("-", $suivi[0])[2].',
                    "lineColor": "#CC0000"
                }],
                "theme": "light",
                "categoryAxis": {
                    "gridAlpha": 0.07,
                    "title": "' . explode("-", $suivi[0])[0] . '",
                    "labelRotation": 55,
                    "gridPosition": "start",
                    "parseDates": true,
                    "axisAlpha": 0,
                    "gridAlpha": 0.1,
                    "minorGridAlpha": 0.1,
                    "minorGridEnabled": true
                },
                "valueAxes": [{
                        "stackType": "regular",
                        "title": "' . explode("-", $suivi[0])[1] . '",
                        "gridAlpha": 0.07,
                    }],
                "guides": [],
                "balloon": {},
                "graphs": [{
                        "type": "line",
                        "title": "' . explode("-", $suivi[0])[1] . '",
                        "valueField": "' . explode("-", $suivi[0])[1] . '",
                        "lineAlpha": 0,
                        "fillAlphas": 0.6
                    }],
                //"rotate": true
            });
        ';
        $i++;
    }
    ?>
            </script>
            <div class="suiviAliment" style="padding:50px;">
                <?php
                $a = 0;
                foreach ($suiviAlim as $suivi) { // div lié à chaque code javascript
                    echo '<div id="chartdivAli' . $a . '"  style="height: 60vh !important;"></div>';
                    $a++;
                }
                ?>
            </div>
        <?php } //fermeture du else ?>

        <h2> Mes paramètres médicaux <small><?php echo $this->Html->link('Mettre à jour vos paramètres', ['controller' => 'monDossier',
                'action' => 'reglages',
                'full_base' => true,],
                ['class' => "button small"]
                ) ?></small></h2>

        <form method="POST">
            <input id="paramjour" name="dureeParams" value="jour" type="submit" class="button" />
            <input id="paramsem" name="dureeParams" value="semaine" type="submit" class="button" />
            <input id="parammois" name="dureeParams" value="mois" type="submit" class="button" />
        </form>
        
        
        <?php
        if ($suiviParam == null) {
            echo "<h5 style='margin-left:40px'>Vous n'avez pas de donnée pour cette période. Vous pouvez en ajouter via " .
            $this->Html->link('vos réglages de suivi des paramètres médicaux.', ['controller' => 'monDossier',
                'action' => 'reglages',
                'full_base' => true]
            )
            . " ou choisir une autre période. </h5>";
        } else {
            ?>
           <script>
    <?php
    $i = 0;

    foreach ($suiviParam as $suivi) { // création des x javascript pour AmChart (x = nombre de sport spécifié dans la durée)
        // aide avec la function VAR_DUMP pour faire du débuging
       /* echo "<pre>" ;var_dump($suivi) ; echo"</pre>";*/
        echo '
            AmCharts.makeChart("chartdivParam' . $i . '", {
                "type": "serial",
                "startDuration": 1,
                "dataProvider": ' . $suivi[1] . ',
                "categoryField": "date",
                "trendLines": [],
                "theme": "light",
                "categoryAxis": {
                    "gridAlpha": 0.07,
                    "title": "'.explode("-", $suivi[0])[0].'",
                    "labelRotation": 55,
                    "gridPosition": "start"
                },
                "valueAxes": [{
                        "stackType": "regular",
                        "title": "'.explode("-", $suivi[0])[1].'",
                        "gridAlpha": 0.07,
                    }],
                "guides": [],
                "balloon": {},
                "graphs": [{
                        "type": "line",
                        "title": "'.explode("-", $suivi[0])[1].'",
                        "valueField": "'.explode("-", $suivi[0])[1].'",
                        "lineAlpha": 0,
                        "fillAlphas": 0.6
                    }],
                //"rotate": true
            });
        ';
        $i++;
    }
    ?>
            </script>
            <div class="suiviParam" style="padding:50px;">
                <?php
                $a = 0;
                foreach ($suiviParam as $suivi) { // div lié à chaque code javascript
                    echo '<div id="chartdivParam' . $a . '"  style="height: 60vh !important;"></div>';
                    $a++;
                }
                ?>
            </div>

        </div>
    </div>
</div>
<?php
} //fermeture du else 
//////////////////////////// initialisation slider ///////////////////////////////////////
echo $this->Html->script('slick.min.js');
echo $this->Html->script('slick.conf.js');
echo $this->Html->css('slick-theme'); // app/webroot/css
echo $this->Html->css('slick');
