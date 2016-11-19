<div id="presentation" >
<?php
if (AuthComponent::user('role') == 'administrateur') :
	echo $this->Form->create('Statique'); ?>
    <div id="retour"> <?php echo $this->Html->link('<< Retour', '/Statiques/index'); ?> </div>
	<div class="bloc-index" style="margin-top:10px">
		<p id="article"><?php echo $statique['Statique']['title']; ?></p>
		<div id="bloc2">
			<input type="submit" value="Je confirme" />
		</div>
	</div>
</form>

<!-- Si l'administrateur décide de supprimer un article, avant de faire la suppression, on s'assure qu'il n'a pas commis d'erreur -->

<?php endif; ?>
</div>