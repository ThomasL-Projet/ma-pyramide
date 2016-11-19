<?php

App::uses('AppController', 'Controller');

class PhotosController extends AppController {

    public $helpers = array('Form', 'Html');
    public $uses = array('Photo');

    public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('role') != 'administrateur') {
             $this->Session->setFlash("Vous devez être connecter en tant qu'administrateur pour accèder à cette fonctionnalité.", 'messageAvert');
            $this->redirect(['controller' => 'users', 'action' => 'login']);
        }      
        $this->set('page_cours', 'violet');
    }

    //Permet d'afficher l'ensemble des articles
    public function index() {
        $resultat = $this->Photo->find('all');

        $titre1 = $resultat['0']['Photo']['titre'];
        $description1 = $resultat['0']['Photo']['description'];
        $this->set('titre1', $titre1);
        $this->set('description1', $description1);

        $titre2 = $resultat['1']['Photo']['titre'];
        $description2 = $resultat['1']['Photo']['description'];
        $this->set('titre2', $titre2);
        $this->set('description2', $description2);

        $titre3 = $resultat['2']['Photo']['titre'];
        $description3 = $resultat['2']['Photo']['description'];
        $this->set('titre3', $titre3);
        $this->set('description3', $description3);

        $titre4 = $resultat['3']['Photo']['titre'];
        $description4 = $resultat['3']['Photo']['description'];
        $this->set('titre4', $titre4);
        $this->set('description4', $description4);

        if (!empty($this->request->data)) {
            $this->request->data['Photo']['id'] = $this->request->data['Photo']['id'] + 1;

            $this->Session->setFlash($this->request->data['Photo']["description"]);
            $this->Photo->save($this->request->data);
            $extension = strtolower(pathinfo($this->request->data['Photo']['photo_file']['name'], PATHINFO_EXTENSION));

            if (!empty($this->request->data['Photo']['photo_file']['tmp_name']) &&
                    in_array($extension, array('png', 'jpeg', 'jpg'))) {
                move_uploaded_file($this->request->data['Photo']['photo_file']['tmp_name'], IMAGES . 'photos' . DS . $this->Photo->id . '.' . 'png');
                $this->Photo->saveField('photo', 'png');
                $this->Session->setFlash('La photo a bien été ajouté','messageBon');
            } else if (!empty($this->request->data['Photo']['photo_file']['tmp_name'])) {
                $this->Session->setFlash('Vous ne pouvez pas envoyer ce type de fichier','messageAvert');
            }
        } else {
            $this->Photo->id = 1;
            $this->request->data = $this->Photo->read();
        }
    }

}
