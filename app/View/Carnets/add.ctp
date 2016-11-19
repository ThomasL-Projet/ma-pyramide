<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Ajouter un élément à votre journal');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Vous pouvez consulter et prendre connaissance d\informations diverses via les articles crées par nos diététicien');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon journal', ['controller' => 'carnets', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Ajout d\'une journée', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Ajout d'une journée </div> 
        </div>
    </div> 
    <div class="row">
        <div class="small-12 columns">
            <div class="bloc1">	
                <?php echo $this->Form->create('Carnet'); ?>
                <?php $iduti = AuthComponent::user('id'); ?>


                <?php echo '<br/>'; ?>
                <?php echo $this->Form->input('titre', array('label' => 'Titre de cette journée ', 'style' => 'width:228px')); ?>
                <?php echo '<br/>'; ?>
                <label>Date
                    <input type="date" value="<?php echo date('m/d/Y', time()); ?>" readonly/>
                </label>
                <?php echo '<br/>'; ?>
                <?php echo $this->Form->input('aliment', array('label' => "Aliment consommés ", 'type' => 'textarea')); ?>
                <?php echo '<br/>'; ?>
                <?php echo $this->Form->input('lieu', array('label' => "Lieux des repas ", 'type' => 'textarea')); ?>
                <?php echo '<br/>'; ?>
                <?php echo $this->Form->input('activite', array('label' => "Activité physique ", 'type' => 'textarea')); ?>
                <?php echo '<br/>'; ?>
                <?php echo $this->Form->input('humeur', array('label' => "Humeur ", 'type' => 'textarea')); ?>
                <?php echo '<br/>'; ?>
                <?php echo $this->Form->input('note', array('label' => "Note ", 'type' => 'textarea')); ?>
                <?php echo '<br/>'; ?>


                <?php //echo $this->Form->end('Enregistrer'); ?><br />
                <input type="submit" id="confirm" class="button" name="enregistrer" value="Enregistrer">
                <?php echo $this->Html->link("Retour", array('controller' => 'carnets', 'action' => 'index'), array('class' => 'button')) ?>


                <!--<div id="retour" style="margin-left:800px; position:absolute; margin-top: -270px "> -->


            </div>
        </div>
    </div>
</div>  
<script type="text/javascript">
    jQuery(document).ready(function () {
    /** Création de type */
    jQuery('#confirm').click(function () {

    var date = jQuery("#dateActivite").val();
            var dur = jQuery("#duree").val();



</script>