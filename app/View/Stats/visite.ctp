<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Statisques des visites');
// récupération des paramètres 
$dateDeDebut = "";
$dateDeFin = "";
if (isset($type)) {
    $dateDeDebut = $dateDeb;
    $dateDeFin = $dateFin;
    switch ($type) {
        case "Général":
            $axeHori = "date";
            $axeVert = "visiteurs";
            $elmtHauteurAVerif = "";
            break;
        case "Origine géographique":
            $axeHori = "pays";
            $axeVert = "visiteurs";
            $elmtHauteurAVerif = "";
            break;
        case "Pages les plus visités":
            $axeHori = "pages";
            $axeVert = "visiteurs";
            $elmtHauteurAVerif = "pages";
            break;
        case "Temps moyen passé sur une page":
            $axeHori = "pages";
            $axeVert = "temps moyen (seconde)";
            $elmtHauteurAVerif = "pages";
            break;
        case "Mot-clés les plus utilisés":
            $axeHori = "mot-clé";
            $axeVert = "visiteurs";
            $elmtHauteurAVerif = "mot-clé";
            break;
    }
    ?>
    <script src="http://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="http://www.amcharts.com/lib/3/serial.js"></script>
    <script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
    <script>
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "dataProvider": <?php echo $data; ?>,
            "categoryField": "<?php echo $axeHori; ?>",
            "categoryAxis": {
                "gridAlpha": 0.07,
                "title": "<?php echo $axeHori; ?>",
                "labelRotation": 55
            },
            "valueAxes": [{
                    "stackType": "regular",
                    "title": "<?php echo $axeVert; ?>",
                    "gridAlpha": 0.07,
                }],
            "graphs": [{
                    "type": "column",
                    "title": "<?php echo $axeVert; ?>",
                    "valueField": "<?php echo $axeVert; ?>",
                    "lineAlpha": 0,
                    "fillAlphas": 0.6
                }],
            "autoGridCount": true,
            //"rotate": true
        });
    </script>
<?php } ?>
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
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Statistiques du site', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area">Consulter les statistiques de visite</div>      
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <?php echo $this->Form->create('Stat'); ?>
            <H3> Choisissez une période </H3>
            <div class="row">
                <div class="small-12 small-centered columns">
                    <div class="small-6 columns">
                        <label> Date de début de période </label>
                        <input type="text" name="dateDeb" class="date" id="dateDeb" value="<?php echo $dateDeDebut; ?>"/>
                    </div>
                    <div class="small-6 columns left">
                        <label> Date de fin de période </label>
                        <input type="text" name="dateFin" class="date" id="dateFin" value="<?php echo $dateDeFin; ?>"/>
                    </div>
                </div>
            </div>        
            <hr/>
            <H3> Choisissez une catégorie </H3>
            <input class="button" type="submit" name="gen" value="Général" />
            <input class="button" type="submit" name="lan" value="Origine géographique" />
            <input class="button" type="submit" name="pag" value="Pages les plus visitées" />
            <input class="button" type="submit" name="dur" value="Temps moyen passé sur une page" />
            <input class="button" type="submit" name="mot" value="Mot-clés les plus utilisés" />
            <pre>
                <?php //var_dump($rslt);   ?>
            </pre>
            <?php if (isset($type)) { ?>
                <div class="row">
                    <div class="large-12 columns">
                        <h2 class="text-center">Statistiques : </h2>
                        <h3 class="subheader">Catégorie : <?php echo $type ?></h3>
                        <h3 class="subheader">Période : du <?php echo $dateDeb ?> au <?php echo $dateFin ?></h3>
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="large-12 columns">
                        <?php
                        if (strlen($elmtHauteurAVerif) != 0) {
                            // on s'assure que si la longueur d'un titre de page est trop élèver 
                            // on adapte la hauteur du graphique
                            $arr = json_decode($data, true);
                            $max = "";
                            for ($i = 0; $i < count($arr); $i++) {
                                if (strlen($arr[$i][$elmtHauteurAVerif]) > strlen($max)) {
                                    $max = strlen($arr[$i][$elmtHauteurAVerif]);
                                }
                            }
                            if ($max > 25) {
                                $maxheight = 150;
                            } else if ($max > 15) {
                                $maxheight = 100;
                            } else if ($max <= 15) {
                                $maxheight = 80;
                            }
                        } else {
                            $maxheight = 80;
                        }
                        ?>
                        <div id="chartdiv" style="min-height:<?php echo $maxheight; ?>vh;max-height: 180vh;"></div>

                    </div>
                </div>

            <?php } else { ?>
                <h3> Veuillez commencer par choisir une période et une catégorie pour afficher les statistiques associées au site </h3>
            <?php } ?>

            <div id="problemDate" class="reveal-modal" data-reveal>
                <h2 id="ActiviteTitle">Attention problème pour la période</h2>
                Les périodes que vous avez indiquées ne sont pas dans l'ordre chronologique.<br/>
                Veuillez réessayer en choisissant des périodes ordonnées (date début < date fin).
                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>

            <div id="problemDateFutur" class="reveal-modal" data-reveal>
                <h2 id="ActiviteTitle">Attention problème pour la période</h2>
                Une ou plusieurs dates indiquées sont dans le futur<br/>
                Veuillez réessayer en choisissant des périodes passées (date début <= aujourd'hui et date fin <= aujourd'hui).
                <a class="close-reveal-modal button" aria-label="Close">Bien compris</a>
                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>



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
                if ((jQuery.datepicker.parseDate("yy-mm-dd", dateFin) > jQuery.datepicker.formatDate('yy-mm-dd', new Date()))
                        || (jQuery.datepicker.parseDate("yy-mm-dd", dateDeb) > jQuery.datepicker.formatDate('yy-mm-dd', new Date()))) {
                    jQuery("#dateFin").val("");
                    jQuery("#dateFin").val("");
                    jQuery('#problemDateFutur').foundation('reveal', 'open');
                }
            });
        });
    </script>