<div id="presentation">

<?php if (AuthComponent::user('role') != 'dieteticien') : ?>
	<!-- Accès seulement aux diététiciens -->
	<?php echo $this->Html->link('<< Retour', '/pages/home');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
<?php elseif(isset($_POST['suivi1']) ) : ?>
	<!-- CINQ OBJECTIFS -->
	<?php echo $this->Html->link('<< Retour', '/demandes/suivis/');?>
	<?php if (empty($client['Cinqobjectif'])) : ?>
		<?php echo '<h1 align="center">Votre client ne s\'est pas encore fixé des objectifs</h1>'; ?>
	<?php else : ?>
		<div class="span2" align = "center" style="margin-left:225px">Objectifs de <?php echo $client['User']['username']; ?> :</div>
		<div class="span2" style="margin-left:270px">Objectifs</div>
		<div class="span3"style="margin-left:770px">Conseils</div>
			<div id="contenu_obj">
				<table class="fixed">
				<col width="500px" />
				<col width="500px" />
				<?php 
				$i = count($client['Cinqobjectif']);
				foreach ($client['Cinqobjectif'] as $obj) :
				$i--;
				?>
				<tr>
					<td style="border-right:1px dotted #4D2B08;<?php if ($i != 0) echo 'border-bottom:1px dotted #4D2B08;';?>">
						<?php
						echo '<strong>'.dateenlettre($obj['created']).'</strong><br><br>';
						echo $obj['description'] . '<br><br>';
						?>
					</td>
					<td style="font-style: italic;<?php if ($i != 0) echo 'border-bottom:1px dotted #4D2B08;';?>">
						<?php 
						if (!empty($obj['conseil'])) {
							echo $obj['conseil'] . '<br><br>';
							echo $this->Html->link('<input type="button" value="Modifier">', '/demandes/editConseil/'.$obj['id'] . '/' . $client['User']['id'] , array('escape' => false,'title' => 'Modifier le conseil'));
							echo $this->Html->link('<input type="button" value="Supprimer">', '/demandes/deleteConseil/'.$obj['id'] . '/' . $client['User']['id'], array('escape' => false,'title' => 'Supprimer le conseil'));
						} else {
							echo $this->Html->link('<input style="width:150px;" type="button" value="Ajouter un conseil">', '/demandes/addConseil/'.$obj['id'] . '/' . $client['User']['id'], array('escape' => false,'title' => 'Ajouter un conseil'));
						}
						
						?>
					</td>
				</tr>
				<?php endforeach; ?>
				</table>
			</div>
		</div>
	<?php endif; ?>
	<!-- FIN CINQ OBJECTIFS -->
<?php elseif(isset($_POST['suivi2']) ) : ?>
	<!-- SUIVI ALIMENTAIRE -->
	<?php echo $this->Html->link('<< Retour', '/demandes/suivis/');?>
	<div class="span2">Suivi alimentaire de <?php echo $client['User']['username']; ?> :</div>
	<div id="bloc-editeur">
	
	<p>Objectif protéines : <?php echo $obPro; ?> g</p>
	<?php if (!empty($fix_proteines)) : ?>
		<p style="color:red;">Vous lui avez fixé  <?php echo $fix_proteines; ?> g (avec <?php echo $fix_p_valeur;?> g/kg/j)</p>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Modifier l\'objectif">', '/demandes/editObjectif/'.$id_proteines.'/' . $client['User']['id'] , array('escape' => false,'title' => 'Modifier l\'objectif')); ?>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Supprimer l\'objectif">', '/demandes/deleteObjectif/'.$id_proteines.'/' . $client['User']['id'] , array('escape' => false,'title' => 'Supprimer l\'objectif')); ?>
	<?php else : ?>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Modifier son objectif">', '/demandes/addObjectif/1/' . $client['User']['id'] , array('escape' => false,'title' => 'Modifier son objectif')); ?>
	<?php endif; ?>
	<br><br><hr />
	
	<p>Objectif lipides : <?php echo $obLip; ?> g</p>
	<?php if (!empty($fix_lipides)) : ?>
		<p style="color:red;">Vous lui avez fixé  <?php echo $fix_lipides; ?> g (avec <?php echo $fix_l_valeur * 100;?>% comme pourcentage d’énergie apportée)</p>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Modifier l\'objectif">', '/demandes/editObjectif/'.$id_lipides.'/' . $client['User']['id'] , array('escape' => false,'title' => 'Modifier l\'objectif')); ?>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Supprimer l\'objectif">', '/demandes/deleteObjectif/'.$id_lipides.'/' . $client['User']['id'] , array('escape' => false,'title' => 'Supprimer l\'objectif')); ?>
	<?php else : ?>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px; " type="button" value="Modifier son objectif">', '/demandes/addObjectif/2/' . $client['User']['id'] , array('escape' => false,'title' => 'Modifier son objectif')); ?>
	<?php endif; ?>
	<br><br><hr />
	
	<p>Objectif fibres : <?php echo $obFib; ?> g</p>
	<?php if (!empty($fix_fibres)) : ?>
		<p style="color:red;">Vous lui avez fixé  <?php echo $fix_fibres; ?> g </p>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Modifier l\'objectif">', '/demandes/editObjectif/'.$id_fibres.'/' . $client['User']['id'] , array('escape' => false,'title' => 'Modifier l\'objectif')); ?>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Supprimer l\'objectif">', '/demandes/deleteObjectif/'.$id_fibres.'/' . $client['User']['id'] , array('escape' => false,'title' => 'Supprimer l\'objectif')); ?>
	<?php else : ?>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Modifier son objectif">', '/demandes/addObjectif/3/' . $client['User']['id'] , array('escape' => false,'title' => 'Modifier son objectif')); ?>
	<?php endif; ?>
	<br><br><hr />
	
	<p>Objectif sel : <?php echo $obSel; ?> mg</p>
	<?php if (!empty($fix_sel)) : ?>
		<p style="color:red;">Vous lui avez fixé  <?php echo $fix_sel; ?> mg </p>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Modifier l\'objectif">', '/demandes/editObjectif/'.$id_sel.'/' . $client['User']['id'] , array('escape' => false,'title' => 'Modifier l\'objectif')); ?>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Supprimer l\'objectif">', '/demandes/deleteObjectif/'.$id_sel.'/' . $client['User']['id'] , array('escape' => false,'title' => 'Supprimer l\'objectif')); ?>
	<?php else : ?>
		<?php echo $this->Html->link('<input style="width:160px;margin-top:10px;margin-left:0px" type="button" value="Modifier son objectif">', '/demandes/addObjectif/4/' . $client['User']['id'] , array('escape' => false,'title' => 'Modifier son objectif')); ?>
	<?php endif; ?>
	</div>
<?php endif; ?>
</div>