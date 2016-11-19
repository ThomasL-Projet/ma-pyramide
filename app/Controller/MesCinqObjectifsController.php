<?php
App::uses('AppController', 'Controller');
/**
 * MesCinqObjectifs Controller
 *
 * @property MesCinqObjectifs $MesCinqObjectifs
 */
class MesCinqObjectifsController extends AppController {

	// Pour utiliser des modèles spécifiques
	public $uses = array('User','Cinqobjectif');

	public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('id') == null) {
            $this->Session->setFlash("Vous devez être connecter pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->set('page_cours', 'rouge');
        }

        public function index() {
		// Fonction permettant de traduire une date au format sql en lettre, avec heure
		function dateenlettre($date) {
			$dateheure = explode(" ",$date);
			$date = $dateheure[0];
			$heure = $dateheure[1];
			$split = explode("-",$date);
			$jour = $split[2];
			$mois = $split[1];
			$annee = $split[0];
			$newTimestamp = mktime(12,0,0,$mois,$jour,$annee);
			 
			$Jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
			$Mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
			 
			$split = explode(":",$heure);
			$heure = $split[0] . 'h' . $split[1];
			return $Jour[date("w", $newTimestamp)] . ' ' . $jour . ' ' . $Mois[date("n", $newTimestamp)] . ' ' . $annee . ' à ' . $heure;
		}
		$user = $this->User->find('first', array('conditions' => array('id' => AuthComponent::user('id'))));
		$this->set('user',$user);
		
		if ($this->request->is('post')) {
			$this->Cinqobjectif->create();
			$this->Cinqobjectif->set('user_id', $user['User']['id']);
			$commentaire = nl2br($_POST['com']);
			$this->Cinqobjectif->set('description', $commentaire);
			if ($this->Cinqobjectif->save()) {
				$this->Session->setFlash('Votre objectif à bien été enregistré','messageBon');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Erreur lors de l\'enregistrement de votre objectif, le nombre de retour à la ligne est trop grand','messageeErr');
                                $this->redirect(array('action' => 'index'));           
                        }
		}
	}
	
	public function delete($id=null) {
		// Vérification que l'id consulté est bien celui du client
		$user = $this->User->find('first', array('conditions' => array('id' => AuthComponent::user('id'))));
		$ok = false;
		$objectif;
		foreach ($user['Cinqobjectif'] as $obj) {
			if ($obj['id'] == $id) {
				$ok = true;
				$objectif = $obj;
				break;
			}
		}
		if (!$ok) {
			$this->Session->setFlash('Erreur ! Vous n\'êtes pas autorisé à accéder à cette ressource.','messageErr');
			$this->set('affichage', false);
                        return $this->redirect(array('action' => 'index'));
		} else {
			// ok
			$this->set('affichage', true);
			$this->set('objectif', $objectif);
			if ($this->request->is('post')) {
				$this->Cinqobjectif->id = $objectif['id'];
				if ($this->Cinqobjectif->delete()) {
					$this->Session->setFlash('Objectif a bien été supprimé','messageBon');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('L\'objectif n\'a pas été supprimé. Merci de réessayer.','messageAvert');
					$this->redirect(array('action' => 'delete/'.$id));
				}
			}
		}
	}
	
	public function edit($id=null) {
		// Vérification que l'id consulté est bien celui du client
		$user = $this->User->find('first', array('conditions' => array('id' => AuthComponent::user('id'))));
		$ok = false;
		$objectif;
		foreach ($user['Cinqobjectif'] as $obj) {
			if ($obj['id'] == $id) {
				$ok = true;
				$objectif = $obj;
				break;
			}
		}
		if (!$ok) {
			$this->Session->setFlash('Erreur ! Vous n\'êtes pas autorisé à accéder à cette ressource.','messageErr');
			$this->set('affichage', false);
                        $this->redirect(array('action' => 'index'));
		} else {
			// ok
			$this->set('affichage', true);
			$this->set('objectif', $objectif);
			if ($this->request->is('post')) {
				$commentaire = nl2br($_POST['com']);
				if ($this->Cinqobjectif->updateAll(array('Cinqobjectif.description' => '"'. $commentaire . '"'), array('Cinqobjectif.id' => $id))) {
					$this->Session->setFlash('Objectif a bien été modifié','messageBon');
					$this->redirect(array('action' => 'index'));
				} else {
                                        $this->Session->setFlash('L\'objectif n\'a pas été modifié, le nombre de retour à la ligne est trop grand. Merci de réessayer.','messageAvert');
					$this->redirect(array('action' => 'edit/'.$id));
				}
			}
			
		}
	}
}