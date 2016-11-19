<?php echo $this->Form->create('Suivialimentaire'); 
echo $this->Html->link('<< Retour', '/evolutionphysiques/edit/'); 
	  if (!$affichage) : ?>
	  <!-- L'utilisateur consulte un suiviAlimentaire qui ne le concerne pas -->
	  <?php echo "<h1 align=\"center\">Vous n'avez pas la permission d'acceder à cette page</h1>"; ?>
<?php else : ?>

		 <div class="span2"> Confirmer la suppression de : </div> 
		 <div class="bloc-index">
			<p id="user"><?php echo $activite['Activitephysique']['ACTIVITE_SPECIFIQUE']; ?>  </p>
			<div id="bloc2">
			<input type="submit" value="Je confirme" />
		 </div>
		 </div>
	</form>

<?php endif; ?>