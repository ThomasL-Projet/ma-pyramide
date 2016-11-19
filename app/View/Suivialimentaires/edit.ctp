<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon Suivi Alimentaire');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Un suivi de votre nutrition dans le temps.');
$this->end();
?>

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon suivi alimentaire', ['controller' => 'suivialimentaires', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Vos repas', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">

        <div class="small-12 small-centered columns">
            <!-- Cette page est accessible à partir du supertracker : Cliquez sur "Ressources" -> "Super Traqueur" -> "Suivi Alimentaire" -->
            <div class="title-area"> Vos repas d'aujourd'hui </div> 

        </div>

        <?php
        for ($i = 0; $i < count($infosSuivi); $i++) {
            echo '<div class="row" data-equalizer>';
            echo '<div class="large-12 columns panel" data-equalizer-watch>';

            $fichier = isset($infosAliment[$i][0]['Aliment']) ? $infosAliment[$i][0]['Aliment']['chemin'] : '';
            if ($fichier == '') {
                $fichier = 'noimage.jpg';
            }
            if (isset($infosAliment[$i][0]['Alimhorsclassification']))
                echo "<h3>" . $infosAliment[$i][0]['Alimhorsclassification']['nom'] . "</h3>";
            else
                echo "<h3>" . $this->Html->link($infosAliment[$i][0]['Aliment']['nomFR'], '../app/webroot/img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $infosAliment[$i][0]['Aliment']['nomFR'], 'escape' => true)) . "</h3>";


            echo 'Quantité : ' . $infosSuivi[$i]['Suivialimentaire']['quantite'] . '<br />';
            echo 'Portion : ' . $infosSuivi[$i]['Suivialimentaire']['nomPortion'] . '<br />';
            echo 'Moment : ';
            $split = explode("@", $infosSuivi[$i]['Suivialimentaire']['nomSA']);
            for ($j = 0; $j < count($split); $j++) {
                if ($j == (count($split) - 1)) {
                    echo $split[$j] . '<br /><br />';
                } else {
                    echo $split[$j] . ' / ';
                }
            }
            echo $this->Html->link('<input type="button" class="button tiny" value="Modifier"/>', '/suivialimentaires/modif/' . $infosSuivi[$i]['Suivialimentaire']['id'], array('escape' => false));
            echo $this->Html->link('<input type="button" class="button tiny" value="Supprimer"/>', '/suivialimentaires/delete/' . $infosSuivi[$i]['Suivialimentaire']['id'], array('escape' => false));
            echo '</center></div>';
        }

        echo '<div id="bloc-editeur" style="margin-top:40px"><center>';
        echo '<div style="font-style:italic">Navigation : </div>';
        echo $this->Paginator->prev('<<' . __('Précédent', true), array(), null, array('class' => 'disable'));
        echo $this->Paginator->numbers();
        echo $this->Paginator->next('Suivant' . __('>>', true), array(), null, array('class' => 'disable'));
        echo '</center></div>';

        ?>
    </div>
</div>


<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
<script type="text/javascript">
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
