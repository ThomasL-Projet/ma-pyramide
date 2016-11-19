<?php

App::uses('AppController', 'Controller');

class StatiquesController extends AppController {
	var $helpers = array('Html', 'Form', 'Ck', 'Js'); 

	// Pour utiliser des modèles spécifiques
	public $uses = array('Statique', 'Category', 'Form', 'Ck', 'Categoriesimage');
	
	public $components = array('Paginator');

	public function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow('pages'); // Letting non-users see public articles
                        $this->set('page_cours', 'violet');
		}
	public function index() {
		$this->Statique->recursive = 0;
		if ($this->request->is('post') and $_POST['filtre'] != 'all') {
			$this->paginate = array(
			'conditions' => array('Statique.category_id' => $_POST['filtre']),
			'limit' => 10,
			'order' => array('Categoriesimage.name' => 'ASC'));
			$this->set('filtrer',$_POST['filtre']);
		} else {
			$this->paginate = array(
			'limit' => 10,
			'order' => array('Categoriesimage.name' => 'ASC'));
		}
		
		
		$this->set('pages', $this->paginate());
		$this->set('categories', $this->Categoriesimage->find('all', array('order' => array('Categoriesimage.sous_partie ASC'))));
		
	}
	
	//Permet d'ajouter un une page statique
	public function add() {
		$this->set('categories', $this->Categoriesimage->find('all', array('order' => array('Categoriesimage.sous_partie ASC'))));

		if ($this->request->is('post')) {
			$images = "";
				if (isset($_POST['images'])) {
					if (count($_POST['images']) == 1) {
						$images = $_POST['images'][0];
					} elseif (count($_POST['images']) == 2) {
						$images = $_POST['images'][0] . '@' . $_POST['images'][1];
					}
					$_POST['data']['Statique']['imagesid'] = $images;
				} else {
					$_POST['data']['Statique']['imagesid'] = "";
				}
				$cpy = $_POST['data']['Statique'];
				$this->Statique->create();
				if ($this->Statique->save($cpy)) {
					$this->Session->setFlash(__("La page a bien été ajoutée"));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__("Erreur lors de la creation de la page. Merci de réessayer."));
				}
			}
	}
	
	public function pages($id = null) {
                $this->set('page_cours', 'jaune');
		if ($id != null) {
			$page = $this->Statique->find('first', array('conditions' => array('Statique.id' => $id)));
			$affichage = true;
			if (empty($page)) {
				$this->Session->setFlash(__("La page est introuvable"));
				$affichage = false;
			}
			$this->set('affichage', $affichage);
			$this->set('pages', $page);
		} else {
			$page = $this->Statique->find('all');
			$this->set('pages', $page);
		}
	}
	
	public function delete($id = null) {
			
			$this->Session->setFlash("Veuillez confirmer la suppression de la page");
			
			if (AuthComponent::user('role') == 'administrateur') {
				$statiques = $this->Statique->find('first', array('conditions' => array('Statique.id' => $id)));
				$this->set('statique', $statiques);

				if ($this->request->is('post')) {
					$this->Statique->id = $id;
					if (!$this->Statique->exists()) {
						throw new NotFoundException(__('Page invalide'));
					}
					if ($this->Statique->delete()) {
						$this->Session->setFlash(__('Page supprimé'));
						$this->redirect(array('action' => 'index'));
					}
					$this->Session->setFlash(__("La page n'a pas pu être supprimé. Merci de réessayer."));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__("Vous n'avez pas accès à cette page"));
				$this->redirect(array('action' => 'index'));
			}
	}
	
	public function edit($id=null) {
		$this->Statique->id = $id;
		if (!$this->Statique->exists()) {
			throw new NotFoundException(__('Id de page invalide'));
		}

		$this->set('id', $id);

		$statique = $this->Statique->find('first', array('conditions' => array('Statique.id' => $id)));
		$this->set('titre', $statique['Statique']['title']);
		$this->set('onglet', $statique['Statique']['titreonglet']);
		$this->set('idCategorie', $statique['Statique']['category_id']);
		$this->set('contenu1', $statique['Statique']['content1']);
		$this->set('contenu2', $statique['Statique']['content2']);
		$this->set('contenu3', $statique['Statique']['content3']);
		$this->set('images', explode("@",$statique['Statique']['imagesid']));
		$this->set('categories', $this->Categoriesimage->find('all', array('order' => array('Categoriesimage.sous_partie ASC'))));

		if ($this->request->is('post') || $this->request->is('put')) {
				$images = "";
				if (isset($_POST['images'])) {
					if (count($_POST['images']) == 1) {
						$images = $_POST['images'][0];
					} elseif (count($_POST['images']) == 2) {
						$images = $_POST['images'][0] . '@' . $_POST['images'][1];
					}
					$_POST['data']['Statique']['imagesid'] = $images;
				} else {
					$_POST['data']['Statique']['imagesid'] = "";
				}
				$cpy = $_POST['data']['Statique'];
				if ($this->Statique->save($cpy)) {
					$this->Session->setFlash(__("La page a été modifiée"));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__("La page n'a pas pu être modifiée. Merci de réessayer."));
				}
			
		}
	}
}