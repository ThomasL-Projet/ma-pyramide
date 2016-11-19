<?php 
if (AuthComponent::user('role') == 'administrateur') :
	 if($id != null) : ?>
	<?php 
		echo $this->html->script('ckeditor/ckeditor.js');
		echo $this->Form->create('Lien'); 
	?>

		<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer les liens -->
		<div class="span2">Informations sur le lien</div>
		<div class="bloc1">
			<!-- Permet à l'administrateur de préciser le titre du lien ainsi que la catégorie à laquelle il appartient -->
			<label for="LienTitle">Titre du lien</label>
			<div class="input text">
				<input name="data[Lien][title]" maxlength="150" type="text" id="LienTitle" value="<?php echo $titre; ?>" required="required"/>
			</div>
			<div class="input select">
			<label for="LienCategoryId">Catégorie</label>
			<select name="data[Lien][categorie]" id="LienCategoryId">
				<?php
					echo "<option value=0>" . 'Grand Public' . "</option>";
					echo "<option value=1>" . 'Professionnelle' . "</option>";
					echo "<option value=2>" . 'Professionnelle Privée' . "</option>";
				 ?>
			</select>
		</div>
			
			

		</div>
		<!-- Ceci correspond à l'éditeur de texte. L'administrateur peut ici saisir le contenu de son lien -->
		<div class="span2">Contenu du lien</div>
		<div id="bloc-editeur">
			<div class="input textarea">
				<label for="LienContent"></label>
				<textarea name="data[Lien][content]" cols="160" rows="5" id="LienContent"><?php echo $contenu ?></textarea>
				<?php echo $this->Ck->load('Lien.content'); ?>
			</div>
		</div>
		<div id="bloc11">
			<!-- Lorsqu'un administrateur clique sur le bouton "Enregistrer", les modifications qu'il vient d'effectuer sony automatiquement reportées sur la page du 
			     site concernée -->
		    <?php echo $this->Form->end("Enregistrer"); ?> 
		</div>

		<script type="text/javascript">
			function postData() {
				var formulaire =  document.forms['LienEditForm'];

				formulaire.elements["LienTitle"].value = "<?php echo $titre ?>";
				formulaire.elements["LienCategoryId"].value = <?php echo $idCategorie ?>;
			}
		</script>
	<?php endif; ?>
<?php endif; ?>