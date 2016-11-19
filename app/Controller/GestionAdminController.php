<?php

App::uses('AppController', 'Controller');

/**
 * Stats Controller
 *
 * @property Stat $Stat
 */
class GestionAdminController extends AppController {
    
    // On ne veut pas de table sql liée aux statistiques (externalisées sur google analytics)
    var $uses = array();

    public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('role') != 'administrateur') {  
            $this->Session->setFlash("Il faut vous connecter en tant qu'administrateur pour accèder à cette page", "messageAvert");
            $this->redirect(['controller'=> 'users', 'action' => 'login']);
        }
        $this->set('page_cours', 'violet');
    }

    public function index() {

    }
}