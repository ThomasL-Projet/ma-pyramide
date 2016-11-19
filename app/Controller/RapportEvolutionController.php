<?php
App::uses('AppController', 'Controller');
/**
 * RapportEvolution Controller
 *
 * @property RapportEvolution $RapportEvolution
 */
class RapportEvolutionController extends AppController {

	// Pour utiliser des modèles spécifiques
	public $uses = array('User', 'Suivialimentaire', 'Aliment', 'Constituantaliment', 'Constante');

	public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('id') == null) {
            $this->Session->setFlash("Vous devez être connecter pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->set('page_cours', 'rouge');
        }

        // Page accueil rapport evolution
	public function index() {
		
	}
	
	// Page sommaire_repas
	public function sommaireRepas() {
		
		// Fonction permettant de traduire une date au format sql en lettre
		function dateenlettre($date) {
			$split = explode("-",$date);
			$jour = $split[2];
			$mois = $split[1];
			$annee = $split[0];
			$newTimestamp = mktime(12,0,0,$mois,$jour,$annee);
			 
			$Jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
			$Mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
			 
			return $Jour[date("w", $newTimestamp)] . ' ' . $jour . ' ' . $Mois[date("n", $newTimestamp)] . ' ' . $annee;
		}
		
		
		$id = AuthComponent::user('id');
		setlocale (LC_TIME, 'fr_FR.utf8','fra');
		$date = date('Y-m-d');
		
		$this->set('debut',null);
		$this->set('fin',null);
		if ($this->request->is('post')) {
			/* Vérification des informations envoyées */
			$message;
			$stop = false;
			$deb = $_POST['debut'];
			$fin = $_POST['fin'];
			
			if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$deb))) {
				$stop = true;
				$message = "Erreur, la date de début est invalide, elle doit être sous format 'YYYY-MM-DD'";
			} elseif (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$fin))) {
				$stop = true;
				$message = "Erreur, la date de fin est invalide, elle doit être sous format 'YYYY-MM-DD'";
			} else {
				if ($deb > $date ) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être supérieure à la date d'aujourd'hui";
				} elseif ($fin > $date) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être supérieure à la date d'aujourd'hui";
				}
				if ($deb == $fin) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être égale à la date de fin";
				} elseif ($deb > $fin) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être supérieure à la date de fin";
				}
				$this->set('debut',$deb);
				$this->set('fin',$fin);
			}
			/* fin vérif */
			if ($stop) {
				$this->Session->setFlash(__($message));
			} else {
				$fin = $fin . ' 23:59:59';
				$repas = $this->Suivialimentaire->find('all',array('conditions' => array('AND' => array(
								array('id_user' => $id),
								array('Suivialimentaire.created BETWEEN ? AND ?' => array($deb, $fin))
				)),'order' => array('Suivialimentaire.created DESC'), 'limit' => 25 ));
				$temp = $repas;
				$i = 0;
				foreach ($repas as $r) {
					$temp[$i]['Aliment']= $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $r['Suivialimentaire']['id_aliment'])));
					$i++;
				}
				$this->set('repas', $temp);
			}
		}
	}
	
	// Page detailsAlim
	public function detailsAlim() {
		$id = AuthComponent::user('id');
		setlocale (LC_TIME, 'fr_FR.utf8','fra');
		$date = date('Y-m-d');
		$debut = $date . ' 00:00:00';
		$fin = $date . ' 23:59:59';
		$this->Suivialimentaire->recursive = 0;
		$this->paginate = array(
				'conditions' => array('AND' => array(
						array('id_user' => $id),
						array('Suivialimentaire.created BETWEEN ? AND ?' => array($debut, $fin))
		)),
				'limit' => 10,
				'order' => array('Suivialimentaire.created' => 'DESC'));
				$suivi = $this->paginate('Suivialimentaire');
		if (empty($suivi)) {
			$this->Session->setFlash(__("Vous n'avez pas encore ajouté d'aliment à votre repas aujourd'hui"));
			$this->set('affichage',false);
		} else {
			$this->set('affichage',true);
			$alim = array();
			foreach ($suivi as $s) {
				$alim[]['Aliment'] = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $s['Suivialimentaire']['id_aliment'])));
			}
			$this->set('suivis',$suivi);
			$this->set('alim',$alim);
		}
	}
	
	// Page diagrammes
	public function diagrammes() {
		$id = AuthComponent::user('id');
		setlocale (LC_TIME, 'fr_FR.utf8','fra');
		$dates =array(); // dates de la semaine
		
		$dates[] = date('Y-m-d');
		$dates[] = date("Y-m-d",mktime(0,0,0, date("m")  , date("d")-1, date("Y")));
		$dates[] = date("Y-m-d",mktime(0,0,0, date("m")  , date("d")-2, date("Y")));
		$dates[] = date("Y-m-d",mktime(0,0,0, date("m")  , date("d")-3, date("Y")));
		$dates[] = date("Y-m-d",mktime(0,0,0, date("m")  , date("d")-4, date("Y")));
		$dates[] = date("Y-m-d",mktime(0,0,0, date("m")  , date("d")-5, date("Y")));
		$dates[] = date("Y-m-d",mktime(0,0,0, date("m")  , date("d")-6, date("Y")));
		$datesFR = array(); // dates sous forme jj/mm/aaaa
		// mise sous forme fr
		foreach ($dates as $date) {
			$split = explode("-", $date);
			$jour = $split[2];
			$mois = $split[1];
			$annee = $split[0];
			$datesFR[] = $jour . '/' . $mois . '/' . $annee;
		}
		if (isset($mois)) unset($mois);
		if (isset($jour)) unset($jour);
		if (isset($annee)) unset($annee);
		
		// suivis alimentaires de chacun des jours
		$suivis = array();
		foreach ($dates as $date) {
			$debut = $date . ' 00:00:00';
			$fin = $date . ' 23:59:59';
			$suivis[] = $this->Suivialimentaire->find('all',array('conditions' => array('AND' => array(
							array('id_user' => $id),
							array('Suivialimentaire.created BETWEEN ? AND ?' => array($debut, $fin))
			))));
		}
		
		/* DIAGRAMME CALORIES */
		$diagCal = array();
		foreach($suivis as $suiv) { // chaque jours 
			$cal = 0;
			foreach ($suiv as $s) { // chaques suivis 
				if (isset($s['Suivialimentaire']['id_aliment'])) {
					$ali = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $s['Suivialimentaire']['id_aliment'])));
					$cal = $cal + ($ali['Donneesaliment'][1]['valmoy'] * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				} else {
					$valsplit = explode("@", $s['Alimhorsclassification']['nutri']);
					$valresul = $valsplit[1];
					$cal = $cal + ($valresul * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				}
			}
			$diagCal[] = $cal;
		}
		
		/* DIAGRAMME PROTEINES */
		$diagProt = array();
		foreach($suivis as $suiv) { // chaque jours 
			$cal = 0;
			foreach ($suiv as $s) { // chaques suivis 
				if (isset($s['Suivialimentaire']['id_aliment'])) {
					$ali = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $s['Suivialimentaire']['id_aliment'])));
					$cal = $cal + ($ali['Donneesaliment'][16]['valmoy'] * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				} else {
					$valsplit = explode("@", $s['Alimhorsclassification']['nutri']);
					$valresul = $valsplit[16];
					$cal = $cal + ($valresul * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				}
			}
			$diagProt[] = $cal;
		}
		/* DIAGRAMME LIPIDES */
		$diagLip = array();
		foreach($suivis as $suiv) { // chaque jours 
			$cal = 0;
			foreach ($suiv as $s) { // chaques suivis 
				if (isset($s['Suivialimentaire']['id_aliment'])) {
					$ali = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $s['Suivialimentaire']['id_aliment'])));
					$cal = $cal + ($ali['Donneesaliment'][23]['valmoy'] * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				} else {
					$valsplit = explode("@", $s['Alimhorsclassification']['nutri']);
					$valresul = $valsplit[23];
					$cal = $cal + ($valresul * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				}
			}
			$diagLip[] = $cal;
		}
		/* DIAGRAMME GLUCIDES */
		$diagGlu = array();
		foreach($suivis as $suiv) { // chaque jours 
			$cal = 0;
			foreach ($suiv as $s) { // chaques suivis
				if (isset($s['Suivialimentaire']['id_aliment'])) {
					$ali = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $s['Suivialimentaire']['id_aliment'])));
					$cal = $cal + ($ali['Donneesaliment'][18]['valmoy'] * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				} else {
					$valsplit = explode("@", $s['Alimhorsclassification']['nutri']);
					$valresul = $valsplit[18];
					$cal = $cal + ($valresul * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				}
			}
			$diagGlu[] = $cal;
		}
		/* DIAGRAMME EAU */
		$diagEau = array();
		foreach($suivis as $suiv) { // chaque jours 
			$cal = 0;
			foreach ($suiv as $s) { // chaques suivis 
				if (isset($s['Suivialimentaire']['id_aliment'])) {
					$ali = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $s['Suivialimentaire']['id_aliment'])));
					$cal = $cal + ($ali['Donneesaliment'][4]['valmoy'] * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				} else {
					$valsplit = explode("@", $s['Alimhorsclassification']['nutri']);
					$valresul = $valsplit[4];
					$cal = $cal + ($valresul * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				}
			}
			$diagEau[] = $cal;
		}
		/* DIAGRAMME FIBRES */
		$diagFib = array();
		foreach($suivis as $suiv) { // chaque jours 
			$cal = 0;
			foreach ($suiv as $s) { // chaques suivis 
				if (isset($s['Suivialimentaire']['id_aliment'])) {
					$ali = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $s['Suivialimentaire']['id_aliment'])));
					$cal = $cal + ($ali['Donneesaliment'][22]['valmoy'] * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				} else {
					$valsplit = explode("@", $s['Alimhorsclassification']['nutri']);
					$valresul = $valsplit[22];
					$cal = $cal + ($valresul * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				}
			}
			$diagFib[] = $cal;
		}
		/* DIAGRAMME SEL */
		$diagSel = array();
		foreach($suivis as $suiv) { // chaque jours 
			$cal = 0;
			foreach ($suiv as $s) { // chaques suivis 
				if (isset($s['Suivialimentaire']['id_aliment'])) {
					$ali = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $s['Suivialimentaire']['id_aliment'])));
					$cal = $cal + ($ali['Donneesaliment'][5]['valmoy'] * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				} else {
					$valsplit = explode("@", $s['Alimhorsclassification']['nutri']);
					$valresul = $valsplit[5];
					$cal = $cal + ($valresul * $s['Suivialimentaire']['quantite'] * $s['Suivialimentaire']['portion']/100) * count(explode("@",$s['Suivialimentaire']['nomSA']));
				}
			}
			$diagSel[] = $cal;
		}
		// A partir d'un tableau de valeurs et d'un tableau de date, les transforment en un tableau javascript pour construire des graphes
		function en_javascript($valeurs,$dates) {
			$v = '[';
			for ($i = 0; $i < count($valeurs); $i++) {
				$v = $v . '[\'' . $dates[$i] . '\',' . $valeurs[$i] . '] , ';
			}
			$v = substr($v,0,strlen($v)-3);
			$v = $v . ']';
			return $v;
		}
		$this->set('diagCal',en_javascript($diagCal, $dates));
		$this->set('diagProt',en_javascript($diagProt, $dates));
		$this->set('diagLip',en_javascript($diagLip, $dates));
		$this->set('diagGlu',en_javascript($diagGlu, $dates));
		$this->set('diagEau',en_javascript($diagEau, $dates));
		$this->set('diagFib',en_javascript($diagFib, $dates));
		$this->set('diagSel',en_javascript($diagSel, $dates));
		
				/* 
				 * Calcul des constantes à atteindre en fonction du du poid/age de l'utilisateur
				 * ainsi que la taille, son CA en fonction de son activité physique, si l'utilisateur
				 * est une femme et est enceinte, etc
				 */
				 /* poids utilisateur */
				 $user = $this->User->find('first', array('conditions' => array('id' => $id)));
				 $obPoi = $user['User']['poids'];
				 /* age utilisateur */
				 $naiss = $user['User']['datenaissance'];
				 $age = $this->Suivialimentaire->query("SELECT TIMESTAMPDIFF(YEAR,'". $naiss . "', NOW()) as age;");
				 $age = $age[0][0]['age'];
				 if ($age == 0 || $age == 1 || $age == 2) {
					 $mois = $this->Suivialimentaire->query("SELECT TIMESTAMPDIFF(MONTH,'". $naiss . "', NOW()) as age;");
					 $mois = $mois[0][0]['age'];
				 }
				 /* Calcul du CA */
				 $activite = $user['User']['activite'];
				 $sexe = $user['User']['sexe'];
				 $ca;
				 if ($age >= 3 && $age <= 18 && $sexe == "homme") {
					 switch ($activite) {
						 case "sédentaire" : $ca = 1.00; break;
						 case "peu actif" : $ca = 1.13; break;
						 case "actif" : $ca = 1.26; break;
						 case "très actif" : $ca = 1.42; break;
					 }
				 } elseif ($age >= 3 && $age <= 18 && $sexe == "femme") {
					 switch ($activite) {
						 case "sédentaire" : $ca = 1.00; break;
						 case "peu actif" : $ca = 1.16; break;
						 case "actif" : $ca = 1.31; break;
						 case "très actif" : $ca = 1.56; break;
					 }
				 } elseif ($age >= 19 && $sexe == "homme") {
					 switch ($activite) {
						 case "sédentaire" : $ca = 1.00; break;
						 case "peu actif" : $ca = 1.11; break;
						 case "actif" : $ca = 1.25; break;
						 case "très actif" : $ca = 1.48; break;
					 }
				 } elseif ($age >= 19 && $sexe == "femme") {
					 switch ($activite) {
						 case "sédentaire" : $ca = 1.00; break;
						 case "peu actif" : $ca = 1.12; break;
						 case "actif" : $ca = 1.27; break;
						 case "très actif" : $ca = 1.45; break;
					 }
				 }
				 /* Calcul nb de kcal */
				 $taille = $user['User']['taille'] / 100.00;
				 $grossesse = $user['User']['enceinte'] == "O" ? true : false;
				 $allaitement = $user['User']['allaitante'] == "O" ? true : false;
				 if ($grossesse) {
					 $moisgrossesse = $user['User']['nbmoisenceinte'];
				 }
				 if ($allaitement) {
					 $moisallaitement = $user['User']['nbmoisallaitement'];
				 }
				 /*Nourrissons et jeunes enfants */
				 if (isset($mois) && $mois >= 0 && $mois <= 3) {
					 $obEnKcal = (89 * $obPoi -100) +175;
				 } elseif (isset($mois) && $mois >= 4 && $mois <= 6) {
					 $obEnKcal = (89 * $obPoi - 100) +56;
				 } elseif (isset($mois) && $mois >= 7 && $mois <= 12) {
					 $obEnKcal = (89 * $obPoi - 100) +22;
				 } elseif (isset($mois) && $mois >= 13 && $mois <= 34) {
					 $obEnKcal = (89 * $obPoi - 100) +20;
				 } /* Enfants et adolescents de 3 à 18 ans */
				   elseif ($age >= 3 && $age <= 8 && $sexe == "homme") {
					 $obEnKcal = 88.5 - (61.9 * $age) + $ca * ((26.7 * $obPoi) + (903 * $taille)) +20;
				 } elseif ($age >= 9 && $age <= 18 && $sexe == "homme") {
					 $obEnKcal = 88.5 - (61.9 * $age) + $ca * ((26.7 * $obPoi) + (903 * $taille)) +25;
				 } elseif ($age >= 3 && $age <= 8 && $sexe == "femme") {
					 $obEnKcal = 135.3 - (30.8 * $age) + $ca * ((10.0 * $obPoi) + (934 * $taille)) +20;
				 } elseif ($age >= 9 && $age <= 18 && $sexe == "femme") {
					 $obEnKcal = 135.3 - (30.8 * $age) + $ca * ((10.0 * $obPoi) + (934 * $taille)) +25;
				 } /* Adultes de 19 ans et plus */
				   elseif ($age >= 19 && $sexe == "homme") {
					 $obEnKcal = 662 - (9.53 * $age) + $ca * ((15.91 * $obPoi) + (539.6 * $taille));
				 } elseif ($age >= 19 && $sexe == "femme") {
					 $obEnKcal = 354 - (9.91 * $age) + $ca * ((9.36 * $obPoi) + (726 * $taille));
				 } /* Grossesse */
				   if ($grossesse && $moisgrossesse >3 && $moisgrossesse <= 6) {
					 $obEnKcal = $obEnKcal +340;
				 } if ($grossesse && $moisgrossesse >6 && $moisgrossesse <= 9) {
					 $obEnKcal = $obEnKcal +452;
				 } /* Allaitement */
				   if ($allaitement && $moisallaitement >=0 && $moisallaitement <= 6) {
					 $obEnKcal = $obEnKcal +500 - 170;
				 } if ($allaitement && $moisallaitement >=7 && $moisallaitement <= 12) {
					 $obEnKcal = $obEnKcal +400;
				 }
				 
				 
				/* Calcul protéines */
				$ok = false;
				if (!empty($user['Constsuivialimentaire'])) {
					/* Un diététicien ou un administrateur lui a fixé une valeur, analyse valeur */
					$constante = null;
					foreach ($user['Constsuivialimentaire'] as $const) {
						if (!empty($const['proteines'])) {
							$constante = $const['proteines'];
							break;
						}
					}
					if (!empty($constante)) {
						$obPro = $obPoi * $constante;
						$ok = true;
					}
				} 
				if (!$ok) {
					$con = $this->Constante->findAllBycategorie(2);
					if ($age < 2) {
						$obPro = 0;
					} elseif ($age >= 2 && $age < 4) {
						$obPro = $obPoi * $con[0]['Constante']['valeur'];
					} elseif ($age >= 4 && $age < 8) {
						$obPro = $obPoi * $con[1]['Constante']['valeur'];
					} elseif ($age >= 8 && $age < 13) {
						$obPro = $obPoi * $con[2]['Constante']['valeur'];
					} elseif ($age >= 14 && $age <= 18) {
						$obPro = $obPoi * $con[3]['Constante']['valeur'];
					} elseif ($age >= 19 && $age <= 50) {
						$obPro = $obPoi * $con[4]['Constante']['valeur'];
					}  elseif ($age > 50) {
						$obPro = $obPoi * $con[9]['Constante']['valeur'];
					} if ($grossesse && $moisgrossesse > 0 && $moisgrossesse <= 3) {
						$obPro = $obPoi * $con[5]['Constante']['valeur'];
					} if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
						$obPro = $obPoi * $con[6]['Constante']['valeur'];
					} if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
						$obPro = $obPoi * $con[7]['Constante']['valeur'];
					} if ($allaitement) {
						$obPro = $obPoi * $con[8]['Constante']['valeur'];
					}
				}
				
				/* Calcul lipides */
				$ok = false;
				if (!empty($user['Constsuivialimentaire'])) {
					/* Un diététicien ou un administrateur lui a fixé une valeur, analyse valeur */
					$constante = null;
					foreach ($user['Constsuivialimentaire'] as $const) {
						if (!empty($const['lipides'])) {
							$constante = $const['lipides'];
							break;
						}
					}
					if (!empty($constante)) {
						$obLip = ($obEnKcal * $constante)/9;
						$ok = true;
					}
				} 
				if (!$ok) {
					$obLip = ($obEnKcal * 35/100)/9;
				}
				
				/* Calcul glucide */
				$ok = false;
				if (!empty($user['Constsuivialimentaire'])) {
					/* Un diététicien ou un administrateur lui a fixé une valeur, analyse valeur */
					$constante = null;
					foreach ($user['Constsuivialimentaire'] as $const) {
						if (!empty($const['lipides'])) {
							$constante = $const['lipides'];
							break;
						}
					}
					if (!empty($constante)) {
						$pourLip = $constante;
						$ok = true;
					}
				} 
				if (!$ok) {
					$con = $this->Constante->findAllBycategorie(3);
					$pourLip = $con[0]['Constante']['valeur'];
				}
				$ePro = $obPro*4;
				$pourPro = $ePro / $obEnKcal;
				$obGlu = 1 - ($pourPro + $pourLip);
				$obGlu = $obEnKcal * ($obGlu/100);
				$obGlu = $obGlu/4;
				
				/* Calcul fibres */
				$ok = false;
				if (!empty($user['Constsuivialimentaire'])) {
					/* Un diététicien lui a fixé une valeur, analyse valeur */
					$constante = null;
					foreach ($user['Constsuivialimentaire'] as $const) {
						if (!empty($const['fibres'])) {
							$constante = $const['fibres'];
							break;
						}
					}
					if (!empty($constante)) {
						$obFib = $constante;
						$ok = true;
					}
				} 
				if (!$ok) {
					$con = $this->Constante->findAllBycategorie(1);
					if ($age < 2) {
						$obFib = 0;
					} elseif ($age >= 2 && $age < 4) {
						$obFib = $con[0]['Constante']['valeur'];
					} elseif ($age >= 4 && $age <= 8) {
						$obFib = $con[1]['Constante']['valeur'];
					} elseif ($age >= 9 && $age <= 13 && $sexe == "homme") {
						$obFib = $con[2]['Constante']['valeur'];
					} elseif ($age >= 9 && $age <= 13 && $sexe == "femme") {
						$obFib = $con[3]['Constante']['valeur'];
					} elseif ($age >= 14 && $age <= 18 && $sexe == "homme") {
						$obFib = $con[4]['Constante']['valeur'];
					} elseif ($age >= 14 && $age <= 18 && $sexe == "femme") {
						$obFib = $con[5]['Constante']['valeur'];
					} elseif ($age >= 19 && $age <= 50 && $sexe == "homme") {
						$obFib = $con[6]['Constante']['valeur'];
					} elseif ($age >= 19 && $age <= 50 && $sexe == "femme") {
						$obFib = $con[7]['Constante']['valeur'];
					} elseif ($age > 50 && $sexe == "homme") {
						$obFib = $con[10]['Constante']['valeur'];
					} elseif ($age > 50 && $sexe == "femme") {
						$obFib = $con[11]['Constante']['valeur'];
					} if ($grossesse) {
						$obFib = $con[8]['Constante']['valeur'];
					} if ($allaitement) {
						$obFib = $con[9]['Constante']['valeur'];
					}
				}
				
				/* Calcul sel */
				$ok = false;
				if (!empty($user['Constsuivialimentaire'])) {
					/* Un diététicien lui a fixé une valeur, analyse valeur */
					$constante = null;
					foreach ($user['Constsuivialimentaire'] as $const) {
						if (!empty($const['sel'])) {
							$constante = $const['sel'];
							break;
						}
					}
					if (!empty($constante)) {
						$obSel = $constante;
						$ok = true;
					}
				} 
				if (!$ok) {
					$con = $this->Constante->findAllBycategorie(4);
					if ($age < 2) {
						$obSel = 0;
					} elseif ($age >= 2 && $age < 4) {
						$obSel = $con[0]['Constante']['valeur'];
					} elseif ($age >= 4 && $age < 9) {
						$obSel = $con[1]['Constante']['valeur'];
					} elseif ($age >= 9 && $age < 13) {
						$obSel = $con[2]['Constante']['valeur'];
					} elseif ($age >= 14 && $age <= 18) {
						$obSel = $con[3]['Constante']['valeur'];
					} elseif ($age >= 19 && $age <= 50) {
						$obSel = $con[4]['Constante']['valeur'];
					}  elseif ($age > 50) {
						$obSel = $con[9]['Constante']['valeur'];
					} if ($grossesse && $moisgrossesse > 0 && $moisgrossesse <= 3) {
						$obSel = $con[5]['Constante']['valeur'];
					} if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
						$obSel = $con[6]['Constante']['valeur'];
					} if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
						$obSel = $con[7]['Constante']['valeur'];
					} if ($allaitement) {
						$obSel = $con[8]['Constante']['valeur'];
					}
				}
				
				/* Mise en forme */
				$obEnKcal = intval($obEnKcal);
				$obEnKJ = intval($obEnKcal * 4,18);
				$obPro = intval($obPro);
				$obLip = intval($obLip);
				$obGlu = intval($obGlu *100);
				$obPoi = intval($obPoi);
				$obFib = intval($obFib);
				$obSel = intval($obSel);
				
				$obEau = $obEnKcal;
				$this->set('obEnKcal',$obEnKcal);
				$this->set('obEnKJ',$obEnKJ);
				$this->set('obPro',$obPro);
				$this->set('obLip',$obLip);
				$this->set('obGlu',$obGlu);
				$this->set('obEau',$obEau);
				$this->set('obFib',$obFib);
				$this->set('obSel',$obSel);
				$this->set('obPoi',$obPoi);
	}
	
	public function groupes_ali_et_cal() {
		// Fonction permettant de traduire une date au format sql en lettre
		function dateenlettre($date) {
			$split = explode("-",$date);
			$jour = $split[2];
			$mois = $split[1];
			$annee = $split[0];
			$newTimestamp = mktime(12,0,0,$mois,$jour,$annee);
			 
			$Jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
			$Mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
			 
			return $Jour[date("w", $newTimestamp)] . ' ' . $jour . ' ' . $Mois[date("n", $newTimestamp)] . ' ' . $annee;
		}
		
		// Fonction qui renvoi le nombre de jours entre deux dates
		function jours($date1, $date2){
			$diff = abs($date1 - $date2); 
			$retour = array();
		 
			$tmp = $diff;
			$retour['second'] = $tmp % 60;
		 
			$tmp = floor( ($tmp - $retour['second']) /60 );
			$retour['minute'] = $tmp % 60;
			
			$tmp = floor( ($tmp - $retour['minute'])/60 );
			$retour['hour'] = $tmp % 24;
				 
			$tmp = floor( ($tmp - $retour['hour'])  /24 );
			$retour['day'] = $tmp;
				 
			return $retour['day'];
		}
		
		
		$id = AuthComponent::user('id');
		setlocale (LC_TIME, 'fr_FR.utf8','fra');
		$date = date('Y-m-d');
		
		$this->set('debut',null);
		$this->set('fin',null);
		if ($this->request->is('post')) {
			/* Vérification des informations envoyées */
			$message;
			$stop = false;
			$deb = $_POST['debut'];
			$fin = $_POST['fin'];
			
			if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$deb))) {
				$stop = true;
				$message = "Erreur, la date de début est invalide, elle doit être sous format 'YYYY-MM-DD'";
			} elseif (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$fin))) {
				$stop = true;
				$message = "Erreur, la date de fin est invalide, elle doit être sous format 'YYYY-MM-DD'";
			} else {
				if ($deb > $date ) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être supérieure à la date d'aujourd'hui";
				} elseif ($fin > $date) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être supérieure à la date d'aujourd'hui";
				}
				if ($deb == $fin) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être égale à la date de fin";
				} elseif ($deb > $fin) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être supérieure à la date de fin";
				}
				$this->set('debut',$deb);
				$this->set('fin',$fin);
			}
			/* fin vérif */
			if ($stop) {
				$this->Session->setFlash(__($message));
			} else {
				$fin = $fin . ' 23:59:59';
				$repas = $this->Suivialimentaire->find('all',array('conditions' => array('AND' => array(
								array('id_user' => $id),
								array('Suivialimentaire.created BETWEEN ? AND ?' => array($deb, $fin))
				)),'order' => array('Suivialimentaire.created DESC') ));
				$temp = $repas;
				$i = 0;
				foreach ($repas as $r) {
					$temp[$i]['Aliment']= $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $r['Suivialimentaire']['id_aliment'])));
					$i++;
				}
				$repas = $temp;
				$cal = 0;
				foreach ($repas as $rep) {
					if (!empty($rep['Aliment'])) {
						$cal = $cal + ($rep['Aliment']['Donneesaliment'][1]['valmoy'] * $rep['Suivialimentaire']['quantite'] * $rep['Suivialimentaire']['portion']/100) * count(explode("@",$rep['Suivialimentaire']['nomSA']));
					} else  {
						$valsplit = explode("@", $rep['Alimhorsclassification']['nutri']);
						$valresul = $valsplit[1];
						$cal = $cal + ($valresul * $rep['Suivialimentaire']['quantite'] * $rep['Suivialimentaire']['portion']/100) * count(explode("@",$rep['Suivialimentaire']['nomSA']));
					}
				}
				$this->set('repas',$repas);
				$this->set('cal',$cal);
				$time1 = strtotime($deb);
				$time2 = strtotime($fin);
				$e=jours($time1, $time2);
				$this->set('joursDiff',$e);
				
			}
		}
	}
	
	public function nutriments() {
		// Fonction permettant de traduire une date au format sql en lettre
		function dateenlettre($date) {
			$split = explode("-",$date);
			$jour = $split[2];
			$mois = $split[1];
			$annee = $split[0];
			$newTimestamp = mktime(12,0,0,$mois,$jour,$annee);
			 
			$Jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
			$Mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
			 
			return $Jour[date("w", $newTimestamp)] . ' ' . $jour . ' ' . $Mois[date("n", $newTimestamp)] . ' ' . $annee;
		}
		
		// Fonction qui renvoi le nombre de jours entre deux dates
		function jours($date1, $date2){
			$diff = abs($date1 - $date2); 
			$retour = array();
		 
			$tmp = $diff;
			$retour['second'] = $tmp % 60;
		 
			$tmp = floor( ($tmp - $retour['second']) /60 );
			$retour['minute'] = $tmp % 60;
			
			$tmp = floor( ($tmp - $retour['minute'])/60 );
			$retour['hour'] = $tmp % 24;
				 
			$tmp = floor( ($tmp - $retour['hour'])  /24 );
			$retour['day'] = $tmp;
				 
			return $retour['day'];
		}
		
		
		$id = AuthComponent::user('id');
		setlocale (LC_TIME, 'fr_FR.utf8','fra');
		$date = date('Y-m-d');
		
		$this->set('debut',null);
		$this->set('fin',null);
		if ($this->request->is('post')) {
			/* Vérification des informations envoyées */
			$message;
			$stop = false;
			$deb = $_POST['debut'];
			$fin = $_POST['fin'];
			
			if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$deb))) {
				$stop = true;
				$message = "Erreur, la date de début est invalide, elle doit être sous format 'YYYY-MM-DD'";
			} elseif (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$fin))) {
				$stop = true;
				$message = "Erreur, la date de fin est invalide, elle doit être sous format 'YYYY-MM-DD'";
			} else {
				if ($deb > $date ) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être supérieure à la date d'aujourd'hui";
				} elseif ($fin > $date) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être supérieure à la date d'aujourd'hui";
				}
				if ($deb == $fin) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être égale à la date de fin";
				} elseif ($deb > $fin) {
					$stop = true;
					$message = "Erreur, la date de debut ne peut être supérieure à la date de fin";
				}
				$this->set('debut',$deb);
				$this->set('fin',$fin);
			}
			/* fin vérif */
			if ($stop) {
				$this->Session->setFlash(__($message));
			} else {
				$fin = $fin . ' 23:59:59';
				$repas = $this->Suivialimentaire->find('all',array('conditions' => array('AND' => array(
								array('id_user' => $id),
								array('Suivialimentaire.created BETWEEN ? AND ?' => array($deb, $fin))
				)),'order' => array('Suivialimentaire.created DESC') ));
				$temp = $repas;
				$i = 0;
				foreach ($repas as $r) {
					$temp[$i]['Aliment']= $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $r['Suivialimentaire']['id_aliment'])));
					$i++;
				}
				$repas = $temp;
				$nutriments = array();
				$descri = $this->Constituantaliment->query("select name from constituantaliments join donneescompilees on constituantaliments_id = constituantaliments.id where aliments_id = 1000");
				foreach ($descri as $desc) {
					$nutriments[]['nom'] = $desc['constituantaliments']['name'];
				}
				for ($i = 0; $i < 57; $i++) $nutriments[$i]['valeur'] = 0;
				foreach ($repas as $rep) {
					for ($i = 0; $i < 57; $i++) {
						if (!empty($rep['Aliment'])) {
							$nutriments[$i]['valeur'] = $nutriments[$i]['valeur'] + ($rep['Aliment']['Donneesaliment'][$i]['valmoy'] * $rep['Suivialimentaire']['quantite'] * $rep['Suivialimentaire']['portion']/100) * count(explode("@",$rep['Suivialimentaire']['nomSA']));
						} else  {
							$valsplit = explode("@", $rep['Alimhorsclassification']['nutri']);
							$valresul = $valsplit[$i];
							$nutriments[$i]['valeur'] = $nutriments[$i]['valeur'] +  ($valresul * $rep['Suivialimentaire']['quantite'] * $rep['Suivialimentaire']['portion']/100) * count(explode("@",$rep['Suivialimentaire']['nomSA']));
						}
					}
				}
				$this->set('repas',$repas);
				$this->set('nutriments',$nutriments);
				$time1 = strtotime($deb);
				$time2 = strtotime($fin);
				$e=jours($time1, $time2);
				$this->set('joursDiff',$e);
				
			}
		}
	}
}