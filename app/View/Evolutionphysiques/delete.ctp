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
    <li role="menuitem" class="current"><?php echo $this->Html->link('Suppression d\'une activité physique', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Supprimer un activité physique </div> 

        </div>
    </div>﻿
    <div class="row">
        <div class="small-12 columns">

            ﻿<?php
            echo $this->Form->create('Suivialimentaire');
            if (!$affichage) :
                ?>
                <!-- L'utilisateur consulte un suiviAlimentaire qui ne le concerne pas -->
                <div> Vous n'avez pas la permission d'acceder à cette page</div>
            <?php else : ?>

                <div class="span2"> Confirmer la suppression de : </div> 
                <div class="bloc-index">
                    <p id="user"><?php echo $activite['Activitephysique']['ACTIVITE_SPECIFIQUE']; ?>  </p>
                    <div id="bloc2">
                        <input type="submit" class="button" value="Je confirme" />
                    </div>
                </div>
                </form>

            <?php endif; ?>
        </div>
    </div>
</div>

