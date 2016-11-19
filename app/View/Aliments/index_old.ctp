<?php 
echo $this->Form->create('Aliment');



 ?>
	<div id="presentation">
	<!-- Cette page est accessible depuis le menu situé en haut de page. Cliquez sur "Ressources" -> "SuperTracker" -> "Encyclopédie" -->
		<div id="image">
	</div>
	
    <div class="texte">
		<!-- Cette page est accessible à partir du supertracker : Cliquez sur "Ressources" -> "Super Traqueur" -> "Suivi Alimentaire" -->
		<div class="span2"> Encyclopédie </div> 
		
		<div class="p1">Accès rapide à l’information nutritionnelle de plus de 1500 aliments. Choisissez, comparez et ajoutez des aliments à votre repas d'aujourd'hui
		</div>
	</div><br><br><br><br><br><br><br><br><br><br><br><br>
	    <div id="titre-accueil" style="margin-top:80px;margin-left:-200px;">
			<span> Recherche : </span> <br>
			
			<p id="lab1">type :</p>
			
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
			 <input style="margin-left:0px; margin-top: 125px;position:absolute; width:169px" type="submit" name="rechbtn" value="Valider" />	
			 
			 <?php 
				$link = '/aliments/index/';
				if (isset($aliment1)) $link = $link . $aliment1['Aliment']['id'] . '/';
				if (isset($aliment2)) $link = $link . $aliment2['Aliment']['id'] . '/';
				echo $this->Html->link('<input style="margin-left:0px; margin-top: 165px;position:absolute; height:35px;width:169px " type="button" name="refaire" value="Refaire une recherche" />', $link, array('escape' => false));
			 ?>
			 <?php if (isset($user) AND !empty($user['Alimentfavori'])) : ?>
				<input style="margin-left:0px; margin-top: 205px;position:absolute; width:169px" type="submit" name="alifav" value="Mes aliments favoris" />	
			 <?php endif; ?>
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
			if (isset($alimentfavori)) {
				echo '<span> Vos aliments favoris </span>';
			} else {
				echo '<span> Résultats </span>';
			}
		?>
		
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
									if (!isset($aliment1)): 
										echo $this->Html->link($resultat['Alimentsdetaille']['nom'], '/aliments/index/' . $resultat['Aliment'][0]['id']);
									elseif (!isset($aliment2)): 
										echo $this->Html->link($resultat['Alimentsdetaille']['nom'], '/aliments/index/' . $aliment1['Aliment']['id'] .'/' . $resultat['Aliment'][0]['id']);
									else : 
										echo '<a href="#" onClick="alimentsMax();">' . $resultat['Alimentsdetaille']['nom'] . '</a>';
									endif; 
								?>
								
							</li>
				  <?php } 
						echo "</ul>";
					} else {
						echo "Aucun résultat n'est encore disponible pour cette recherche";
					}
			 	endif; 
		 	?>	
		</div>

		<?php if(isset($aliment1)): ?>
		<!-- On affiche ici les caractéristique du second aliment pour lequel l'utilisateur souhaite effectuer une comparaison avec un autre aliment -->
			<div class="bloc-droit"> 
				
				<?php 
					if(isset($aliment2)): 
						echo $this->Html->link('<div class="supprimer"></div>', '/aliments/index/' . $aliment2['Aliment']['id'], array('escape' => false));
					else : 
						echo $this->Html->link('<div class="supprimer"></div>', '/aliments/index/', array('escape' => false));
					endif; 
				?>
				

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
					<div id="clickiciency">
					<?php echo $this->Html->link('Cliquez ici pour voir l\'image', '../app/webroot/img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $aliment1['Alimentsdetaille']['nom'], 'escape' => true)); ?>
						
					</div>
					<?php
						echo "<p> ____________________________ </p>";
					?>	
				</div>
				
				<div class="choix-portion">
				<!-- Ici, l'utilisateur peut chosir la quantité pour laquelle il souhaite effectuer la comparaison -->
				   <p> Choisissez une quantité </p>
				   <select class="quantite" name="quantite" id="quantite">
					   <?php
							if ($quantiteAliment1 == 0.5) {
								echo "<option value='0.5' selected='selected'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5'>1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment1 == 1) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1' selected='selected'>1</option>";
								echo "<option value='1.5'>1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment1 == 1.5) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5' selected='selected'>1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment1 == 2) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5' >1 &frac12;</option>";
								echo "<option value='2' selected='selected'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment1 == 2.5) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5' >1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5' selected='selected'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment1 == 3) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5' >1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3' selected='selected'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment1 == 3.5) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5'>1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5' selected='selected'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} else {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5'>1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4' selected='selected'>4</option>";
							}
						?>
				   </select>
				   <!-- L'utilisateur choisi ici la taille de la portion : "petites portions", "moyennes portions" ou "grandes portions" -->
				    <select class="portion" name="portion" id="portion">
						<?php 
							$split = explode("@",$_POST['portion']);
							$aComparer = $split[0];
							if ($aliment1['Aliment']['P1TypePortion'] != NULL) {
								if ($aliment1['Aliment']['P1Quantite'] == $aComparer) {
									echo '<option value="'. $aliment1['Aliment']['P1Quantite']  .'@'.$aliment1['Aliment']['P1TypePortion'].'" selected=\'selected\'>'. $aliment1['Aliment']['P1TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment1['Aliment']['P1Quantite']  .'@'.$aliment1['Aliment']['P1TypePortion'].'" >'. $aliment1['Aliment']['P1TypePortion'] .'</option>';
								}
							}
							if ($aliment1['Aliment']['P2TypePortion'] != NULL) {
								if ($aliment1['Aliment']['P2Quantite'] == $aComparer) {
									echo '<option value="'. $aliment1['Aliment']['P2Quantite']  .'@'.$aliment1['Aliment']['P2TypePortion'].'" selected=\'selected\'>'. $aliment1['Aliment']['P2TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment1['Aliment']['P2Quantite']  .'@'.$aliment1['Aliment']['P2TypePortion'].'" >'. $aliment1['Aliment']['P2TypePortion'] .'</option>';
								}
							}
							if ($aliment1['Aliment']['P3TypePortion'] != NULL) {
								if ($aliment1['Aliment']['P3Quantite'] == $aComparer) {
									echo '<option value="'. $aliment1['Aliment']['P3Quantite']  .'@'.$aliment1['Aliment']['P3TypePortion'].'" selected=\'selected\'>'. $aliment1['Aliment']['P3TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment1['Aliment']['P3Quantite']  .'@'.$aliment1['Aliment']['P3TypePortion'].'" >'. $aliment1['Aliment']['P3TypePortion'] .'</option>';
								}
							}
							if ($aliment1['Aliment']['P4TypePortion'] != NULL) {
								if ($aliment1['Aliment']['P4Quantite'] == $aComparer) {
									echo '<option value="'. $aliment1['Aliment']['P4Quantite']  .'@'.$aliment1['Aliment']['P4TypePortion'].'" selected=\'selected\'>'. $aliment1['Aliment']['P4TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment1['Aliment']['P4Quantite']  .'@'.$aliment1['Aliment']['P4TypePortion'].'" >'. $aliment1['Aliment']['P4TypePortion'] .'</option>';
								}
							}
							if ($aliment1['Aliment']['P5TypePortion'] != NULL) {
								if ($aliment1['Aliment']['P5Quantite'] == $aComparer) {
									echo '<option value="'. $aliment1['Aliment']['P5Quantite']  .'@'.$aliment1['Aliment']['P5TypePortion'].'" selected=\'selected\'>'. $aliment1['Aliment']['P5TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment1['Aliment']['P5Quantite']  .'@'.$aliment1['Aliment']['P5TypePortion'].'" >'. $aliment1['Aliment']['P5TypePortion'] .'</option>';
								}
							}
							if ($aliment1['Aliment']['P6TypePortion'] != NULL) {
								if ($aliment1['Aliment']['P6Quantite'] == $aComparer) {
									echo '<option value="'. $aliment1['Aliment']['P6Quantite']  .'@'.$aliment1['Aliment']['P6TypePortion'].'" selected=\'selected\'>'. $aliment1['Aliment']['P6TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment1['Aliment']['P6Quantite']  .'@'.$aliment1['Aliment']['P6TypePortion'].'" >'. $aliment1['Aliment']['P6TypePortion'] .'</option>';
								}
							}
							if ($aliment1['Aliment']['P7TypePortion'] != NULL) {
								if ($aliment1['Aliment']['P7Quantite'] == $aComparer) {
									echo '<option value="'. $aliment1['Aliment']['P7Quantite']  .'@'.$aliment1['Aliment']['P7TypePortion'].'" selected=\'selected\'>'. $aliment1['Aliment']['P7TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment1['Aliment']['P7Quantite']  .'@'.$aliment1['Aliment']['P7TypePortion'].'" >'. $aliment1['Aliment']['P7TypePortion'] .'</option>';
								}
							}
							if ($aliment1['Aliment']['P8TypePortion'] != NULL) {
								if ($aliment1['Aliment']['P8Quantite'] == $aComparer) {
									echo '<option value="'. $aliment1['Aliment']['P8Quantite']  .'@'.$aliment1['Aliment']['P8TypePortion'].'" selected=\'selected\'>'. $aliment1['Aliment']['P8TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment1['Aliment']['P8Quantite']  .'@'.$aliment1['Aliment']['P8TypePortion'].'" >'. $aliment1['Aliment']['P8TypePortion'] .'</option>';
								}
							}
						?>
				   </select>
				   
				    <input style="right:-90px" type="submit" name="valider" value="Valider" />		
				</div>
			  	<!-- L'utilisateur peut afficher des informations concernant l'aliment mais aussi les caractéristiques nutritionelles de ce dernier -->
				<div class="onglets-encyclo">
				    <a>Informations nutritionnelles</a>
				</div>
				
				<div class="info-aliment" id='info-aliment1'>
					<div class="scroller">
					
					<table>
					    <tr>
						    <th width=45%> Nutriment </th>
							<th width=10%> Quantité </th>
							<th width=45%> % Valeur quoti-dienne </th>
						</tr>
						 <tr>
						    <td> 
						    	<ul>
						    		<li>
						    			<p class='groupeAlimentaire'>
						    				Calories
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Protéines
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Glucides
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Fibres
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Sucres
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Lipides
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				AG saturés
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				AG mono insaturés
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				AG polyinsaturés
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				A linoléique
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				A alpha - linolénique
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Omega-3 (DHA)
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Omega-3 (EPA)
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Cholestérol
						    			</p>
						    		</li>
						    	</ul>
						    </td>
							<td>  
								<ul>
									<li> 
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][1]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> kcal
										</p>
									</li>
									
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][16]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][18]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][22]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][19]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][23]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][24]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][25]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][26]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][36]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][37]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][40]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][39]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment1['Donneesaliment'][56]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
										</p>
									</li>
								</ul>
							</td>
							<td>  
								<ul>
									<li> 
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment1['Donneesaliment'][1]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obEnKcal)*100,2). ' %';
											?> 
										</p>
									</li>
									
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obPro)) echo round((($aliment1['Donneesaliment'][16]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obPro)*100,2). ' %';
											?> 
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obGlu)) echo round((($aliment1['Donneesaliment'][18]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obGlu)*100,2). ' %';
											?> 
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												/* ND if(isset($obEnKcal)) echo 'ND';*/
												if (isset($obFib)) echo round((($aliment1['Donneesaliment'][22]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obFib)*100,2). ' %';
											?> 
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if(isset($obEnKcal)) echo 'ND'; /*sucres*/
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obLip)) echo round((($aliment1['Donneesaliment'][23]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obLip)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment1['Donneesaliment'][24]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/($obEnKcal * 12 / 100)/9)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if(isset($obEnKcal)) echo 'ND';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if(isset($obEnKcal)) echo 'ND'; /* ag p */
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment1['Donneesaliment'][36]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/($obEnKcal * 4 / 100)/9)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment1['Donneesaliment'][37]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/($obEnKcal * 1 / 100)/9)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment1['Donneesaliment'][40]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/0.25)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment1['Donneesaliment'][39]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/0.25)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if(isset($obEnKcal)) echo 'ND';
											?> 
										</p>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Calcium
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Potassium
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Sodium
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Cuivre
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Fer
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Magnésium
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Phosphore
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Sélénium
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Zinc
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Iode
						    			</p>
						    		</li>
						    	</ul>
						    </td>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][9]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][8]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][5]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][12]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][11]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][10]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][7]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][14]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][13]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][15]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> µg
						    			</p>
						    		</li>
						    	</ul>
						    </td>
							<td> 
						    	<ul>
						    		<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obCal)) echo round((($aliment1['Donneesaliment'][9]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obCal)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obPotass)) echo round((($aliment1['Donneesaliment'][8]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obPotass)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obSel)) echo round((($aliment1['Donneesaliment'][5]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obSel)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obCui)) echo round((($aliment1['Donneesaliment'][12]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obCui)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obFer)) echo round((($aliment1['Donneesaliment'][11]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obFer)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obMagn)) echo round((($aliment1['Donneesaliment'][10]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obMagn)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obPhos)) echo round((($aliment1['Donneesaliment'][7]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obPhos)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obSelenium)) echo round((($aliment1['Donneesaliment'][14]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obSelenium)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obZinc)) echo round((($aliment1['Donneesaliment'][13]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obZinc)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obIod)) echo round((($aliment1['Donneesaliment'][15]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obIod)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
						    	</ul>
						    </td>
						</tr>
						<tr>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine A
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine B6
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine B12
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine C
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine D
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine E
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine K
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Folate (B9)
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Thiamine (B1)
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Riboflavine (B2)
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Niacine (B3, PP)
						    			</p>
						    		</li>
								</ul>
						    </td>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][42]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][51]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][52]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][46]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][43]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][44]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][45]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][53]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][47]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][48]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][49]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> mg
						    			</p>
						    		</li>
								</ul>
						    </td>
							<td> 
						    	<ul>
						    		<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitA)) echo round((($aliment1['Donneesaliment'][42]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitA)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB6)) echo round((($aliment1['Donneesaliment'][51]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitB6)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB12)) echo round((($aliment1['Donneesaliment'][52]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitB12)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitC)) echo round((($aliment1['Donneesaliment'][46]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitC)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitD)) echo round((($aliment1['Donneesaliment'][43]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitD)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitE)) echo round((($aliment1['Donneesaliment'][44]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitE)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitK)) echo round((($aliment1['Donneesaliment'][45]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitK)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB9)) echo round((($aliment1['Donneesaliment'][53]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitB9)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB1)) echo round((($aliment1['Donneesaliment'][47]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitB1)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB2)) echo round((($aliment1['Donneesaliment'][48]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitB2)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB3)) echo round((($aliment1['Donneesaliment'][49]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/$obVitB3)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
								</ul>
						    </td>
						</tr>
						<tr>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Alcool
						    			</p>
						    		</li>
								</ul>
						    </td>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment1['Donneesaliment'][54]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100;
											?> g
						    			</p>
						    		</li>
								</ul>
						    </td>
							<td> 
						    	<ul>
						    		<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obEnKcal)) echo round((($aliment1['Donneesaliment'][54]['valmoy'] * $quantiteAliment1 * $quantitePortion1 / 100)/8.8)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
								</ul>
						    </td>
						</tr>
					</table>
					</div>
					<div class="onglets-encyclo" style="margin-top:3px;">
						<a>Ajouter au repas :</a>
					</div>  
					<div class="choix-portion">
						<!--Ajout aliment-->
						
					<input type="checkbox" name="group1" id="group1" value="Petit d&eacute;jeuner"> Petit d&eacute;jeuner<br>
					<input type="checkbox" name="group2" id="group2" value="D&eacute;jeuner"> D&eacute;jeuner<br>
					<input type="checkbox" name="group3" id="group3" value="Go&ucirc;ter"> Go&ucirc;ter<br>
					<input type="checkbox" name="group4" id="group4" value="D&icirc;ner"> D&icirc;ner<br>
					<input style="right:20px;width:120px;" type="submit" name="repas1" value="Ajouter au repas" onclick="return confirm_ajout_gauche();" />	
					<?php
					if (!isset($user)) {
						echo '<input style="right:-30px; width:120px;" type="submit" name="ajouterfav1" value="Ajouter aux favoris" onclick="return confirm_ajout_fav_gauche();" />';
					} else {
						$estPresent = false;
						foreach ($user['Alimentfavori'] as $fav) {
							if ($aliment1['Aliment'] ['id'] == $fav['idali']) {
								$estPresent = true;
							}
						}
						if ($estPresent) {
							echo '<input style="right:-30px; width:120px;" type="submit" name="retirerfav1" value="Retirer des favoris" onclick="return confirm_retirer_fav_gauche();" />';
						} else {
							echo '<input style="right:-30px; width:120px;" type="submit" name="ajouterfav1" value="Ajouter aux favoris" onclick="return confirm_ajout_fav_gauche();" />';
						}
					}
					?>
					</div>
				</div>	   
				
				
			</div>
					
				  
		<?php endif; ?>
		<?php if(isset($aliment2)): ?>
			<div class="bloc-droit"> 
				  
				<?php echo $this->Html->link('<div class="supprimer"></div>', '/aliments/index/' . $aliment1['Aliment']['id'], array('escape' => false)); ?>
				
			   	<div class="titre">
					<?php
						$fichier = $aliment2['Aliment']['chemin'];
						if ($fichier == '') {
							$fichier = 'noimage.jpg';
						}
						if (strlen($aliment2['Alimentsdetaille']['nom']) > 60) {
							echo "<h2>". substr($aliment2['Alimentsdetaille']['nom'], 0,57) ."...</h2>";
						} else {
							echo "<h2>". $aliment2['Alimentsdetaille']['nom']."</h2>";
						}
					?>
					<div id="clickiciency">
						<?php echo $this->Html->link("Cliquez ici pour voir l'image", '../app/webroot/img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $aliment2['Alimentsdetaille']['nom'], 'escape' => true)); ?>
					</div>
					<?php
						echo "<p> ____________________________ </p>";
					?>				
			    </div>
				
				<div class="choix-portion">
				   <p> Choisissez une quantité </p>
				   <select class="quantite" name="quantite2" id="quantite2">
					   <?php 
							if ($quantiteAliment2 == 0.5) {
								echo "<option value='0.5' selected='selected'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5'>1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment2 == 1) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1' selected='selected'>1</option>";
								echo "<option value='1.5'>1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment2 == 1.5) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5' selected='selected'>1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment2 == 2) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5' >1 &frac12;</option>";
								echo "<option value='2' selected='selected'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment2 == 2.5) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5' >1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5' selected='selected'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment2 == 3) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5' >1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3' selected='selected'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} elseif ($quantiteAliment2 == 3.5) {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5'>1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5' selected='selected'>3 &frac12;</option>";
								echo "<option value='4'>4</option>";
							} else {
								echo "<option value='0.5'>&frac12;</option>";
								echo "<option value='1'>1</option>";
								echo "<option value='1.5'>1 &frac12;</option>";
								echo "<option value='2'>2</option>";
								echo "<option value='2.5'>2 &frac12;</option>";
								echo "<option value='3'>3</option>";
								echo "<option value='3.5'>3 &frac12;</option>";
								echo "<option value='4' selected='selected'>4</option>";
							}
						?>
				   </select>
				   
				    <select class="portion" name="portion2" id="portion2">
						<?php 
							$split = explode("@",$_POST['portion2']);
							$aComparer = $split[0];
							if ($aliment2['Aliment']['P1TypePortion'] != NULL) {
								if ($aliment2['Aliment']['P1Quantite'] == $aComparer) {
									echo '<option value="'. $aliment2['Aliment']['P1Quantite'] .'@'.$aliment2['Aliment']['P1TypePortion'].'" selected=\'selected\'>'. $aliment2['Aliment']['P1TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment2['Aliment']['P1Quantite']  .'@'.$aliment2['Aliment']['P1TypePortion'].'" >'. $aliment2['Aliment']['P1TypePortion'] .'</option>';
								}
							}
							if ($aliment2['Aliment']['P2TypePortion'] != NULL) {
								if ($aliment2['Aliment']['P2Quantite'] == $aComparer) {
									echo '<option value="'. $aliment2['Aliment']['P2Quantite']  .'@'.$aliment2['Aliment']['P2TypePortion'].'" selected=\'selected\'>'. $aliment2['Aliment']['P2TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment2['Aliment']['P2Quantite']  .'@'.$aliment2['Aliment']['P2TypePortion'].'" >'. $aliment2['Aliment']['P2TypePortion'] .'</option>';
								}
							}
							if ($aliment2['Aliment']['P3TypePortion'] != NULL) {
								if ($aliment2['Aliment']['P3Quantite'] == $aComparer) {
									echo '<option value="'. $aliment2['Aliment']['P3Quantite']  .'@'.$aliment2['Aliment']['P3TypePortion'].'" selected=\'selected\'>'. $aliment2['Aliment']['P3TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment2['Aliment']['P3Quantite']  .'@'.$aliment2['Aliment']['P3TypePortion'].'" >'. $aliment2['Aliment']['P3TypePortion'] .'</option>';
								}
							}
							if ($aliment2['Aliment']['P4TypePortion'] != NULL) {
								if ($aliment2['Aliment']['P4Quantite'] == $aComparer) {
									echo '<option value="'. $aliment2['Aliment']['P4Quantite']  .'@'.$aliment2['Aliment']['P4TypePortion'].'" selected=\'selected\'>'. $aliment2['Aliment']['P4TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment2['Aliment']['P4Quantite']  .'@'.$aliment2['Aliment']['P4TypePortion'].'" >'. $aliment2['Aliment']['P4TypePortion'] .'</option>';
								}
							}
							if ($aliment2['Aliment']['P5TypePortion'] != NULL) {
								if ($aliment2['Aliment']['P5Quantite'] == $aComparer) {
									echo '<option value="'. $aliment2['Aliment']['P5Quantite']  .'@'.$aliment2['Aliment']['P5TypePortion'].'" selected=\'selected\'>'. $aliment2['Aliment']['P5TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment2['Aliment']['P5Quantite']  .'@'.$aliment2['Aliment']['P5TypePortion'].'" >'. $aliment2['Aliment']['P5TypePortion'] .'</option>';
								}
							}
							if ($aliment2['Aliment']['P6TypePortion'] != NULL) {
								if ($aliment2['Aliment']['P6Quantite'] == $aComparer) {
									echo '<option value="'. $aliment2['Aliment']['P6Quantite']  .'@'.$aliment2['Aliment']['P6TypePortion'].'" selected=\'selected\'>'. $aliment2['Aliment']['P6TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment2['Aliment']['P6Quantite']  .'@'.$aliment2['Aliment']['P6TypePortion'].'" >'. $aliment2['Aliment']['P6TypePortion'] .'</option>';
								}
							}
							if ($aliment2['Aliment']['P7TypePortion'] != NULL) {
								if ($aliment2['Aliment']['P7Quantite'] == $aComparer) {
									echo '<option value="'. $aliment2['Aliment']['P7Quantite']  .'@'.$aliment2['Aliment']['P7TypePortion'].'" selected=\'selected\'>'. $aliment2['Aliment']['P7TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment2['Aliment']['P7Quantite']  .'@'.$aliment2['Aliment']['P7TypePortion'].'" >'. $aliment2['Aliment']['P7TypePortion'] .'</option>';
								}
							}
							if ($aliment2['Aliment']['P8TypePortion'] != NULL) {
								if ($aliment2['Aliment']['P8Quantite'] == $aComparer) {
									echo '<option value="'. $aliment2['Aliment']['P8Quantite']  .'@'.$aliment2['Aliment']['P8TypePortion'].'" selected=\'selected\'>'. $aliment2['Aliment']['P8TypePortion'] .'</option>';
								} else {
									echo '<option value="'. $aliment2['Aliment']['P8Quantite']  .'@'.$aliment2['Aliment']['P8TypePortion'].'" >'. $aliment2['Aliment']['P8TypePortion'] .'</option>';
								}
							}
						?>
				   </select>
				    <input style="right:-90px" type="submit" name="valider2" value="Valider" />	
				</div>
			  	   
				<div class="onglets-encyclo">
				    <a>Informations nutritionnelles</a>
				</div>
				
				<div class="info-aliment" id='info-aliment2'>
					<div class="scroller">
					
					<table>
					    <tr>
						    <th width=45%> Nutriment </th>
							<th width=10%> Quantité </th>
							<th width=45%> % Valeur quoti-dienne </th>
						</tr>
						 <tr>
						    <td> 
						    	<ul>
						    		<li>
						    			<p class='groupeAlimentaire'>
						    				Calories
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Protéines
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Glucides
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Fibres
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Sucres
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Lipides
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				AG saturés
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				AG mono insaturés
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				AG polyinsaturés
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				A linoléique
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				A alpha - linolénique
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Omega-3 (DHA)
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Omega-3 (EPA)
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Cholestérol
						    			</p>
						    		</li>
						    	</ul>
						    </td>
							<td>  
								<ul>
									<li> 
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][1]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> kcal
										</p>
									</li>
									
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][16]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][18]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][22]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][19]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][23]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][24]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][25]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][26]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][36]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][37]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][40]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][39]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												echo $aliment2['Donneesaliment'][56]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
										</p>
									</li>
								</ul>
							</td>
							<td>  
								<ul>
									<li> 
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment2['Donneesaliment'][1]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obEnKcal)*100,2). ' %';
											?> 
										</p>
									</li>
									
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obPro)) echo round((($aliment2['Donneesaliment'][16]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obPro)*100,2). ' %';
											?> 
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obGlu)) echo round((($aliment2['Donneesaliment'][18]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obGlu)*100,2). ' %';
											?> 
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												/* ND if(isset($obEnKcal)) echo 'ND';*/
												if (isset($obFib)) echo round((($aliment2['Donneesaliment'][22]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obFib)*100,2). ' %';
											?> 
										</p>
									</li>
								
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if(isset($obEnKcal)) echo 'ND'; /*sucres*/
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obLip)) echo round((($aliment2['Donneesaliment'][23]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obLip)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment2['Donneesaliment'][24]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/($obEnKcal * 12 / 100)/9)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if(isset($obEnKcal)) echo 'ND';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if(isset($obEnKcal)) echo 'ND'; /* ag p */
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment2['Donneesaliment'][36]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/($obEnKcal * 4 / 100)/9)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment2['Donneesaliment'][37]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/($obEnKcal * 1 / 100)/9)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment2['Donneesaliment'][40]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/0.25)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if (isset($obEnKcal)) echo round((($aliment2['Donneesaliment'][39]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/0.25)*100,2). ' %';
											?> 
										</p>
									</li>
									<li>
										<p class='groupeAlimentaire'>
											<?php 
												if(isset($obEnKcal)) echo 'ND';
											?> 
										</p>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Calcium
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Potassium
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Sodium
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Cuivre
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Fer
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Magnésium
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Phosphore
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Sélénium
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Zinc
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Iode
						    			</p>
						    		</li>
						    	</ul>
						    </td>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][9]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][8]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][5]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][12]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][11]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][10]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][7]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][14]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][13]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][15]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> µg
						    			</p>
						    		</li>
						    	</ul>
						    </td>
							<td> 
						    	<ul>
						    		<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obCal)) echo round((($aliment2['Donneesaliment'][9]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obCal)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obPotass)) echo round((($aliment2['Donneesaliment'][8]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obPotass)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obSel)) echo round((($aliment2['Donneesaliment'][5]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obSel)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obCui)) echo round((($aliment2['Donneesaliment'][12]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obCui)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obFer)) echo round((($aliment2['Donneesaliment'][11]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obFer)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obMagn)) echo round((($aliment2['Donneesaliment'][10]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obMagn)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obPhos)) echo round((($aliment2['Donneesaliment'][7]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obPhos)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obSelenium)) echo round((($aliment2['Donneesaliment'][14]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obSelenium)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obZinc)) echo round((($aliment2['Donneesaliment'][13]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obZinc)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obIod)) echo round((($aliment2['Donneesaliment'][15]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obIod)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
						    	</ul>
						    </td>
						</tr>
						<tr>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine A
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine B6
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine B12
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine C
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine D
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine E
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Vitamine K
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Folate (B9)
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Thiamine (B1)
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Riboflavine (B2)
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Niacine (B3, PP)
						    			</p>
						    		</li>
								</ul>
						    </td>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][42]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][51]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][52]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][46]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][43]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][44]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][45]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][53]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> µg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][47]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][48]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][49]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> mg
						    			</p>
						    		</li>
								</ul>
						    </td>
							<td> 
						    	<ul>
						    		<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitA)) echo round((($aliment2['Donneesaliment'][42]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitA)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB6)) echo round((($aliment2['Donneesaliment'][51]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitB6)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB12)) echo round((($aliment2['Donneesaliment'][52]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitB12)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitC)) echo round((($aliment2['Donneesaliment'][46]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitC)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitD)) echo round((($aliment2['Donneesaliment'][43]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitD)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitE)) echo round((($aliment2['Donneesaliment'][44]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitE)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitK)) echo round((($aliment2['Donneesaliment'][45]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitK)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB9)) echo round((($aliment2['Donneesaliment'][53]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitB9)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB1)) echo round((($aliment2['Donneesaliment'][47]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitB1)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB2)) echo round((($aliment2['Donneesaliment'][48]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitB2)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obVitB3)) echo round((($aliment2['Donneesaliment'][49]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/$obVitB3)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
								</ul>
						    </td>
						</tr>
						<tr>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				Alcool
						    			</p>
						    		</li>
								</ul>
						    </td>
							<td> 
						    	<ul>
									<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												echo $aliment2['Donneesaliment'][54]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100;
											?> g
						    			</p>
						    		</li>
								</ul>
						    </td>
							<td> 
						    	<ul>
						    		<li>
						    			<p class='groupeAlimentaire'>
						    				<?php 
												if (isset($obEnKcal)) echo round((($aliment2['Donneesaliment'][54]['valmoy'] * $quantiteAliment2 * $quantitePortion2 / 100)/8.8)*100,2). ' %';
											?> 
						    			</p>
						    		</li>
								</ul>
						    </td>
						</tr>
					</table>
					</div>
				<div class="onglets-encyclo" style="margin-top:3px;">
					<a>Ajouter au repas :</a>
				</div>  
				<div class="choix-portion">
						<!--Ajout aliment-->
					
					<input type="checkbox" name="group12" id="group12" value="Petit d&eacute;jeuner"> Petit d&eacute;jeuner<br>
					<input type="checkbox" name="group22" id="group22" value="D&eacute;jeuner"> D&eacute;jeuner<br>
					<input type="checkbox" name="group32" id="group32" value="Go&ucirc;ter"> Go&ucirc;ter<br>
					<input type="checkbox" name="group42" id="group42" value="D&icirc;ner"> D&icirc;ner<br>
					<input style="right:20px; width:120px;" type="submit" name="repas2" value="Ajouter au repas" onclick="return confirm_ajout_droite();" />	
					<?php
					if (!isset($user)) {
						echo '<input style="right:-30px; width:120px;" type="submit" name="ajouterfav2" value="Ajouter aux favoris" onclick="return confirm_ajout_fav_droite();" />';
					} else {
						$estPresent = false;
						foreach ($user['Alimentfavori'] as $fav) {
							if ($aliment2['Aliment'] ['id'] == $fav['idali']) {
								$estPresent = true;
							}
						}
						if ($estPresent) {
							echo '<input style="right:-30px; width:120px;" type="submit" name="retirerfav2" value="Retirer des favoris" onclick="return confirm_retirer_fav_droite();" />';
						} else {
							echo '<input style="right:-30px; width:120px;" type="submit" name="ajouterfav2" value="Ajouter aux favoris" onclick="return confirm_ajout_fav_droite();" />';
						}
					} 
					?>
					</div>
				</div>	   
				
				
			</div>
		<?php endif; ?>
	</div>
</form>


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

	function confirm_ajout_gauche() {
			var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>') ;
			if (isNaN(id_user)) {
				/* Utilisateur non connecté */
				alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
				return false;
			}
			/* else : utilisateur connecté */
			var res = "";
			if (document.getElementById('group1').checked) {
				res += document.getElementById('group1').value + ", ";
			}
			if (document.getElementById('group2').checked) {
				res += document.getElementById('group2').value + ", ";
			}
			if (document.getElementById('group3').checked) {
				res += document.getElementById('group3').value + ", ";
			}
			if (document.getElementById('group4').checked) {
				res += document.getElementById('group4').value + ", ";
			}
			
			res = res.substring(0, res.length-2);
			res = res + "?";
			if (res.length == 1) {
				alert("Vous n'avez pas sélectionné de repas");
				return false;
			}
			var q = document.getElementById('quantite').value;
			switch (q) {
			case '0.5' :
				q = '1/2';
				break;
			case '1.5' :
				q = '1 et demis';
				break;
			case '2.5' :
				q = '2 et demis';
				break;
			case '3.5' :
				q = '3 et demis';
				break;
			} 
			<?php if(isset($aliment1)) : ?>
			if (confirm("Confirmez-vous l'ajout de "+q+"x <?php echo str_replace('"','\'',$aliment1['Alimentsdetaille']['nom']);?> lors du " + res)) { 
				return true;
			} else {
				return false;
			}
			<?php endif; ?>
	}
	
	function confirm_ajout_fav_droite() {
		var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>') ;
		if (isNaN(id_user)) {
			/* Utilisateur non connecté */
			alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
			return false;
		}
		/* else : utilisateur connecté */
		<?php if(isset($aliment2)) : ?>
		if (confirm("Confirmez-vous l'ajout de l'aliment <?php echo str_replace('"','\'',$aliment2['Alimentsdetaille']['nom']);?> à vos aliments favoris ?")) { 
			return true;
		} else {
			return false;
		}
		<?php endif; ?>
	}
	
	function confirm_ajout_fav_gauche() {
		var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>') ;
		if (isNaN(id_user)) {
			/* Utilisateur non connecté */
			alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
			return false;
		}
		/* else : utilisateur connecté */
		<?php if(isset($aliment1)) : ?>
		if (confirm("Confirmez-vous l'ajout de l'aliment <?php echo str_replace('"','\'',$aliment1['Alimentsdetaille']['nom']);?> à vos aliments favoris ?")) { 
			return true;
		} else {
			return false;
		}
		<?php endif; ?>
	}
	
	function confirm_retirer_fav_gauche() {
		var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>') ;
		if (isNaN(id_user)) {
			/* Utilisateur non connecté */
			alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
			return false;
		}
		/* else : utilisateur connecté */
		<?php if(isset($aliment1)) : ?>
		if (confirm("Confirmez-vous le retrait de l'aliment <?php echo str_replace('"','\'',$aliment1['Alimentsdetaille']['nom']);?> de vos aliments favoris ?")) { 
			return true;
		} else {
			return false;
		}
		<?php endif; ?>
	}
	
	function confirm_retirer_fav_droite() {
		var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>') ;
		if (isNaN(id_user)) {
			/* Utilisateur non connecté */
			alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
			return false;
		}
		/* else : utilisateur connecté */
		<?php if(isset($aliment2)) : ?>
		if (confirm("Confirmez-vous le retrait de l'aliment <?php echo str_replace('"','\'',$aliment2['Alimentsdetaille']['nom']);?> de vos aliments favoris ?")) { 
			return true;
		} else {
			return false;
		}
		<?php endif; ?>
	}
	
	function confirm_ajout_droite() {
			var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>') ;
			if (isNaN(id_user)) {
				/* Utilisateur non connecté */
				alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
				return false;
			}
			/* else : utilisateur connecté */
			var res = "";
			if (document.getElementById('group12').checked) {
				res += document.getElementById('group12').value + ", ";
			}
			if (document.getElementById('group22').checked) {
				res += document.getElementById('group22').value + ", ";
			}
			if (document.getElementById('group32').checked) {
				res += document.getElementById('group32').value + ", ";
			}
			if (document.getElementById('group42').checked) {
				res += document.getElementById('group42').value + ", ";
			}
			
			res = res.substring(0, res.length-2);
			res = res + "?";
			if (res.length == 1) {
				alert("Vous n'avez pas sélectionné de repas");
				return false;
			}
			var q = document.getElementById('quantite2').value;
			switch (q) {
			case '0.5' :
				q = '1/2';
				break;
			case '1.5' :
				q = '1 et demis';
				break;
			case '2.5' :
				q = '2 et demis';
				break;
			case '3.5' :
				q = '3 et demis';
				break;
			} 
			<?php if(isset($aliment2)) : ?>
			if (confirm("Confirmez-vous l'ajout de "+q+"x <?php echo str_replace('"','\'',$aliment2['Alimentsdetaille']['nom']);?> lors du " + res)) { 
				return true;
			} else {
				return false;
			}
			<?php endif; ?>
	}
	function alimentsMax() {
			alert("Vous avez déjà choisi deux aliments. Pour en remplacer un, supprimez le d'abord !");
	}

	function validRecherche() {
			if (document.getElementById("zone-aliment").value.length >= 3) {
				return true; 
			} else {
				alert('Vous devez saisir au moins trois lettres pour votre recherche.');
				return false
			}
	}

	function afficherNutriment($numAliment) {
		document.getElementById("info-nutriment-aliment" + $numAliment).style.display = "block";
		document.getElementById("info-aliment" + $numAliment).style.display = "none";
	}

	function afficherAliment($numAliment) {
		document.getElementById("info-aliment" + $numAliment).style.display = "block";
		document.getElementById("info-nutriment-aliment" + $numAliment).style.display = "none";
	}
	
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
