<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Suivi alimentaire');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<?php
if ($username = AuthComponent::user('username')) { // User connecté 
	calculDonnees($username);
    $obEnKcal = 2000;
    $obEnKJ   = $obEnKcal*4.186;
    $obPro    = 54;
	$obLip    = 77;
	$obGlu    = 271;
	$obEau    = $obEnKcal;
	$obFib    = 38;
	$obSel    = 3810;
	$obPoi    = 60;
} else {
  /** Variables par defaut (user pas connecté) */
    $obEnKcal = 2000;
    $obEnKJ   = $obEnKcal*4.186;
    $obPro    = 54;
	$obLip    = 77;
	$obGlu    = 271;
	$obEau    = $obEnKcal;
	$obFib    = 38;
	$obSel    = 3810;
	$obPoi    = 60;
/** FIN Variables par defaut (user pas connecté) */
}
?>
<head>
	<!-- Barre de recherche -->
	<script>
	  $(function() {
	    // run the currently selected effect
	    function runEffect() {
	    	var options = {};
	      // run the effect
	      $( "#searchForm" ).show( "drop", options, 500, callback );
	    };
	 
	    //callback function to bring a hidden box back
	    function callback() {
			setTimeout(function() {
		        $( "#searchForm:visible" ).removeAttr( "style" ).fadeOut();
		      }, 10000 ); // timout de 10 secondes 
		    };
		 // set effect from select menu value
	    $( "#searchIcon" ).click(function() {
	      runEffect();
	      return false;
	    });

	    	$( "#searchForm" ).hide();
  		});
  	</script>
</head>
    <!-- VARIABLES  CONSOMMATION-->
    <?php
	$coEnKcal = 2008;
    $coEnKJ   = $coEnKcal*4.184;
    $coPro    = 0;
	$coLip    = 0;
	$coGlu    = 0;
	$coEau    = 0;
	$coFib    = 0;
	$coSel    = 0; ?>
	<!--FIN VARIABLES -->

<div class = "suiviresume">
	<div class ="statsresume">
		<p class = "pluslong"><strong>Aujourd'hui</strong></br>
			<i class = "date">
						  <?php // Affichage de quelque chose comme : Monday 8th of August 2005 03:12:46 PM
						        setlocale (LC_TIME, 'fr_FR.utf8','fra');
						        echo (strftime("%A %d"));?></i>|</br>|</br>|</p>
 		<p class = "pluslong"><strong>Bilan énergétique (Kcal)</strong>
 			<i class = "statl">
 			<?php echo $obEnKcal ?></i></p>
 		<p class = "pluslong"><strong>Bilan énergétique (KJ)</strong>
 			<i class = "statl">
			<?php echo $obEnKJ ?></i></p>
 		<a href="#" id="msaprot1" onclick="openWin(this.id+'.jpg')"><p><strong>Protéines (g)</strong>
 			<i class = "stat">
 			<?php echo $obPro ?></i></p></a>
 		<a href="#" id="msalip1" onclick="openWin(this.id+'.jpg')"><p><strong>Lipides (g)</strong>
 			<i class = "stat">
 			<?php echo $obLip ?></i></p></a>
 		<a href="#" id="msaglu1" onclick="openWin(this.id+'.jpg')"><p><strong>Glucides (g)</strong>
 			<i class = "stat">
 			<?php echo $obGlu ?></i></p></a>
 		<p><strong>Eau (ml)</strong>
 			<i class = "stat">
 			<?php echo $obEau ?></i></p>
 		<a href="#" id="msafib1" onclick="openWin(this.id+'.jpg')"><p><strong>Fibres (g)</strong>
 			<i class = "stat">
 			<?php echo $obFib ?></i></p></a>
 		<p><strong>Sel (mg)</strong>
 			<i class = "stat">
 			<?php echo $obSel ?></i></p>
 		<p><strong>Poids (Kg)</strong>
 			<i class = "stat">
 			<?php echo $obPoi ?></i></p>
	</div>

	<div class ="consommes">
		<p class = "pluslong"><strong>Consommés :</strong></p>
		<p class = "pluslong"><?php echo $coEnKcal?></p>
 		<p class = "pluslong"><?php echo $coEnKJ?></p>
 		<p><?php echo $coPro?></p>
 		<p><?php echo $coLip?></p>
 		<p><?php echo $coGlu?></p>
 		<p><?php echo $coEau?></p>
 		<p><?php echo $coFib?></p>
 		<p><?php echo $coSel?></p>
 		<p></p>
 	</div>
 	<!-- Calcul des restes -->
 	<?php
 	$restecal = calcReste($obEnKcal, $coEnKcal);
 	$resteJ   = calcReste($obEnKJ, $coEnKJ);
 	$restepro = calcReste($obPro, $coPro);
 	$restelip = calcReste($obLip, $coLip);
 	$resteglu = calcReste($obGlu, $coGlu);
 	$resteeau = calcReste($obEau, $coEau);
 	$restefib = calcReste($obFib, $coFib);
 	$restesel = calcReste($obSel, $coSel); ?>
 	<!-- FIN calcul des restes -->
 	<div class ="reste">
		<p class = "pluslong"><strong>Reste :</strong></p>
		<p class = "pluslong"><?php affichReste($restecal)?></p>
 		<p class = "pluslong"><?php affichReste($resteJ)?></p>
 		<p><?php affichReste($restepro)?></p>
 		<p><?php affichReste($restelip)?></p>
 		<p><?php affichReste($resteglu)?></p>
 		<p><?php affichReste($resteeau)?></p>
 		<p><?php affichReste($restefib)?></p>
 		<p><?php affichReste($restesel)?></p>
 		<p></p>
 	</div>
 	<?php
 	$grEnKcal = ($coEnKcal*100)/$obEnKcal;
 	$grpro    = ($coPro*100)/$obPro;
 	$grlip    = ($coLip*100)/$obLip;
 	$grglu    = ($coGlu*100)/$obGlu;
 	$greau    = ($coEau*100)/$obEau;
 	$grfib    = ($coFib*100)/$obFib;
 	$grsel    = ($coSel*100)/$obSel; ?>
 	<div class="jump"></div>
 	<div class="graphe">
		<div id="chart2" style="margin-left: 10px; margin-top: 50px; width: 1260px; height: 300px; "></div>
		<script class="code" type="text/javascript" language="javascript">
			$(document).ready(function(){
       		$.jqplot.config.enablePlugins = true;
		
			// Coordonnées x du repère
        	var points = [<?php echo $grEnKcal ?>, 
        				  <?php echo $grpro ?>, 
        				  <?php echo $grlip ?>,
        				  <?php echo $grglu ?>,
        				  <?php echo $greau ?>,
        				  <?php echo $grfib ?>,
        				  <?php echo $grsel ?>];
		
			// Coordonnées y du repère
        	var nutriment = ['Bilan énergétique','Protéines','Lipides','Glucides','Eau','Fibres','Sel'];
         
        	plot1 = $.jqplot('chart2', [points], {
            
           		seriesDefaults:{
					// Plugin permettant de créer un histogramme
                	renderer:$.jqplot.BarRenderer,
                	pointLabels: { show: true }
            	},
				// Cette fonction permet de faire tourner le label de l'axe des ordonnées 
				axesDefaults: {
					labelRenderer: $.jqplot.CanvasAxisLabelRenderer
				},
            	axes: {
                	xaxis: {
						label : "",
                    	renderer: $.jqplot.CategoryAxisRenderer, 
                    	ticks: nutriment,
						tickRenderer: $.jqplot.CanvasAxisTickRenderer,
						tickOptions: {
						}
                	},
					yaxis: {
						label : "Objectif (%)"
					}
           		},
            	highlighter: { show: false }
        	});
     
    	});
		</script>
    </div>

 	<div class ="conseils">
		<a href="#" id="msabilan1" onclick="openWin(this.id+'.jpg')"><p><strong>Bilan énergétique</strong> Objectif
		   	<?php objectif($grEnKcal)?></p></a>
		<a href="#" id="msaprot2" onclick="openWin(this.id+'.jpg')"><p><strong>Protéines</strong></br> Objectif
		    <?php objectif($grpro)?></p></a>
 		<a href="#" id="msalip2" onclick="openWin(this.id+'.jpg')"><p><strong>Lipides</strong></br> Objectif
 			<?php objectif($grlip)?></p></a>
 		<a href="#" id="msaglu3" onclick="openWin(this.id+'.jpg')"><p><strong>Glucides</strong></br> Objectif
 			<?php objectif($grglu)?></p></a>
 		<a href="#" id="msaeau1" onclick="openWin(this.id+'.jpg')"><p><strong>Eau</strong></br> Objectif
 			<?php objectif($greau)?></p></a>
 		<a href="#" id="msafib2" onclick="openWin(this.id+'.jpg')"><p><strong>Fibre</strong></br> Objectif
 			<?php objectif($grfib)?></p></a>
 		<a href="#" id="msasel1" onclick="openWin(this.id+'.jpg')"><p><strong>Sel</strong></br> Objectif
 			<?php objectif($grsel)?></p></a>
 	</div>
 	 	<div class ="introresumerepas">
 		<p><strong>Menu quotidient</strong></p>
    </div>
    <div class ="resumerepas">
    	<p class ="ptdej"><strong>Petit déjeuner</strong>
    	<i class = "contenurepas"><!-- CONTENU PTIT DEJ --></i></br>|</br>|</br>|</br>|</br>|</p>
    	<p class ="dej"><strong>Déjeuner</strong>
    	<i class = "contenurepas"><!-- CONTENU DEJEUNER --></i></br>|</br>|</br>|</br>|</br>|</p>
    	<p class ="diner"><strong>Dîner</strong>
    	<i class = "contenurepas"><!-- CONTENU DINER --></i></p>
    </div>
<!--    	<form method="POST" action="">
		<p><input type="text" name ="search" id="search"/></p>
	</form>
		
	<div id="resultat">
		<ul>
		</ul>
	</div>
	<div id="loader">
		<img src="http://mapyramide.fr/app/webroot/img/loader.gif" alt="loader"/>
	</div>
</div>
 -->
 <div id="retour1" style="margin-left:1050px; position:absolute; margin-top: 400px ">
  <a href="supertracker" title="supertracker" id="supertracker"> <input type="button" name="retour" value="Retour" ></a>
</div>
</div>
<?php
function calculDonnees($username) {

	$query = "SELECT *
			  FROM users
			  WHERE username = '".$username."'";
	$result = requete_bd($query);
}

function calcReste($objectif, $consomme) {
	return $objectif-$consomme;
}

function affichReste($reste) {
	if( $reste < 0 ) {
		echo '0';
	} else {
		echo $reste;
	}
}

function objectif($gr) {
	if($gr < 97.5) {
		echo '<i class = "objectifetat" style="color : darkred;">Pas atteint !</i>';
	} else if($gr > 102.5) {
		echo '<i class = "objectifetat" style="color : darkgreen;">Dépassé !</i>';
	} else {
		echo '<i class = "objectifetat" style="color : black;">Normal</i>';
	}
}

function requete_bd($requete){
	
	//réglage de l'encodage de la page
	echo "<head>
          <meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"utf-8\">";
	    try{
			$host = 'mysql:host=localhost;dbname=pyr';
				$user = 'root';
				$pwd = '';
			
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
			//transformation en tableau
			$resultat = $cnx->prepare($requete);
			$resultat->execute();
			$tab = $resultat->fetchAll();
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

?>
<script type="text/javascript">
function openWin(nomimg) {
	var conseil = window.open("http://mapyramide.fr/app/webroot/img/"
		+nomimg,'Image',"top=100, left=450, width=636, height=480");
}

function openImg(nomimg) {
	var conseil = window.open("http://mapyramide.fr/app/webroot/img/imagesAliment"
		+nomimg,'Image',"top=100, left=450, width=636, height=480");
}
</script>

<script type="text/javascript">
	alert("Attention !! N'oubliez pas de saisir vos boissons, vos en-cas, les sucreries, les confiseries, les matières grasses (huiles, margarines, beurres...)	et le sel (même s il faut le peser !)");
</script>