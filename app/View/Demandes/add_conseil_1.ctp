﻿<?php echo $this->Form->create('Cinqobjectif'); 
?>
<div id="presentation">
<?php if (AuthComponent::user('role') != 'dieteticien' OR !$affichage) : ?>
	<!-- Accès seulement aux diététiciens et interdit aux modifications de l'url -->
	<?php echo $this->Html->link('<< Retour', '/pages/home/');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
<?php else : ?>
	<?php echo $this->Html->link('<< Retour', '/demandes/suivis/');?>
	<div class="span2"> Saisissez votre conseil : </div> 
		 <div id="bloc-editeur">
			<textarea rows="6" cols="100" name="com" required="required" title="Le conseil doit faire entre 1 et 300 caractètres" maxlength="300"></textarea>
			<div id="bloc2">
			<input type="submit" value="Ajouter" />
		 </div>
		 </div>
<?php endif; ?>
</form>
</div>