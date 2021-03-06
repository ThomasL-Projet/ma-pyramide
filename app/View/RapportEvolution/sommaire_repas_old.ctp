﻿<?php echo $this->Form->create('Suivialimentaire'); ?>
<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/rapportEvolution/index/');?>
	<div id="image">
	</div>
    <div class="texte">
		<div class="span3"> Sommaire Repas </div>
		<div class="p1"> Revoyez les menus que vous avez mangé ou planifié pendant une période déterminée.
		<br><br>Veuillez entrer une période pour laquelle vous voulez afficher vos aliments consommés
		</div> 			
	</div>
	<div id="texte4">
		<table>
			<tr>
				<td >
				<br /><br /> 
				<h1> Choisissez une date de début : </h1>
				<input type="text" id="datedebut" name="debut" value ="<?php if (!empty($debut)) echo $debut;?>"></input>
				</td>
				<td >
				<br /><br /> 
				<h1> Choisissez une date de fin : </h1>
				<input type="text" id="datefin" name="fin" value ="<?php if (!empty($fin)) echo $fin;?>"></input>
				</td>
				<td>
				<input style="margin-top: 105px;" type="submit" name="valider" value="Valider" onclick="return validPost();"/>	
				</td>
			</tr>
		</table>
	</div>
	<?php if (isset($repas) AND empty($repas)) : ?>
	<div id="bloc-editeur" style="margin-top:50px;">
	<center><p>Resultats :</p></center>
	<center><div class="span2"> Aucun repas n'a été trouvé pour cette période</div> </center>
	</div>
	<?php elseif (isset($repas) AND !empty($repas)) : ?>
	<!-- contenu des repas -->
	<div id="bloc-editeur" style="margin-top:50px;">
	<?php
	$limit = 50;
	$i=0;
	$dateAncienne = array();
	foreach ($repas as $r) {
		if ($i == $limit) break;
		$dateActu = $r['Suivialimentaire']['created'];
		$date = explode(" ", $dateActu);
		$date = $date[0];
		if (!in_array($date,$dateAncienne)) {
			if ($i != 0) {
				echo '</ul><br><br><center><h1>'. dateenlettre($date) .'</h1></center><ul>';
			} else {
				echo '<center><h1>'. dateenlettre($date) .'</h1></center><ul>';
			}
		} 
		$dateAncienne[] = $date;
		if (!empty($r['Aliment'])) $texte = '<li>' . $r['Suivialimentaire']['quantite'] .'x '. $r['Aliment']['Aliment']['nomFR'] . ', portion : ' . $r['Suivialimentaire']['nomPortion'] . ', au ';
		else $texte = '<li>' . $r['Suivialimentaire']['quantite'] .'x '. $r['Alimhorsclassification']['nom'] . ', portion : ' . $r['Suivialimentaire']['nomPortion'] . ', au ';
		$portions = explode("@",$r['Suivialimentaire']['nomSA']);
		foreach ($portions as $port) {
			$texte = $texte . $port . '/';
		}
		$texte = substr($texte,0,strlen($texte)-1);
		$texte = $texte . '</li>';
		echo '<div id=\'no-format\'>';
		echo '<div class=\'p1\'>'. $texte . ' </div>';
		echo '</div>';
		$i++;
	}
	?></ul>
	<?php if (count($repas) == 25) : ?><br /><hr /><br /><center><div style="font-style:italic; color:green">25 résultats maximum affichés, veuillez rétrécir l'espace entre les deux dates.</div></center><?php endif; ?>
	</div>
	
	<?php endif; ?>
</div>
<script>
	$(function() {
		$( "#datedebut" ).datepicker({
			dateFormat: "yy-mm-dd", 
			changeMonth: true, 
			changeYear: true,
			minDate: "-100Y", 
			maxDate: "0",
			showOtherMonths: true,
      		selectOtherMonths: true,
      		defaultDate: "-1Y",
      		yearRange: "c-101:c"
		});
	});
	$(function() {
		$( "#datefin" ).datepicker({
			dateFormat: "yy-mm-dd", 
			changeMonth: true, 
			changeYear: true,
			minDate: "-100Y", 
			maxDate: "0",
			showOtherMonths: true,
      		selectOtherMonths: true,
      		defaultDate: "0Y",
      		yearRange: "c-101:c"
		});
	});
</script>
<script type="text/javascript">
function validPost() {
	regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
	if (!(regex.test(document.getElementById("datedebut").value))) {
		alert("la date de debut est invalide, elle doit être sous format 'YYYY-MM-DD'");
		return false;
	}
	if (!(regex.test(document.getElementById("datefin").value))) {
		alert("la date de fin est invalide, elle doit être sous format 'YYYY-MM-DD'");
		return false;
	}
	
	var birthday = new Date(document.getElementById("datedebut").value);
	var birthday2 = new Date(document.getElementById("datefin").value);
	var today = new Date();
	var age = today.getFullYear() - birthday.getFullYear();
	var age2 = today.getFullYear() - birthday2.getFullYear();

	// Reset birthday to the current year.
	birthday.setFullYear(today.getFullYear());
	birthday2.setFullYear(today.getFullYear());

	// If the user's birthday has not occurred yet this year, subtract 1.
	if (today < birthday)
	{
	    age--;
	}
	if (today < birthday2)
	{
	    age2--;
	}
	if (age < 0) {
		alert("La date de debut ne peut être supérieure à la date d'aujourd'hui !");
		return false;
	}
	if (age2 < 0) {
		alert("La date de fin ne peut être supérieure à la date d'aujourd'hui !");
		return false;
	}
	if (document.getElementById("datedebut").value == document.getElementById("datefin").value) {
		alert("Les deux dates ne doivent pas être les mêmes !");
		return false;
	} else if (document.getElementById("datedebut").value > document.getElementById("datefin").value) {
		alert("La date de début ne peut être supérieure à la date de fin !");
		return false;
	}
	return true;
}
</script>