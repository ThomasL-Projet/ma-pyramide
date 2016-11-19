<?php

App::uses('AppController', 'Controller');

class CarnetsController extends AppController {

    var $helpers = array('Html', 'Form', 'Ck', 'Js');
    // Pour utiliser des modèles spécifiques
    public $uses = array('Carnet', 'Form', 'Ck');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('page_cours', 'rouge');
    }

    //Permet d'afficher l'ensemble des carnet
    public function index() {
        $iduti = AuthComponent::user('id');
        //$this->layout = false;
        $this->Carnet->recursive = 0;
        $this->paginate = array(
            'conditions' => array('user_id' => $iduti),
            'limit' => 4,
            'order' => array('Carnet.created' => 'DESC'));
        $this->set('carnets', $this->paginate());




        $resultat = $this->Carnet->find('all', array('conditions' => array('user_id' => $iduti),
            'order' => array('Carnet.created DESC')));
        $this->set('resultat', $resultat);


        //$nbtotal = $this->Carnet->find('count', array('conditions' => array(array('user_id' => $iduti))));
        //$this->set('nbtotal',$nbtotal);
    }

    public function carnet($id = null) {
        $iduti = AuthComponent::user('id');
        $resultat = $this->Carnet->find('all', array('conditions' => array('user_id' => $iduti)));
        $this->set('resultat', $resultat);
    }

    //Permet d'effectuer les modifications concernant une journée 
    public function edit($id = null) {
        $this->Carnet->id = $id;
        if (!$this->Carnet->exists()) {
            $this->Session->setFlash("Impossible d'éditer, aucune entrée ce jour là.", "messageErr");
            $this->redirect(array('action' => 'index'));
        }

        $this->set('id', $id);

        $carnet = $this->Carnet->find('first', array('conditions' => array('Carnet.id' => $id)));
        $this->set('titre', $carnet['Carnet']['titre']);
        $this->set('aliment', $carnet['Carnet']['aliment']);
        $this->set('lieu', $carnet['Carnet']['lieu']);
        $this->set('activite', $carnet['Carnet']['activite']);
        $this->set('humeur', $carnet['Carnet']['humeur']);
        $this->set('note', $carnet['Carnet']['note']);



        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Carnet->save($this->request->data)) {
                $this->Session->setFlash("Le journal a été modifié", "messageBon");
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("Le journal n'a pas pu être modifié. Merci de réessayer.", "messageErr");
            }
        }
    }

    //Permet d'ajouter une journée
    public function add() {
        $iduti = AuthComponent::user('id');

        $today = date("Y-m-d");
        $todayBegin = $today . ' 00:00:00';
        $todayEnd = $today . ' 23:59:59';

        $present = $this->Carnet->find('count', array('conditions' => array('AND' => array(
                    array('user_id' => $iduti),
                    array('Carnet.created BETWEEN ? AND ?' => array($todayBegin, $todayEnd))
        ))));



        if ($present >= 1) {
            $this->Session->setFlash("Vous avez déjà rempli votre journal pour aujourd'hui", 'messageAvert');
            $this->redirect(array('action' => 'index'));
        } else {

            if ($this->request->is('post')) {



                $this->Carnet->create();
                $this->Carnet->data['Carnet']['user_id'] = $iduti;




                if ($this->Carnet->save($this->request->data)) {

                    $this->Session->setFlash("Votre journée a été ajouté au journal", "messageBon");
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash("Erreur lors de l'ajout de la journée au journal. Merci de réessayer.", "messageErr");
                }
            }
        }
    }

    //Permet de supprimer une journée
    public function delete($id = null) {

        $carnet = $this->Carnet->find('first', array('conditions' => array('Carnet.id' => $id)));
        $this->set('carnet', $carnet);

        if ($this->request->is('post')) {
            $this->Carnet->id = $id;
            if (!$this->Carnet->exists()) {
                $this->Session->setFlash("Impossible de supprimer, aucune entrée ce jour là.", "messageErr");
                $this->redirect(array('action' => 'index'));
            }
            if ($this->Carnet->delete()) {
                $this->Session->setFlash('Journée supprimé', "messageBon");
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash("La journée n'a pas pu être supprimé. Merci de réessayer.","messageErr");
            $this->redirect(array('action' => 'index'));
        }
    }

}
