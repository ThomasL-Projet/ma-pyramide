<div id="bloc-editeur">
	<h2><?php echo $image['Image']['titre'] ?></h2>
	<div id='no-format'>
		<?php echo "<div class='p1'>".$image['Image']['description']."</div>" ?>
	</div>
	<?php echo $this->Html->image('urls/1001.jpg', array('width' => '100', 'height' => '100','alt' => $contenu)); ?>

</div>