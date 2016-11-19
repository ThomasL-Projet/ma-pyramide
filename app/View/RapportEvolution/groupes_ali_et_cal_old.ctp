<?php echo $this->Form->create('Suivialimentaire'); ?>
<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/rapportEvolution/index/');?>
	<div id="image">
	</div>
    <div class="texte">
		<div class="span3"> Groupes alimentaires et calories </div>
		<div class="p1"> Choisissez une période et vous obtiendrez vos apports moyens en termes de calories et groupes alimentaires
		<br><br>Veuillez entrer une période pour laquelle vous voulez afficher vos résultats :
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
	<center><div class="span2"> Vous n'avez pas ajouté de repas pendant cette période </div> </center>
	</div>
	<?php elseif (isset($repas) AND !empty($repas)) : ?>
	<!-- contenu des repas -->
	<div id="bloc-editeur" style="margin-top:50px;">
	<?php
	echo '<center><h1>Vos apports moyens du '. dateenlettre($debut) .' au '. dateenlettre($fin) . ' (durée de '. $joursDiff .' jours)</h1></center><br><br><ul>';
	
	echo '<li>Nombre moyen de calories consommés : <strong>'. intval($cal) .' kcal</strong></li>';
	echo '<li>Les differents groupes alimentaires et les repas associés : </li><br>';
	$ali = array();
	$famillepass = array();
	$i = 0;
	foreach ($repas as $r) {
		if (!empty( $r['Aliment'])) $ali[$i][0] = $r['Aliment']['Famillealiments']['name'];
		else $ali[$i][0] = "Aliment non classé";
		$ali[$i][1] = $r['Suivialimentaire']['quantite'] * count(explode("@",$r['Suivialimentaire']['nomSA']));
		$i++;
	}
	$ref = array("Divers","Céréales","Sucres","Produits laitiers","Produits protéinés","Matières grasses", "Légumes","Fruits", "Boissons", "Assaisonnements", "Aliment non classé");
	$quantite = array();
	$quantite[0] = 0;
	$quantite[1] = 0;
	$quantite[2] = 0;
	$quantite[3] = 0;
	$quantite[4] = 0;
	$quantite[5] = 0;
	$quantite[6] = 0;
	$quantite[7] = 0;
	$quantite[8] = 0;
	$quantite[9] = 0;
	$quantite[10] = 0;
	foreach ($ali as $a) {
		switch ($a[0]) {
			case 'Divers': $quantite[0] = $quantite[0] + $a[1];
						   break;
			case 'Céréales': $quantite[1] = $quantite[1] + $a[1];
						   break;
			case 'Sucres': $quantite[2] = $quantite[2] + $a[1];
						   break;
			case 'Produits laitiers': $quantite[3] = $quantite[3] + $a[1];
						   break;			   
			case 'Produits protéinés': $quantite[4] = $quantite[4] + $a[1];
						   break;			   
			case 'Matières grasses': $quantite[5] = $quantite[5] + $a[1];
						   break;			   
			case 'Légumes': $quantite[6] = $quantite[6] + $a[1];
						   break;
			case 'Fruits': $quantite[7] = $quantite[7] + $a[1];
						   break;
			case 'Boissons': $quantite[8] = $quantite[8] + $a[1];
						   break;
			case 'Assaisonnements': $quantite[9] = $quantite[9] + $a[1];
						   break;	
			case 'Aliment non classé' : $quantite[10] = $quantite[10] + $a[1];
						   break;
		}
	}
	$i = 0;
	echo '<table>';
	foreach ($quantite as $q) {
		$i++;
		if ($q == 0) continue;
		echo '<tr>';
		echo '<div id=\'no-format\'>';
		
		echo '<td><div class=\'p1\'>'.$ref[$i-1].'</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp<strong>'.intval($q).' repas</strong></td></div>';
		echo '</div>';
		echo '</tr>';
	}
	echo '</table>';
	?></ul>
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