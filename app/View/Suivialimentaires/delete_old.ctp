<?php echo $this->Form->create('Suivialimentaire'); 
echo $this->Html->link('<< Retour', '/suivialimentaires/edit/');
if ($affichage) : ?>
		 <div class="span2"> Confirmer la suppression de : </div> 
		 <div class="bloc-index">
			<p id="user"><?php if (isset($aliment['Aliment'])) echo $aliment['Aliment']['nomFR']; else  echo $aliment['Alimhorsclassification']['nom'];?>  </p>
			<div id="bloc2">
			<input type="submit" value="Je confirme" />
		 </div>
		 </div>
	</form>

<?php endif; ?>