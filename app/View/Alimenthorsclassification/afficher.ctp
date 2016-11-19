<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Aliments non classifiés : '.$alimhorsclass['Alimhorsclassification']['nom']);
?>
<div class="row">
    <div class="small-12 columns">
<?php echo $this->Html->link('<< Retour', '/alimenthorsclassification/');?>
<?php if (!$affichage) : ?>
	<!-- Url incorrecte -->
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
<?php else : ?>
<div id="bloc-editeur">
	<h1 align="center" style="color:#A6BC2A;">Aliment "<?php echo $alimhorsclass['Alimhorsclassification']['nom']; ?>"</h1><br /><br />
	<hr />
	<center><div style="font-style:italic; font-size:1.2em">Informations concernant l'aliment</div></center>
	<hr />
	<br /><br />
	<div id="affichrec">
	<table style="width:750px">
	<tr>
		<td width=40%>Nom de l'aliment :</td>
		<td width=60%><?php echo $alimhorsclass['Alimhorsclassification']['nom']; ?></td>
	</tr>
	<tr>
		<td>Origine de l'aliment :</td>
		<td><?php echo $alimhorsclass['Alimhorsclassification']['origine']; ?></td>
	</tr>
	<tr>
		<td>Portion de l'aliment (en g) :</td>
		<td><?php echo $alimhorsclass['Alimhorsclassification']['portion']; ?></td>
	</tr>
	<tr>
		<td>Description :</td>
		<td><?php echo $alimhorsclass['Alimhorsclassification']['description']; ?></td>
	</tr>
	</table>
	</div>
	<br><br><br>
	<hr />
	<?php if (isset($alimhorsclass['Alimhorsingrediant']) AND !empty($alimhorsclass['Alimhorsingrediant'])) : ?>
	<center><div style="font-style:italic; font-size:1.2em">Informations concernant les ingrédients</div>
	<hr />
	<br /><br />
	<div id="affichrec">
	<table style="width:750px" id="insert">
	<tr>
		<td width=50%><strong>Nom de l'ingrédient</strong></div></td>
		<td width=50%><strong>Quantité associée en %</strong></td>
	</tr>
	<?php foreach ($alimhorsclass['Alimhorsingrediant'] as $alim) : ?>
	<tr>
		<td>
			<?php echo $alim['nom']; ?>
		</td>
		<td>
			<?php echo $alim['quantite']; ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	</div><br /><br /><br />
	<hr />
	<?php endif; ?>
	<center><div style="font-style:italic; font-size:1.2em">Informations concernant les nutriments</div>
	<hr />
	<br /><br />
	<div id="affichrec">
	<table style="width:750px">
	<tr>
		<td width=50%><strong>Nutriment</strong></td>
		<td width=25%><strong>Valeur pour 100g (en g)</td>
		<td width=25% id="descriport"><strong>Valeur pour <?php echo $alimhorsclass['Alimhorsclassification']['portion']; ?>g</td>
	</tr>
	<?php for ($j = 0; $j < 57; $j++) : ?>
	<tr>
		<td>
			<?php echo $descri[$j]['constituantaliments']['name']?>
		</td>
		<td><?php echo $nutri[$j]; ?></td>
		<td>
		<?php echo $nutri[$j] * $alimhorsclass['Alimhorsclassification']['portion']/100; ?>
		</td>
	</tr>
	<?php endfor; ?>
	</table>
	</div><br /><hr /><br />
	<?php echo $this->Html->link('<input class="button" type="button" value="Retour" />', '/alimenthorsclassification/', array('escape' => false)); ?>
</div>
<?php endif; ?>
</div>
</div>
<script type="text/javascript">
var i = <?php if(isset($i)) echo $i; else echo '0'; ?>;
var basei = <?php if(isset($i)) echo $i; else echo '0'; ?>;
var baseQuantite = <?php echo $alimhorsclass['Alimhorsclassification']['portion']; ?>;
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