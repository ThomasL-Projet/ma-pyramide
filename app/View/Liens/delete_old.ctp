<?php
if (AuthComponent::user('role') == 'administrateur') :
	echo $this->Form->create('Lien'); ?>
    <div id="retour"> <?php echo $this->Html->link('<< Retour', '/liens/index'); ?> </div>
	<div class="bloc-index">
		<p id="article"><?php echo $lien['Lien']['title']; ?></p>
		<div id="bloc2">
			<input type="submit" value="Je confirme" onClick="return confirmation();"/>
		</div>
	</div>
</form>

<!-- Si l'administrateur décide de supprimer un lien, avant de faire la suppression, on s'assure qu'il n'a pas commis d'erreur -->
<script type="text/javascript">
	function confirmation() {
		return(confirm("Êtes vous sûrs de vouloir supprimer ce lien ?"));
	}
</script>
<?php endif; ?>