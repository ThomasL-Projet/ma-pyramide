<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Messages');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<div class="row">
    <div class="small-12 columns">
<?php if (AuthComponent::user('role') != 'utilisateur') : ?>
	<!-- Acc�s seulement aux di�t�ticiens -->
	<div class="row">
	<?php echo $this->Html->link('<< Retour', 'javascript:history.back()'); ?>
    <?php echo '<h2 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h2>'; ?>
	</div>
<?php else : ?>
	<?php if (empty($messagesnouv) AND empty($messagesanc)) : ?>
		<?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
		<h1 align="center">Vous n'avez pas de messages</h1>
	<?php else : ?>
		<?php if (!empty($messagesnouv)) : ?>
			<!-- Le di�t�ticien a des nouveaux messages -->
			<div class="span2">Nouveaux messages :</div>
			<?php foreach ($messagesnouv as $mess) : ?>
				<div class="bloc-index">
				<p id="user"><strong>Message de :</strong> <?php echo $mess['User']['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Objet :</strong> <?php echo $mess['Message']['objet']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>envoy� le :</strong> <?php echo $mess['Message']['created']; ?></p>
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
			<!-- Le di�t�ticien a des messages auquels il a r�pondu -->
			<div class="span2">Anciens messages :</div>
			<?php foreach ($messagesanc as $mess) : ?>
				<div class="bloc-index">
				<p id="user"><strong>Message de :</strong> <?php echo $mess['User']['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Objet :</strong> <?php echo $mess['Message']['objet']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>envoy� le :</strong> <?php echo $mess['Message']['created']; ?></p>
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
</div>