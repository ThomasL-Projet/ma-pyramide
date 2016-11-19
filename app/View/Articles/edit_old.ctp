<?php 
if (AuthComponent::user('role') == 'administrateur') :
	 if($id != null) : ?>
	<?php 
		echo $this->html->script('ckeditor/ckeditor.js');
		echo $this->Form->create('Article'); 
	?>
	<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/articles/');?>

		<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des articles -->
		<div class="span2">Informations sur l'article</div>
		<div class="bloc1">
			<!-- Permet à l'administrateur de préciser le titre de l'article ainsi que la catégorie à laquelle il appartient -->
			<label for="ArticleTitle">Titre de l'article</label>
			<div class="input text">
				<input style="margin-right:200px" name="data[Article][title]" maxlength="150" type="text" id="ArticleTitle" required="required"/>
			</div>
			<div class="input select">
				<label for="ArticleCategoryId">Catégorie</label>
				<select name="data[Article][category_id]" id="ArticleCategoryId">
					<?php foreach ($categories as $categorie) {
						echo "<option value=" . $categorie['Category']['id'] . ">" . $categorie['Category']['name'] . "</option>";
					} ?>
				</select>
			</div>
		</div>
		<!-- Ceci correspond à l'éditeur de texte. L'administrateur peut ici saisir le contenu de son article -->
		<div class="span2">Contenu de l'article</div>
		<div id="bloc-editeur">
			<div class="input textarea">
				<label for="ArticleContent"></label>
				<textarea name="data[Article][content]" cols="160" rows="5" id="ArticleContent"><?php echo $contenu ?></textarea>
				<?php echo $this->Ck->load('Article.content'); ?>
			</div>
		</div>
		<div id="bloc11" style="margin-left:480px">
			<!-- Lorsqu'un administrateur clique sur le bouton "Enregistrer", les modifications qu'il vient d'effectuer son automatiquement reportées sur la page du 
			     site concernée -->
		    <?php echo $this->Form->end("Enregistrer"); ?> 
			<?php echo $this->Html->link('<input style="margin-left:10px" type="button" value="Annuler">', '/articles/', array('escape' => false));?>
		</div>

		<script type="text/javascript">
			function postData() {
				var formulaire =  document.forms['ArticleEditForm'];

				formulaire.elements["ArticleTitle"].value = "<?php echo $titre ?>";
				formulaire.elements["ArticleCategoryId"].value = <?php echo $idCategorie ?>;
			}
		</script>
		</div>
	<?php endif; ?>
<?php endif; ?>