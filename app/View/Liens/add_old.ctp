<?php 
if (AuthComponent::user('role') == 'administrateur') :
	echo $this->html->script('ckeditor/ckeditor.js');
	echo $this->Form->create('Lien', array('action' => 'add')); 
	echo $this->Form->input('id', array('type'=>'hidden')); 
?>
	<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer les leins -->
	<div class="span2">Informations sur le lien</div>
	<div class="bloc1">
		<!-- Permet à l'utilisateur de saisir le titre du lien -->
		<label for="LienTitle">Titre du lien</label>
		<div class="input text">
			<input name="data[Lien][title]" maxlength="150" type="text" id="LienTitle" required="required"/>
		</div>
		<!-- Permet à l'utilisateur de saisir à quel endroit il veut voir son lien -->
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
	<!-- L'utilisateur saisi ici le contenu du lien -->
	<div class="span2">Contenu du lien</div>
	<div id="bloc-editeur">
		<div class="input textarea">
			<label for="LienContent"></label>
			<textarea name="data[Lien][content]" cols="160" rows="5" id="LienContent"></textarea>
			<?php echo $this->Ck->load('Lien.content'); ?>
		</div>
	</div>
	<div id="bloc11">
	    <?php echo $this->Form->end("Enregistrer"); ?> 
	</div>
<?php endif; ?>