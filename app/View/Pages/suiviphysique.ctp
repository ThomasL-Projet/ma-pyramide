<?php
	App::import('Vendor', 'Fonction_PDO');

	if (!($username = AuthComponent::user('username'))) {
?>
  <script type="text/javascript">
   alert("Il faut etre connecte pour utiliser cette fontionnalité.");
  </script>
<?php } else { 	// On recupere le poids et l'objectifs poids

	$requetePhysique = "SELECT DISTINCT(grande_rubrique)
						FROM activite_physique_2014";

			
	// Tableau de la courbe de poids
	$tab = requete_bd($requetePhysique);
	echo '<FORM name="saisie" onsubmit="insert(lepoids.value); return false;">';
	echo '<select name ="searchType" id="searchType" style="width:200px;"/>';
	for ($i=0; $i<count($tab); $i++) {
		echo '<option value=0><'.$tab[$i][0].' </option>';
	}
	echo '</select>';
	
	echo '<input type="button" name="physique" value="activite" onclick="" >';
}
?>