<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/evolutionphysiques/');  ?>
<div class="span2"> Vos activités </div> 
	
		<?php
			for ($i = 0; $i < count($resultats); $i++) {
				echo '<div class="bloc1">';
				echo '<h3>'. $resultats[$i]['Activitephysique']['ACTIVITE_SPECIFIQUE']. '</h3>';
				echo 'Durée : ' . $resultats[$i]['Suiviphysique']['tempsAP']. ' minutes <br />';
				echo 'Jour : ' . date("d/m/Y", strtotime($resultats[$i]['Suiviphysique']['jourAP'])) . '<br />';
				echo $this->Html->link('<input type="button" value="Modifier"/>', '/evolutionphysiques/modif/' . $resultats[$i]['Suiviphysique']['id'], array('escape' => false));
				echo $this->Html->link('<input type="button" value="Supprimer"/>', '/evolutionphysiques/delete/' . $resultats[$i]['Suiviphysique']['id'], array('escape' => false));
				echo '</div>';
			}
		?>

</div></div>
