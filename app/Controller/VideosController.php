<?php

App::uses('AppController', 'Controller');

class VideosController extends AppController {

    var $helpers = array('Html', 'Form', 'Ck', 'Js');
    // Pour utiliser des modèles spécifiques
    public $uses = array('Video', 'Form', 'Ck');

    public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('role') != 'administrateur') {
            $this->Session->setFlash("Vous devez être connecter en tant qu'administrateur pour accèder à cette fonctionnalité.", 'messageAvert');
            $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $this->set('page_cours', 'violet');
        $this->Auth->allow('vue'); // Letting non-users see public articles
    }

    //Permet d'afficher l'ensemble des actualites
    public function index() {

        $videos = $this->Video->find('all');
        $this->set('videos', $videos);
    }

    public function vue() {

        $this->Video->recursive = 0;
        $this->paginate = array(
            'limit' => 4);
        $this->set('videos', $this->paginate());

        //$images = $this->Image->find('all');
        //$nbimages = $this->Image->find('count');
        //$max = $this->Image->find('first', array('fields' => array('MAX(Image.id) as max_id')));
        //$this->set('maxId',$max[0]['max_id']);
        //$this->set('images', $images);
        //$this->set('nbimages',$nbimages);
    }

    //Permet d'effectuer les modifications concernant un actualite 
    public function edit($id = null) {
        $this->Video->id = $id;
        if (!$this->Video->exists()) {
            $this->set('affichage', false);
            return;
        } else {
            $this->set('affichage', true);
        }

        $this->set('id', $id);


        $video = $this->Video->find('first', array('conditions' => array('Video.id' => $id)));
        $this->set('titre', $video['Video']['titre']);
        $this->set('contenu', $video['Video']['description']);


        $this->set('url', $video['Video']['url']);


        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Video->save($this->request->data)) {
                $this->Session->setFlash(__("La vidéo a été modifié"));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__("La vidéo n'a pas pu être modifié. Merci de réessayer."));
            }
        }
    }

    //Permet d'ajouter un actualite
    public function add() {

        if ($this->request->is('post')) {
            $this->Video->create();
            if ($this->Video->save($this->request->data)) {
                $this->Session->setFlash('La vidéo a bien été ajouté');
                $this->redirect(array('action' => 'index/'));
            } else {
                $this->Session->setFlash('Erreur lors de l\'ajout de la vidéo. Merci de réessayer');
            }
        }
    }

    //Permet de supprimer un actualite 
    public function delete($id = null) {


        $this->Video->id = $id;
        if (!$this->Video->exists()) {
            $this->set('affichage', false);
            return;
        } else {
            $this->set('affichage', true);
        }

        if (AuthComponent::user('role') == 'administrateur') {
            $this->Session->setFlash("Veuillez confirmer la suppression de la vidéo");
            $video = $this->Video->find('first', array('conditions' => array('Video.id' => $id)));
            $this->set('video', $video);
            if ($this->request->is('post')) {
                if ($this->Video->delete()) {
                    $this->Session->setFlash(__('Vidéo supprimée'));
                    $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__("La vidéo n'a pas pu être supprimé. Merci de réessayer."));
                $this->redirect(array('action' => 'index'));
            }
        }
    }

}
