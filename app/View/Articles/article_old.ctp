<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/pages/home/');?>
<div id="bloc-editeur">

	<h1><?php echo $article['Article']['title'] ?></h1>
	<h2 id="titreCategorie"> (Catégorie : <?php echo $article['Category']['name'] ?>)</h2>
	<!-- Permet de préciser les dates de création et de modification de l'article ainsi que le contenu de ce dernier-->
	<h5>
		<?php 
			$temp = explode("-", $article['Article']['created']); 
			$heur = explode(" ", $temp[2]);
			$heure = $heur[1];
			$dat = explode(" ", $temp[2]);
			$date = $dat[0] . '-' . $temp[1] . '-' . $temp[0];
		?>
		<div id="datesArticles">Création : <?php echo $date . ' à ' . $heure ?></div>
		<?php 
			$temp = explode("-", $article['Article']['created']); 
			$heur = explode(" ", $temp[2]);
			$heure = $heur[1];
			$dat = explode(" ", $temp[2]);
			$date = $dat[0] . '-' . $temp[1] . '-' . $temp[0];
		?>
		<?php if (!empty ($article['Article']['modified'])) 
			echo "<div id=\"datesArticles\">Dernière modification : ". $date . ' à ' . $heure ."</div>"
		?>
	</h5>

	<div id='no-format'>
		<?php echo "<div class='p1'>".$article['Article']['content']."</div>" ?>
	</div>
</div>
</div>