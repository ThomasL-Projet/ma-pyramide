<div id="bloc-editeur">
	<h1><?php echo $lien['Lien']['title'] ?></h1>
	<!-- Permet de préciser les dates de création et de modification du lien ainsi que le contenu de ce dernier-->
	<h5>
		<?php 
			$temp = explode("-", $lien['Lien']['created']); 
			$split = explode(" ", $temp[2]);
			$heure = $split[1];
			$split2 = explode(" ", $temp[2]); 
			$date = $split2[0] . '-' . $temp[1] . '-' . $temp[0];
		?>
		<div id="datesArticles">Création : <?php echo $date . ' à ' . $heure ?></div>
		<?php 
			$temp = explode("-", $lien['Lien']['created']); 
			$split = explode(" ", $temp[2]);
			$heure = $split[1];
			$split2 = explode(" ", $temp[2]);
			$date = $split2[0] . '-' . $temp[1] . '-' . $temp[0];
		?>
		<?php if (!empty ($lien['Lien']['modified'])) 
			echo "<div id=\"datesArticles\">Dernière modification : ". $date . ' à ' . $heure ."</div>"
		?>
	</h5>

	<div id='no-format'>
		<?php echo "<div class='p1'>".$lien['Lien']['content']."</div>" ?>
	</div>
</div>