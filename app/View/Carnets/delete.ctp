<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Supprimer une partie de votre journal');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Vous pouvez consulter et prendre connaissance d\informations diverses via les articles crées par nos diététicien');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon journal', ['controller' => 'carnets', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Suppression d\'une journée', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Suppression d'une journée </div> 
        </div>
    </div> 
    <div class="row">
        <div class="small-12 columns">
            <?php echo $this->Form->create('Carnet'); ?>
            <?php
            $temp = explode("-", $carnet['Carnet']['created']);
            $split = explode(" ", $temp[2]);
            $date = $split[0] . '-' . $temp[1] . '-' . $temp[0];
            ?> 
            <div class="bloc-index">
                <h3> Êtes-vous sur de vouloir supprimer votre journal du : </h3>
                <p id="article"><?php echo $date; ?></p>
                <div id="bloc2">
                    <?php echo $this->Html->link('Annuler', ['controller' => 'carnets', 'action' => 'index', 'full_base' => true], ['class' => 'button']); ?>
                    <input type="submit" class="button" value="Je confirme" />

                </div>
            </div>
            </form>
        </div>
    </div>
</div>
