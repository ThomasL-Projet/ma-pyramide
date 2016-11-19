<?php 
		echo $this->Html->script('ckeditor/ckeditor.js');
		echo $this->Form->create('Tuteur', array('action' => 'affichmessage')); 
		if (isset($diet)) {
			echo $this->Form->input('Message.iddiet', array('type' => 'hidden', 'value' => $diet['User']['id']));
			echo $this->Form->input('Message.idcli', array('type' => 'hidden', 'value' => AuthComponent::user('id')));
			echo $this->Form->input('Message.idexpediteur', array('type' => 'hidden', 'value' => AuthComponent::user('id')));
			echo $this->Form->input('Message.repondu', array('type' => 'hidden', 'value' => 'non'));
		}
?>
<?php if (isset($affichage)) : ?>
	<!-- Accès seulement au client concerné -->
	<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/tuteurs/messages'); ?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
	</div>
<?php else : ?>
	<div id="presentation">
		<?php echo $this->Html->link('<< Retour', '/tuteurs/messages'); ?>
		<div class="span2">Nouveau message</div>
		<div id="bloc-editeur">
			<!-- Permet à l'utilisateur de saisir l'objet de son message -->
			<h2 style="margin-left:200px">Objet :<br></h2>
				<input style="margin-left:300px;margin-top:-35px" name="data[Message][objet]" maxlength="150" type="text" id="MessageObjet" required="required"/>
		</div>
			<!-- L'utilisateur saisi ici le contenu de son message -->
			<div class="span2">Contenu de votre réponse</div>
			<div id="bloc-editeur">
				<div class="input textarea">
					<label for="MessageMessage"></label>
					<textarea name="data[Message][message]" cols="160" rows="5" id="MessageMessage"></textarea>
					<?php echo $this->Ck->load('Message.message'); ?>
				</div>
			</div>
			<div id="bloc11">
				<?php echo $this->Form->end(array('label'=>'Envoyer','style' => 'margin-left:500px')); ?>  
			</div>
	</div>
<?php endif; ?>
			