<?php

App::uses('AppController', 'Controller');

class ConstantesController extends AppController {

    public $uses = array('Constante');

    public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('role') != 'administrateur') {
            $this->Session->setFlash("Vous n'avez pas les droits pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
        $this->set('page_cours', 'violet');
    }

    public function index() {


        $tout = $this->Constante->find('all');
        $this->set('tout', $tout);

        $fibres = $this->Constante->findAllBycategorie(1);
        $this->set('fibres', $fibres);

        $sel = $this->Constante->findAllBycategorie(4);
        $this->set('sel', $sel);

        $lipidesbrut = $this->Constante->findAllBycategorie(3);
        $lipides = $lipidesbrut[0]['Constante']['valeur'] * 100;
        $this->set('lipides', $lipides);
        $this->set('lipidesbrut', $lipidesbrut);


        $proteines = $this->Constante->findAllBycategorie(2);
        $this->set('proteines', $proteines);
    }

    public function edit($id = null) {

        if ($id < 1 OR $id > 4) {
            $this->set('affichage', false);
        } else {
            $this->set('affichage', true);
            $this->Constante->categorie = $id;
            $this->set('id', $id);


            $constantes = $this->Constante->findAllBycategorie($id);

            $this->set('constantes', $constantes);

            if ($this->request->is('post')) {
                if ($id == 2) {
                    $valeur = $_POST['valeurpro'];
                    $description = $_POST['descpro'];
                    if (
                            $this->Constante->updateAll(array('Constante.valeur' => $valeur), array('Constante.description' => $description, 'Constante.categorie' => $id))) {
                        $this->Session->setFlash("La constante a été modifié","message");
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__("La constante n'a pas pu être modifié. Merci de réessayer."));
                    }
                } elseif ($id == 1) {

                    $valeur = $_POST['valeurfibre'];
                    $description = $_POST['descfibre'];
                    if (
                            $this->Constante->updateAll(array('Constante.valeur' => $valeur), array('Constante.description' => $description, 'Constante.categorie' => $id))) {
                        $this->Session->setFlash(__("La constante a été modifié"));
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__("La constante n'a pas pu être modifié. Merci de réessayer."));
                    }
                } elseif ($id == 4) {

                    $valeur = $_POST['valeursel'];
                    $description = $_POST['descsel'];
                    if (
                            $this->Constante->updateAll(array('Constante.valeur' => $valeur), array('Constante.description' => $description, 'Constante.categorie' => $id))) {
                        $this->Session->setFlash(__("La constante a été modifié"));
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__("La constante n'a pas pu être modifié. Merci de réessayer."));
                    }
                } elseif ($id == 3) {
                    $valeur = $_POST['valeurlip'];


                    if (
                            $this->Constante->updateAll(array('Constante.valeur' => $valeur), array('Constante.categorie' => $id))) {
                        $this->Session->setFlash(__("La constante a été modifié"));
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__("La constante n'a pas pu être modifié. Merci de réessayer."));
                    }
                }
            }
        }
    }

}

