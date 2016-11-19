<div id="presentation">
<?php
if (AuthComponent::user('role') == 'administrateur') :
	echo $this->Form->create('Article'); ?>
    <div id="retour"> <?php echo $this->Html->link('<< Retour', '/articles/index'); ?> </div>
	<div class="bloc-index" style="margin-top:10px">
		<p id="article"><?php echo $article['Article']['title']; ?></p>
		<div id="bloc2">
			<input type="submit" value="Je confirme" onClick="return confirmation();"/>
		</div>
	</div>
</form>

<!-- Si l'administrateur décide de supprimer un article, avant de faire la suppression, on s'assure qu'il n'a pas commis d'erreur -->
<script type="text/javascript">
	function confirmation() {
		return(confirm("Êtes vous sûrs de vouloir supprimer cet article ?"));
	}
</script>
<?php endif; ?>
</div>