<?php

App::uses('AppController', 'Controller');

class AlimenthorsclassificationController extends AppController {

    // Pour utiliser des modèles spécifiques
    public $uses = array('User', 'Alimhorsclassification', 'Aliment', 'Alimhorsingrediant', 'Suivialimentaire');

    public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('id') == null) {
            $this->Session->setFlash("Vous devez être connecter pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->set('page_cours', 'rouge');
    }
    

    public function index() {
        $id = AuthComponent::user('id');
        $this->set('alimhorsclass', $this->Alimhorsclassification->findAllByuser_id($id));
    }

    public function edit($id1 = null) {
        $id = AuthComponent::user('id');
        $alimhorsclass = $this->Alimhorsclassification->find('first', array('conditions' => array('AND ' => array(array(
                        array('Alimhorsclassification.user_id' => $id),
                        array('Alimhorsclassification.id' => $id1)
        )))));
        if (empty($alimhorsclass)) {
            $this->set('affichage', false);
        } else {
            $this->set('affichage', true);
            $this->set('alimhorsclass', $alimhorsclass);
            $nutriments = array();
            $descri = $this->Aliment->query("select name from constituantaliments join donneescompilees on constituantaliments_id = constituantaliments.id where aliments_id = 1000");
            $this->set('descri', $descri);
            // nutriments de l'aliment
            $nutri = explode("@", $alimhorsclass['Alimhorsclassification']['nutri']);
            $this->set('nutri', $nutri);
        }
        if ($this->request->is('post')) {
            // Verif données envoyées
            $fin = false;
            if (!(preg_match("`^[0-9]{1,5}$`", $_POST['data']['Mesrecette']['portion']))) {
                $fin = true;
                $message = "Erreur, la portion de l'aliment n'est pas un entier.";
            }
            foreach ($_POST['Ingrediant'] as $ingr) {
                if (!empty($ingr['quantite']) AND ! (preg_match("`^[0-9]{1,3}$`", $ingr['quantite'])) OR ( !empty($ingr['quantite']) AND $ingr['quantite'] > 100)) {
                    $fin = true;
                    $message = "Erreur, une des quantités d'un des ingrédients n'est pas un entier compris entre 0 et 100.";
                }
            }
            foreach ($_POST['Nutri'] as $lesnutris) {
                if (!(preg_match("`^[0-9]{1,6}$`", $lesnutris))) {
                    $fin = true;
                    $message = "Erreur, une des portions des nutriments n'est pas un entier.";
                }
            }
            $const; // variable qui sera sauvegardée
            $const['Alimhorsclassification'] = $_POST['data']['Mesrecette'];
            $const['Alimhorsclassification']['id'] = $id1;
            $const['Alimhorsclassification']['user_id'] = $id;
            $nutri = "";
            foreach ($_POST['Nutri'] as $lesnutris) {
                $nutri .= $lesnutris . '@';
            }
            $nutri = substr($nutri, 0, strlen($nutri) - 1);
            $const['Alimhorsclassification']['nutri'] = $nutri;
            $i = 0;
            foreach ($_POST['Ingrediant'] as $ingr) {
                if (empty($ingr['nom']))
                    continue;
                if (empty($ingr['quantite']))
                    $ingr['quantite'] = 0;
                $const['Alimhorsingrediant'][$i] = $ingr;
                $const['Alimhorsingrediant'][$i]['alim_id'] = $id1;
                $const['Alimhorsingrediant'][$i]['user_id'] = $id;
                $i++;
            }
            $nutri = explode("@", $const['Alimhorsclassification']['nutri']);
            $this->set('nutri', $nutri);
            $this->set('alimhorsclass', $const);
            if ($fin) {
                $this->Session->setFlash($message, 'messageErr');
                return;
            } else {
                $this->Alimhorsingrediant->deleteAll(array('Alimhorsingrediant.alim_id' => $id1), false);
                $this->Alimhorsclassification->id = $id1;
                if ($this->Alimhorsclassification->saveAll($const)) {
                    $this->Session->setFlash("L'aliment a bien été modifié", "messageBon");
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash("Erreur lors de l'enregistrement de l'aliment. Veuillez réessayer.", "messageAvert");
                }
            }
        }
    }

    public function add() {
        $id = AuthComponent::user('id');
        $descri = $this->Aliment->query("select name from constituantaliments join donneescompilees on constituantaliments_id = constituantaliments.id where aliments_id = 1000");
        $this->set('descri', $descri);
        if ($this->request->is('post')) {
            // Verif données envoyées
            $fin = false;
            if (!(preg_match("`^[0-9]{1,5}$`", $_POST['data']['Mesrecette']['portion']))) {
                $fin = true;
                $message = "Erreur, la portion de l'aliment n'est pas un entier.";
            }
            if (isset($_POST['Ingrediant'])) {
                foreach ($_POST['Ingrediant'] as $ingr) {
                    if (!empty($ingr['quantite']) AND ! (preg_match("`^[0-9]{1,3}$`", $ingr['quantite'])) OR ( !empty($ingr['quantite']) AND $ingr['quantite'] > 100)) {
                        $fin = true;
                        $message = "Erreur, une des quantités d'un des ingrédients n'est pas un entier compris entre 0 et 100.";
                    }
                }
            }
            foreach ($_POST['Nutri'] as $lesnutris) {
                if (!(preg_match("`^[0-9]{1,6}$`", $lesnutris))) {
                    $fin = true;
                    $message = "Erreur, une des portions des nutriments n'est pas un entier.";
                }
            }
            $const; // variable qui sera sauvegardée
            $const['Alimhorsclassification'] = $_POST['data']['Mesrecette'];
            $const['Alimhorsclassification']['user_id'] = $id;
            $nutri = "";
            foreach ($_POST['Nutri'] as $lesnutris) {
                $nutri .= $lesnutris . '@';
            }
            $nutri = substr($nutri, 0, strlen($nutri) - 1);
            $const['Alimhorsclassification']['nutri'] = $nutri;
            $i = 0;
            if (isset($_POST['Ingrediant'])) {
                foreach ($_POST['Ingrediant'] as $ingr) {
                    if (empty($ingr['nom']))
                        continue;
                    if (empty($ingr['quantite']))
                        $ingr['quantite'] = 0;
                    $const['Alimhorsingrediant'][$i] = $ingr;
                    $const['Alimhorsingrediant'][$i]['user_id'] = $id;
                    $i++;
                }
            }
            $nutri = explode("@", $const['Alimhorsclassification']['nutri']);
            $this->set('nutri', $nutri);
            $this->set('alimhorsclass', $const);
            if ($fin) {
                $this->Session->setFlash($message, 'messageErr');
                return;
            } else {
                $this->Alimhorsclassification->create();
                if ($this->Alimhorsclassification->saveAll($const)) {
                    $this->Session->setFlash("L'aliment a bien été ajouté", 'messageBon');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash("Erreur lors de l'enregistrement de l'aliment. Veuillez réessayer.", 'messageErr');
                }
            }
        }
    }

    public function afficher($id1 = null) {
        $id = AuthComponent::user('id');
        $alimhorsclass = $this->Alimhorsclassification->find('first', array('conditions' => array('AND ' => array(array(
                        array('Alimhorsclassification.user_id' => $id),
                        array('Alimhorsclassification.id' => $id1)
        )))));
        if (empty($alimhorsclass)) {
            $this->set('affichage', false);
        } else {
            $this->set('affichage', true);
            $this->set('alimhorsclass', $alimhorsclass);
            $nutriments = array();
            $descri = $this->Aliment->query("select name from constituantaliments join donneescompilees on constituantaliments_id = constituantaliments.id where aliments_id = 1000");
            $this->set('descri', $descri);
            // nutriments de l'aliment
            $nutri = explode("@", $alimhorsclass['Alimhorsclassification']['nutri']);
            $this->set('nutri', $nutri);
        }
    }

    public function delete($id1 = null) {
        $id = AuthComponent::user('id');
        $alimhorsclass = $this->Alimhorsclassification->find('first', array('conditions' => array('AND ' => array(array(
                        array('Alimhorsclassification.user_id' => $id),
                        array('Alimhorsclassification.id' => $id1)
        )))));
        if (empty($alimhorsclass)) {
            $this->set('affichage', false);
        } else {
            $this->set('affichage', true);
            $this->set('alimhorsclass', $alimhorsclass);
        }

        if ($this->request->is('post')) {
            if ($this->Alimhorsclassification->delete($id1, true)) {
                $this->Suivialimentaire->deleteAll(array('Suivialimentaire.id_horsclass' => $id1), false);
                $this->Session->setFlash("L'aliment a bien été supprimé.", "messageBon");
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("Erreur lors de la suppression de l'aliment, veuillez réessayer.", "messageErr");
            }
        }
    }

    public function addsuiv($id1 = null) {
        $id = AuthComponent::user('id');
        $alimhorsclass = $this->Alimhorsclassification->find('first', array('conditions' => array('AND ' => array(array(
                        array('Alimhorsclassification.user_id' => $id),
                        array('Alimhorsclassification.id' => $id1)
        )))));
        if (empty($alimhorsclass)) {
            $this->set('affichage', false);
        } else {
            $this->set('affichage', true);
            $this->set('alimhorsclass', $alimhorsclass);
        }
        if ($this->request->is('post')) {
            // vérif données
            if (!isset($_POST['moment1']) AND ! isset($_POST['moment2']) AND ! isset($_POST['moment3']) AND ! isset($_POST['moment4'])) {
                $this->Session->setFlash("Vous devez sélectionner un moment de repas pour pouvoir modifier ce repas", "messageAvert");
                return;
            }
            // tab à sauvegarder
            $save = array();
            $save['Suivialimentaire']['id_user'] = $id;
            $save['Suivialimentaire']['quantite'] = $_POST['quantite'];
            $save['Suivialimentaire']['portion'] = $alimhorsclass['Alimhorsclassification']['portion'];
            $save['Suivialimentaire']['nomPortion'] = 'Portion de ' . $alimhorsclass['Alimhorsclassification']['portion'] . 'g';

            /* Création du champ concernant le moment ou le repas à été éjouté */
            $res = "";
            if (isset($_POST['moment1'])) {
                $res = $res . $_POST['moment1'] . '@';
            }
            if (isset($_POST['moment2'])) {
                $res = $res . $_POST['moment2'] . '@';
            }
            if (isset($_POST['moment3'])) {
                $res = $res . $_POST['moment3'] . '@';
            }
            if (isset($_POST['moment4'])) {
                $res = $res . $_POST['moment4'] . '@';
            }
            /* Suppression du dernier séparateur */
            $res = substr($res, 0, strlen($res) - 1);

            $save['Suivialimentaire']['nomSA'] = $res;
            $save['Suivialimentaire']['id_horsclass'] = $id1;
            $this->set('save', $save);
            $this->Suivialimentaire->create();
            if ($this->Suivialimentaire->save($save)) {
                $this->Session->setFlash("L'aliment a bien été ajouté au suivi alimentaire.", "messageBon");
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("Erreur lors de l'ajout de l'aliment au suivi alimentaire, veuillez réessayer.", 'messageErr');
            }
        }
    }

}
