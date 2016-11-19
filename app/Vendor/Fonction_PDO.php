	<?php
	//fonction qui execute la requete passée en argument
	//et en renvoi le résultat sous forme de tableau
	function requete_bd($requete){
	
	//réglage de l'encodage de la page
	echo "<head>
          <meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"utf-8\">";
	    try{
				$host = 'mysql:host=mysql51-77.perso;dbname=mapyramide2013';
				$user = 'mapyramide2013';
				$pwd = '4sdpY2356';
			
			//réglage de l'encodage du tableau (si on ne le fait pas partout ça marche 
			//pas vérifier si votre base de données est aussi en utf8)
			$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			);
			//connexion
			$cnx = new PDO($host, $user, $pwd);
			$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if (!$cnx) 
			{
				printf('Impossible de se connecter');
			}
			//execution
			$resultat = $cnx->prepare($requete);
			$resultat->execute();
			//transformation en tableau
			$tab= $resultat->fetchAll();
			//renvoi du tableau obtenu
			return $tab;
			
		}catch (Exception $e){
			 echo "impossible de se connecter", $e->getMessage();
		}	
	echo"</head>";
	}
	
	//fonction de connextion simple pour les page ne nécéssitant 
	//pas d'execution de select
	function connexion(){
		//réglage de l'encodage de la page
		echo "<head>
			  <meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"utf-8\">";
	    try{
			$host = 'mysql:host=localhost;dbname=pyr';
				$user = 'root';
				$pwd = '';
			
			//connexion
			$cnx = new PDO($host, $user, $pwd);
			$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if (!$cnx) 
			{
				printf('Impossible de se connecter');
			}
		}catch (Exception $e){
			 echo "impossible de se connecter", $e->getMessage();
		}	
	echo"</head>";	
	}
	
    //fonction qui ajoute une ligne dans la base de données
	function ajout_bd($table, $tableau_attribut, $tableau_donnees){
		$insert_part1 = "INSERT INTO ".$table." (";
		$insert_part2 = "VALUES (";
		if (count($tableau_attribut) == count($tableau_donnees)) {
			for ($indice = 0; $indice < count($tableau_attribut); $indice++){
	
				$insert_part1 .= $tableau_attribut[$indice];
				$insert_part2 .= "'".$tableau_donnees[$indice]."'";
				
				if ($indice+1 < count($tableau_attribut)) {
					$insert_part1 .= ", ";
					$insert_part2 .= ", ";
				}
			}
			
			$insert_part1 .= ") ";
			$insert_part2 .= ")";
	
			$insert = $insert_part1.$insert_part2;
			
			//connexion
			$host = 'mysql:host=localhost;dbname=pyr';
				$user = 'root';
				$pwd = '';
			$cnx = new PDO($host, $user, $pwd);
			$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$resultat = $cnx->prepare($insert);
			$resultat->execute();

		}	
	}
	
	//fonction qui supprime une ligne dans la base de données
	function suppr_bd($table, $conditions){
		$delete = "DELETE FROM ".$table." WHERE ".$conditions[0];
		for ($indice = 1; $indice < count($conditions) ; $indice++){
			$delete .= " AND ".$conditions[$indice];
		}
			
		//connexion
		$host = 'mysql:host=localhost;dbname=pyr';
				$user = 'root';
				$pwd = '';
		$cnx = new PDO($host, $user, $pwd);
		$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$resultat = $cnx->prepare($delete);
		$resultat->execute();
	}
	
	?>