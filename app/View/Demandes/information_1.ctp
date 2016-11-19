<div id="presentation">
<?php if (AuthComponent::user('role') != 'dieteticien') : ?>
	<!-- Accès seulement aux diététiciens -->
	<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/pages/home');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
	</div>
<?php else : ?>
<?php echo $this->Html->link('<< Retour', '/demandes/'); ?>
<?php if ($affichage == 0) : ?>

<div class="span2">Nom du client demandeur : </div> 	
<div class="bloc-index">
    <label><?php echo $users['User']['username'];?></label>

</div>

<div class="span2">Sexe : </div> 	
<div class="bloc-index">
    <label><?php echo $users['User']['sexe'];?></label>

</div>

<div class="span2">Taille : </div> 	
<div class="bloc-index">
    <label><?php echo $users['User']['taille'];?> cm</label>

</div>

<div class="span2">Poids : </div> 	
<div class="bloc-index">
    <label><?php echo $users['User']['poids'];?> kg</label>

</div>

<div class="span2">Email : </div> 	
<div class="bloc-index">
    <label><?php echo $users['User']['email'];?></label>

</div>

<?php else: ?>
    <?php echo "<h1 align=\"center\">Vous n'avez pas la permission d'acceder à cette page</h1>"; ?>
<?php endif; ?>
<?php endif; ?>
</div>
