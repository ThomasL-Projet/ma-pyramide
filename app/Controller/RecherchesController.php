<?php

App::uses('AppController', 'Controller');

class RecherchesController extends AppController {

    var $helpers = array('Html', 'Form', 'Ck', 'Js');
    // Pour utiliser des modèles spécifiques
    public $uses = array('Actualite', 'Article', 'Aliment', 'Form', 'Ck');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('page_cours', 'rouge');
        $this->Auth->allow('recherche');
    }

    public function recherche() {
        if (!empty($_GET['s'])) {
            $termes = str_replace(" ", "%", $_GET['s']);
            $articles = $this->Article->find('all', array(
                'conditions' => array('content LIKE' => '%' . $termes . '%')));
           //$this->set('articles', $articles);

            // préparement de l'array de la requêtte (chaque mot = une occurance)
            // on enlève les balises html éventuelle
            $motsEnTableau = explode(' ',strip_tags($_GET['s']));
            
            
            /**
             * Recherche par un aliment
             */
            
            // requête sql
            $sqlRequest= array();
            // tableau des requêtes sql convertie comme il faut avec chaque mot
            for($i = 0 ; $i < count($motsEnTableau) ; $i++) {
                $sqlRequest[$i] =  array('UPPER(Aliment.nomFR) LIKE' => 'UPPER(\'%' . $motsEnTableau[$i] . '%\')');
            }
           // var_dump($sqlRequest);
            // lancement de la recherche
            $aliments = $this->Aliment->find('all', array('conditions' => array('AND' => $sqlRequest), 'limit' => '25'));
            // mise en mémoire les résutats pour la vues
            $this->set('aliments', $aliments);
        }
    }

}
