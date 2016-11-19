<?php
App::uses('AppController', 'Controller');
/**
 * Gestionpoids Controller
 *
 * @property Gestionpoid $Gestionpoid
 */
 
 
 
 //TODO
 //AFFICHER COURBE OBJECTIF
 
 
class GestionpoidsController extends AppController {

	public $uses = array('User','Suiviphysique','Objectifpoid', 'Gestionpoid');

	public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('id') == null) {
            $this->Session->setFlash("Vous devez être connecter pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->set('page_cours', 'rouge');
        }

        public function index(){
		/* Converti une date en sql (ex : 2015-3-20) en francais (20/3/2015) */
		function dateEnFrancais($date) {
			$split = explode("-", $date);
			$jour = $split[2];
			$mois = $split[1];
			$annee = $split[0];
			return $jour . '/' . $mois . '/' . $annee;
		}
		
		$id = AuthComponent::user('id');
		//Gestion et generation des données pour l'affichage du graphe
		//Selection des poids de l'utilisateur
		$poi = $this->Gestionpoid->find('all',array('conditions' => array('Gestionpoid.idclient' => $id),'order' => array('Gestionpoid.date ASC')));
		$this->set('poids', $poi);
		//selection de l'objectif de l'utilisateur
		$currentObj = $this->Objectifpoid->find('first',array('conditions' => array('Objectifpoid.idclient' => $id)));
		//cas ou il n'y a pas d'objectif
		if (empty($currentObj['Objectifpoid']['objectif'])){
			$objectif = 0 ;
		} else {
			$objectif = $currentObj['Objectifpoid']['objectif'] ;
		}
		$this->set('obj',$objectif);
		//cas ou l'utilisateur a deja rentré un poids
		if(!empty($poi)){
			
			$maxp = $this->Gestionpoid->find('first',array('conditions' => array('Gestionpoid.idclient' => $id),'fields' => array('MAX(Gestionpoid.poids) as max_poids')));
			
			$compteur = count($poi);
			$i = 0;
			foreach ($poi as $poid) {
				$compteur--;
				if ($compteur > 9) continue;
				$tabAbs[$i] = dateEnFrancais($poid['Gestionpoid']['date']);
				$tabOrd[$i] = $poid['Gestionpoid']['poids'];
				$i++;
			}
			$this->set('Abscisse',$tabAbs);
			$this->set('Ordonne',$tabOrd);
			$this->set('Maxpoids',$maxp);
		
		
		}
		//formulaire
		if ($this->request->is('post')) {
			//enregistrement poids
			$fin = false;
			$message ="";
			if (!(preg_match("`^[0-9]{0,3}$`",$_POST['lepoids']))) {
				$fin = true;
				$message = "Attention, le poids doit être un nombre de 1 à 3 chiffres (ex: 56)";
			} elseif (!empty($_POST['lepoids']) AND $_POST['lepoids'] <= 0) {
				$fin = true;
				$message = "Attention, le poids doit être supperieur à zero";
			}
			$_POST['objectif'] = isset($_POST['objectif']) ? $_POST['objectif'] : $objectif;
			if (!(preg_match("`^[0-9]{1,3}$`",$_POST['objectif']))) {
				$fin = true;
				$message = "Attention, l'objectif doit être un nombre de 1 à 3 chiffres (ex: 56)";
			} elseif ($_POST['objectif'] <= 0) {
				$fin = true;
				$message = "Attention, l'objectif doit être supperieur à zero";
			}
			if ($fin) {
				$this->Session->setFlash(__($message));
			} else {
				$poidinsert = $_POST['lepoids'] ;
				if (empty($poidinsert)) {
					// Modification seulement de l'objectif
					if($objectif==0){
						$this->Objectifpoid->create();
						$this->Objectifpoid->set('idclient' , $id);
						$this->Objectifpoid->set('objectif' , $_POST['objectif']);
						if ($this->Objectifpoid->save()) {
                                                        $this->Session->setFlash("L'objectif a bien été enregistré", 'messageBon');
							$this->redirect(array('action' => 'index'));
						}
					} else {
						if ($objectif != $_POST['objectif']) {
							$this->Objectifpoid->updateAll(array('Objectifpoid.objectif' => '\''. $_POST['objectif'] . '\''), array('Objectifpoid.idclient' => $id));
							$this->Session->setFlash("L'objectif a bien été enregistré", 'messageBon');
							$this->redirect(array('action' => 'index'));
						} // si meme objectif on enregistre pas
					}
				} else {
					$date = date('y/m/d h:i:s a', time());
					$this->Gestionpoid->create();
					$this->Gestionpoid->set('idclient' , $id);
					$this->Gestionpoid->set('poids' , $poidinsert);
					$this->Gestionpoid->set('date' , $date);
					if($this->Gestionpoid->save()){ 
						if($objectif==0){
							$this->Objectifpoid->create();
							$this->Objectifpoid->set('idclient' , $id);
							$this->Objectifpoid->set('objectif' , $_POST['objectif']);
							if ($this->Objectifpoid->save()) {
                                                            $this->Session->setFlash("Le poids et l'objectif ont bien été enregistrés", 'messageBon');
                                                            $this->redirect(array('action' => 'index'));
							}
						} else {
							if ($objectif != $_POST['objectif']) {
								$this->Objectifpoid->updateAll(array('Objectifpoid.objectif' => '\''. $_POST['objectif'] . '\''), array('Objectifpoid.idclient' => $id));
								$this->Session->setFlash("Le poids et l'objectif ont bien été enregistrés", 'messageBon');
								$this->redirect(array('action' => 'index'));
							} else { // si meme objectif on enregistre pas
								$this->Session->setFlash("Le poids a bien été enregistré", 'messageBon');
								$this->redirect(array('action' => 'index'));
							}
						}
					} else {
                                                $this->Session->setFlash("Erreur lors de la sauvegarde de votre poids, veuillez réessayer", 'messageAvert');
					}
				}
			}
		}
	}
}	
