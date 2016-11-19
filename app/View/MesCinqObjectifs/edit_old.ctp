<?php echo $this->Form->create('Cinqobjectif'); 
?>
<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/mesCinqObjectifs/index');?>
</div>
<?php if ($affichage) : ?>
	<div class="span2"> Modifier un objectif : </div> 
		 <div id="bloc-editeur">
			<textarea rows="6" cols="100" name="com" required="required" title="La description doit faire entre 1 et 300 caractètres" maxlength="300"><?php echo str_replace("<br />", "",$objectif['description']); ?></textarea>
			<div id="bloc2">
			<input type="submit" value="Modifier" />
		 </div>
		 </div>
	</form>
<?php endif; ?>