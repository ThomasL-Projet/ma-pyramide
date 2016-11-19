
<?php 
if (AuthComponent::user('role') == 'administrateur') :
	echo $this->html->script('ckeditor/ckeditor.js');
	echo $this->Form->create('Article', array('action' => 'add')); 
	echo $this->Form->input('id', array('type'=>'hidden')); 
?>
<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/articles/');?>
<script type="text/javascript">
			alert("Attention : Pour faire un saut de ligne, appuyer 2 fois sur \"enter\".");
</script>
	<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des articles -->
	<div class="span2">Informations sur l'article</div>
	<div class="bloc1" style="width:780px">
		<!-- Permet à l'utilisateur de saisir le titre de l'article -->
		<label for="ArticleTitle">Titre de l'article</label>
		<div class="input text">
			<input style="margin-right:200px" name="data[Article][title]" maxlength="150" type="text" id="ArticleTitle" required="required"/>
		</div>
		<!-- Permet à l'utilisateur de choisir dans quelle catégorie il souhaite ajouter l'article -->
		<div class="input select">
			<label for="ArticleCategoryId">Catégorie</label>
			<select name="data[Article][category_id]" id="ArticleCategoryId">
				<?php foreach ($categories as $categorie) {
					echo "<option value=" . $categorie['Category']['id'] . ">" . $categorie['Category']['name'] . "</option>";
				} ?>
			</select>
		</div>
	</div>
	<!-- L'utilisateur saisi ici le contenu de l'article -->
	<div class="span2">Contenu de l'article</div>
	<div id="bloc-editeur">
		<div class="input textarea">
			<label for="ArticleContent"></label>
			<textarea name="data[Article][content]" cols="160" rows="5" id="ArticleContent"></textarea>
			<?php echo $this->Ck->load('Article.content'); ?>
		</div>
	</div>
	<div id="bloc11" style="margin-left:480px">
	
	    <?php echo $this->Form->end("Enregistrer"); ?> 
		<?php echo $this->Html->link('<input style="margin-left:10px" type="button" value="Annuler">', '/articles/', array('escape' => false));?>
	</div>
	</div>
<?php endif; ?>