<div id="presentation">
<?php
if (AuthComponent::user('role') == 'administrateur') : ?>
	<?php echo $this->Html->link('<< Retour', '/pages/choixphoto/');?>
<div class="bloc1" style="width:780px">	
	<h1>Modifications des photos</h1>
<?php echo $this->Form->create('Photo', array('type' => 'file')); ?>
<?php echo '<br/><br/>' ?>
<?php echo $this->Form->input('id', array('label' => 'Selectionner le numéro de l\'image à modifier' ,'options' => array(1, 2, 3, 4), 'id' => 'choixId', 'onChange' => 'Choix(this.value)','selected' => '0')); ?>
<?php echo '<br/><br/><br/><br/>' ?>
<?php echo $this->Html->image('aide_photos.jpg', array('style' => 'margin-left:140px')); ?>
	<?php echo $this->Form->input('titre', array('label' => "Titre ", 'id' => 'titre', 'value' => $titre1)); ?>
	<?php echo '<br/><br/><br/><br/>' ?>
	<?php echo $this->Form->input('description', array('label' => "Description", 'type' => 'textarea','id' => 'description','value' => $description1)); ?>
	<?php echo '<br/><br/>' ?>
	<?php echo $this->Form->input('photo_file', array('label' => 'Votre image au format JPEG ou PNG' , 'type' => 'file')); ?>
	<?php echo '<br/><br/>' ?><br />
<input type="submit" value="Editer" style="margin:0px;margin-left:250px;" /><br />
<?php echo $this->Html->link('<input type="button" name="retour" style="margin:0px;margin-left:400px; margin-top:-30px" value="Retour" >', '/pages/choixphoto/', array('escape' => false));?>

</div>

<script type="text/javascript">

function Choix(formulaire) {
	
var i = document.getElementById('choixId').selectedIndex+1;


switch (i) {
case 1 : 
document.getElementById("titre").value = '<?php echo $titre1; ?>'
document.getElementById("description").value = '<?php echo $description1; ?>'
		 break;
case 2 : 
document.getElementById("titre").value = '<?php echo $titre2; ?>'
document.getElementById("description").value = '<?php echo $description2; ?>'
		 break;
case 3 : 
document.getElementById("titre").value = '<?php echo $titre3; ?>'
document.getElementById("description").value = '<?php echo $description3; ?>'
		 break;
case 4 : 
document.getElementById("titre").value = '<?php echo $titre4; ?>'
document.getElementById("description").value = '<?php echo $description4; ?>'
		 break;

}


}

// Fin -->
</script>
<?php else : ?>
<?php echo $this->Html->link('<< Retour', '/pages/home');?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
<?php endif; ?>
</div>