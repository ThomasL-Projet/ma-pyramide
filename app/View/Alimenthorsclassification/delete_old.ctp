<?php echo $this->Form->create('Alimhorsclassification'); 
	  if (!$affichage) : ?>
	  <!-- Un utilisateur consulte la page alors qu'il n'a pas le droit d'accès -->
	  <?php echo $this->Html->link('<< Retour', '/alimenthorsclassification/');?>
	  <?php echo "<h1 align=\"center\">Vous n'avez pas la permission d'acceder à cette page</h1>"; ?>
<?php else : ?>
		<?php echo $this->Html->link('<< Retour', '/alimenthorsclassification/'); ?>
		 <div class="span2"> Supprimer l'aliment hors classification : </div> 
		 <div class="bloc-index">
			<p id="user"><?php echo $alimhorsclass['Alimhorsclassification']['nom']; ?>  </p>
			<div id="bloc2">
			<input type="submit" value="Je confirme" />
		 </div>
		 </div>
	</form>

<?php endif; ?>