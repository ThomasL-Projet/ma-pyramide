<?php 
if (AuthComponent::user('role') == 'administrateur') :
	 if($id != null) : ?>
	<?php 
		echo $this->html->script('ckeditor/ckeditor.js');
		echo $this->Form->create('Actualite'); 
	?>
	<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/actualites/');?>

		<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des actualites -->
		<div class="span2">Informations sur l'actualité</div>
		<div class="bloc1" style="width:780px">
			<!-- Permet à l'administrateur de préciser le titre de l'actualite ainsi que la catégorie à laquelle il appartient -->
			<label for="ActualiteTitle">Titre de l'actualité</label>
			<div class="input text">
				<input name="data[Actualite][title]" maxlength="150" value="<?php echo $titre; ?>" type="text" id="ActualiteTitle" required="required"/>
			</div>

		</div>
		<!-- Ceci correspond à l'éditeur de texte. L'administrateur peut ici saisir le contenu de son actualite -->
		<div class="span2">Contenu de l'actualité</div>
		<div id="bloc-editeur">
			<div class="input textarea">
				<label for="ActualiteContent"></label>
				<textarea name="data[Actualite][content]" cols="160" rows="5" id="ActualiteContent"><?php echo $contenu ?></textarea>
				<?php echo $this->Ck->load('Actualite.content'); ?>
			</div>
		</div>
		<div id="bloc11" style="margin-left:480px">
	    <?php echo $this->Form->end("Enregistrer"); ?> 
		<?php echo $this->Html->link('<input style="margin-left:10px" type="button" value="Annuler">', '/actualites/', array('escape' => false));?>
	</div>
</div>
		<script type="text/javascript">
			function postData() {
				var formulaire =  document.forms['ActualiteEditForm'];

				formulaire.elements["ActualiteTitle"].value = "<?php echo $titre ?>";
				formulaire.elements["ActualiteCategoryId"].value = <?php echo $idCategorie ?>;
			}
		</script>
		
	<?php endif; ?>
<?php endif; ?>