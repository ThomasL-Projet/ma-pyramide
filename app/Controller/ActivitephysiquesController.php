<?php

App::uses('AppController', 'Controller');

/**
 * Donneescompilees Controller
 *
 * @property Donneescompilee $Donneescompilee
 */
class ActivitephysiquesController extends AppController {

    // Pour utiliser des modèles spécifiques
    public $uses = array('Activitephysique', 'Suiviphysique', 'Activitefavorite', 'User', 'Jackpotacti', 'Suivialimentaire');

    public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('id') == null) {
            $this->Session->setFlash("Vous devez être connecter pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->Auth->allow('index');
        $this->set('page_cours', 'rouge');
    }

    public function index($id1 = NULL) {
        /* Recherche des catégories d'aliments qui seront présents dans la 1ere boite a liste */
        $rubriques = $this->Activitephysique->find('all', array(
            'fields' => 'GRANDE_RUBRIQUE',
            'group' => array('GRANDE_RUBRIQUE')));
        $this->set('rubriques', $rubriques);

        if ($this->request->is('post')) {
            $id = AuthComponent::user('id');
            if (!empty($_POST['activite'])) {
                /* L'utilisateur est enregister */
                $this->Suiviphysique->create();
                /* Création du champ concernant le moment ou le repas à été éjouté */
                $this->Suiviphysique->set(array(
                    'user_id' => $id,
                    'activitephysique_id' => $id1,
                    'jourAP' => $_POST['date'],
                    'tempsAP' => $_POST['duree']));
                if ($this->Suiviphysique->save()) {
                    $this->Session->setFlash("L'activité a bien été ajoutée.", 'messageBon');
                }
            }
            if (!empty($_POST['ajouterfav'])) {
                /* Aliment de gauche ajouté aux favoris */
                $this->Activitefavorite->set(array(
                    'iduti' => $id,
                    'idacti' => $id1));
                if ($this->Activitefavorite->save()) {
                    $this->Session->setFlash("L'activité a bien été ajouté à vos activité favorites", 'messageBon');
                } else {
                    $this->Session->setFlash("Erreur lors de l'ajout de l'activité aux favoris", 'messageAvert');
                }
            }

            if (!empty($_POST['retirerfav'])) {
                $iduti = $id;
                $idacti = $id1;
                if ($this->Activitefavorite->deleteAll(array('Activitefavorite.iduti' => $iduti, 'Activitefavorite.idacti' => $idacti), false)) {
                    $this->Session->setFlash("L'activité a bien été retiré de vos activités favorites", 'messageBon');
                } else {
                    $this->Session->setFlash("Erreur lors du retrait de l'activité des favoris", 'messageAvert');
                }
            }

            /*  le résultat de la recherche sera affiché */
            $resultats = $this->Activitephysique->find('all', array('conditions' => array(
                    array('GRANDE_RUBRIQUE' => $_POST['rech']))
            ));
            $this->set('resultats', $resultats);
        }

        if (!empty($_POST['actifav'])) {
            /* Bouton activité favoris */
            $res = $this->Activitefavorite->find('all', array('conditions' => array('iduti' => AuthComponent::user('id'))));
            $resultats = array();
            $i = 0;
            foreach ($res as $r) {
                $resultats[$i] = $this->Activitephysique->find('first', array('conditions' => array('id' => $r['Activitefavorite']['idacti'])));
                $i++;
            }
            $this->set('resultats', $resultats);
            $this->set('activitefavorite', true);
        }


        if ($id1 != NULL) {
            $activite = $this->Activitephysique->find('first', array('conditions' => array('Activitephysique.id' => $id1)));
            $this->set('activite', $activite);
        }
        if (AuthComponent::user('id') != null) {
            $user = $this->User->find('first', array('conditions' => array('User.id' => AuthComponent::user('id'))));
            $this->set('user', $user);
        }
    }

    public function jackpot($id1 = NULL) {
        /* Recherche des cathegories d'aliements qui seront présents dans la 1ere boite a liste */
        $rubriques = $this->Activitephysique->find('all', array(
            'fields' => 'GRANDE_RUBRIQUE',
            'group' => array('GRANDE_RUBRIQUE')));
        $this->set('rubriques', $rubriques);

        if ($this->request->is('post')) {

            if (!empty($_POST['reinit'])) {
                $id = AuthComponent::user('id');
                $this->Jackpotacti->deleteAll(array('Jackpotacti.user_id' => $id), false);
                $this->Session->setFlash(__("Vos activités du jackpot ont été réinitialisées."));
            }


            if (!empty($_POST['activite'])) {
                $id = AuthComponent::user('id');
                if ($id != null) {

                    /* L'utilisateur est enregister */
                    $this->Jackpotacti->create();
                    /* Création du champ concernant le moment ou le repas à été éjouté */
                    $this->Jackpotacti->set(array(
                        'user_id' => $id,
                        'activitephysique_id' => $id1,
                        'tempsAP' => $_POST['duree']));
                    if ($this->Jackpotacti->save()) {
                        $this->Session->setFlash(__("L'activité a été ajoutée."));
                    } else {
                        $this->Session->setFlash(__("Erreur lors de l'ajout de l'activité"));
                    }
                }
            }
            if (!empty($_POST['ajouterfav'])) {
                /* Aliment de gauche ajouté aux favoris */
                $id = AuthComponent::user('id');
                if ($id != null) {
                    $this->Activitefavorite->set(array(
                        'iduti' => $id,
                        'idacti' => $id1));
                    if ($this->Activitefavorite->save()) {
                        $this->Session->setFlash(__("L'activité a bien été ajouté à vos activité favorites"));
                    } else {
                        $this->Session->setFlash(__("Erreur lors de l'ajout de l'activité aux favoris"));
                    }
                } else {
                    $this->Session->setFlash(__("Vous devez vous connecter pour utiliser cette fonctionnalitée"));
                }
            }
            if (!empty($_POST['retirerfav'])) {
                $id = AuthComponent::user('id');
                if ($id != null) {
                    $iduti = $id;
                    $idacti = $id1;
                    if ($this->Activitefavorite->deleteAll(array('Activitefavorite.iduti' => $iduti, 'Activitefavorite.idacti' => $idacti), false)) {
                        $this->Session->setFlash(__("L'activité a bien été retiré de vos activités favorites"));
                    } else {
                        $this->Session->setFlash(__("Erreur lors du retrait de l'activité des favoris"));
                    }
                } else {
                    $this->Session->setFlash(__("Vous devez vous connecter pour utiliser cette fonctionnalitée"));
                }
            }
            /*  le résultat de la recherche sera affiché */
            $resultats = $this->Activitephysique->find('all', array('conditions' => array(
                    array('GRANDE_RUBRIQUE' => $_POST['rech']))
            ));
            $this->set('resultats', $resultats);
        }

        if (!empty($_POST['alifav'])) {
            /* Bouton activité favoris */
            $res = $this->Activitefavorite->find('all', array('conditions' => array('iduti' => AuthComponent::user('id'))));
            $resultats = array();
            $i = 0;
            foreach ($res as $r) {
                $resultats[$i] = $this->Activitephysique->find('first', array('conditions' => array('id' => $r['Activitefavorite']['idacti'])));
                $i++;
            }
            $this->set('resultats', $resultats);
            $this->set('alimentfavori', true);
        }


        if ($id1 != NULL) {
            $activite = $this->Activitephysique->find('first', array('conditions' => array('Activitephysique.id' => $id1)));
            $this->set('activite', $activite);
        }
        if (AuthComponent::user('id') != null) {
            $user = $this->User->find('first', array('conditions' => array('User.id' => AuthComponent::user('id'))));
            $this->set('user', $user);
        }
    }

    public function vuejackpot() {
        $id = AuthComponent::user('id');
        $user = $this->User->find('first', array('conditions' => array('id' => $id)));
        $obPoi = $user['User']['poids'];
        /* age utilisateur */
        $naiss = $user['User']['datenaissance'];
        $age = $this->Suivialimentaire->query("SELECT TIMESTAMPDIFF(YEAR,'" . $naiss . "', NOW()) as age;");
        $age = $age[0][0]['age'];
        if ($age == 0 || $age == 1 || $age == 2) {
            $mois = $this->Suivialimentaire->query("SELECT TIMESTAMPDIFF(MONTH,'" . $naiss . "', NOW()) as age;");
            $mois = $mois[0][0]['age'];
        }
        /* Calcul du CA */
        $activite = $user['User']['activite'];
        $sexe = $user['User']['sexe'];
        $ca;
        if ($age >= 3 && $age <= 18 && $sexe == "homme") {
            switch ($activite) {
                case "sédentaire" : $ca = 1.00;
                    break;
                case "peu actif" : $ca = 1.13;
                    break;
                case "actif" : $ca = 1.26;
                    break;
                case "très actif" : $ca = 1.42;
                    break;
            }
        } elseif ($age >= 3 && $age <= 18 && $sexe == "femme") {
            switch ($activite) {
                case "sédentaire" : $ca = 1.00;
                    break;
                case "peu actif" : $ca = 1.16;
                    break;
                case "actif" : $ca = 1.31;
                    break;
                case "très actif" : $ca = 1.56;
                    break;
            }
        } elseif ($age >= 19 && $sexe == "homme") {
            switch ($activite) {
                case "sédentaire" : $ca = 1.00;
                    break;
                case "peu actif" : $ca = 1.11;
                    break;
                case "actif" : $ca = 1.25;
                    break;
                case "très actif" : $ca = 1.48;
                    break;
            }
        } elseif ($age >= 19 && $sexe == "femme") {
            switch ($activite) {
                case "sédentaire" : $ca = 1.00;
                    break;
                case "peu actif" : $ca = 1.12;
                    break;
                case "actif" : $ca = 1.27;
                    break;
                case "très actif" : $ca = 1.45;
                    break;
            }
        }
        /* Calcul nb de kcal */
        $taille = $user['User']['taille'] / 100.00;
        $grossesse = $user['User']['enceinte'] == "O" ? true : false;
        $allaitement = $user['User']['allaitante'] == "O" ? true : false;
        if ($grossesse) {
            $moisgrossesse = $user['User']['nbmoisenceinte'];
        }
        if ($allaitement) {
            $moisallaitement = $user['User']['nbmoisallaitement'];
        }
        /* Nourrissons et jeunes enfants */
        if (isset($mois) && $mois >= 0 && $mois <= 3) {
            $objectif = (89 * $obPoi - 100) + 175;
        } elseif (isset($mois) && $mois >= 4 && $mois <= 6) {
            $objectif = (89 * $obPoi - 100) + 56;
        } elseif (isset($mois) && $mois >= 7 && $mois <= 12) {
            $objectif = (89 * $obPoi - 100) + 22;
        } elseif (isset($mois) && $mois >= 13 && $mois <= 34) {
            $objectif = (89 * $obPoi - 100) + 20;
        } /* Enfants et adolescents de 3 à 18 ans */ elseif ($age >= 3 && $age <= 8 && $sexe == "homme") {
            $objectif = 88.5 - (61.9 * $age) + $ca * ((26.7 * $obPoi) + (903 * $taille)) + 20;
        } elseif ($age >= 9 && $age <= 18 && $sexe == "homme") {
            $objectif = 88.5 - (61.9 * $age) + $ca * ((26.7 * $obPoi) + (903 * $taille)) + 25;
        } elseif ($age >= 3 && $age <= 8 && $sexe == "femme") {
            $objectif = 135.3 - (30.8 * $age) + $ca * ((10.0 * $obPoi) + (934 * $taille)) + 20;
        } elseif ($age >= 9 && $age <= 18 && $sexe == "femme") {
            $objectif = 135.3 - (30.8 * $age) + $ca * ((10.0 * $obPoi) + (934 * $taille)) + 25;
        } /* Adultes de 19 ans et plus */ elseif ($age >= 19 && $sexe == "homme") {
            $objectif = 662 - (9.53 * $age) + $ca * ((15.91 * $obPoi) + (539.6 * $taille));
        } elseif ($age >= 19 && $sexe == "femme") {
            $objectif = 354 - (9.91 * $age) + $ca * ((9.36 * $obPoi) + (726 * $taille));
        } /* Grossesse */
        if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
            $objectif = $objectif + 340;
        } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
            $objectif = $objectif + 452;
        } /* Allaitement */
        if ($allaitement && $moisallaitement >= 0 && $moisallaitement <= 6) {
            $objectif = $objectif + 500 - 170;
        } if ($allaitement && $moisallaitement >= 7 && $moisallaitement <= 12) {
            $objectif = $objectif + 400;
        }
        $this->set('objectif', intval($objectif));
        $resultats = $this->Jackpotacti->find('all', array('conditions' => array('user_id' => AuthComponent::user('id'))));
        $this->set('resultats', $resultats);

        $this->set('poids', $obPoi);
        $caldep = 0;

        if (!empty($resultats)) {


            foreach ($resultats as $resultat) {
                $caldep = $caldep + (($resultat['Activitephysique']['MET'] * ($resultat['Jackpotacti']['tempsAP'] / 64) * $obPoi));
            }
            $this->set('caldep', $caldep);
            $test = (((500 - $caldep) * 64) / ($resultats[0]['Activitephysique']['MET'] * $obPoi)) + ($resultats[0]['Jackpotacti']['tempsAP']);


            $this->set('test', $test);
        }
    }

}
