<?php

App::uses('AppController', 'Controller');

class MesrecettesController extends AppController {

	// Pour utiliser des modèles spécifiques
	public $uses = array('User','Mesrecette','Modespreparation', 'Aliment', 'Famillealiment', 'Alimentsdetaille', 'Alimentfavori');

	public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('id') == null) {
            $this->Session->setFlash("Vous devez être connecter pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->set('page_cours', 'rouge');
        }

        public function index() {
		$id = AuthComponent::user('id');
		$this->set('recettes', $this->Mesrecette->findAllByuser_id($id));
	}
	
	public function edit($recid = null) {
		
		/* Recherche du nom d'une portion dans un tableau de donnée a partir de la valeur de la portion */
		function rech_portion($tab, $val) {
			$i = 0;
			$pos =0;
			foreach ($tab as $t) {
				if ($t == $val) {
					$pos = $i-1;
					break;
				}
				$i++;
			}
			$i=0;
			foreach ($tab as $t) {
				if ($i == $pos) {
					return $t;
				}
				$i++;
			}
		}
		
		/*
		 * Ajoute la valeur (ou tableau) $valaj dans un tableau $tab a la position (indice) $debut 
		 * Renvoie tableau avec décalage effectué
		 */
		function decale_indices($tab, $debut, $valaj) {
			$res = array();
			for ($i=0;$i<$debut;$i++) {
				$res[] = $tab[$i];
			}
			$res[] = $valaj;
			for ($i; $i < count($tab); $i++) {
				$res[] = $tab[$i];
			}
			return $res;
		}
		
		/* A parir d'un tableau de modes preparation, met a jour les étapes si elles sont dans le désordre : exemple [etape1,etape1,etape7] 
		 * renverra [etape1,etape2,etape3]
		 */
		function metAJourEtapes($tab) {
			for ($i = 0; $i < count($tab); $i++) {
				$tab[$i]['etape'] = $i+1;
			}
			return $tab;
		}
		
		if (!empty($_POST['postresult'])) {
			$aliment1 = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $_POST['postresult'])));
			if (!empty($aliment1)) {
			
			$id1 = $_POST['postresult'];
			if (empty($_POST['repas1'])) {
				$this->set('aliment1', $aliment1);
			}
			
			
			//On récupère la quantité du premier aliment que l'utilisateur souhaite comparer
			if (isset($_POST['quantite'])) {
				$quantiteAliment1 = $_POST['quantite'];
				$this->set('quantiteAliment1', $quantiteAliment1);
			} elseif (! isset($quantiteAliment1)) {
				$this->set('quantiteAliment1', 1);
			}
			
			//On récupère la portion du premier aliment que l'utilisateur souhaite comparer
			if (isset($_POST['portion'])) {
				$split = explode("@",$_POST['portion']);
				$quantitePortion1 = $split[0];
				$this->set('quantitePortion1', $quantitePortion1);
			} else {
				$this->set('quantitePortion1', $aliment1['Aliment']['P1Quantite']);
			}
		}
		}
		/* Recherche des cathegories d'aliements qui seront présents dans la 1ere boite a liste */
			$familles = $this->Alimentsdetaille->find('all',array(
							'fields' => 'type',
							'group' => array('type')));
			$this->set('familles',$familles);
			$sous_types = $this->Alimentsdetaille->find('all',array(
							'fields' => array('sous_type','type'),
							'group' => array('sous_type')));
			$this->set('sous_types',$sous_types);
			$classe = $this->Alimentsdetaille->find('all',array(
								'fields' => array('classe','sous_type','type'),
								'group' => array('classe')));
			$this->set('classes',$classe);
			$sous_classe = $this->Alimentsdetaille->find('all',array(
								'fields' => array('sous_classe','classe','sous_type','type'),
								'group' => array('sous_classe')));
			$this->set('sous_classes',$sous_classe);
		
		
		$id = AuthComponent::user('id');
		$recettes = $this->Mesrecette->findAllByuser_id($id);
		$recette;
		foreach ($recettes as $r) {
			if ($r['Mesrecette']['id'] == $recid) {
				$recette = $r;
				break;
			}
		}
		if (empty($recette)) {
			$this->set('affichage', false);
		} else {
			$this->set('recid', $recid);
			$this->set('affichage', true);
			/* Recette ok*/
			$this->set('recette', $recette);
			$idaliments = explode("@", $recette['Mesrecette']['aliments']);
			$portions = explode("@", $recette['Mesrecette']['portions']);
			$quantites = explode("@", $recette['Mesrecette']['quantites']);
			$aliments = array();
			$i = 0;
			foreach ($idaliments as $a) {
				$aliments[$i]['aliment'] = $this->Aliment->findByid($a);
				$aliments[$i]['portion'] = $portions[$i];
				$aliments[$i]['quantite'] = $quantites[$i];
				$i++;
			}
			$this->set('aliments', $aliments);
			$fam = $this->Famillealiment->find('all', array('fields' => array('subcategory', 'id'), 'order' => array('subcategory ASC')));
			$familles = array();
			$i = 0;
			foreach ($fam as $f) {
				if ($f['Famillealiment']['id'] == 0) continue;
				$familles[$i]['famille'] = $f['Famillealiment']['subcategory'];
				$familles[$i]['id'] = $f['Famillealiment']['id'];
				$i++;
			}
			$this->set('fams',$familles);
		}
		
		if ($this->request->is('post')) {
			if (!empty($_POST['rechbtn'])) {
				/* Lancement recherche */
				if (!empty($_POST['rech4'])) {
					/* Aliment contenant une sous-classe */
					$resultats = $this->Alimentsdetaille->find('all',array('conditions' =>array(
							'AND' =>array(
								array('type' => $_POST['rech']),
								array('sous_type' => $_POST['rech2']),
								array('classe' => $_POST['rech3']),
								array('sous_classe' => $_POST['rech4']))
							)));
					$this->set('resultats', $resultats);
				} elseif (!empty($_POST['rech3'])) {
					/* Aliment contenant une classe */
					$resultats = $this->Alimentsdetaille->find('all',array('conditions' =>array(
							'AND' =>array(
								array('type' => $_POST['rech']),
								array('sous_type' => $_POST['rech2']),
								array('classe' => $_POST['rech3']))
							)));
					$this->set('resultats', $resultats);
				} elseif (!empty($_POST['rech2'])) {
					/* Aliment contenant un sous-type et un type -> obligé, classe & sous-classe sont facultatifs mais sous-type obligé */
					$resultats = $this->Alimentsdetaille->find('all',array('conditions' =>array(
							'AND' =>array(
								array('type' => $_POST['rech']),
								array('sous_type' => $_POST['rech2']))
							)));
					$this->set('resultats', $resultats);
				} 
			}
			
			$aliments = array();
			$i =0;
			if (isset($_POST['Ingred'])){
				foreach ($_POST['Ingred'] as $new) {
					$split = explode("@", $new);
					$aliments[$i]['aliment'] = $this->Aliment->findByid($split[0]);
					$aliments[$i]['portion'] = $split[1];
					$aliments[$i]['quantite'] = $split[2];
					$i++;
				}
			}
			if (!empty($_POST['repas1'])) {
				$split = explode("@", $_POST['repas1']);
				$aliments[$i]['aliment'] = $this->Aliment->findByid($split[0]);
				$aliments[$i]['portion'] = $split[1];
				$aliments[$i]['quantite'] = $split[2];
				$this->Session->setFlash("L'ingrédient a bien été ajouté");
			}
			$this->set('aliments', $aliments);
			$newmode = array();
			if (isset($_POST['Mode'])) {
				
				$i = 0;
				foreach ($_POST['Mode'] as $lesmodes) {
					$newmode[$i]['id_mode'] = $recid;
					$newmode[$i]['etape'] = $i+1;
					$newmode[$i]['descri'] = $lesmodes;
					$newmode[$i]['user_id'] = AuthComponent::user('id');
					$i++;
				}
			}
			$recette['Modespreparation'] = $newmode;
			if (isset($_POST['instru']) AND !empty($_POST['instru']['descri'])) {
					$tempo[$_POST['instru']['etape']-1]['id_mode'] = $recid;
					$tempo[$_POST['instru']['etape']-1]['etape'] = $_POST['instru']['etape'];
					$tempo[$_POST['instru']['etape']-1]['descri'] = $_POST['instru']['descri'];
					$tempo[$_POST['instru']['etape']-1]['user_id'] = AuthComponent::user('id');
					$tempo = decale_indices($newmode, $_POST['instru']['etape']-1, $tempo[$_POST['instru']['etape']-1]);
					$tempo = metAJourEtapes($tempo);
					$recette['Modespreparation'] = $tempo;
					$this->Session->setFlash("Le mode de préparation a bien été ajouté");
			}
			$this->set('recette',$recette);
			if (isset($_POST['endform'])) {
				if (empty($aliments)) {
					// pas d'aliments ajoutés
					$this->Session->setFlash("Vous devez ajouter au moins un aliment pour cette recette");
				} elseif (empty($recette['Modespreparation'])) {
					// pas de modes de préparation
					$this->Session->setFlash("Vous devez ajouter au moins un mode de préparation pour cette recette");
				} else {
					$this->set('fin', true);
					// Calcul des nutriments pour chaque aliment en fonction de la quantité de la recette (nb portion)
					$nutriments = array();
					$descri = $this->Aliment->query("select name from constituantaliments join donneescompilees on constituantaliments_id = constituantaliments.id where aliments_id = 1000");
					$this->set('descri',$descri);
					foreach ($descri as $desc) {
						$nutriments[]['nom'] = $desc['constituantaliments']['name'];
					}
					for ($i = 0; $i < 57; $i++) $nutriments[$i]['valeur'] = 0;
					foreach ($aliments as $alim) {
						for ($i = 0; $i < 57; $i++) {
							$nutriments[$i]['valeur'] = $nutriments[$i]['valeur'] + ($alim['aliment']['Donneesaliment'][$i]['valmoy'] * $alim['quantite'] * $alim['portion']/100);
						}
					}
					for ($i = 0; $i < count($nutriments); $i++) $nutriments[$i]['valeur'] = $nutriments[$i]['valeur'] * $_POST['data']['Mesrecette']['quantite'];
					$this->set('nutriments',$nutriments);
					$portiontotale = 0;
					foreach ($aliments as $alim) {
						$portiontotale = $portiontotale + $alim['portion'];
					}
					$this->set('portiontotale',$portiontotale);
				}
			}
			if (isset ($_POST['data']['Mesrecette'])) {
			    $newrecette = array();
				$newrecette['id'] = $recid;
				$newrecette['user_id'] = AuthComponent::user('id');
				//aliments
				$res = "";
				foreach ($aliments as $alim) $res = $res . $alim['aliment']['Aliment']['id'] . '@';
				$res = substr($res,0,strlen($res) -1);//supp dernier @
				$newrecette['aliments'] = $res;
				// portions
				$res = "";
				foreach ($aliments as $alim) $res = $res . $alim['portion'] . '@';
				$res = substr($res,0,strlen($res) -1);//supp dernier @
				$newrecette['portions'] = $res;
				// quantite
				$res = "";
				foreach ($aliments as $alim) $res = $res . $alim['quantite'] . '@';
				$res = substr($res,0,strlen($res) -1);//supp dernier @
				$newrecette['quantites'] = $res;
				$newrecette['quantite'] = $_POST['data']['Mesrecette']['quantite'];
				$newrecette['nom'] = $_POST['data']['Mesrecette']['nom'];
				$newrecette['type_id'] = $_POST['data']['Mesrecette']['type_id'];
				$newrecette['description'] = $_POST['data']['Mesrecette']['description'];
				$newrecette['temps_cui'] = $_POST['data']['Mesrecette']['temps_cui'];
				$newrecette['temps_prepa'] = $_POST['data']['Mesrecette']['temps_prepa'];
				$recette['Mesrecette'] = $newrecette;
				$this->set('recette', $recette);
			}
			if (isset($_POST['enregistrer'])) {
				// enregistrement de la recette
				$this->Modespreparation->deleteAll(array('Modespreparation.id_mode' => $recid), false);
				$this->Mesrecette->id = $recid;
				if ($this->Mesrecette->saveAll($recette)) {
					// suppression de tous les modes de préparation pour enregistrer les nouveaux
					
						$this->Session->setFlash("La recette a bien été modifiée");
						$this->redirect(array('action' => 'index'));
					
				} else {
					$this->Session->setFlash("Erreur lors de l'enregistrement de la recette. Veuillez réessayer.");
				}
			}
		}
	}
	
	public function add() {
		
		/* Recherche du nom d'une portion dans un tableau de donnée a partir de la valeur de la portion */
		function rech_portion($tab, $val) {
			$i = 0;
			$pos =0;
			foreach ($tab as $t) {
				if ($t == $val) {
					$pos = $i-1;
					break;
				}
				$i++;
			}
			$i=0;
			foreach ($tab as $t) {
				if ($i == $pos) {
					return $t;
				}
				$i++;
			}
		}
		
		/*
		 * Ajoute la valeur (ou tableau) $valaj dans un tableau $tab a la position (indice) $debut 
		 * Renvoie tableau avec décalage effectué
		 */
		function decale_indices($tab, $debut, $valaj) {
			$res = array();
			for ($i=0;$i<$debut;$i++) {
				$res[] = $tab[$i];
			}
			$res[] = $valaj;
			for ($i; $i < count($tab); $i++) {
				$res[] = $tab[$i];
			}
			return $res;
		}
		
		/* A parir d'un tableau de modes preparation, met a jour les étapes si elles sont dans le désordre : exemple [etape1,etape1,etape7] 
		 * renverra [etape1,etape2,etape3]
		 */
		function metAJourEtapes($tab) {
			for ($i = 0; $i < count($tab); $i++) {
				$tab[$i]['etape'] = $i+1;
			}
			return $tab;
		}
		
		if (!empty($_POST['postresult'])) {
			$aliment1 = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $_POST['postresult'])));
			if (!empty($aliment1)) {
			
			$id1 = $_POST['postresult'];
			if (empty($_POST['repas1'])) {
				$this->set('aliment1', $aliment1);
			}
			
			
			//On récupère la quantité du premier aliment que l'utilisateur souhaite comparer
			if (isset($_POST['quantite'])) {
				$quantiteAliment1 = $_POST['quantite'];
				$this->set('quantiteAliment1', $quantiteAliment1);
			} elseif (! isset($quantiteAliment1)) {
				$this->set('quantiteAliment1', 1);
			}
			
			//On récupère la portion du premier aliment que l'utilisateur souhaite comparer
			if (isset($_POST['portion'])) {
				$split = explode("@",$_POST['portion']);
				$quantitePortion1 = $split[0];
				$this->set('quantitePortion1', $quantitePortion1);
			} else {
				$this->set('quantitePortion1', $aliment1['Aliment']['P1Quantite']);
			}
		}
		}
		/* Recherche des cathegories d'aliements qui seront présents dans la 1ere boite a liste */
			$familles = $this->Alimentsdetaille->find('all',array(
							'fields' => 'type',
							'group' => array('type')));
			$this->set('familles',$familles);
			$sous_types = $this->Alimentsdetaille->find('all',array(
							'fields' => array('sous_type','type'),
							'group' => array('sous_type')));
			$this->set('sous_types',$sous_types);
			$classe = $this->Alimentsdetaille->find('all',array(
								'fields' => array('classe','sous_type','type'),
								'group' => array('classe')));
			$this->set('classes',$classe);
			$sous_classe = $this->Alimentsdetaille->find('all',array(
								'fields' => array('sous_classe','classe','sous_type','type'),
								'group' => array('sous_classe')));
			$this->set('sous_classes',$sous_classe);
		
		
		$id = AuthComponent::user('id');
		$recette = array();
		$this->set('recette', $recette);
		$aliments = array();
		$this->set('aliments', $aliments);
		$fam = $this->Famillealiment->find('all', array('fields' => array('subcategory', 'id'), 'order' => array('subcategory ASC')));
		$familles = array();
		$i = 0;
		foreach ($fam as $f) {
			if ($f['Famillealiment']['id'] == 0) continue;
			$familles[$i]['famille'] = $f['Famillealiment']['subcategory'];
			$familles[$i]['id'] = $f['Famillealiment']['id'];
			$i++;
		}
		$this->set('fams',$familles);
			
		if ($this->request->is('post')) {
			if (!empty($_POST['rechbtn'])) {
				/* Lancement recherche */
				if (!empty($_POST['rech4'])) {
					/* Aliment contenant une sous-classe */
					$resultats = $this->Alimentsdetaille->find('all',array('conditions' =>array(
							'AND' =>array(
								array('type' => $_POST['rech']),
								array('sous_type' => $_POST['rech2']),
								array('classe' => $_POST['rech3']),
								array('sous_classe' => $_POST['rech4']))
							)));
					$this->set('resultats', $resultats);
				} elseif (!empty($_POST['rech3'])) {
					/* Aliment contenant une classe */
					$resultats = $this->Alimentsdetaille->find('all',array('conditions' =>array(
							'AND' =>array(
								array('type' => $_POST['rech']),
								array('sous_type' => $_POST['rech2']),
								array('classe' => $_POST['rech3']))
							)));
					$this->set('resultats', $resultats);
				} elseif (!empty($_POST['rech2'])) {
					/* Aliment contenant un sous-type et un type -> obligé, classe & sous-classe sont facultatifs mais sous-type obligé */
					$resultats = $this->Alimentsdetaille->find('all',array('conditions' =>array(
							'AND' =>array(
								array('type' => $_POST['rech']),
								array('sous_type' => $_POST['rech2']))
							)));
					$this->set('resultats', $resultats);
				} 
			}
			
			$aliments = array();
			$i =0;
			if (isset($_POST['Ingred'])){
				foreach ($_POST['Ingred'] as $new) {
					$split = explode("@", $new);
					$aliments[$i]['aliment'] = $this->Aliment->findByid($split[0]);
					$aliments[$i]['portion'] = $split[1];
					$aliments[$i]['quantite'] = $split[2];
					$i++;
				}
			}
			if (!empty($_POST['repas1'])) {
				$split = explode("@", $_POST['repas1']);
				$aliments[$i]['aliment'] = $this->Aliment->findByid($split[0]);
				$aliments[$i]['portion'] = $split[1];
				$aliments[$i]['quantite'] = $split[2];
				$this->Session->setFlash("L'ingrédient a bien été ajouté");
			}
			$this->set('aliments', $aliments);
			$newmode = array();
			if (isset($_POST['Mode'])) {
				
				$i = 0;
				foreach ($_POST['Mode'] as $lesmodes) {
					$newmode[$i]['etape'] = $i+1;
					$newmode[$i]['descri'] = $lesmodes;
					$newmode[$i]['user_id'] = AuthComponent::user('id');
					$i++;
				}
			}
			$recette['Modespreparation'] = $newmode;
			if (isset($_POST['instru']) AND !empty($_POST['instru']['descri'])) {
					$tempo[$_POST['instru']['etape']-1]['etape'] = $_POST['instru']['etape'];
					$tempo[$_POST['instru']['etape']-1]['descri'] = $_POST['instru']['descri'];
					$tempo[$_POST['instru']['etape']-1]['user_id'] = AuthComponent::user('id');
					$tempo = decale_indices($newmode, $_POST['instru']['etape']-1, $tempo[$_POST['instru']['etape']-1]);
					$tempo = metAJourEtapes($tempo);
					$recette['Modespreparation'] = $tempo;
					$this->Session->setFlash("Le mode de préparation a bien été ajouté");
			}
			$this->set('recette',$recette);
			if (isset($_POST['endform'])) {
				if (empty($aliments)) {
					// pas d'aliments ajoutés
					$this->Session->setFlash("Vous devez ajouter au moins un aliment pour cette recette");
				} elseif (empty($recette['Modespreparation'])) {
					// pas de modes de préparation
					$this->Session->setFlash("Vous devez ajouter au moins un mode de préparation pour cette recette");
				} else {
					$this->set('fin', true);
					// Calcul des nutriments pour chaque aliment en fonction de la quantité de la recette (nb portion)
					$nutriments = array();
					$descri = $this->Aliment->query("select name from constituantaliments join donneescompilees on constituantaliments_id = constituantaliments.id where aliments_id = 1000");
					$this->set('descri',$descri);
					foreach ($descri as $desc) {
						$nutriments[]['nom'] = $desc['constituantaliments']['name'];
					}
					for ($i = 0; $i < 57; $i++) $nutriments[$i]['valeur'] = 0;
					foreach ($aliments as $alim) {
						for ($i = 0; $i < 57; $i++) {
							$nutriments[$i]['valeur'] = $nutriments[$i]['valeur'] + ($alim['aliment']['Donneesaliment'][$i]['valmoy'] * $alim['quantite'] * $alim['portion']/100);
						}
					}
					for ($i = 0; $i < count($nutriments); $i++) $nutriments[$i]['valeur'] = $nutriments[$i]['valeur'] * $_POST['data']['Mesrecette']['quantite'];
					$this->set('nutriments',$nutriments);
					$portiontotale = 0;
					foreach ($aliments as $alim) {
						$portiontotale = $portiontotale + $alim['portion'];
					}
					$this->set('portiontotale',$portiontotale);
				}
			}
			if (isset ($_POST['data']['Mesrecette'])) {
			    $newrecette = array();
				$newrecette['user_id'] = AuthComponent::user('id');
				//aliments
				$res = "";
				foreach ($aliments as $alim) $res = $res . $alim['aliment']['Aliment']['id'] . '@';
				$res = substr($res,0,strlen($res) -1);//supp dernier @
				$newrecette['aliments'] = $res;
				// portions
				$res = "";
				foreach ($aliments as $alim) $res = $res . $alim['portion'] . '@';
				$res = substr($res,0,strlen($res) -1);//supp dernier @
				$newrecette['portions'] = $res;
				// quantite
				$res = "";
				foreach ($aliments as $alim) $res = $res . $alim['quantite'] . '@';
				$res = substr($res,0,strlen($res) -1);//supp dernier @
				$newrecette['quantites'] = $res;
				$newrecette['quantite'] = $_POST['data']['Mesrecette']['quantite'];
				$newrecette['nom'] = $_POST['data']['Mesrecette']['nom'];
				$newrecette['type_id'] = $_POST['data']['Mesrecette']['type_id'];
				$newrecette['description'] = $_POST['data']['Mesrecette']['description'];
				$newrecette['temps_cui'] = $_POST['data']['Mesrecette']['temps_cui'];
				$newrecette['temps_prepa'] = $_POST['data']['Mesrecette']['temps_prepa'];
				$recette['Mesrecette'] = $newrecette;
				$this->set('recette', $recette);
			}
			if (isset($_POST['enregistrer'])) {
				// enregistrement de la recette
				$this->Mesrecette->create();
				if ($this->Mesrecette->saveAll($recette)) {
					// suppression de tous les modes de préparation pour enregistrer les nouveaux
					
						$this->Session->setFlash("La recette a bien été ajoutée");
						$this->redirect(array('action' => 'index'));
					
				} else {
					$this->Session->setFlash("Erreur lors de l'enregistrement de la recette. Veuillez réessayer.");
				}
			}
		}
	}
	
	public function afficher($idrec = null) {
		/* Recherche du nom d'une portion dans un tableau de donnée a partir de la valeur de la portion */
		function rech_portion($tab, $val) {
			$i = 0;
			$pos =0;
			foreach ($tab as $t) {
				if ($t == $val) {
					$pos = $i-1;
					break;
				}
				$i++;
			}
			$i=0;
			foreach ($tab as $t) {
				if ($i == $pos) {
					return $t;
				}
				$i++;
			}
		}
		
		$id = AuthComponent::user('id');
		$user = $this->User->findByid($id);
		$afficher = false;
		$recette = $this->Mesrecette->find('first', array('conditions' => array('AND' => array(array(
			array('Mesrecette.user_id' => $id),
			array('Mesrecette.id' => $idrec)
		)))));
		if (!empty($recette)) {
			$afficher = true;
		}
			
		$this->set('afficher', $afficher);
		if ($afficher) {
			$this->set('recette', $recette);
			$idaliments = explode("@", $recette['Mesrecette']['aliments']);
			$portions = explode("@", $recette['Mesrecette']['portions']);
			$quantites = explode("@", $recette['Mesrecette']['quantites']);
			$aliments = array();
			$i = 0;
			foreach ($idaliments as $a) {
				$aliments[$i]['aliment'] = $this->Aliment->findByid($a);
				$aliments[$i]['portion'] = $portions[$i];
				$aliments[$i]['quantite'] = $quantites[$i];
				$i++;
			}
			$this->set('aliments', $aliments);
			$nutriments = array();
			$descri = $this->Aliment->query("select name from constituantaliments join donneescompilees on constituantaliments_id = constituantaliments.id where aliments_id = 1000");
			$this->set('descri',$descri);
			foreach ($descri as $desc) {
				$nutriments[]['nom'] = $desc['constituantaliments']['name'];
			}
			for ($i = 0; $i < 57; $i++) $nutriments[$i]['valeur'] = 0;
			foreach ($aliments as $alim) {
				for ($i = 0; $i < 57; $i++) {
					$nutriments[$i]['valeur'] = $nutriments[$i]['valeur'] + ($alim['aliment']['Donneesaliment'][$i]['valmoy'] * $alim['quantite'] * $alim['portion']/100);
				}
			}
			for ($i = 0; $i < count($nutriments); $i++) $nutriments[$i]['valeur'] = $nutriments[$i]['valeur'] * $recette['Mesrecette']['quantite'];
			$this->set('nutriments',$nutriments);
			$portiontotale = 0;
			foreach ($aliments as $alim) {
				$portiontotale = $portiontotale + $alim['portion'];
			}
			$this->set('portiontotale',$portiontotale);
		}
	}

	public function delete($idrec = null) {
		$id = AuthComponent::user('id');
		$afficher = false;
		$recette = $this->Mesrecette->find('first', array('conditions' => array('AND' => array(array(
			array('Mesrecette.user_id' => $id),
			array('Mesrecette.id' => $idrec)
		)))));
		if (!empty($recette)) {
			$afficher = true;
		}
			
		$this->set('affichage', $afficher);
		if ($afficher) {
			$this->set('recette', $recette);
		}
		
		if ($this->request->is('post')) {
			if ($this->Mesrecette->delete($idrec, true)) {
				$this->Session->setFlash("La recette a bien été supprimée.");
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash("Erreur lors de la suppression de la recette, veuillez réessayer.");
			}
		}
	}
}
