<?php echo $this->Form->create('Demande'); 
	  if ($affichage == 1) : ?>
	  <!-- Un utilisateur consulte la page alors qu'il n'a pas le droit d'accès -->
	  <?php echo $this->Html->link('<< Retour', '/pages/home/');?>
	  <?php echo "<h1 align=\"center\">Vous n'avez pas la permission d'acceder à cette page</h1>"; ?>
<?php else : ?>
		<?php echo $this->Html->link('<< Retour', '/demandes/'); ?>
		 <div class="span2"> Annuler le suivi avec le client : </div> 
		 <div class="bloc-index">
			<p id="user"><?php echo $users['User']['username']; ?>  </p>
			<div id="bloc2">
			<input type="submit" value="Je confirme" />
		 </div>
		 </div>
	</form>

<?php endif; ?>