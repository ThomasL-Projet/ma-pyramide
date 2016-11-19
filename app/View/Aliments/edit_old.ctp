<?php 
echo $this->Form->create('Aliment', array('type' => 'file'));
?>
	<div id="presentation">
	<!-- Cette page est accessible depuis le menu situé en haut de page. Cliquez sur "Ressources" -> "SuperTracker" -> "Encyclopédie" -->
	    <div id="titre-accueil">
			<span> Modification des photos</span> 
			<p>Effectuez la recherche d'un aliment pour pouvoir modifier/ajouter sa photo.</p> 
			<p>type :</p>
			
			<!-- Liste déroulante permettant à l'utilisateur de choisir dans quelle catégorie d'aliments, se trouve l'aliment qu'il recherche.
			     Cette dernière a pour but de faciliter la recherche. -->
			<!-- type -->
			
			<select name = "rech" id="rech" class="target1">
			<option selected>- Choisissez un type -</option>
			<?php
				foreach($familles as $fam) {
					echo '<option style="font-weight: bold;" value="'.$fam['Alimentsdetaille']['type'].'">' . $fam['Alimentsdetaille']['type'] . '</option>';
				}
			?>
			</select> 
			
			<!-- sous-type -->
			<p id="lab2">sous-type :</p>
			<select name = "rech2" id="rech2" class="target">
			<option></option>
			<?php
				foreach($sous_types as $sous_type) {
					echo '<option value="'.$sous_type['Alimentsdetaille']['sous_type'].'" class = "'. $sous_type['Alimentsdetaille']['type'] .'">' . $sous_type['Alimentsdetaille']['sous_type'] . '</option>';
				}
			?>
			</select> 
			
			<!-- classe -->
			<p id="lab3">classe :</p>
			<select name = "rech3" id="rech3" style = "margin-left:30px" class="target3">
			<?php
				foreach($classes as $classe) {
					echo '<option value="'.$classe['Alimentsdetaille']['classe'].'" class = "'. $classe['Alimentsdetaille']['sous_type'] .'">' . $classe['Alimentsdetaille']['classe'] . '</option>';
				}
			?>
			</select> 
			<!-- sous_classe (possible qu'il n'y en ai pas) -->
			<p id="lab4">sous-classe :</p>
			<select name = "rech4" id="rech4" style = "margin-left:446px; margin-top: -40px" >
			<?php
				foreach($sous_classes as $sous_classe) {
					echo '<option value="'.$sous_classe['Alimentsdetaille']['sous_classe'].'" class = "'. $sous_classe['Alimentsdetaille']['classe'] .'">' . $sous_classe['Alimentsdetaille']['sous_classe'] . '</option>';
				}
			?>
			</select> 
			
			 
	
		</div>
			<!-- BOUTONS valider, refaire une recherche, mes aliments favoris -->
				
			 <input style="margin-left:100px; margin-top: 125px;position:absolute; width:169px" type="submit" name="rechbtn" value="Valider" />	
			 <?php 
				$link = '/aliments/edit/';
				if (isset($aliment1)) $link = $link . $aliment1['Aliment']['id'] . '/';
				
				echo $this->Html->link('<input style="margin-left:100px; margin-top: 165px;position:absolute; height:35px;width:169px" type="button" name="refaire" value="Refaire une recherche" />', $link, array('escape' => false));
			 ?>
			<script language="JavaScript" type="text/javascript">
			$("#rech2").chained("#rech");
				$("#rech3").chained("#rech2");
				$("#rech4").chained("#rech3");
			</script>
			<!-- Zone de texte permettant à l'utilisateur de saisir le nom de l'aliment recherché -->
			<!-- <input type="text" name="zone-aliment" value="" id="zone-aliment" /> <br><br><br> -->

			<!--<input type="submit" value="Rechercher" onClick='return validRecherche();' /> -->
		</div>
		
		<!-- <div id="lien-accueil">
			<a href="?page=supertracker"> Retourner à l'accueil du SuperTracker </a>
		</div> -->
		
	<div id="encyclo">
        	<?php 
					echo '<span> Résultats </span>';
			?>
		<!-- <span> Résultats </span>-->
		<!-- On affiche ici les caractéristique du premier aliment pour lequel l'utilisateur souhaite effectuer une comparaison avec un autre aliment -->
		<div class="bloc-gauche">
			<?php 
				if (isset($resultats)) :
					if (sizeof($resultats) >= 1) {
						echo "<ul>";
						$compteurResultats=0;
						// Ici on peut modifier le nombre de résultats affichés
						foreach ($resultats as $resultat) { $compteurResultats++; if($compteurResultats > 100) {break;} ?>

							<li>
								<?php 
									
										echo $this->Html->link($resultat['Alimentsdetaille']['nom'], '/aliments/edit/' . $resultat['Aliment'][0]['id']);
									
								?>
								
							</li>
				  <?php } 
						echo "</ul>";
					} else {
						echo "Aucun résultat ne correspond à votre recherche";
					}
			 	endif; 
		 	?>	
		</div>

	
            
                <?php if(isset($aliment1)): ?>
		<!-- On affiche ici les caractéristique du second aliment pour lequel l'utilisateur souhaite effectuer une comparaison avec un autre aliment -->
			<div class="bloc-droit"> 		
                               
			   	<div class="titre">
					<?php
						$fichier = $aliment1['Aliment']['chemin'];
						if ($fichier == '') {
							$fichier = 'noimage.jpg';
						}
						if (strlen($aliment1['Alimentsdetaille']['nom']) > 60) {
							echo "<h2>". substr($aliment1['Alimentsdetaille']['nom'], 0,57) ."...</h2>";
						} else {
							echo "<h2>". $aliment1['Alimentsdetaille']['nom']."</h2>";
						}
					?>
					
					<?php
						echo "<p> ____________________________ </p>";
					?>	
                 </div>
				
				<div id="caract" class="choix-portion"> 
				<!-- Ici, l'utilisateur peut chosir la quantité pour laquelle il souhaite effectuer la comparaison -->
				    <?php
						$fichier = $aliment1['Aliment']['chemin'];
						if ($fichier == '') {
							echo '<p> Cet aliment n\'a pas encore de photo associée </p>';
						} else {
							echo "<h2>".$this->Html->link('Ciquer ici pour voir la photo actuelle', '../app/webroot/img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $aliment1['Alimentsdetaille']['nom'], 'escape' => true)) ."</h2>";

						}
						echo "<br/><p><center>______________________________</center></p>";
					?>   
					<p>Selectionez une photo (JPEG,JPG,PNG)</p>
						<?php echo $this->Form->input('chemin_file', array('label' => '' , 'type' => 'file')); ?>
						    <input style=" margin-top: 25px; right:-20px; width:200px; text-align: center;" type="submit" name="modifier" value="Enregistrer les modifications" />
                                        <br/>
				</div> 
                           
            </div>                                        

			
					
				  
		<?php endif; ?>
	</div>
</form>

<div id="retour1" style="margin-left:1060px; position:absolute; margin-top: 970px ">
		<?php echo $this->Html->link('<input type="button" name="retour" value="Retour" >', '/pages/choixphoto', array('escape' => false));?>
</div>

<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>

<script type="text/javascript">

document.getElementById("rech2").style.display = "none";
document.getElementById("rech3").style.display = "none";
document.getElementById("rech4").style.display = "none";
document.getElementById("lab2").style.display = "none";
document.getElementById("lab3").style.display = "none";
document.getElementById("lab4").style.display = "none";

$( ".target1" ).change(function() {
			setTimeout(function(){
				if ($('#rech2>option').length != 1) {
					document.getElementById("rech2").style.display = "block";
					document.getElementById("lab2").style.display = "block";
					$( ".target" ).change(function() {
						setTimeout(function(){
							if ($('#rech3>option').length != 1) {
								document.getElementById("rech3").style.display = "block";
								document.getElementById("lab3").style.display = "block";
								$( ".target3" ).change(function() {
									setTimeout(function(){
										if ($('#rech4>option').length != 1) {
											document.getElementById("rech4").style.display = "block";
											document.getElementById("lab4").style.display = "block";
										} else {
											document.getElementById("rech4").style.display = "none";
											document.getElementById("lab4").style.display = "none";
										}
									}, 500);
								});
							} else {
								document.getElementById("rech3").style.display = "none";
								document.getElementById("lab3").style.display = "none";
							}
						}, 500);
						document.getElementById("rech4").style.display = "none";
						document.getElementById("lab4").style.display = "none";
					});
				}
			}, 500);
			document.getElementById("rech3").style.display = "none";
			document.getElementById("rech4").style.display = "none";
			document.getElementById("lab3").style.display = "none";
			document.getElementById("lab4").style.display = "none";
		});
jQuery(function($){
        $('a.zoombox').zoombox();

        /**
        * Or You can also use specific options
        $('a.zoombox').zoombox({
            theme       : 'zoombox',        //available themes : zoombox,lightbox, prettyphoto, darkprettyphoto, simple
            opacity     : 0.8,              // Black overlay opacity
            duration    : 800,              // Animation duration
            animation   : true,             // Do we have to animate the box ?
            width       : 500,              // Default width
            height      : 500,              // Default height
            gallery     : true,             // Allow gallery thumb view
            autoplay : false                // Autoplay for video
        });
        */
	});
</script>



