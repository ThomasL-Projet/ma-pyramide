<div id="presentation">
<?php if (AuthComponent::user('role') == 'administrateur' AND $affichage) : ?>
<?php echo $this->Html->link('<< Retour', '/images/');?>
<div class="bloc1">	
	<h1>Modifications des photos</h1>
<?php echo $this->Form->create('Photo', array('type' => 'file')); ?>
<?php echo '<br/><br/>' ?>
	<?php echo $this->Form->input('titre', array('label' => "Titre ", 'id' => 'titre', 'value' => $titre)); ?>
	<?php echo '<br/><br/><br/><br/>' ?>
	<?php echo $this->Form->input('description', array('label' => "Description", 'type' => 'textarea','id' => 'description','value' => $contenu)); ?>
	<?php echo '<br/>' ?>
	<?php if ($url != 'urls/') : ?>
	<center><p> Photo actuelle : </p> 
		<?php echo $this->Html->image($url, array('width' => '200', 'height' => '200','alt' => $contenu)); ?></center>
	<?php endif ; ?>	
	<?php echo '<br/><br/>' ?>
	<?php echo $this->Form->input('photo_file', array('label' => 'Votre image au format JPEG, JPG ou PNG' , 'type' => 'file')); ?>
	<?php echo '<br/><br/>' ?>
		
<br /><input type="submit" value="Modifier" style="margin:0px;margin-left:300px" /><br />
<?php echo $this->Html->link('<input type="button" name="retour" value="Annuler" style="margin:0px;margin-left:430px; margin-top:-30px" >', '/images/', array('escape' => false));?>

</div>
<?php else : ?>
<?php echo $this->Html->link('<< Retour', '/pages/home');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
<?php endif; ?>
</div>