<?php 
		echo $this->html->script('ckeditor/ckeditor.js');
		echo $this->Form->create('Demande', array('action' => 'affichmessage')); 
		if (AuthComponent::user('role') == 'dieteticien' ) {
			echo $this->Form->input('Message.iddiet', array('type' => 'hidden', 'value' => $dietid));
			//echo $this->Form->input('Message.idcli', array('type' => 'hidden', 'value' => $idcli));
			echo $this->Form->input('Message.idexpediteur', array('type' => 'hidden', 'value' => $dietid));
			echo $this->Form->input('Message.repondu', array('type' => 'hidden', 'value' => 'non'));
		}
?>
<?php if (AuthComponent::user('role') != 'dieteticien') : ?>
	<!-- Accès seulement aux diététiciens -->
	<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/pages/home');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
	</div>
<?php elseif (empty($clients)) : ?>
		<!-- Pas de clients -->
		<div id="presentation">
		<?php echo $this->Html->link('<< Retour', '/demandes/messages');?>
		<?php echo '<h1 align="center">Vous n\'avez aucun client pour l\'instant</h1>'; ?>
		</div>
<?php else : ?>
	<div id="presentation"><?php echo $this->Html->link('<< Retour', '/demandes/messages'); ?>
		<div class="span2"align = "center" style="margin-left:225px">Nouveau message</div>
			<div class="span2">Selectionez un de vos clients :</div>
		<div id="bloc-editeur">
			<!-- Permet à l'utilisateur de saisir l'objet de sa réponse -->
			<h2 align = "center">
				<select name="data[Message][idcli]" required="required">
				<?php
					foreach ($clients as $client) {
						echo '<option value="'. $client['User']['id'] .'">'. $client['User']['username'] .'</option>';
					}
				?>
				</select>
		</div><div class="span2">Saisissez un objet</div>
		<div id="bloc-editeur">
			<!-- Permet à l'utilisateur de saisir l'objet de sa réponse -->
			<h2 style="margin-left:200px">Objet :<br></h2>
				<input style="margin-left:300px;margin-top:-35px" name="data[Message][objet]" maxlength="150" type="text" id="MessageObjet" required="required"/>
		</div>
			<!-- L'utilisateur saisi ici le contenu de sa réponse -->
			<div class="span2">Contenu de votre Message</div>
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
			