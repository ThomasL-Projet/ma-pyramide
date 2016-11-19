<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Supprimer un objectif');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes 5 objectifs', ['controller' => 'mesCinqObjectifs', 'action' => 'index', 'full_base' => true]); ?></li>    
    <li role="menuitem" class="current"><?php echo $this->Html->link('Suppression d\'un objectif' , 'Javascript:void(0);'); ?></li>
</nav>
<?php
if ($affichage) :
    echo $this->Form->create('Cinqobjectif');
?>
    <div id="presentation">
        <div class="row">
            <div class="small-12 small-centered columns">
                <div class="title-area"> Suppression d'un objectif </div> 
            </div> 
            <div class="row">  
            <div class="small-12 columns">
                <label>Votre objectif : </label>
                <p class="text-justify"> <?php echo $objectif['description']; ?> </p> 
            </div>
            <div class="row"></div>
            <div class="small-6 columns text-right">            
                <?php echo $this->Html->link('Annuler', ['controller' => 'mesCinqObjectifs', 'action' => 'index', 'full_base' => true], ['class' => 'button']); ?>
            </div>
            <div class="small-6 columns text-left">
                <input type="submit" class="button" name="Je confirme" value="Je confirme" />
            </div>
        </div>
    </div>
</form>
<?php endif; ?>