<?php

App::uses('AppController', 'Controller');

class ActualitesController extends AppController {

    var $helpers = array('Html', 'Form', 'Ck', 'Js');
    // Pour utiliser des modèles spécifiques
    public $uses = array('Actualite', 'Form', 'Ck');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('actualite');
        $this->Auth->allow('index');
        if (AuthComponent::user('role') == 'administrateur') {
            $this->set('page_cours', 'violet');
        } else {
            $this->set('page_cours', 'bleu');
        }
        // Letting non-users see public actualites
    }

    //Permet d'afficher l'ensemble des actualites
    public function index() {
        $actualites = $this->Actualite->find('all');
        // array_reverse -> met les articles dans l'ordre de date
        $this->set('actualites', array_reverse ($actualites));
    }

    public function actualite($id = null) {
        if ($id != null) {
            $actualite = $this->Actualite->find('first', array('conditions' => array('Actualite.id' => $id)));
            if(empty($actualite)) {
                $this->Session->setFlash("L'actualité spécifié n'existe pas.", "messageAvert");
                $this->redirect(array('action' => 'index'));
            }
            $this->set('actualite', $actualite);
        } else {
            $actualite = $this->Actualite->find('all');
            $this->set('actualite', $actualite);
        }
    }

    //Permet d'effectuer les modifications concernant un actualite 
    public function edit($id = null) {
        $this->Actualite->id = $id;
        if (!$this->Actualite->exists()) {
            $this->Session->setFlash("L'actualité spécifiée ne semble pas exister", "messageAvert");
                $this->redirect(array('action' => 'index'));
        }

        $this->set('id', $id);

        $actualite = $this->Actualite->find('first', array('conditions' => array('Actualite.id' => $id)));
        $this->set('titre', $actualite['Actualite']['title']);

        $this->set('contenu', $actualite['Actualite']['content']);


        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Actualite->save($this->request->data)) {
                $this->Session->setFlash("L'actualité a été modifié", "messageBon");
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("L'actualité n'a pas pu être modifié. Merci de réessayer.", "messageAvert");
            }
        }
    }

    //Permet d'ajouter un actualite
    public function add() {
        //$this->set('categories', $this->Category->find('all'));

        if ($this->request->is('post')) {
            $this->Actualite->create();
            if ($this->Actualite->save($this->request->data)) {
                $this->Session->setFlash("L'Actualité a été ajouté","messageBon");
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("Erreur lors de la creation de l'actualité. Merci de réessayer.","messageErr");
            }
        }
    }

    //Permet de supprimer un actualite 
    public function delete($id = null) {


        if (AuthComponent::user('role') == 'administrateur') {
            $actualite = $this->Actualite->find('first', array('conditions' => array('Actualite.id' => $id)));
            $this->set('actualite', $actualite);

            if ($this->request->is('post')) {
                $this->Actualite->id = $id;
                if (!$this->Actualite->exists()) {
                    $this->Session->setFlash("L'actualité spécifiée n'a pas pu être supprimé", 'messageErr');
                    $this->redirect(array('action' => 'index'));
                }
                if ($this->Actualite->delete()) {
                    $this->Session->setFlash('Actualité supprimé','messageBon');
                    $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash("L'actualité n'a pas pu être supprimé. Merci de réessayer.", 'messageAvert');
                $this->redirect(array('action' => 'index'));
            }
        } else {
            $this->Session->setFlash("Vous n'avez pas les droits d'accès à cette page","messageErr");
            $this->redirect(array('action' => 'index'));
        }
    }

}
