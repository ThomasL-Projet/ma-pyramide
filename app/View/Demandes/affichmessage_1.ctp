<?php 
		echo $this->html->script('ckeditor/ckeditor.js');
		echo $this->Form->create('Demande', array('action' => 'affichmessage')); 
		echo $this->Form->input('idmess', array('type'=>'hidden')); 
		if (AuthComponent::user('role') == 'dieteticien' AND isset($dietid) AND isset($idcli) AND isset($idmessage) ) {
			echo $this->Form->input('Message.iddiet', array('type' => 'hidden', 'value' => $dietid));
			echo $this->Form->input('Message.idcli', array('type' => 'hidden', 'value' => $idcli));
			echo $this->Form->input('Message.idexpediteur', array('type' => 'hidden', 'value' => $dietid));
			echo $this->Form->input('Message.repondu', array('type' => 'hidden', 'value' => 'non'));
			echo $this->Form->input('idmessage', array('type' => 'hidden', 'value' => $idmessage));
		}
?>
<div id="presentation">
<?php if (AuthComponent::user('role') != 'dieteticien') : ?>
	<!-- Accès seulement aux diététiciens -->
	<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/pages/home');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
	</div>
<?php else : ?>
	<?php if ($affichage == 0) : ?>
		<div id="presentation">
		<!-- Affichage du message -->
		<div id="bloc-editeur">
			<h2><?php echo 'Message de : ' . $nomCli; ?></h2>
			<h2><?php echo 'Objet : ' . $objet; ?></h2>
			<?php 
			/* Mise sous forme francaise de la date */
			$temp = explode("-", $created); 
			$temp2 = explode(" ", $temp[2]);
			$heure = $temp2[1];
			$heure2 = explode(" ", $temp[2]);
			$date = $heure2[0] . '-' . $temp[1] . '-' . $temp[0];
			?>
			<h5><?php echo 'Envoyé le : ' . $date . ' à ' . $heure;?></h5>
			<br /><br />
			<div id='no-format'>
				<?php echo "<div class='p1'>". $message ."</div>" ?>
			</div>
		</div>
		<!-- Si le message n'a pas été répondu l'éditeur ckeditor est alors présent pour permettre au diététicien de répondre à son client -->
		<?php if ($repondu == 'non') : ?>
		<div class="span2">Réponse</div>
		<div id="bloc-editeur">
			<!-- Permet à l'utilisateur de saisir l'objet de sa réponse -->
			<h2 style="margin-left:200px">Objet :<br></h2>
				<input style="margin-left:300px;margin-top:-35px" name="data[Message][objet]" maxlength="150" type="text" id="MessageObjet" required="required"/>
		</div>
			<!-- L'utilisateur saisi ici le contenu de sa réponse -->
			<div class="span2">Contenu de votre réponse</div>
			<div id="bloc-editeur">
				<div class="input textarea">
					<label for="MessageMessage"></label>
					<textarea name="data[Message][message]" cols="160" rows="5" id="MessageMessage"></textarea>
					<?php echo $this->Ck->load('Message.message'); ?>
				</div>
			</div>
			<div id="bloc11">
				<input type="hidden" name="idmessage" id="hiddenField" value="<?php echo $idmessage; ?>" />
				<?php echo $this->Form->end(array('label'=>'Envoyer','style' => 'margin-left:500px')); ?> 
			</div>
		</div>
		<?php else : ?>
			<p align="center"><?php echo $this->Html->link('<input type="button" name="retour" value="Retour" >', '/demandes/messages', array('escape' => false)); ?></p>
		<?php endif; ?>
	<?php else: ?>
		<?php echo $this->Html->link('<< Retour', '/demandes/messages'); ?>
		<?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder à cette page</h1>'; ?>
	<?php endif; ?>
<?php endif; ?>
</div>