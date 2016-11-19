<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/pages/jackpotsante');?>
	<div id="image">
	</div>
	
    <div class="texte">
		<!-- Cette page est accessible à partir du supertracker : Cliquez sur "Ressources" -> "Super Traqueur" -> "Suivi Alimentaire" -->
		<div class="span2"> Mes recettes </div> 
		
		<div class="p1">Personnalisez vos recettes en combinant des aliments.<br>Ajoutez-en, modifiez-en, ou supprimez-en
		</div>
	</div><br>
<div id="bloc-editeur">
	<h1 align="center">Mes recettes</h1>
	
	<div id="tabrecette">
	<?php echo $this->Html->link('<input type="button" value="Analyser une recette" />', '/mesrecettes/add/', array('escape' => false));?>
	<br /><br />
	<hr />
	<?php if (empty($recettes)) echo '<br /><center><div style="font-style:italic; font-size:1.2em; color:green">Vous n\'avez pas encore de recettes, cliquez sur analyser pour en créer.</div></center>'; ?>
	<?php $i = count($recettes); foreach ($recettes as $recette) : ?>
	<table style="width:720px">	
	<tr>
		<th width=30%>Nom de la recette</th>
		<th width=20%>Type de recette</th>
		<th width=15%>Portions</th>
		<th width=35%>Actions</th>
	</tr>
	<tr>
		<td><?php echo $this->Html->link($recette['Mesrecette']['nom'], '/mesrecettes/afficher/' . $recette['Mesrecette']['id'], array('escape' => false));?></td>
		<td><?php echo $recette['Famillealiment']['subcategory']; ?></td>
		<td><?php 
		if ($recette['Mesrecette']['quantite'] == 0.5) {
			echo '&frac12';
		} elseif ($recette['Mesrecette']['quantite'] == 1.5) {
			echo '1 &frac12';
		} elseif ($recette['Mesrecette']['quantite'] == 2.5) {
			echo '2 &frac12';
		} elseif ($recette['Mesrecette']['quantite'] == 3.5) {
			echo '3 &frac12';
		} else {
			echo $recette['Mesrecette']['quantite'];
		}
		 ?></td>
		<td>
		<?php echo $this->Html->link('<input style="margin-top: 5px" type="button" value="Modifier" />', '/mesrecettes/edit/' . $recette['Mesrecette']['id'], array('escape' => false));?>
		<?php echo $this->Html->link('<input type="button" value="Afficher" />', '/mesrecettes/afficher/' . $recette['Mesrecette']['id'], array('escape' => false));?>
		<?php echo $this->Html->link('<input style="margin-bottom: 5px" type="button" value="Supprimer" />', '/mesrecettes/delete/' . $recette['Mesrecette']['id'], array('escape' => false));?>
		
		</td>
	</tr>
	
	</table>
	<?php if ($i != 1) : ?><br /><hr /><br /> <?php else : echo '<br />'; endif; $i--; ?>
	<?php endforeach; ?>
	</div>
</div>
</div>