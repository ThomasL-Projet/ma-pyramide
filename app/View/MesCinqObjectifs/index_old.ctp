<?php 
		echo $this->Form->create('Cinqobjectif'); 
		
?>
<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/pages/supertracker/');?>
	<div id="image">
	</div>
<div class="texte">
		<!-- Cette page est accessible à partir du supertracker : Cliquez sur "Mes 5 objectifs"-->
		<h1> Mes 5 objectifs prioritaires </h1> 
		
		<div class="p1">Fixez-vous un ensemble d’objectifs que vous voulez atteindre.
		Vous pouvez choisir et suivre 5 objectifs.
		Votre <strong>Coach virtuel</strong> vous apportera conseils et soutient alors que vous essayez d’atteindre vos objectifs.
		</div>
	</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php if (empty($user['Cinqobjectif'])) : ?>
	<!-- Utilisateur n'a pas d'objectifs -->
	    <div id="titre-accueil">
			<p>Vous ne vous êtes pas encore fixé d'objectifs</p><br><br>
			<p>Fixez-vous un objectif :</p>
		</div>
		<div class="span2" style="margin-top:-200px">Description de votre objectif</div>
			<div id="bloc-editeur" style="margin-top:-150px">
				<textarea rows="6" cols="100" name="com" required="required" title="La description doit faire entre 1 et 300 caractètres" maxlength="300"></textarea>
			</div>
			<div id="bloc11">
				<?php echo $this->Form->end(array('label' => 'Valider','style'=>'margin-left:500px', 'onclick' => 'return validData();')); ?> 
			</div>
		</div>
<?php else : ?>
	<?php if (count($user['Cinqobjectif']) == 5): ?>
		</form>
		<div id="titre-accueil">
			<p>Vous vous êtes fixé 5 objectifs, vous pouvez ici les contempler, les modifiers, ou en supprimer</p><br><br>
		</div>
		<div class="span2" style="margin-left:270px;margin-top:-250px">Vos objectifs</div>
		<div class="span3" style="margin-top:-250px">Conseils de votre dieteticien</div>
			<div id="contenu_obj" style="margin-top:-200px">
				<table class="fixed">
				<col width="500px" />
				<col width="500px" />
	
				<?php 
				$i = count($user['Cinqobjectif']);
				foreach ($user['Cinqobjectif'] as $obj) :
				$i--;
				?>
				<tr>
					<td style="border-right:1px dotted #4D2B08;<?php if ($i != 0) echo 'border-bottom:1px dotted #4D2B08;';?>">
						<?php
						echo '<strong>'.dateenlettre($obj['created']).'</strong><br><br>';
						echo $obj['description'] . '<br><br>';
						echo $this->Html->link('<input type="button" value="Modifier">', '/mesCinqObjectifs/edit/'.$obj['id'], array('escape' => false,'title' => 'Modifier l\'objectif'));
						echo $this->Html->link('<input type="button" value="Supprimer">', '/mesCinqObjectifs/delete/'.$obj['id'], array('escape' => false,'title' => 'Supprimer l\'objectif'));
						?>
					</td>
					<td style="font-style: italic;<?php if ($i != 0) echo 'border-bottom:1px dotted #4D2B08;';?>">
						<?php 
						echo $obj['conseil'];
						?>
					</td>
				</tr>
				<?php endforeach; ?>
				</table>
			</div>
		</div>
	<?php else : ?>
		<div id="titre-accueil">
			<p>Vous pouvez ici ajouter, contempler, modifier ou supprimer vos objectifs</p><br><br>
			<p>Fixez-vous un autre objectif :</p>
		</div>
		<div class="span2" style="margin-top:-200px">Description de votre objectif</div>
			<div id="bloc-editeur" style="margin-top:-150px">
				<textarea rows="6" cols="100" name="com" required="required" title="La description doit faire entre 1 et 300 caractètres" maxlength="300"></textarea>
			</div>
			<div id="bloc11">
				<?php echo $this->Form->end(array('label' => 'Valider','style'=>'margin-left:500px', 'onclick' => 'return validData();')); ?> 
			</div>
		<div class="span2" style="margin-left:270px">Vos objectifs</div>
		<div class="span3">Conseils de votre dieteticien</div>
			<div id="contenu_obj">
				<table class="fixed">
				<col width="500px" />
				<col width="500px" />
	
				<?php 
				$i = count($user['Cinqobjectif']);
				foreach ($user['Cinqobjectif'] as $obj) :
				$i--;
				?>
				<tr>
					<td style="border-right:1px dotted #4D2B08;<?php if ($i != 0) echo 'border-bottom:1px dotted #4D2B08;';?>">
						<?php
						echo '<strong>'.dateenlettre($obj['created']).'</strong><br><br>';
						echo $obj['description'] . '<br><br>';
						echo $this->Html->link('<input type="button" value="Modifier">', '/mesCinqObjectifs/edit/'.$obj['id'], array('escape' => false,'title' => 'Modifier l\'objectif'));
						echo $this->Html->link('<input type="button" value="Supprimer">', '/mesCinqObjectifs/delete/'.$obj['id'], array('escape' => false,'title' => 'Supprimer l\'objectif'));
						?>
					</td>
					<td style="font-style: italic;<?php if ($i != 0) echo 'border-bottom:1px dotted #4D2B08;';?>">
						<?php 
						echo $obj['conseil'];
						?>
					</td>
				</tr>
				<?php endforeach; ?>
				</table>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>
<script type="text/javascript">
function validData() {
	return confirm("Confirmez-vous l'ajout de l'objectif ?");
}
</script>