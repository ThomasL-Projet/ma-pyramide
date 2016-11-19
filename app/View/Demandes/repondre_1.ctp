<div id="presentation">
<?php if (AuthComponent::user('role') != 'dieteticien') : ?>
	<!-- Accès seulement aux diététiciens -->
	<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/pages/home');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
	</div>
<?php else : ?>
<?php echo $this->Form->create('Demande'); ?>
<?php if ($affichage == 0) : ?>
<?php echo $this->Html->link('<< Retour', '/demandes/');?>
<div class="bloc-index">Repondre a la demande de <?php echo $demandeur['User']['username'];?> : <br /><br />
<input type ="submit" value = "Oui" name="oui" />
<input type ="submit" value = "Non" name="non" />
<input type ="submit" value = "Retour" name="retour" />

</div>
<?php else: ?>
	<?php echo $this->Html->link('<< Retour', '/pages/home');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder à cette page</h1>'; ?>
<?php endif; ?>
<?php endif; ?>
</div>
