<?php

App::uses('AppController', 'Controller');

class LiensController extends AppController {
	var $helpers = array('Html', 'Form', 'Ck', 'Js'); 

	// Pour utiliser des modèles spécifiques
	public $uses = array('Lien', 'Form', 'Ck');

	public function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow('lien', 'recherche'); // Letting non-users see public actualites
                        $this->set('page_cours', 'violet');
		}

	//Permet d'afficher l'ensemble des liens
	public function index() {

		$liens = $this->Lien->find('all');
		$this->set('liens', $liens);
	}

	public function lien($id = null) {
                $this->Lien->id = $id;
		if ($this->Lien->exists()) {
			$lien = $this->Lien->find('first', array('conditions' => array('Lien.id' => $id)));
				$this->set('lien', $lien);
		} else {
                    $this->Session->setFlash('Le lien n\'existe pas', 'messageAvert');
                    $this->redirect(array('action' => 'index')); 
		}
	}

	
	public function recherche() {
		$termes = str_replace(" ", "%", $_GET['s']);
		$liens = $this->Lien->find('all', array(
			'conditions' => array('content LIKE' => '%' . $termes . '%')));
		$this->set('liens', $liens);
	}

	//Permet d'effectuer les modifications concernant un lien 
	public function edit($id=null) {
		$this->Lien->id = $id;
		if (!$this->Lien->exists()) {
                    $this->Session->setFlash('Erreur ! Le lien à modifier n\'existe pas','messageErr');
                    $this->redirect(array('action' => 'index'));
		}

		$this->set('id', $id);

		$lien = $this->Lien->find('first', array('conditions' => array('Lien.id' => $id)));
		$this->set('titre', $lien['Lien']['title']);
		
		$this->set('contenu', $lien['Lien']['content']);
		

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lien->save($this->request->data)) {
				$this->Session->setFlash('Le lien a été modifié','messageBon');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Le lien n\'a pas pu être modifié. Merci de réessayer.','messageAvert');
			}
		}
	}

	//Permet d'ajouter un lien
	public function add() {
		//$this->set('categories', $this->Category->find('all'));

		if ($this->request->is('post')) {
				$this->Lien->create();
				if ($this->Lien->save($this->request->data)) {
					$this->Session->setFlash('Le lien a été ajouté', 'messageBon');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Erreur lors de la creation du lien. Merci de réessayer.','messageErr');
				}
			}
	}

	//Permet de supprimer un lien 
        public function delete($id = null) {
                if (AuthComponent::user('role') == 'administrateur') {
                        $lien = $this->Lien->find('first', array('conditions' => array('Lien.id' => $id)));
                        $this->set('lien', $lien);

                        if ($this->request->is('post')) {
                                $this->Lien->id = $id;
                                if (!$this->Lien->exists()) {
                                        throw new NotFoundException(__('Lien invalide'));
                                }
                                if ($this->Lien->delete()) {
                                        $this->Session->setFlash('Lien supprimé','messageBon');
                                        $this->redirect(array('action' => 'index'));
                                }
                                $this->Session->setFlash('Le lien n\'a pas pu être supprimé. Merci de réessayer.','messageAvert');
                                $this->redirect(array('action' => 'index'));
                        }
                } else {
                        $this->Session->setFlash('Vous n\'avez pas accès à cette page', 'messageAvert');
                        $this->redirect(array('action' => 'index'));
                }
        }
}
