<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Supprimer une recette');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿﻿
    <nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes simulations', ['controller' => 'pages', 'action' => 'jackpotsante', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes recettes', ['controller' => 'mesrecettes', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Suppression d\'une recette', 'Javascript:void(0);'); ?></li>
</nav>
<?php echo $this->Form->create('Mesrecette'); ?>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Suppression d'une recette</div> 

        </div>  
    </div>
	<?php  if (!$affichage) : ?>
	  <!-- Un utilisateur consulte la page alors qu'il n'a pas le droit d'accès -->
	  
	  <?php echo "<h1 align=\"center\">Vous n'avez pas la permission d'acceder à cette page</h1>"; ?>
<?php else : ?>
		
		 <div class="span2"> Supprimer la recette : </div> 
		 <div class="bloc-index">
			<p id="user"><?php echo $recette['Mesrecette']['nom']; ?>  </p>
			<div id="bloc2">
			<input type="submit" value="Je confirme" />
		 </div>
		 </div>
	</form>

<?php endif; ?>