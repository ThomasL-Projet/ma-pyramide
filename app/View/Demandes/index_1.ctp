<div id="presentation">
<?php if (AuthComponent::user('role') != 'dieteticien') : ?>
	<!-- Accès seulement aux diététiciens -->
	<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder à cette page</h1>'; ?>
	</div>
<?php else : ?>
<?php if (empty($users)) : ?>
		<?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
		<div class="span2">Vous n'avez pas de nouvelles demandes</div>
		
<?php else : ?>			
	<div id="presentation"><?php echo $this->Html->link('<< Retour', '/pages/home'); ?></div>
	<div class="span2">Vos demandes :</div>
<?php foreach ($users as $user) : ?>
    <div class="bloc-index">
        <p id="user">Demande de :  <?php echo $user['User']['username']; ?></p>
        <div class="btns-index">
            <!-- Bouton Répondre -->
            <?php echo $this->Html->link('<div class="btn-rep">Répondre</div>', '/demandes/repondre/' . $user['User']['id'], array('escape' => false)); ?>
	    
            <!-- Bouton information -->
            <?php echo $this->Html->link('<div class="btn-infos">Informations</div>', '/demandes/information/' . $user['User']['id'], array('escape' => false)); ?>
            
        </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>
<!-- Partie clients -->
<?php if (!empty($clients)) : ?>
	<div class="span2">Vos clients :</div>
<?php foreach ($clients as $client) : ?>
    <div class="bloc-index">
        <p id="user"><?php echo $client['User']['username']; ?></p>
        <div class="btns-index">
            <!-- Bouton information --><?php echo $this->Html->link('<div class="btn-supprimer-demande">Supprimer</div>', '/demandes/delete/' . $client['User']['id'], array('escape' => false)); ?>
            <?php echo $this->Html->link('<div class="btn-infos">Informations</div>', '/demandes/information/' . $client['User']['id'], array('escape' => false)); ?>
            
        </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
</div>
