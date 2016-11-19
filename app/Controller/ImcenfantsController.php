<?php
App::uses('AppController', 'Controller');
/**
 * Imcenfants Controller
 *
 * @property Imcenfant $Imcenfant
 */
class ImcenfantsController extends AppController {

	// Pour utiliser des modèles spécifiques
	public $uses = array('Imcenfant', 'User');
        
        

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'calcul'); // Letting non-users see these pages
                $this->set('page_cours', 'jaune');
	}
	
	public function index()
	{
		
                $id = AuthComponent::user('id');
		if ($id != null) {
			$user = $this->User->find('first', array('conditions' => array('id' => $id)));
			$this->set('datenaissance', $user['User']['datenaissance']);
			$this->set('taille', $user['User']['taille']);
			$this->set('poids', $user['User']['poids']);
			$this->set('sexe', $user['User']['sexe']);
			$this->set('enceinte', $user['User']['enceinte']);
			$this->set('allaitante', $user['User']['allaitante']);
		} else {
			$this->set('noPost', 1);
		}
	}


	//Permet de calculer l'IMC d'une personne
	public function calcul() {
                
		$fille=0;
		$garcon=0;
		//On récupère les informations concernant le poids et la taille de la personne
		//Par la suite, on applique la formule poids/taille²
		if ($this->request->is('post')) {
			$message;
			$valid = true;
			if (!(preg_match("/^[0-9]{1,3}$/", $_POST['zt_age']) AND $_POST['zt_age'] > 0 AND $_POST['zt_age'] <130)) {
				$message = 'Veuillez saisir un âge valide';
				$valid= false;
			} 
			if (!(preg_match("/^[0-9]{1,3}$/", $_POST['zt_poids']) AND $_POST['zt_poids'] > 0 AND $_POST['zt_poids'] <600)) {
				$message = 'Veuillez saisir un poids valide';
				$valid = false;
			}
			if (!(preg_match("/^[0-9]{1,3}$/", $_POST['zt_taille']) AND $_POST['zt_taille'] > 0 AND $_POST['zt_taille'] <270)) {
				$message = 'Veuillez saisir une taille valide';
				$valid = false;
			}
                        $this->set('affichage', $valid);
			if (!$valid) { 
                            $this->Session->setFlash($message, "messageAvert");
                            $this->redirect(array('action' => 'index'));
                        }

                if ($valid) {
			
			$imc=($_POST['zt_poids']/($_POST['zt_taille']*$_POST['zt_taille']))*10000;
			//Si l'utilisateur est un enfant (age <=18)
			if ($_POST['zt_age']<18) {
				if ($imc < 11 OR $imc > 32) {
								$this->Session->setFlash(__('Votre IMC ne peut pas être affiché dans le graphe'));
				}
				$imcenfants = $this->Imcenfant->find('first', array('conditions' => array(
					'Imcenfant.id' => $_POST['zt_age'])));
				//Que l'enfant soit un garçon & une fille, on recherche dans la bdd le poids minimal et le poids maximal correspondant à son âge et à son sexe
				if ($_POST['sexe'] == 'homme') {
					$imcMin = $imcenfants['Imcenfant']['ming'];
					$imcMax = $imcenfants['Imcenfant']['maxg'];
					$garcon=1;
					$this->set('garcon',$garcon);

				} else {
					$imcMin = $imcenfants['Imcenfant']['minf'];
					$imcMax = $imcenfants['Imcenfant']['maxf'];
					$fille=1;
					$this->set('fille',$fille);
				}
			//Si l'utilisateur est un adulte, son IMC doit être compris entre 18.5 et 25 inclus
			} else {
				$imcMin = 18.5;
				$imcMax = 25;
			}

			if ($_POST['sexe'] == 'homme') {
				switch ($_POST['AP']) {
					case 1: 
						$AP = 1.0;
						break;
					case 2: 
						$AP = 1.11;
						break;
					case 3: 
						$AP = 1.25;
						break;
					case 4: 
						$AP = 1.48;
				}
				//Calcul des besoins énergétiques estimés pour un homme en fonction de son age et de son poids
				$BEE = round(864 - 9.72 * $_POST['zt_age'] + $AP * (14.2 * $_POST['zt_poids'] + 503 * $_POST['zt_taille'] / 100));

			} else {
				switch ($_POST['AP']) {
					case 1: 
						$AP = 1.0;
						break;
					case 2: 
						$AP = 1.12;
						break;
					case 3: 
						$AP = 1.27;
						break;
					case 4: 
						$AP = 1.45;
				}
				//Calcul des besoins énergétiques estimés pour une femme en fonction de son age et de son poids
				$BEE = round(387 - 7.31 * $_POST['zt_age'] + $AP * (10.9 * $_POST['zt_poids'] + 660.7 * $_POST['zt_taille'] / 100));

			}

			$this->set('imc', $imc);
			$this->set('imcMin', $imcMin);
			$this->set('imcMax', $imcMax);
			$this->set('BEE', $BEE);
	}
		}
	}
}
