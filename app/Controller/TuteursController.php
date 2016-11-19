<?php

App::uses('AppController', 'Controller');

/**
 * Tuteurs Controller
 *
 * @property Tuteurs $Tuteurs
 */
class TuteursController extends AppController {

    // Pour utiliser des modèles spécifiques
    public $uses = array('User', 'Demande', 'Message', 'Cinqobjectif', 'Constsuivialimentaire');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('page_cours', 'vert');
        $this->Auth->allow('index'); // laisse les utilisateurs non connecté accéder à la page mais un message alert sera afficher pour signaler à l'utilisateur qu'il faut se connecter pour choisir un diététicien et le renvera sur la page d'accueil
    }

    public function index() {

        if (AuthComponent::user('role') == 'dieteticien') {
            $this->set('suivi', 'dieteticien');
        } else {
            /* Diététiciens du site */
            $dieteticiens = $this->User->findAllByrole('dieteticien');
            $this->set('dieteticiens', $dieteticiens);

            if (!empty($dieteticiens)) {



                /* Est-ce que le consultant est déjà suivi par un diététicien ? */
                $demandes = $this->Demande->find('first', array('conditions' => array('AND' => array(array(
                                'clientid' => AuthComponent::user('id'),
                                'accepte' => 'oui'
                )))));
                $nonSuivi = false;
                if (empty($demandes)) {
                    /* Le consultant n'est pas suivi */
                    $this->set('suivi', 'non');
                    $nonSuivi = true;
                } else {
                    /* Le consultant est déjà suivi */
                    $this->set('suivi', 'oui');
                    $nomdiet = $this->User->find('first', array('conditions' => array('id' => $demandes['Demande']['dieteticienid'])));
                    $this->set('nomdiet', $nomdiet['User']['username']);
                }

                /* Est-ce que le consultant à une demande en attente ? */
                $demandes = $this->Demande->find('all', array('conditions' => array('AND' => array(array(
                                'clientid' => AuthComponent::user('id'),
                                'accepte' => 'pas encore'
                )))));
                if (!empty($demandes)) {
                    /* Une demande est en attente */
                    $this->set('suivi', 'pas encore');
                }

                if ($nonSuivi) {
                    /* Le consultant n'est pas suivi, recherche des diététiciens qui ne l'ont pas refusé */
                    $demandes = $this->Demande->find('all', array('conditions' => array('AND' => array(array(
                                    'clientid' => AuthComponent::user('id'),
                                    'accepte' => 'non'
                    )))));
                    if (empty($demandes)) {
                        /* Aucun diététicien n'a refusé une de ses demandes */
                        $this->set('dieteticiens', $dieteticiens);
                    } else {
                        /* Des demandes ont été refusées */
                        $idrefus = array();
                        for ($i = 0; $i < count($demandes); $i++) {
                            $idrefus[$i] = $demandes[$i]['Demande']['dieteticienid'];
                        }
                        $possibilites = array();
                        $ajouter;
                        for ($i = 0; $i < count($dieteticiens); $i++) {
                            $ajouter = true;
                            foreach ($idrefus as $idrefu) {
                                if ($idrefu == $dieteticiens[$i]['User']['id']) {
                                    $ajouter = false;
                                }
                            }
                            if ($ajouter) {
                                $possibilites[$i] = $dieteticiens[$i];
                            }
                        }

                        if (empty($possibilites)) {
                            /* Tous les diététiciens ont refusés le client */
                            $this->set('suivi', 'refuse');
                        } else {
                            /* Il reste des diététiciens n'ayant pas refusé le demandeur */
                            $this->set('dieteticiens', $possibilites);
                        }
                    }
                }
            }
        }
    }

    public function add() {
        /* Le tuteur demandé */
        if (isset($_POST['choix'])) {
            $idtut = $_POST['choix'];

            $tut = $this->User->find('first', array('conditions' => array('id' => $idtut)));
            if (empty($tut)) {
                $this->Session->setFlash("Vous devez sélectionner un professionnel", "messageAvert");
                $this->redirect(array('action' => 'index'));
            } else {
                $this->set('dieteticien', $tut);
            }
        }

        if ($this->request->is('post') AND ! isset($_POST['choix'])) {
            /* Ajout de la demande */
            $this->Demande->create();
            if ($this->Demande->save($this->request->data)) {
                $this->Session->setFlash("La demande a bien été envoyée", "messageBon");
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("Erreur lors de l'envoie de la demande", "messageAvert");
            }
        }
    }

    public function annuler() {
        $affichage = true;
        /* Recherche de la demande en attente de l'utilisateur */
        $demande = $this->Demande->find('first', array('conditions' => array('AND' => array(array(
                        'clientid' => AuthComponent::user('id'),
                        'accepte' => 'pas encore'
        )))));
        if (empty($demande)) {
            /* Un utilisateur consulte la page sans avoir de demande en cours */
            $this->set('affichage', false);
            $affichage = false;
        }
        if ($affichage) {
            $diet = $this->User->findAllByid($demande['Demande']['dieteticienid']);
            $this->set('demande', $demande);
            $this->set('diet', $diet[0]);
            /* Suppression de la demande */
            if ($this->request->is('post')) {
                /* id de la demande a supprimer */
                $this->Demande->id = $demande['Demande']['id'];
                if ($this->Demande->delete()) {
                    $this->Session->setFlash("La demande a bien été annulé", "messageBon");
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__("La demande n'a pas pu être annulée. Merci de réessayer."));
                    $this->redirect(array('action' => 'annuler'));
                }
            }
        }
    }

    public function annulersuivi() {
        /* Vérification d'accès à la page */
        $affichage = true;
        /* Recherche de la demande validée de l'utilisateur */
        $demande = $this->Demande->find('first', array('conditions' => array('AND' => array(array(
                        'clientid' => AuthComponent::user('id'),
                        'accepte' => 'oui'
        )))));
        if (empty($demande)) {
            /* Un utilisateur consulte la page alors qu'il n'y a pas le droit d'accès */
            $this->set('affichage', false);
            $affichage = false;
        }

        if ($affichage) {
            $diet = $this->User->findAllByid($demande['Demande']['dieteticienid']);
            $this->set('demande', $demande);
            $this->set('diet', $diet[0]);
            /* Suppression de la demande */
            if ($this->request->is('post')) {
                /* id de la demande a supprimer */
                $this->Demande->id = $demande['Demande']['id'];
                if ($this->Demande->delete()) {
                    /* tuteur supprimé */
                    /* Suppression des conseils objectifs donnés par le diététicien */
                    $commentaire = "";
                    $this->Cinqobjectif->updateAll(array('Cinqobjectif.conseil' => '"' . $commentaire . '"'), array('Cinqobjectif.user_id' => AuthComponent::user('id')));
                    $this->Constsuivialimentaire->deleteAll(array('Constsuivialimentaire.user_id' => AuthComponent::user('id')), false);

                    /* suppression des messages */
                    if ($this->Message->deleteAll(array('Message.idcli' => AuthComponent::user('id')), false)) {
                        $this->Session->setFlash(__("Tuteur supprimé"));
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__("Le tuteur n'a pas pu être supprimé. Merci de réessayer."));
                        $this->redirect(array('action' => 'annulersuivi'));
                    }
                } else {
                    $this->Session->setFlash(__("Le tuteur n'a pas pu être supprimé. Merci de réessayer."));
                    $this->redirect(array('action' => 'annulersuivi'));
                }
            }
        } else {
            $this->Session->setFlash("Vous n'avez pas accès à cette ressource", 'messageAvert');
            $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
    }

    public function messages() {
        /* Vérification d'accès à la page */
        $affichage = true;
        /* Recherche de la demande validée de l'utilisateur */
        $demande = $this->Demande->find('first', array('conditions' => array('AND' => array(array(
                        'clientid' => AuthComponent::user('id'),
                        'accepte' => 'oui'
        )))));
        if (empty($demande)) {
            /* Un utilisateur consulte la page alors qu'il n'y a pas le droit d'accès */
            $this->set('affichage', false);
            $affichage = false;
        }

        if ($affichage) {
            /* Diététicien en rapport avec le client */
            $diet = $this->User->findAllByid($demande['Demande']['dieteticienid']);
            $this->set('diet', $diet[0]);

            /* Recherche des messages */
            $id = AuthComponent::user('id');
            $messagesnouv = $this->Message->find('all', array('conditions' => array('AND' => array(
                        array('idcli' => $id),
                        array('idexpediteur <>' => $id),
                        array('repondu' => 'non'
                        ))), 'order' => array('Message.created desc')));
            $messagesanc = $this->Message->find('all', array('conditions' => array('AND' => array(
                        array('idcli' => $id),
                        array('idexpediteur <>' => $id),
                        array('repondu' => 'oui'
                        ))), 'order' => array('Message.created desc')));
            $this->set('messagesnouv', $messagesnouv);
            $this->set('messagesanc', $messagesanc);
        } else {
            $this->Session->setFlash("Vous n'avez pas accès à cette ressource", 'messageAvert');
            $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
    }

    public function affichmessage($id = null) {
        /* Vérification d'accès à la page */
        $affichage = true;
        /* Recherche de la demande validée de l'utilisateur */
        $demande = $this->Demande->find('first', array('conditions' => array('AND' => array(array(
                        'clientid' => AuthComponent::user('id'),
                        'accepte' => 'oui'
        )))));
        if (empty($demande)) {
            /* Un utilisateur consulte la page alors qu'il n'y a pas le droit d'accès */
            $this->set('affichage', false);
            $affichage = false;
            $this->Session->setFlash("Vous n'avez pas accès à cette ressource", 'messageAvert');
            $this->redirect(array('action' => 'index'));
        }

        if ($affichage) {
            $dietid = $this->User->findAllByid($demande['Demande']['dieteticienid']);
            /* Diététicien en rapport avec le client */
            $diet = $this->User->findAllByid($demande['Demande']['dieteticienid']);
            $this->set('diet', $diet[0]);

            if ($this->request->is('post')) {
                /* Enregistrement d'une reponse */
                $this->Message->create();
                if ($this->Message->save($this->request->data)) {
                    $this->Message->updateAll(array('Message.repondu' => '\'oui\''), array('Message.idmess' => $_POST['idmessage']));
                    $this->Session->setFlash(__("Le message a bien été envoyé"));
                    $this->redirect(array('action' => 'messages'));
                } else {
                    $this->Session->setFlash(__("Erreur lors de l'envoie du message. Merci de réessayer."));
                }
            }
            /* Vérification que le message affiché soit bien un message du consultant */
            $this->set('affichage2', 1);
            $rech = $this->Message->findAllByidmess($id);
            foreach ($rech as $r) {
                if ($r['Message']['idcli'] == AuthComponent::user('id')) {
                    $this->set('affichage2', 0);
                }
            }
            if ($affichage2 == 1) {
                $affichage = false;
                $this->Session->setFlash("Vous n'avez pas accès à cette ressource", 'messageAvert');
                $this->redirect(array('action' => 'index'));
            }
            /* affichage2 vaut 1 si ce n'est pas un message à l'utilisateur et 0 si oui */
            /* Informations concernant le message */
            if (!empty($rech)) {
                $this->set('message', $rech[0]['Message']['message']);
                $this->set('objet', $rech[0]['Message']['objet']);
                $this->set('created', $rech[0]['Message']['created']);
                $this->set('repondu', $rech[0]['Message']['repondu']);
                $this->set('idcli', $rech[0]['Message']['idcli']);
                $this->set('idmessage', $id);
            }
        }
    }

    public function newmessage() {
        /* Vérification d'accès à la page */
        $affichage = true;
        /* Recherche de la demande validée de l'utilisateur */
        $demande = $this->Demande->find('first', array('conditions' => array('AND' => array(array(
                        'clientid' => AuthComponent::user('id'),
                        'accepte' => 'oui'
        )))));
        if (empty($demande)) {
            /* Un utilisateur consulte la page alors qu'il n'y a pas le droit d'accès */
            $this->set('affichage', false);
            $affichage = false;
        }

        if ($affichage) {
            $dietid = $this->User->findAllByid($demande['Demande']['dieteticienid']);
            /* Diététicien en rapport avec le client */
            $diet = $this->User->findAllByid($demande['Demande']['dieteticienid']);
            $this->set('diet', $diet[0]);

            if ($this->request->is('post')) {
                /* Enregistrement d'une reponse */
                $this->Message->create();
                if ($this->Message->save($this->request->data)) {
                    $this->Message->updateAll(array('Message.repondu' => '\'oui\''), array('Message.idmess' => $_POST['idmessage']));
                    $this->Session->setFlash(__("Le message a bien été envoyé"));
                    $this->redirect(array('action' => 'messages'));
                } else {
                    $this->Session->setFlash(__("Erreur lors de l'envoie du message. Merci de réessayer."));
                }
            }
        }
    }

}

