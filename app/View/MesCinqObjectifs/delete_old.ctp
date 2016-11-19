<?php echo $this->Form->create('Cinqobjectif'); 
?>
<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/mesCinqObjectifs/index');?>
</div>
<?php if ($affichage) : ?>
	<div class="row"> Confirmer la suppression de l'objectif : </div> 
		 <div id="bloc-editeur">
			<label><?php echo $objectif['description']; ?>  </label>
			<div id="bloc2">
			<input type="submit" class="button" name="Je confirme" />
		 </div>
		 </div>
	</form>
<?php endif; ?>