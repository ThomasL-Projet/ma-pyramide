<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Pages';
    // Pour utiliser des modèles spécifiques
    public $uses = array('Article', 'Aliment', 'Famillealiment', 'Actualite', 'Photo', 'Lien');

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        // TODO : ne le lancer qu'à l'affichage de la page d'accueil
        $actualite = $this->Actualite->find('all');
        $this->set('conseils', $actualite);

        $article = $this->Article->find('all');
        $this->set('articles', $article);

        $this->Auth->allow('display'); // Letting non-users see public pages
        $this->set('logged_in', $this->Auth->loggedIn());

        $this->loadModel("Statique");
        $pageStatique = $this->Statique->find('all');
        $pageActPh = array();
        $pageCereal = array();
        $pageFruit = array();
        $pageLait = array();
        $pageLegume = array();
        $pageMatG = array();
        $pagePond = array();
        $pageCal = array();
        $pageProt = array();
        $pageRess = array();
        foreach ($pageStatique as $pageStatiques) {

            switch ($pageStatiques['Statique']['category_id']) {
                case 1:
                    array_push($pageCal, $pageStatiques['Statique']);
                    break;
                case 2:
                    array_push($pageActPh, $pageStatiques['Statique']);
                    break;
                case 3:
                    array_push($pagePond, $pageStatiques['Statique']);
                    break;
                case 4:
                    array_push($pageFruit, $pageStatiques['Statique']);
                    break;
                case 5:
                    array_push($pageLegume, $pageStatiques['Statique']);
                    break;
                case 6:
                    array_push($pageCereal, $pageStatiques['Statique']);
                    break;
                case 7:
                    array_push($pageProt, $pageStatiques['Statique']);
                    break;
                case 8:
                    array_push($pageLait, $pageStatiques['Statique']);
                    break;
                case 9:
                    array_push($pageMatG, $pageStatiques['Statique']);
                    break;
                case 10:
                    array_push($pageRess, $pageStatiques['Statique']);
                    break;
            }
        }
        $this->set('calories', $pageCal);
        $this->set('statique', $pageStatique);
        $this->set('legume', $pageLegume);
        $this->set('fruit', $pageFruit);
        $this->set('prot', $pageProt);
        $this->set('cereale', $pageCereal);
        $this->set('lait', $pageLait);
        $this->set('matG', $pageMatG);
        $this->set('Pond', $pagePond);
        $this->set('ActPh', $pageActPh);
        $this->set('ressources', $pageRess);
    }

    //Permet l'affichage des éléments dans les différentes catégories
    public function display() {

        $allPhotos = $this->Photo->find('all');
        $this->set('allPhotos', $allPhotos);

        $LiensGP = $this->Lien->find('all', array(
            'fields' => array('id', 'title', 'content'),
            'order' => 'created DESC',
            'conditions' => array('categorie' => 0)));
        $this->set('LiensGP', $LiensGP);

        $LiensProfessionnels = $this->Lien->find('all', array(
            'fields' => array('id', 'title', 'content'),
            'order' => 'created DESC',
            'conditions' => array('categorie' => 1)));
        $this->set('LiensProfessionnels', $LiensProfessionnels);

        $LiensPrivés = $this->Lien->find('all', array(
            'fields' => array('id', 'title', 'content'),
            'order' => 'created DESC',
            'conditions' => array('categorie' => 2)));
        $this->set('LiensPrivés', $LiensPrivés);


        $derniersArticles = $this->Article->find('all', array(
            'fields' => array('id', 'title', 'content'),
            'order' => 'created DESC'));
        $this->set('derniersArticles', $derniersArticles);

        $derniersActualites = $this->Actualite->find('all', array(
            'fields' => array('id', 'title', 'content'),
            'order' => 'created DESC'));
        $this->set('derniersActualites', $derniersActualites);

        // Recherche et tri des aliments par catégorie
        $donnees['Céréales']['Grains entiers'] = $this->Famillealiment->findAllBySubname('Grains entiers');
        $donnees['Céréales']['Grains raffinés'] = $this->Famillealiment->findAllBySubname('Grains raffinés');
        $donnees['Produits laitiers']['Yaourts'] = $this->Famillealiment->findAllBySubname('Yaourts');
        $donnees['Produits laitiers']['Fromages'] = $this->Famillealiment->findAllBySubname('Fromages');
        $donnees['Produits laitiers']['Lait et desserts à base de lait'] = $this->Famillealiment->findAllBySubname('Lait et desserts à base de lait');
        $donnees['Protéines']['Viandes'] = $this->Famillealiment->findAllBySubname('Viandes');
        $donnees['Protéines']['Poissons'] = $this->Famillealiment->findAllBySubname('Poissons');
        $donnees['Protéines']['Œufs et dérivés'] = $this->Famillealiment->findAllBySubname('Œufs et dérivés');
        $donnees['Matières grasses']['Huiles'] = $this->Famillealiment->findAllBySubname('Huiles');
        $donnees['Matières grasses']['Graisses solides'] = $this->Famillealiment->findAllBySubname('Graisses solides');
        $donnees['Légumes']['Légumes verts'] = $this->Famillealiment->findAllBySubname('Légumes verts');
        $donnees['Légumes']['Légumes féculents'] = $this->Famillealiment->findAllBySubname('Légumes féculents');
        $donnees['Légumes']['Autres légumes'] = $this->Famillealiment->findAllBySubname('Autres légumes');
        $donnees['Fruits']['Fruits'] = $this->Famillealiment->findAllBySubname('Fruits');
        $donnees['Fruits']['Jus de fruits'] = $this->Famillealiment->findAllBySubname('Jus de fruits');
        $this->set('donnees', $donnees);



        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }

        //On affecte les couleurs de la barre a chaque page correspondantes
        if ($page == 'home' || $page == 'supertracker' || $page == 'jackpotsante' || $page == 'mentionslegales' || $page == 'sitemap' || $page == 'contacts') {
            $this->set('page_cours', 'rouge');
        } else if ($page == 'choixphoto') {
            $this->set('page_cours', 'violet');
        } else if ($page == 'gazette') {
            $this->set('page_cours', 'bleu');
        } else {
            $this->set('page_cours', 'jaune');
        }

        $this->set(compact('page', 'subpage', 'title_for_layout'));
        $this->render(implode('/', $path));
    }

}
