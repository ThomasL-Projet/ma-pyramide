<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Éditer une partie du journal');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Vous pouvez consulter et prendre connaissance d\informations diverses via les articles crées par nos diététicien');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon journal', ['controller' => 'carnets', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Modification d\'une journée', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Modification d'une journée </div> 
        </div>
    </div> 
    <div class="row">
        <div class="small-12 columns">
            <div class="bloc1">	

                <?php echo $this->Form->create('Carnet'); ?>
                <?php $iduti = AuthComponent::user('id'); ?>


                <?php echo '<br/><br/>' ?>
                <?php echo $this->Form->input('titre', array('label' => 'Titre de cette journée ', 'style' => 'width:228px', 'value' => $titre)); ?>
                <?php echo '<br/><br/><br/>' ?>
                <?php echo $this->Form->input('aliment', array('label' => "Aliment consommés ", 'type' => 'textarea', 'value' => $aliment)); ?>
                <?php echo '<br/>' ?>
                <?php echo $this->Form->input('lieu', array('label' => "Lieux des repas ", 'type' => 'textarea', 'value' => $lieu)); ?>
                <?php echo '<br/>' ?>
                <?php echo $this->Form->input('activite', array('label' => "Activité physique ", 'type' => 'textarea', 'value' => $activite)); ?>
                <?php echo '<br/>' ?>
                <?php echo $this->Form->input('humeur', array('label' => "Humeur ", 'type' => 'textarea', 'value' => $humeur)); ?>
                <?php echo '<br/>' ?>
                <?php echo $this->Form->input('note', array('label' => "Note ", 'type' => 'textarea', 'value' => $note)); ?>
                <?php echo '<br/>' ?>


                <?php //echo $this->Form->end('Enregistrer'); ?>
                <input class="button" type="submit" name="modifier" value="Modifier">
                <?php echo $this->Html->link("Retour", array('controller' => 'carnets', 'action' => 'index'), array('class' => 'button')) ?>


                <!--<div id="retour" style="margin-left:800px; position:absolute; margin-top: -270px "> -->

            </div>
        </div>
    </div>
</div>