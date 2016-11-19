<?php 
if (AuthComponent::user('role') == 'administrateur') :
	echo $this->html->script('ckeditor/ckeditor.js');
	echo $this->Form->create('Actualite', array('action' => 'add')); 
	echo $this->Form->input('id', array('type'=>'hidden')); 
?>
<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/actualites/');?>
	<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des actualites -->
	<div class="span2">Informations sur l'actualité</div>
	<div class="bloc1" style="width:780px">
		<!-- Permet à l'utilisateur de saisir le titre de l'actualite -->
		<label for="ActualiteTitle">Titre de l'actualité</label>
		<div class="input text">
			<input name="data[Actualite][title]" maxlength="150" type="text" id="ActualiteTitle" required="required"/>
		</div>
	</div>
	<!-- L'utilisateur saisi ici le contenu de l'actualite -->
	<div class="span2">Contenu de l'actualité</div>
	<div id="bloc-editeur">
		<div class="input textarea">
			<label for="ActualiteContent"></label>
			<textarea name="data[Actualite][content]" cols="160" rows="5" id="ActualiteContent"></textarea>
			<?php echo $this->Ck->load('Actualite.content'); ?>
		</div>
	</div>
	<div id="bloc11" style="margin-left:480px">
	    <?php echo $this->Form->end("Enregistrer"); ?> 
		<?php echo $this->Html->link('<input style="margin-left:10px" type="button" value="Annuler">', '/actualites/', array('escape' => false));?>
	</div>
</div>
<?php endif; ?>