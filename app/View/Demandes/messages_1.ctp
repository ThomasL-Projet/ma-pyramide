<div id="presentation">
<?php if (AuthComponent::user('role') != 'dieteticien') : ?>
	<!-- Accès seulement aux diététiciens -->
	<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/pages/home');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
	</div>
<?php else : ?>
	<!-- Bouton nouveau message -->
	<?php echo $this->Html->link('<div id="btn-ajouter">  </div>', '/demandes/newmessage/', array('escape' => false)); ?>
	<?php if (empty($messagesnouv) AND empty($messagesanc)) : ?>
		<?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
		<h1 align="center">Vous n'avez pas de messages</h1>
	<?php else : ?>
		<?php if (!empty($messagesnouv)) : ?>
			<div id="presentation"><?php echo $this->Html->link('<< Retour', '/pages/home');?></div>
			<!-- Le diététicien a des nouveaux messages -->
			<div class="span2">Nouveaux messages :</div>
			<?php foreach ($messagesnouv as $mess) : ?>
				<div class="bloc-index">
				<?php 
				/* Mise sous forme francaise de la date */
				$temp = explode("-", $mess['Message']['created']); 
				$temp2 = explode(" ", $temp[2]);
				$heure = $temp2[1];
				$heure2 = explode(" ", $temp[2]);
				$date = $heure2[0] . '-' . $temp[1] . '-' . $temp[0];
				?>
				<p id="user"><strong>Message de :</strong> <?php echo $mess['User']['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Objet :</strong> <?php echo $mess['Message']['objet']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>envoyé le :</strong> <?php echo $date . ' à ' . $heure; ?></p>
				<div class="btns-index">
				<!-- Bouton voir message -->
				<?php echo $this->Html->link('<div class="btn-rep-solo">Message</div>', '/demandes/affichmessage/' . $mess['Message']['idmess'], array('escape' => false)); ?>
				</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="span2">Vous n'avez pas de nouveaux messages</div>
		<?php endif; ?>
		<?php if (!empty($messagesanc)) : ?>
			<!-- Le diététicien a des messages auquels il a répondu -->
			<div class="span2">Anciens messages :</div>
			<?php foreach ($messagesanc as $mess) : ?>
				<div class="bloc-index">
				<?php 
				/* Mise sous forme francaise de la date */
				$temp = explode("-", $mess['Message']['created']); 
				$temp2 = explode(" ", $temp[2]);
				$heure = $temp2[1];
				$heure2 = explode(" ", $temp[2]);
				$date = $heure2[0] . '-' . $temp[1] . '-' . $temp[0];
				?>
				<p id="user"><strong>Message de :</strong> <?php echo $mess['User']['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Objet :</strong> <?php echo $mess['Message']['objet']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>envoyé le :</strong> <?php echo $date . ' à ' . $heure; ?></p>
				<div class="btns-index">
				<!-- Bouton voir message -->
				<?php echo $this->Html->link('<div class="btn-rep-solo">Message</div>', '/demandes/affichmessage/' . $mess['Message']['idmess'], array('escape' => false)); ?>
				</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
</div>