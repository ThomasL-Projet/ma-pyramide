<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Ajouter un conseil');
?>
<?php 
if (AuthComponent::user('role') == 'administrateur') :
	echo $this->html->script('ckeditor/ckeditor.js');
	echo $this->Form->create('Actualite', array('action' => 'add')); 
	echo $this->Form->input('id', array('type'=>'hidden')); 
?>
<div class="row">
    <div class="small-12 small-centered">
<?php echo $this->Html->link('<< Retour', '/actualites/');?> 
	<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des actualites -->
        <h2>Informations sur l'actualité</h2>
	<div class="bloc1">
		<!-- Permet à l'utilisateur de saisir le titre de l'actualite -->
		<h3>Titre de l'actualité</h3>
		<div class="input text">
			<input name="data[Actualite][title]" maxlength="150" type="text" id="ActualiteTitle" required="required"/>
		</div>
	</div>
	<!-- L'utilisateur saisi ici le contenu de l'actualite -->
	<h3>Contenu de l'actualité</h3>
	<div id="bloc-editeur">
		<div class="input textarea">
			<label for="ActualiteContent"></label>
			<textarea name="data[Actualite][content]" cols="160" rows="5" id="ActualiteContent"></textarea>
			<?php echo $this->Ck->load('Actualite.content'); ?>
		</div>
	</div>
	<div id="bloc11">
                <input Enregistrer="Enregistrer" type="submit" value="Enregistrer" class="button" />
		<?php echo $this->Html->link('<input class="button" type="button" value="Annuler">', '/actualites/', array('escape' => false));?>
	</div>
    </div>
</div>
</form>

<?php endif; ?>