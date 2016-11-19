<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/pages/jackpotsante');?>
	<div id="image">
	</div>
	
    <div class="texte">
		<div class="span2"> Aliments hors classification </div> 
		
		<div class="p1">Personnalisez vos aliments achetés dans le commerce et non répertoriés dans notre classification.<br>Ajoutez-en, modifiez-en ou supprimez-en et vous pourrez les ajouter dans le suivi alimentaire.
		</div>
	</div><br>
<div id="bloc-editeur">
	<h1 align="center">Mes aliments</h1>
	
	<div id="tabrecette">
	<?php echo $this->Html->link('<input type="button" value="Ajouter un aliment" />', '/alimenthorsclassification/add/', array('escape' => false));?>
	<br /><br />
	<hr />
	<?php if (empty($alimhorsclass)) echo '<br /><center><div style="font-style:italic; font-size:1.2em; color:green">Vous n\'avez pas encore entré des aliments, cliquez sur ajouter pour en ajouter.</div></center>'; ?>
	<?php $i = count($alimhorsclass); foreach ($alimhorsclass as $alim) : ?>
	<table style="width:720px">	
	<tr>
		<th width=40%>Nom de l'aliment</th>
		<th width=15%>Portion</th>
		<th width=45%>Actions</th>
	</tr>
	<tr>
		<td><?php echo $this->Html->link($alim['Alimhorsclassification']['nom'], '/alimenthorsclassification/afficher/' . $alim['Alimhorsclassification']['id'], array('escape' => false));?></td>
		<td><?php echo $alim['Alimhorsclassification']['portion'] . 'g'; ?></td>
		<td><div class="boutplusgros">
		<?php echo $this->Html->link('<input class="boutplusgros" style="margin-top: 5px" type="button" value="Modifier" />', '/alimenthorsclassification/edit/' . $alim['Alimhorsclassification']['id'], array('escape' => false));?>
		<?php echo $this->Html->link('<input type="button" value="Afficher" />', '/alimenthorsclassification/afficher/' . $alim['Alimhorsclassification']['id'], array('escape' => false));?>
		<?php echo $this->Html->link('<input type="button" value="Ajouter au suivi alimentaire" />', '/alimenthorsclassification/addsuiv/' . $alim['Alimhorsclassification']['id'], array('escape' => false));?>
		<?php echo $this->Html->link('<input style="margin-bottom: 5px" type="button" value="Supprimer" />', '/alimenthorsclassification/delete/' . $alim['Alimhorsclassification']['id'], array('escape' => false));?>
		</div>
		</td>
	</tr>
	
	</table>
	<?php if ($i != 1) : ?><br /><hr /><br /> <?php else : echo '<br />'; endif; $i--; ?>
	<?php endforeach; ?>
	</div>
</div>
</div>