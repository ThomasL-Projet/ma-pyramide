<?php 
	echo $this->Form->create('Alimhorsclassification');
?>
<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/alimenthorsclassification/');?>
<div id="bloc-editeur">
	<h1 align="center" style="color:#A6BC2A;">Ajouter un aliment hors classification</h1><br /><br />
	<hr />
	<center><div style="font-style:italic; font-size:1.2em">Informations concernant l'aliment</div></center>
	<hr />
	<br /><br />
	<div style="margin-bottom:-30px;"><p> Nom de l'aliment :</p></div>
	<input style="margin-left:220px" type="text" maxlength="50" id="saisie1" value="<?php if(isset($alimhorsclass)) echo $alimhorsclass['Alimhorsclassification']['nom']; ?>" required="required" name="data[Mesrecette][nom]" /><br><br><br>
	<div style="margin-bottom:-30px;"><p> Origine de l'aliment :</p></div>
	<input style="margin-left:220px" type="text" maxlength="50" id="saisie2" value="<?php if(isset($alimhorsclass)) echo $alimhorsclass['Alimhorsclassification']['origine']; ?>" required="required" name="data[Mesrecette][origine]" /><br><br><br>
	<div style="margin-bottom:-30px;"><p> Portion de l'aliment (en g) :</p></div>
	<input style="margin-left:220px" type="text" maxlength="5" id="saisie3" value="<?php if(isset($alimhorsclass)) echo $alimhorsclass['Alimhorsclassification']['portion']; else echo '100'; ?>" required="required" name="data[Mesrecette][portion]" onchange="changePortion()" /><br><br><br>
	<div style="margin-bottom:-30px;"><p> Description :</p></div>
	<textarea style="margin-left:220px; width:530px" id="saisie4" rows="6" cols="70" name="data[Mesrecette][description]" title="La description doit faire entre 1 et 500 caractètres" maxlength="500"><?php if(isset($alimhorsclass)) echo $alimhorsclass['Alimhorsclassification']['description']; ?></textarea><br><br><br>
	<hr />
	<center><div style="font-style:italic; font-size:1.2em">Informations concernant les ingrédients</div>
	<div style="color:green; font-style:italic;">Remplir avec ce qu’il y a sur l’étiquette de l'aliment, si vous avez ajouté une ligne par erreur, ne la remplissez pas pour ne pas qu'elle soit prise en compte</div></center>
	<hr />
	<br /><br />
	<div id="affichrec">
	<table style="width:750px" id="insert">
	<tr>
		<td width=50%><div style="margin-top:10px; margin-bottom:10px;"><strong>Saisissez le nom de l'ingrédient</strong></div></td>
		<td width=50%><strong>Saisissez la quantité associée (si présente) en %</strong></td>
	</tr>
	<?php if(isset($alimhorsclass['Alimhorsingrediant'])) { $i = 0; foreach ($alimhorsclass['Alimhorsingrediant'] as $alim) : ?>
	<tr>
		<td>
			<input style="margin-left:70px; margin-top:10px; margin-bottom:10px" type="text" maxlength="20" id="alimnom<?php echo $i; ?>" value="<?php echo $alim['nom']; ?>" name="Ingrediant[<?php echo $i; ?>][nom]" />
		</td>
		<td><input style="margin-left:50px; margin-top:10px; margin-bottom:10px" type="text" maxlength="3" id="alimqua<?php echo $i; ?>" value="<?php echo $alim['quantite']; ?>" name="Ingrediant[<?php echo $i; ?>][quantite]" /><div style="margin-top:14px;">%</div></td>
	</tr>
	<?php $i++; endforeach; } ?>
	<tr>
		<td><input style="margin:0px; margin-left:90px; margin-top:10px; margin-bottom:10px; width:180px;" type="button" value="Ajouter une ligne" id="ajoute" onclick="addLigne()" /></td>
		<td></td>
	</tr>
	</table>
	</div><br /><br /><br />
	<hr />
	<center><div style="font-style:italic; font-size:1.2em">Informations concernant les nutriments</div>
	<div style="color:green; font-style:italic;">Remplir avec ce qu’il y a sur l’étiquette de l'aliment</div></center>
	<hr />
	<br /><br />
	<div id="affichrec">
	<table style="width:750px">
	<tr>
		<td width=50%><strong>Nutriment</strong></td>
		<td width=25%><strong>Valeur pour 100g (en g)</td>
		<td width=25% id="descriport"><strong>Valeur pour <?php if(isset($alimhorsclass)) echo $alimhorsclass['Alimhorsclassification']['portion']; else echo '100';?>g</td>
	</tr>
	<?php for ($j = 0; $j < 57; $j++) : ?>
	<tr>
		<td>
			<div id="textep<?php echo $j; ?>" style="margin-top:10px; margin-bottom:10px;"><?php echo $descri[$j]['constituantaliments']['name']?></div>
		</td>
		<td><input style="width:70px; margin-left:45px; margin-top:10px; margin-bottom:10px" type="text" maxlength="6" id="nutri<?php echo $j; ?>" value="<?php if(isset($nutri)) echo $nutri[$j]; else echo '0'; ?>" name="Nutri[<?php echo $j; ?>]" onchange="actuVals(<?php echo $j; ?>)" /></td>
		<td>
		<div style="font-style:italic" id="nutrival<?php echo $j; ?>"><?php if(isset($alimhorsclass)) echo $nutri[$j] * $alimhorsclass['Alimhorsclassification']['portion']/100; else echo '0'; ?></div>
		</td>
	</tr>
	<?php endfor; ?>
	</table>
	</div><br /><hr /><br />
	<input style="margin:0px;alter:left; width:180px; margin-left:70px" type="submit" id="endform" name="endform" value="Ajouter l'aliment" onclick="return validForm();" /><br>
	<input style="margin:0px; margin-top:-30px; width:180px; margin-left:280px;" type="button" id="reset" value="Réinitialiser les champs" onclick="resetChamps();" /></a>
	<?php echo $this->Html->link('<input style="margin:0px; margin-top:-30px; margin-left:490px; width:180px" type="button" value="Annuler" />', '/alimenthorsclassification/', array('escape' => false)); ?>
</div>
</div>

<script type="text/javascript">
var i = <?php if(isset($i)) echo $i; else echo '0'; ?>;
var basei = <?php if(isset($i)) echo $i; else echo '0'; ?>;
var baseQuantite = <?php if(isset($alimhorsclass)) echo $alimhorsclass['Alimhorsclassification']['portion']; else echo '100';?>;
function addLigne() {
	i = i + 1;
	if (i == 21) {
		alert("Nombre maximum de 20 aliments atteint.");
		return;
	}
	var tab = document.getElementById('insert');
	var newRow = tab.insertRow(tab.rows.length-1);
	var newCell = newRow.insertCell(0);
	newCell.innerHTML = '<input style="margin-left:70px; margin-top:10px; margin-bottom:10px" type="text" maxlength="20" id="alimnom'+ i +'" name="Ingrediant['+ i +'][nom]" />';
	
	newCell = newRow.insertCell(1);
	newCell.innerHTML = '<input style="margin-left:50px; margin-top:10px; margin-bottom:10px" type="text" maxlength="3" id="alimqua'+ i +'" name="Ingrediant['+ i +'][quantite]" /><div style="margin-top:14px;">%</div></td></tr>';
}

function actuVals(id) {
	regex = /^[0-9]{1,6}$/;
	var ok = true;
	var newPortion;
	if (!(regex.test(document.getElementById('nutri'+ id).value))) {
		document.getElementById('nutri'+ id).value = 0;
	}
	var portionSaisie = document.getElementById("saisie3").value;
	regex = /^[0-9]{1,5}$/;
	if (!(regex.test(document.getElementById("saisie3").value))) {
		ok = false;
	}
	for (var j = 0; j < 57; j++) {
		if (ok) document.getElementById('nutrival' +id).innerHTML = document.getElementById('nutri' + id).value * document.getElementById("saisie3").value / 100;
	}
}

function changePortion() {
	regex = /^[0-9]{1,5}$/;
	var ok = true;
	var newPortion;
	if (!(regex.test(document.getElementById("saisie3").value))) {
		ok = false;
	}
	if (ok) {
		newPortion = document.getElementById("saisie3").value;
	} else {
		newPortion = '<strong>La valeur saisie dans "portion" n\'est pas un entier</strong>';
	}
	var contenu;
	contenu = document.getElementById('descriport').innerHTML;
	if (contenu == '<strong>La valeur saisie dans "portion" n\'est pas un entier</strong>') {
		contenu = '<strong>Valeur pour 100g</strong>';
		baseQuantite = 100;
	}
	if (ok) { 
		contenu = contenu.replace(baseQuantite + 'g', newPortion + 'g'); 
		baseQuantite = newPortion;
	} else {
		contenu = newPortion;
	}
	
	document.getElementById('descriport').innerHTML = contenu;
	
	for (var j = 0; j < 57; j++) {
		if (ok) document.getElementById('nutrival' +j).innerHTML = document.getElementById('nutri' + j).value * newPortion / 100;
		else document.getElementById('nutrival' +j).innerHTML = 'Erreur saisie portion';
	}
}

function validForm() {
	regex = /^[0-9]{1,5}$/;
	if (!(regex.test(document.getElementById("saisie3").value))) {
		alert("Erreur, la portion de l'aliment n'est pas un entier.");
		return false;
	}
	regex = /^[0-9]{1,3}$/;
	var tab = document.getElementById('insert');
	var champ;
	for (var j=0; j <i+1; j++) {
		if (j==basei) continue;
		champ = document.getElementById('alimqua' + j);
		if (champ.value.length != 0 && !(regex.test(champ.value)) || (champ.value.length != 0 && champ.value > 100)) {
			alert("Erreur, une des quantités d'un des ingrédients n'est pas un entier compris entre 0 et 100.");
			return false;
		}
	}
	return true;
}

function resetChamps() {
	if (confirm("Confirmez-vous de vouloir réinitialiser les champs ? Les informations concernant les nutriments seront toutes à zero.")) {
		for (var j=0; j <i+1; j++) {
			if (j==basei) continue;
			document.getElementById('alimqua' + j).value="";
			document.getElementById('alimnom' + j).value="";
		}
		document.getElementById('saisie1').value="";
		document.getElementById('saisie2').value="";
		document.getElementById('saisie3').value="100";
		document.getElementById('saisie4').value="";
		for (var j = 0; j < 57; j++) {
			document.getElementById('nutri' +j).value = "0";
		}
		changePortion();
	}
}
</script>