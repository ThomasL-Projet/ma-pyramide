<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mes recettes');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes simulations', ['controller' => 'pages', 'action' => 'jackpotsante', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mes recettes', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Mes recettes</div> 

            <div class="textarea">
                <p class="text-justify">
                    Personnalisez vos recettes en combinant des aliments. Ajoutez-en, modifiez-en, ou supprimez-en !
                </p>			
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="small-12 small-centered columns text-center">
            <?php echo $this->Html->link('Ajouter une recette', ['controller' => 'mesrecettes', 'action' => 'add'], ['class' => 'button', 'escape' => false]); ?>
        </div>
    </div> 
    <div class="row">
        <div class="small-12 small-centered columns">
            <?php if (empty($recettes)) { ?>
                <h3>Vous n'avez pas encore de recettes, cliquez sur le bouton "Ajouter une recette" ci-dessus pour en créer</h3>
            <?php } else { ?>
                <h3>Voici vos recettes</h3>
                <table class="small-12">
                    <thead>
                        <tr>
                            <th width=30%>Nom de la recette</th>
                            <th width=20%>Type de recette</th>
                            <th width=15%>Portions</th>
                            <th width=35%>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($recettes as $recette) :
                            ?>
                        <td>
                            <?php echo $this->Html->link($recette['Mesrecette']['nom'], '/mesrecettes/afficher/' . $recette['Mesrecette']['id'], array('escape' => false)); ?>
                        </td>
                        <td>
                            <?php echo $recette['Famillealiment']['subcategory']; ?>
                        </td>
                        <td>
                            <?php
                            if ($recette['Mesrecette']['quantite'] == 0.5) {
                                echo '&frac12';
                            } elseif ($recette['Mesrecette']['quantite'] == 1.5) {
                                echo '1 &frac12';
                            } elseif ($recette['Mesrecette']['quantite'] == 2.5) {
                                echo '2 &frac12';
                            } elseif ($recette['Mesrecette']['quantite'] == 3.5) {
                                echo '3 &frac12';
                            } else {
                                echo $recette['Mesrecette']['quantite'];
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $this->Html->link('Afficher', '/mesrecettes/afficher/' . $recette['Mesrecette']['id'], ['escape' => false, 'class' => 'button']); ?>
                            <br/>
                            <?php echo $this->Html->link('Modifier', '/mesrecettes/edit/' . $recette['Mesrecette']['id'], ['escape' => false, 'class' => 'button']); ?>
                            <br/>
                            <?php echo $this->Html->link('Supprimer', '/mesrecettes/delete/' . $recette['Mesrecette']['id'], ['escape' => false, 'class' => 'button']); ?>
                        </td>
                    <?php
                    endforeach;
                }
                ?>

                </tbody>
            </table>


            
        </div>
    </div>
</div>

