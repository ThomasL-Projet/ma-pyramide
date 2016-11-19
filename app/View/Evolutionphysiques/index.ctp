<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Évolution de l\'activité physique');
// récupération des paramètres
?>
<script>
    // Ajout du datepicker (aide pour choisir une date sur un formulaire)
    jQuery(function () {
        jQuery("#dateDeb").datepicker({
            dateFormat: "yy-mm-dd",
            altFormat: "yy-mm-dd"
        });
        jQuery("#dateFin").datepicker({
            dateFormat: "yy-mm-dd",
            altFormat: "yy-mm-dd"
        });
    });
</script>
<?php if (isset($data)) { ?>
    <script src="http://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="http://www.amcharts.com/lib/3/serial.js"></script>
    <script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
    <script>
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "dataProvider": <?php echo $data; ?>,
        "categoryField": "date",
        "categoryAxis": {
            "gridAlpha": 0.07,
            "title": "date",
            "labelRotation": 55
        },
        "valueAxes": [{
                "stackType": "regular",
                "title": "calories",
                "gridAlpha": 0.07,
            }],
        "graphs": [{
                "type": "column",
                "title": "calories",
                "valueField": "calories",
                "lineAlpha": 0,
                "fillAlphas": 0.6
            }],
        "autoGridCount": true,
        //"rotate": true
    });
    </script>
<?php } ?>

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes rapports d\'évolution', ['controller' => 'rapportEvolution', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mon évolution physique', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Mon évolution physique </div> 

            <div class="textarea">
                <p class="text-justify">
                    Retracez votre activité physique    
                </p>			
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <div class="subtitle"><h2>Choisissez une période</h2></div>
        </div>
    </div>
    <?php echo $this->Form->create('Evolutionphysique'); ?>
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="small-4 columns">
                <label for="dateDeb"> Date de début de période </label>
                <input type="text" name="dateDeb" class="date" id="dateDeb" value="<?php //echo $dateDeDebut;        ?>"/>
            </div>
            <div class="small-4 columns left">
                <label for="dateFin"> Date de fin de période </label>
                <input type="text" name="dateFin" class="date" id="dateFin" value="<?php //echo $dateDeFin;        ?>"/>
            </div>
        </div> 

    </div>
    <div class="row">
        <div class="small-12 columns text-center">
            <input type="submit" class="button" value="Voir mon activité physique pour cette période" />
        </div>
    </div>  
    <div class="row">
        <div class="small-12 columns">

            <?php if (!isset($data)) { ?>
                <h3> Veuillez commencer par choisir une période pour consulter vos calories consommées dans le cadre de vos activités physiques </h3>
            <?php } else { ?>
                <div class="row">
                    <div class="large-12 columns">
                        <h2 class="text-center">Statistiques des calories consommées par vos activités physiques : </h2>
                        <h3 class="subheader">Période : du <?php echo $dateDeb ?> au <?php echo $dateFin ?></h3>
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="large-12 columns">

                        <div id="chartdiv" style="min-height:80vh;max-height: 100vh;"></div>

                    </div>
                </div>
            <?php } ?>   
            <div class="row">
                <div class="small-12 columns text-center">
                    <?php echo $this->Html->link('<input type="button" class="button" name="modif" value="Voir mes activités" />', '/evolutionphysiques/edit/', array('escape' => false)); ?>
                </div>
            </div>
        </div>
    </div>

    <div id="problemDate" class="reveal-modal" data-reveal>
        <h2 id="ActiviteTitle">Attention problème pour la période</h2>
        Les périodes que vous avez indiquées ne sont pas dans l'ordre chronologique.<br/>
        Veuillez réessayer en choisissant des périodes ordonnées (date début < date fin).
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>

</div>

<script>
    jQuery(document).ready(function () {
        jQuery(".date").change(function () {
            var dateDeb = jQuery("#dateDeb").val();
            var dateFin = jQuery("#dateFin").val();
            if (!(dateDeb.length === 0) && !(dateFin.length === 0)) {
                if (jQuery.datepicker.parseDate("yy-mm-dd", dateDeb) >
                        jQuery.datepicker.parseDate("yy-mm-dd", dateFin)) {
                    jQuery("#dateFin").val("");
                    jQuery('#problemDate').foundation('reveal', 'open');
                }
            }
        });
    });
</script>