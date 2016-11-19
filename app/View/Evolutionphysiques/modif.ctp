<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Évolution de l\'activité physique');
// récupération des paramètres
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes rapports d\'évolution', ['controller' => 'rapportEvolution', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon évolution physique', ['controller' => 'evolutionphysique', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Modification activités physiques', 'Javascript:void(0);'); ?></li>
</nav>
<?php
//if ($affichage) :
echo $this->Form->create('Evolutionphysiques');
?>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Modification de vos activités physiques </div> 

            <div class="textarea">
                <p class="text-center">
                    <?php
                    echo "<h2>" . $activite['Activitephysique']['ACTIVITE_SPECIFIQUE'] . "</h2></br></br>";
                    ?>	
                </p>			
            </div>
        </div>
    </div>﻿
    <div class="row">
        <div class="small-12 columns">

                <div id="caract" class="choix-portion"> 
                    <!-- Ici, l'utilisateur peut chosir la quantité pour laquelle il souhaite effectuer la comparaison -->
                    <form name="form">
                        <label for="duree"> Entrez la durée (en min): </label>
                        <input type="text" name="duree" id="duree"/><br />
                        
                        <!-- L'utilisateur choisi ici la taille de la portion : "petites portions", "moyennes portions" ou "grandes portions" -->	
                        <!-- L'utilisateur peut afficher des informations concernant l'aliment mais aussi les caractéristiques nutritionelles de ce dernier -->

                        <!--<div class="info-aliment" id='info-aliment'>-->


                        <?php $split = explode(" ", $suivi['Suiviphysique']['jourAP']); ?>



                        <div class="choix-portion"></br>
                            <!--Ajout de la date-->
                            <label for="myDate"> Entrez la date de l'activité </label>
                            <input name="date" type="date" id="myDate" value="<?php echo $split[0]; ?>">
                            <input class="button" type="submit" name="activite" value="Modifier" onclick="return (confirm())" />
                    </form>

                </div>	   
            </div> 

        </div>                                        




    </div>

</div>

<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
<script type="text/javascript">
    function confirm() {
        var duree = document.getElementById("duree").value

        if (duree < 0) {
            alert('Entrez une durée valide');
            return false
        }
        return true
    }


</script>	
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
