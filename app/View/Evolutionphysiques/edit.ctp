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
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mes activités physiques', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Mes activités physiques </div> 

            <div class="textarea">
                <p class="text-justify">
                    Voici toutes vos activités physiques   
                </p>			
            </div>
        </div>
    </div>﻿
    <div class="row">
        <div class="small-12 columns">


            <?php
            for ($i = 0; $i < count($resultats); $i++) {
                echo '<div class="bloc1">';
                echo '<h3>' . $resultats[$i]['Activitephysique']['ACTIVITE_SPECIFIQUE'] . '</h3>';
                echo 'Durée : ' . $resultats[$i]['Suiviphysique']['tempsAP'] . ' minutes <br />';
                echo 'Jour : ' . date("d/m/Y", strtotime($resultats[$i]['Suiviphysique']['jourAP'])) . '<br />';
                echo $this->Html->link('<input class="button" type="button" value="Modifier"/>', '/evolutionphysiques/modif/' . $resultats[$i]['Suiviphysique']['id'], array('escape' => false));
                echo $this->Html->link('<input class="button" type="button" value="Supprimer"/>', '/evolutionphysiques/delete/' . $resultats[$i]['Suiviphysique']['id'], array('escape' => false));
                echo '</div>';
            }
            ?>

        </div>
    </div>
</div>

