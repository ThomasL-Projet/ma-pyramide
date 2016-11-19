<?php echo $this->Form->create('Mesrecette'); 
	  if (!$affichage) : ?>
	  <!-- Un utilisateur consulte la page alors qu'il n'a pas le droit d'accès -->
	  <?php echo $this->Html->link('<< Retour', '/mesrecettes/');?>
	  <?php echo "<h1 align=\"center\">Vous n'avez pas la permission d'acceder à cette page</h1>"; ?>
<?php else : ?>
		<?php echo $this->Html->link('<< Retour', '/mesrecettes/'); ?>
		 <div class="span2"> Supprimer la recette : </div> 
		 <div class="bloc-index">
			<p id="user"><?php echo $recette['Mesrecette']['nom']; ?>  </p>
			<div id="bloc2">
			<input type="submit" value="Je confirme" />
		 </div>
		 </div>
	</form>

<?php endif; ?>