<?php

App::uses('AppController', 'Controller');

class ImagesController extends AppController {

    var $helpers = array('Html', 'Form', 'Ck', 'Js');
    // Pour utiliser des modèles spécifiques
    public $uses = array('Image', 'Form', 'Ck');

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

        $images = $this->Image->find('all');
        $this->set('images', $images);
    }

    public function vue() {

        $this->Image->recursive = 0;
        $this->paginate = array(
            'limit' => 8);
        $this->set('images', $this->paginate());

        //$images = $this->Image->find('all');
        //$nbimages = $this->Image->find('count');
        //$max = $this->Image->find('first', array('fields' => array('MAX(Image.id) as max_id')));
        //$this->set('maxId',$max[0]['max_id']);
        //$this->set('images', $images);
        //$this->set('nbimages',$nbimages);
    }

    public function image($id = null) {
        if ($id != null) {
            $image = $this->Image->find('first', array('conditions' => array('Image.id' => $id)));
            $this->set('image', $image);
        } else {
            $image = $this->Image->find('all');
            $this->set('image', $image);
        }
    }

    //Permet d'effectuer les modifications concernant un actualite 
    public function edit($id = null) {
        $this->Image->id = $id;
        if (!$this->Image->exists()) {
            $this->set('affichage', false);
            return;
        } else {
            $this->set('affichage', true);
        }

        $this->set('id', $id);


        $image = $this->Image->find('first', array('conditions' => array('Image.id' => $id)));
        $this->set('titre', $image['Image']['titre']);
        $this->set('contenu', $image['Image']['description']);
        $this->set('url', "urls/" . $image['Image']['url']);


        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Image->save($this->request->data)) {
                $this->Session->setFlash(__("L'image a été modifié"));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__("L'image n'a pas pu être modifié. Merci de réessayer."));
            }
        }
    }

    //Permet d'ajouter un actualite
    public function add() {

        if ($this->request->is('post')) {
            $this->Image->create();
            if ($this->Image->save($this->request->data)) {
                //$this->set('categories', $this->Category->find('all'));

                $compteur = 1001;
                while (1) {
                    $present = $this->Image->find('count', array('conditions' => array('Image.url LIKE' => $compteur . '%')
                    ));
                    if ($present == 0) {
                        break;
                    } else {
                        $compteur++;
                    }
                }

                $extension = strtolower(pathinfo($this->request->data['Image']['url_file']['name'], PATHINFO_EXTENSION));
                if (
                        !empty($this->request->data['Image']['url_file']['tmp_name']) &&
                        in_array($extension, array('png', 'jpeg', 'jpg'))) {
                    move_uploaded_file($this->request->data['Image']['url_file']['tmp_name'], IMAGES . 'urls' . DS . $compteur . '.' . $extension);
                    $this->Image->saveField('url', $compteur . '.jpg');
                    $this->Session->setFlash('L\'image a bien été ajouté');
                    $this->redirect(array('action' => 'index/'));
                } else if (!empty($this->request->data['Image']['url_file']['tmp_name'])) {
                    $this->Session->setFlash('Vous ne pouvez pas envoyer ce type de fichier');
                }
            }
        }
    }

    //Permet de supprimer un actualite 
    public function delete($id = null) {
        $this->Image->id = $id;
        if (!$this->Image->exists()) {
            $this->set('affichage', false);
            return;
        } else {
            $this->set('affichage', true);
        }

        if (AuthComponent::user('role') == 'administrateur') {
            $this->Session->setFlash("Veuillez confirmer la suppression de l'image");
            $image = $this->Image->find('first', array('conditions' => array('Image.id' => $id)));
            $this->set('image', $image);

            if ($this->request->is('post')) {
                if ($this->Image->delete()) {
                    $this->Session->setFlash(__('Image supprimée'));
                    $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__("L'image n'a pas pu être supprimé. Merci de réessayer."));
                $this->redirect(array('action' => 'index'));
            }
        }
    }

}
