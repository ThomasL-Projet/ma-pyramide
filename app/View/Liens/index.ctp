<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Liens');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Gestion des liens', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <?php if (AuthComponent::user('role') == 'administrateur') : ?>
        <div class="row">
            <div class="small-12 small-centered columns">
                <div class="title-area"> Gestion des liens </div>      
            </div>
        </div>
        <div class="row text-center">
            <div class="small-12 columns">
                <!-- Bouton ajout : pour ajouter un nouveau lien -->
                <?php echo $this->Html->link('Ajouter un nouveau lien', '/liens/add/', array('class' => 'button', 'escape' => false)); ?>
            </div>
        </div>
        <?php $nb = 1; ?>
        <?php
        if (!(empty($liens))) :
            foreach ($liens as $lien) :
                ?>

                <div class="row">
                    <div class="small-12 column">

                        <div class="row text-center" data-equalizer>
                            <div class="small-12 columns panel" data-equalizer-watch>

                                <?php
                                echo $this->Html->link('Lien ' . $nb . ' : ' . $lien['Lien']['title'], '/liens/lien/' . $lien['Lien']['id'], array('escape' => false));
                                ?>
                                <br><br>

                                <!-- Bouton suppression : pour supprimer un lien, l'administrateur doit cliquez sur le bouton symbolisé par une croix rouge correspondant
                                         au lien qu'il souhaite modifier -->
                                <?php echo $this->Html->link('Supprimer', '/liens/delete/' . $lien['Lien']['id'], array('class' => 'button', 'escape' => false)); ?>
                                <!-- Bouton modifications : pour effectuer des modifications concernant un lien, l'administrateur doit cliquez sur le bouton symbolisé par un engrenage correspondant
                                                                         au lien qu'il souhaite modifier -->		
                                <?php echo $this->Html->link('Modifier', '/liens/edit/' . $lien['Lien']['id'], array('class' => 'button', 'escape' => false)); ?>


                            </div> 
                        </div>
                    </div> 
                </div>
                <?php $nb++; ?>
                <?php
            endforeach;
        else :
            ?>
            <div class="row">
                <div class="small-12 small-centered">
                    <p class="text-center">Aucun lien n'est renseigné pour le moment, veuillez ajouter un lien pour pouvoir ensuite le modifier ou le supprimer.</p>
                </div>
            </div>
        <?php endif;
        ?>



    <?php endif; ?>

</div>