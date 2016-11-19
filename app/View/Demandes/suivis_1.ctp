<?php
echo $this->Form->create(null, array(
						'url' => array('controller' => 'demandes', 'action' => 'analyseSuivi')
						));
?>
<div id="presentation">
<?php if (AuthComponent::user('role') != 'dieteticien') : ?>
	<!-- Accès seulement aux diététiciens -->
	<?php echo $this->Html->link('<< Retour', '/pages/home');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
<?php elseif (empty($clients)) : ?>
	<?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
	<h1 align="center">Vous n'avez pas de clients</h1>
<?php else : ?>
	<?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
	<div class="span2">Sélectionnez un de vos clients :</div>
	<div id="bloc-editeur">
		<select style="margin-left: 250px" name="choix">
			<option selected="selected">- Choisissez un client -</option>
			<?php
				foreach ($clients as $client) {
					echo '<option value="'. $client['User']['id'] .'">'. $client['User']['username'] .'</option>';
				}
			?>
		</select>
	</div>
	<div class="span2">Sélectionnez un suivi :</div>
	<div id="bloc-editeur">
		<div id="rechercheAli">
			<?php 
			echo $this->Html->image("accueilFruit.png", array( "height" => "100px", "width" => "100px", "class" => "image"));
			echo '<div class="rech1">';
			echo '<strong>Mes 5 objectifs</strong><br>';
			echo 'Donnez des conseils à votre client';
			echo '<br><br>';
			echo $this->Form->end(array('label'=>'Analyser le suivi','style' => 'width: 180px','name'=>'suivi1')); 
			echo '</div>';
			?>
		</div>
		<hr />
		<div id="rechercheAli">
			<?php 
			echo $this->Html->image("accueilFruit.png", array( "height" => "100px", "width" => "100px", "class" => "image"));
			echo '<div class="rech1">';
			echo '<strong>Suivi alimentaire</strong><br>';
			echo 'Analysez et modifiez les valeurs du suivi alimentaire de vos clients';
			echo '<br><br>';
			echo $this->Form->end(array('label'=>'Analyser le suivi','style' => 'width: 180px','name'=>'suivi2')); 
			echo '</div>';
			?>
		</div>
	</div>
<?php endif; ?>
</div>
</form>