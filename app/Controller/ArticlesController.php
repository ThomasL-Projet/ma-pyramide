<?php

App::uses('AppController', 'Controller');

class ArticlesController extends AppController {

    var $helpers = array('Html', 'Form', 'Ck', 'Js');
    // Pour utiliser des modèles spécifiques
    public $uses = array('Article', 'Category', 'Form', 'Ck');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('article'); // Letting non-users see public articles
        $this->Auth->allow('index');
        if (AuthComponent::user('role') == 'administrateur') {
            $this->set('page_cours', 'violet');
        } else {
            $this->set('page_cours', 'bleu');
        }
    }

    //Permet d'afficher l'ensemble des articles
    public function index() {

        $articles = $this->Article->find('all');
        // array_reverse pour mettre les articles dans l'ordre des dates
        $this->set('articles', array_reverse($articles));
    }

    public function article($id = null) {
        if ($id != null) {
            $article = $this->Article->find('first', array('conditions' => array('Article.id' => $id)));
            $this->set('article', $article);
        } else {
            $article = $this->Article->find('all');
            $this->set('article', $article);
        }
    }

    //Permet d'effectuer les modifications concernant un article 
    public function edit($id = null) {
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            $this->Session->setFlash("L'article à modifier n'existe pas.", "messageErr");
             $this->redirect(array('action' => 'index'));
        }

        $this->set('id', $id);

        $article = $this->Article->find('first', array('conditions' => array('Article.id' => $id)));
        $this->set('titre', $article['Article']['title']);
        $this->set('idCategorie', $article['Article']['category_id']);
        $this->set('contenu', $article['Article']['content']);
        $this->set('categories', $this->Category->find('all'));

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Article->save($this->request->data)) {
                $this->Session->setFlash("L'article a été modifié", "messageBon");
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("L'article n'a pas pu être modifié. Merci de réessayer.", "messageErr");
            }
        }
    }

    //Permet d'ajouter un article
    public function add() {
        if (AuthComponent::user('role') == 'administrateur') {
            $this->set('categories', $this->Category->find('all'));

            if ($this->request->is('post')) {
                $this->Article->create();
                if ($this->Article->save($this->request->data)) {
                    $this->Session->setFlash("L'article a été ajouté", "messageBon");
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash("Erreur lors de la creation de l'article. Merci de réessayer.", "messageErr");
                }
            }
        } else {
            $this->Session->setFlash("Vous n'avez pas accès à cette page", "messageAvert");
            $this->redirect(array('action' => 'index'));
        }
    }

    //Permet de supprimer un article 
    public function delete($id = null) {

        if (AuthComponent::user('role') == 'administrateur') {
            $article = $this->Article->find('first', array('conditions' => array('Article.id' => $id)));
            $this->set('article', $article);

            if ($this->request->is('post')) {
                $this->Article->id = $id;
                if (!$this->Article->exists()) {
                    $this->Session->setFlash('L\'article est invalide', "messageErr");
                    $this->redirect(array('action' => 'index'));
                }
                if ($this->Article->delete()) {
                    $this->Session->setFlash('L\'article a bien été supprimé', "messageBon");
                    $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash("L'article n'a pas pu être supprimé. Merci de réessayer.", "messageErr");
                $this->redirect(array('action' => 'index'));
            }
        } else {
            $this->Session->setFlash("Vous n'avez pas accès à cette page", "messageAvert");
            $this->redirect(array('action' => 'index'));
        }
    }

}
