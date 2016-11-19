<?php

App::uses('AppController', 'Controller');

class DemandesController extends AppController {

    public $uses = array('Demande', 'User', 'Message', 'Cinqobjectif', 'Constante', 'Suivialimentaire', 'Constsuivialimentaire');

    /* A verif */

    public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('role') != 'dieteticien') {
            $this->Session->setFlash("Vous n'avez pas les droits pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
        $this->set('page_cours', 'violet');
    }

    public function index() {
        // $users = $this->User->find('all');
        // $this->set('users', $users);

        if (AuthComponent::user('role') == 'dieteticien') {
            $dietid = AuthComponent::user('id');
            $users = $this->Demande->find('all', array('conditions' => array('AND' => array(
                        array('dieteticienid' => AuthComponent::user('id')),
                        array('accepte' => 'pas encore')
            ))));
            $clients = $this->Demande->find('all', array('conditions' => array('AND' => array(
                        array('dieteticienid' => AuthComponent::user('id')),
                        array('accepte' => 'oui')
            ))));
            $this->set('clients', $clients);
            $this->set('dietid', $dietid);
            $this->set('users', $users);
        }
    }

    public function information($id = null) {
        if (AuthComponent::user('role') == 'dieteticien') {
            /* Vérification que le consultant est bien un client du diététicien */
            $dietid = AuthComponent::user('id');
            $this->set('affichage', 1);
            $rech = $this->Demande->findAllByclientid($id);
            foreach ($rech as $r) {
                if ($r['Demande']['dieteticienid'] == $dietid) {
                    $this->set('affichage', 0);
                }
            }
            /** affichage vaut 1 si ce n'est pas un client au dieteticien et 0 si oui */
            $users = $this->User->find('first', array('conditions' => array('id' => $id)));
            $this->set('users', $users);
        } else {
            $this->Session->setFlash("Vous n'avez pas les droit pour accèder à cette page", "messageAvert");
            $this->redirect(['controller' => 'pages', 'action' => 'home', 'full_base' => true]);
        }
    }

    public function repondre($id = null) {
        if (AuthComponent::user('role') == 'dieteticien') {
            $dietid = AuthComponent::user('id');
            if ($this->request->is('post')) {
                /* 	Demande acceptée / refusée ou bouton retour */
                if (isset($_POST['oui'])) {
                    /* 	Demande acceptée */
                    if ($this->Demande->updateAll(
                                    array('Demande.accepte' => '\'oui\''), array('AND' => array(
                                    'Demande.dieteticienid' => $dietid,
                                    'Demande.clientid' => $id
                                )
                            ))
                    ) {
                        $this->Session->setFlash("La demande a été acceptée", "messageBon");
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash("La demande n'a pas pu être acceptée. Merci de réessayer.", "messageErr");
                    }
                } else if (isset($_POST['non'])) {
                    /* 	Demande refusée */
                    if ($this->Demande->updateAll(
                                    array('Demande.accepte' => '\'non\''), array('AND' => array(
                                    'Demande.dieteticienid' => $dietid,
                                    'Demande.clientid' => $id
                                )
                            ))
                    ) {
                        $this->Session->setFlash("La demande a été refusée", "messageBon");
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash("La demande n'a pas pu être refusée. Merci de réessayer.", "messageErr");
                    }
                } else {
                    /* 	Bouton retour */
                    $this->redirect(array('action' => 'index'));
                }
            }
            /* Vérification que le consultant est bien un client du diététicien */
            $this->set('affichage', 1);
            $rech = $this->Demande->findAllByclientid($id);
            foreach ($rech as $r) {
                if ($r['Demande']['dieteticienid'] == $dietid) {
                    $this->set('affichage', 0);
                }
            }
            /** affichage vaut 1 si ce n'est pas un client au dieteticien et 0 si oui */
            $demandes = $this->Demande->find('all', array('conditions' => array('AND' => array(
                        array('accepte' => 'pas encore'),
                        array('dieteticienid' => $dietid)))));
            $this->set('demandes', $demandes);
            $demandeur = $this->User->find('first', array('conditions' => array('id' => $id)));
            $this->set('demandeur', $demandeur);
        }
    }

    public function messages() {
        if (AuthComponent::user('role') == 'dieteticien') {
            $dietid = AuthComponent::user('id');
            $messagesnouv = $this->Message->find('all', array('conditions' => array('AND' => array(
                        array('iddiet' => $dietid),
                        array('idexpediteur <> ' => $dietid),
                        array('repondu' => 'non'
                        ))), 'order' => array('Message.created desc')));
            $messagesanc = $this->Message->find('all', array('conditions' => array('AND' => array(
                        array('iddiet' => $dietid),
                        array('idexpediteur <> ' => $dietid),
                        array('repondu' => 'oui'
                        ))), 'order' => array('Message.created desc')));
            $this->set('messagesnouv', $messagesnouv);
            $this->set('messagesanc', $messagesanc);
            $this->set('dietid', $dietid);
        }
    }

    public function affichmessage($id = null) {
        if (AuthComponent::user('role') == 'dieteticien') {
            $dietid = AuthComponent::user('id');
            if ($this->request->is('post')) {
                /* Enregistrement d'une reponse */
                $this->Message->create();
                if ($this->Message->save($this->request->data)) {
                    $this->Message->updateAll(array('Message.repondu' => '\'oui\''), array('Message.idmess' => $_POST['idmessage']));
                    $this->Session->setFlash("Le message a bien été envoyé", "messageBon");
                    $this->redirect(array('action' => 'messages'));
                } else {
                    $this->Session->setFlash("Erreur lors de l'envoie du message. Merci de réessayer.", "messageErr");
                }
            }
            /* Vérification que le message affiché soit bien un message du diététicien */
            $affichage = $this->set('affichage', 1);
            $rech = $this->Message->findAllByidmess($id);
            foreach ($rech as $r) {
                if ($r['Message']['iddiet'] == $dietid) {
                    $affichage = $this->set('affichage', 0);
                }
            }
            if ($affichage == 1) {
                $this->Session->setFlash("Vous n'avez pas accès à cette page", "messageAvert");
                $this->redirect(array('action' => 'index'));
            } 
            if (!empty($rech)) {
                /* affichage vaut 1 si ce n'est pas un message au dieteticien et 0 si oui */
                /* Informations concernant le message */
                $this->set('message', $rech[0]['Message']['message']);
                $this->set('objet', $rech[0]['Message']['objet']);
                $this->set('created', $rech[0]['Message']['created']);
                $this->set('repondu', $rech[0]['Message']['repondu']);
                $this->set('idcli', $rech[0]['Message']['idcli']);
                $this->set('idmessage', $id);

                /* Information concernant l'expéditeur du message */
                $infoscli = $this->User->find('first', array('conditions' => array('id' => $rech[0]['Message']['idcli'])));
                $this->set('nomCli', $infoscli['User']['username']);

                /* Information concernant le diététicien */
                $this->set('dietid', $dietid);
            }
        }
    }

    public function newmessage() {
        if (AuthComponent::user('role') == 'dieteticien') {
            $dietid = AuthComponent::user('id');
            if ($this->request->is('post')) {
                /* Enregistrement d'un message */
                $this->Message->create();
                if ($this->Message->save($this->request->data)) {
                    $this->Message->updateAll(array('Message.repondu' => '\'oui\''), array('Message.idmess' => $_POST['idmessage']));
                    $this->Session->setFlash("Le message a bien été envoyé", "messageBon");
                    $this->redirect(array('action' => 'messages'));
                } else {
                    $this->Session->setFlash("Erreur lors de l'envoie du message. Merci de réessayer.", "messageErr");
                }
            }
            /* Information concernant le diététicien */
            $this->set('dietid', $dietid);

            // Recherche des clients du diététicien
            $clients = $this->Demande->find('all', array('conditions' => array('AND' => array(
                        array('dieteticienid' => AuthComponent::user('id')),
                        array('accepte' => 'oui')
            ))));
            $this->set('clients', $clients);
        }
    }

    public function suivis() {
        if (AuthComponent::user('role') == 'dieteticien') {
            $clients = $this->Demande->find('all', array('conditions' => array('AND' => array(
                        array('dieteticienid' => AuthComponent::user('id')),
                        array('accepte' => 'oui')
            ))));
            $this->set('clients', $clients);
        }
    }

    public function analyseSuivi() {

        // Fonction permettant de traduire une date au format sql en lettre, avec heure
        function dateenlettre($date) {
            $dateheure = explode(" ", $date);
            $date = $dateheure[0];
            $heure = $dateheure[1];
            $split = explode("-", $date);
            $jour = $split[2];
            $mois = $split[1];
            $annee = $split[0];
            $newTimestamp = mktime(12, 0, 0, $mois, $jour, $annee);

            $Jour = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
            $Mois = array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

            $split = explode(":", $heure);
            $heure = $split[0] . 'h' . $split[1];
            return $Jour[date("w", $newTimestamp)] . ' ' . $jour . ' ' . $Mois[date("n", $newTimestamp)] . ' ' . $annee . ' à ' . $heure;
        }

        if (AuthComponent::user('role') == 'dieteticien' AND $this->request->is('post')) {
            if (isset($_POST['choix'])) {
                /* Mes 5 objectifs + Suivi alimentaire */
                /* Entrée normale sur la page */
                $idclient = $_POST['choix'];
                $client = $this->User->find('first', array('conditions' => array('id' => $idclient)));
                if (empty($client)) {
                    $this->Session->setFlash("Vous devez sélectionner un patient", "messageAvert");
                    $this->redirect(array('action' => 'suivis'));
                } else {
                    $this->set('client', $client);
                }
                if (isset($_POST['suivi2'])) {
                    /* Suivi alimentaire */
                    /* Infos */
                    $naiss = $client['User']['datenaissance'];
                    $age = $this->Suivialimentaire->query("SELECT TIMESTAMPDIFF(YEAR,'" . $naiss . "', NOW()) as age;");
                    $age = $age[0][0]['age'];
                    if ($age == 0 || $age == 1 || $age == 2) {
                        $mois = $this->Suivialimentaire->query("SELECT TIMESTAMPDIFF(MONTH,'" . $naiss . "', NOW()) as age;");
                        $mois = $mois[0][0]['age'];
                    }
                    $grossesse = $client['User']['enceinte'] == "O" ? true : false;
                    $allaitement = $client['User']['allaitante'] == "O" ? true : false;
                    if ($grossesse) {
                        $moisgrossesse = $client['User']['nbmoisenceinte'];
                    }
                    if ($allaitement) {
                        $moisallaitement = $client['User']['nbmoisallaitement'];
                    }
                    $obPoi = $client['User']['poids'];
                    $activite = $client['User']['activite'];
                    $sexe = $client['User']['sexe'];
                    $ca;
                    $taille = $client['User']['taille'] / 100.00;

                    /* Calcul du CA */
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

                    /* Objectif cal */
                    /* Nourrissons et jeunes enfants */
                    if (isset($mois) && $mois >= 0 && $mois <= 3) {
                        $obEnKcal = (89 * $obPoi - 100) + 175;
                    } elseif (isset($mois) && $mois >= 4 && $mois <= 6) {
                        $obEnKcal = (89 * $obPoi - 100) + 56;
                    } elseif (isset($mois) && $mois >= 7 && $mois <= 12) {
                        $obEnKcal = (89 * $obPoi - 100) + 22;
                    } elseif (isset($mois) && $mois >= 13 && $mois <= 34) {
                        $obEnKcal = (89 * $obPoi - 100) + 20;
                    } /* Enfants et adolescents de 3 à 18 ans */ elseif ($age >= 3 && $age <= 8 && $sexe == "homme") {
                        $obEnKcal = 88.5 - (61.9 * $age) + $ca * ((26.7 * $obPoi) + (903 * $taille)) + 20;
                    } elseif ($age >= 9 && $age <= 18 && $sexe == "homme") {
                        $obEnKcal = 88.5 - (61.9 * $age) + $ca * ((26.7 * $obPoi) + (903 * $taille)) + 25;
                    } elseif ($age >= 3 && $age <= 8 && $sexe == "femme") {
                        $obEnKcal = 135.3 - (30.8 * $age) + $ca * ((10.0 * $obPoi) + (934 * $taille)) + 20;
                    } elseif ($age >= 9 && $age <= 18 && $sexe == "femme") {
                        $obEnKcal = 135.3 - (30.8 * $age) + $ca * ((10.0 * $obPoi) + (934 * $taille)) + 25;
                    } /* Adultes de 19 ans et plus */ elseif ($age >= 19 && $sexe == "homme") {
                        $obEnKcal = 662 - (9.53 * $age) + $ca * ((15.91 * $obPoi) + (539.6 * $taille));
                    } elseif ($age >= 19 && $sexe == "femme") {
                        $obEnKcal = 354 - (9.91 * $age) + $ca * ((9.36 * $obPoi) + (726 * $taille));
                    } /* Grossesse */
                    if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
                        $obEnKcal = $obEnKcal + 340;
                    } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                        $obEnKcal = $obEnKcal + 452;
                    } /* Allaitement */
                    if ($allaitement && $moisallaitement >= 0 && $moisallaitement <= 6) {
                        $obEnKcal = $obEnKcal + 500 - 170;
                    } if ($allaitement && $moisallaitement >= 7 && $moisallaitement <= 12) {
                        $obEnKcal = $obEnKcal + 400;
                    }

                    /* Objectif defaut protéines */
                    $con = $this->Constante->findAllBycategorie(2);
                    if ($age < 2) {
                        $obPro = 0;
                    } elseif ($age >= 2 && $age < 4) {
                        $obPro = $obPoi * $con[0]['Constante']['valeur'];
                    } elseif ($age >= 4 && $age < 8) {
                        $obPro = $obPoi * $con[1]['Constante']['valeur'];
                    } elseif ($age >= 8 && $age < 13) {
                        $obPro = $obPoi * $con[2]['Constante']['valeur'];
                    } elseif ($age >= 14 && $age <= 18) {
                        $obPro = $obPoi * $con[3]['Constante']['valeur'];
                    } elseif ($age >= 19 && $age <= 50) {
                        $obPro = $obPoi * $con[4]['Constante']['valeur'];
                    } elseif ($age > 50) {
                        $obPro = $obPoi * $con[9]['Constante']['valeur'];
                    } if ($grossesse && $moisgrossesse > 0 && $moisgrossesse <= 3) {
                        $obPro = $obPoi * $con[5]['Constante']['valeur'];
                    } if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
                        $obPro = $obPoi * $con[6]['Constante']['valeur'];
                    } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                        $obPro = $obPoi * $con[7]['Constante']['valeur'];
                    } if ($allaitement) {
                        $obPro = $obPoi * $con[8]['Constante']['valeur'];
                    }

                    /* Objectif defaut lipides */
                    $obLip = ($obEnKcal * 35 / 100) / 9;

                    /* Objectif defaut fibres */
                    $con = $this->Constante->findAllBycategorie(1);
                    if ($age < 2) {
                        $obFib = 0;
                    } elseif ($age >= 2 && $age < 4) {
                        $obFib = $con[0]['Constante']['valeur'];
                    } elseif ($age >= 4 && $age <= 8) {
                        $obFib = $con[1]['Constante']['valeur'];
                    } elseif ($age >= 9 && $age <= 13 && $sexe == "homme") {
                        $obFib = $con[2]['Constante']['valeur'];
                    } elseif ($age >= 9 && $age <= 13 && $sexe == "femme") {
                        $obFib = $con[3]['Constante']['valeur'];
                    } elseif ($age >= 14 && $age <= 18 && $sexe == "homme") {
                        $obFib = $con[4]['Constante']['valeur'];
                    } elseif ($age >= 14 && $age <= 18 && $sexe == "femme") {
                        $obFib = $con[5]['Constante']['valeur'];
                    } elseif ($age >= 19 && $age <= 50 && $sexe == "homme") {
                        $obFib = $con[6]['Constante']['valeur'];
                    } elseif ($age >= 19 && $age <= 50 && $sexe == "femme") {
                        $obFib = $con[7]['Constante']['valeur'];
                    } elseif ($age > 50 && $sexe == "homme") {
                        $obFib = $con[10]['Constante']['valeur'];
                    } elseif ($age > 50 && $sexe == "femme") {
                        $obFib = $con[11]['Constante']['valeur'];
                    } if ($grossesse) {
                        $obFib = $con[8]['Constante']['valeur'];
                    } if ($allaitement) {
                        $obFib = $con[9]['Constante']['valeur'];
                    }

                    /* Objectif defaut sel */
                    $con = $this->Constante->findAllBycategorie(4);
                    if ($age < 2) {
                        $obSel = 0;
                    } elseif ($age >= 2 && $age < 4) {
                        $obSel = $con[0]['Constante']['valeur'];
                    } elseif ($age >= 4 && $age < 9) {
                        $obSel = $con[1]['Constante']['valeur'];
                    } elseif ($age >= 9 && $age < 13) {
                        $obSel = $con[2]['Constante']['valeur'];
                    } elseif ($age >= 14 && $age <= 18) {
                        $obSel = $con[3]['Constante']['valeur'];
                    } elseif ($age >= 19 && $age <= 50) {
                        $obSel = $con[4]['Constante']['valeur'];
                    } elseif ($age > 50) {
                        $obSel = $con[9]['Constante']['valeur'];
                    } if ($grossesse && $moisgrossesse > 0 && $moisgrossesse <= 3) {
                        $obSel = $con[5]['Constante']['valeur'];
                    } if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
                        $obSel = $con[6]['Constante']['valeur'];
                    } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                        $obSel = $con[7]['Constante']['valeur'];
                    } if ($allaitement) {
                        $obSel = $con[8]['Constante']['valeur'];
                    }

                    /* Mise en forme */
                    $obPro = intval($obPro);
                    $obLip = intval($obLip);
                    $obFib = intval($obFib);
                    $obSel = intval($obSel);

                    $this->set('obPro', $obPro);
                    $this->set('obLip', $obLip);
                    $this->set('obFib', $obFib);
                    $this->set('obSel', $obSel);

                    $this->set('fix_proteines', null);
                    $this->set('fix_lipides', null);
                    $this->set('fix_fibres', null);
                    $this->set('fix_sel', null);
                    if (!empty($client['Constsuivialimentaire'])) {
                        /* valeur déjà fixée */
                        foreach ($client['Constsuivialimentaire'] as $const) {
                            if (!empty($const['proteines']) AND $const['responsable_id'] == AuthComponent::user('id')) {
                                $this->set('fix_proteines', intval($obPoi * $const['proteines']));
                                $this->set('fix_p_valeur', $const['proteines']);
                                $this->set('id_proteines', $const['id']);
                            }
                            if (!empty($const['lipides']) AND $const['responsable_id'] == AuthComponent::user('id')) {
                                $this->set('fix_lipides', intval(($obEnKcal * $const['lipides']) / 9));
                                $this->set('fix_l_valeur', $const['lipides']);
                                $this->set('id_lipides', $const['id']);
                            }
                            if (!empty($const['fibres']) AND $const['responsable_id'] == AuthComponent::user('id')) {
                                $this->set('fix_fibres', $const['fibres']);
                                $this->set('id_fibres', $const['id']);
                            }
                            if (!empty($const['sel']) AND $const['responsable_id'] == AuthComponent::user('id')) {
                                $this->set('fix_sel', $const['sel']);
                                $this->set('id_sel', $const['id']);
                            }
                        }
                    }
                }
            } else {
                /* Modification faite par le diététicien */
            }
        }
    }

    public function addConseil($id1 = null, $id2 = null) {
        if (AuthComponent::user('role') == 'dieteticien') {
            if ($this->request->is('post')) {
                $commentaire = nl2br($_POST['com']);
                if ($this->Cinqobjectif->updateAll(array('Cinqobjectif.conseil' => '"' . $commentaire . '"'), array('Cinqobjectif.id' => $id1))) {
                    $this->Session->setFlash("Conseil ajouté", "messageBon");
                    $this->redirect(array('action' => 'suivis'));
                } else {
                    $this->Session->setFlash("Le conseil n'a pas été ajouté, le nombre de retour à la ligne est trop grand.", "messageErr");
                    $this->redirect(array('action' => 'addConseil/' . $id1 . '/' . $id2));
                }
            }
            /* vérif id2 qui est l'id du client */
            $dietid = AuthComponent::user('id');
            $ok1 = false;
            $rech = $this->Demande->findAllByclientid($id2);
            foreach ($rech as $r) {
                if ($r['Demande']['dieteticienid'] == $dietid) {
                    $ok1 = true;
                }
            }
            /* verif id1 qui est l'id de l'objectif du client à modifier */
            if ($ok1) {
                $ok2 = false;
                $user = $this->User->find('first', array('conditions' => array('id' => $id2)));
                $objectif;
                foreach ($user['Cinqobjectif'] as $obj) {
                    if ($obj['id'] == $id1) {
                        $ok2 = true;
                        $objectif = $obj;
                        break;
                    }
                }
            }
            /* résultat */
            if (!$ok1 OR ! $ok2) {
                $ok = false;
                $this->set('affichage', false);
            } else {
                $ok = true;
                $this->set('affichage', true);
            }

            if ($ok) {
                $this->set('objectif', $objectif);
            }
        }
    }

    public function editConseil($id1 = null, $id2 = null) {
        if (AuthComponent::user('role') == 'dieteticien') {
            if ($this->request->is('post')) {
                $commentaire = nl2br($_POST['com']);
                if ($this->Cinqobjectif->updateAll(array('Cinqobjectif.conseil' => '"' . $commentaire . '"'), array('Cinqobjectif.id' => $id1))) {
                    $this->Session->setFlash("Conseil modifié", "messageBon");
                    $this->redirect(array('action' => 'suivis'));
                } else {
                    $this->Session->setFlash("Le conseil n'a pas été modifié, le nombre de retour à la ligne est trop grand.", "messageErr");
                    $this->redirect(array('action' => 'editConseil/' . $id1 . '/' . $id2));
                }
            }
            /* vérif id2 qui est l'id du client */
            $dietid = AuthComponent::user('id');
            $ok1 = false;
            $rech = $this->Demande->findAllByclientid($id2);
            foreach ($rech as $r) {
                if ($r['Demande']['dieteticienid'] == $dietid) {
                    $ok1 = true;
                }
            }
            /* verif id1 qui est l'id de l'objectif du client à modifier */
            if ($ok1) {
                $ok2 = false;
                $user = $this->User->find('first', array('conditions' => array('id' => $id2)));
                $objectif;
                foreach ($user['Cinqobjectif'] as $obj) {
                    if ($obj['id'] == $id1) {
                        $ok2 = true;
                        $objectif = $obj;
                        break;
                    }
                }
            }
            /* résultat */
            if (!$ok1 OR ! $ok2) {
                $ok = false;
                $this->set('affichage', false);
            } else {
                $ok = true;
                $this->set('affichage', true);
            }

            if ($ok) {
                $this->set('objectif', $objectif);
            }
        }
    }

    public function deleteConseil($id1 = null, $id2 = null) {
        if (AuthComponent::user('role') == 'dieteticien') {
            if ($this->request->is('post')) {
                $commentaire = "";
                if ($this->Cinqobjectif->updateAll(array('Cinqobjectif.conseil' => '"' . $commentaire . '"'), array('Cinqobjectif.id' => $id1))) {
                    $this->Session->setFlash("Conseil supprimé", "messageBon");
                    $this->redirect(array('action' => 'suivis'));
                } else {
                    $this->Session->setFlash("Le conseil n'a pas été supprimé, le nombre de retour à la ligne est trop grand.", "messageErr");
                    $this->redirect(array('action' => 'deleteConseil/' . $id1 . '/' . $id2));
                }
            }
            /* vérif id2 qui est l'id du client */
            $dietid = AuthComponent::user('id');
            $ok1 = false;
            $rech = $this->Demande->findAllByclientid($id2);
            foreach ($rech as $r) {
                if ($r['Demande']['dieteticienid'] == $dietid) {
                    $ok1 = true;
                }
            }
            /* verif id1 qui est l'id de l'objectif du client à modifier */
            if ($ok1) {
                $ok2 = false;
                $user = $this->User->find('first', array('conditions' => array('id' => $id2)));
                $objectif;
                foreach ($user['Cinqobjectif'] as $obj) {
                    if ($obj['id'] == $id1) {
                        $ok2 = true;
                        $objectif = $obj;
                        break;
                    }
                }
            }
            /* résultat */
            if (!$ok1 OR ! $ok2) {
                $ok = false;
                $this->set('affichage', false);
            } else {
                $ok = true;
                $this->set('affichage', true);
            }

            if ($ok) {
                $this->set('objectif', $objectif);
            }
        }
    }

    public function delete($id = null) {
        if (AuthComponent::user('role') == 'dieteticien') {
            /* Vérification que le consultant est bien un client du diététicien */
            $dietid = AuthComponent::user('id');
            $this->set('affichage', 1);
            $rech = $this->Demande->findAllByclientid($id);
            foreach ($rech as $r) {
                if ($r['Demande']['dieteticienid'] == $dietid) {
                    $this->set('affichage', 0);
                }
            }
            /** affichage vaut 1 si ce n'est pas un client au dieteticien et 0 si oui */
            $users = $this->User->find('first', array('conditions' => array('id' => $id)));
            $this->set('users', $users);

            if ($this->request->is('post')) {
                $dietid = AuthComponent::user('id');
                $userid = $users['User']['id'];
                $demandeid = $this->Demande->find('first', array('conditions' => array('AND' => array(
                            array('dieteticienid' => $dietid),
                            array('clientid' => $userid)
                ))));
                $demandeid = $demandeid['Demande']['id'];
                $this->Demande->id = $demandeid;
                if ($this->Demande->delete()) {
                    /* supprimé */
                    /* Suppression des conseils objectifs donnés par le diététicien */
                    $commentaire = "";
                    $this->Cinqobjectif->updateAll(array('Cinqobjectif.conseil' => '"' . $commentaire . '"'), array('Cinqobjectif.user_id' => $userid));
                    $this->Constsuivialimentaire->deleteAll(array('Constsuivialimentaire.user_id' => $userid), false);

                    /* suppression des messages */
                    if ($this->Message->deleteAll(array('Message.idcli' => $userid), false)) {
                        $this->Session->setFlash("Le suivi patient a été supprimé", "messageBon");
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash("Le patient n'a pas pu être supprimé. Merci de réessayer.", "messageErr");
                        $this->redirect(array('action' => 'delete/' . $id));
                    }
                } else {
                    $this->Session->setFlash("Le patient n'a pas pu être supprimé. Merci de réessayer.", "messageErr");
                    $this->redirect(array('action' => 'delete/' . $id));
                }
            }
        }
    }

    public function editObjectif($id1 = null, $id2 = null) {
        if (AuthComponent::user('role') == 'dieteticien') {
            if ($this->request->is('post')) {
                if (isset($_POST['apport1'])) {
                    /* PROTEINES */
                    $apport = $_POST['apport1'];
                    if ($this->Constsuivialimentaire->updateAll(array('Constsuivialimentaire.proteines' => $apport), array('Constsuivialimentaire.id' => $id1))) {
                        $this->Constsuivialimentaire->updateAll(array('Constsuivialimentaire.responsable_id' => AuthComponent::user('id')), array('Constsuivialimentaire.id' => $id1));
                        $this->Session->setFlash("Objectif modifié", "messageBon");
                        $this->redirect(array('action' => 'suivis'));
                    } else {
                        $this->Session->setFlash("L'objectif n'a pas été modifié, veuillez réessayer.", "messageErr");
                        $this->redirect(array('action' => 'editObjectif/' . $id1 . '/' . $id2));
                    }
                } elseif (isset($_POST['apport2'])) {
                    /* Lipides */
                    $apport = $_POST['apport2'];
                    if ($this->Constsuivialimentaire->updateAll(array('Constsuivialimentaire.lipides' => $apport), array('Constsuivialimentaire.id' => $id1))) {
                        $this->Constsuivialimentaire->updateAll(array('Constsuivialimentaire.responsable_id' => AuthComponent::user('id')), array('Constsuivialimentaire.id' => $id1));
                        $this->Session->setFlash("Objectif modifié", "messageBon");
                        $this->redirect(array('action' => 'suivis'));
                    } else {
                        $this->Session->setFlash("L'objectif n'a pas été modifié, veuillez réessayer.", "messageErr");
                        $this->redirect(array('action' => 'editObjectif/' . $id1 . '/' . $id2));
                    }
                } elseif (isset($_POST['apport3'])) {
                    /* fibres */
                    $apport = $_POST['apport3'];
                    /* verif */
                    if (!(preg_match("`^[0-9]{1,2}$`", $apport) AND $apport > 0 AND $apport <= 100)) {
                        $fin = true;
                        $message = "Attention, la quantitée est invalide";
                    } else {
                        $fin = false;
                    }
                    if ($fin) {
                        $this->Session->setFlash($message, "messageAvert");
                        $this->redirect(array('action' => 'editObjectif/' . $id1 . '/' . $id2));
                    } else {
                        if ($this->Constsuivialimentaire->updateAll(array('Constsuivialimentaire.fibres' => $apport), array('Constsuivialimentaire.id' => $id1))) {
                            $this->Constsuivialimentaire->updateAll(array('Constsuivialimentaire.responsable_id' => AuthComponent::user('id')), array('Constsuivialimentaire.id' => $id1));
                            $this->Session->setFlash("Objectif modifié", "messageBon");
                            $this->redirect(array('action' => 'suivis'));
                        } else {
                            $this->Session->setFlash("L'objectif n'a pas été modifié, veuillez réessayer.", "messageErr");
                            $this->redirect(array('action' => 'editObjectif/' . $id1 . '/' . $id2));
                        }
                    }
                } elseif (isset($_POST['apport4'])) {
                    /* sel */
                    $apport = $_POST['apport4'];
                    /* verif */
                    if (!(preg_match("`^[0-9]{1,4}$`", $apport) AND $apport > 0 AND $apport <= 10000)) {
                        $fin = true;
                        $message = "Attention, la quantitée est invalide";
                    } else {
                        $fin = false;
                    }
                    if ($fin) {
                        $this->Session->setFlash($message, "messageAvert");
                        $this->redirect(array('action' => 'editObjectif/' . $id1 . '/' . $id2));
                    } else {
                        if ($this->Constsuivialimentaire->updateAll(array('Constsuivialimentaire.sel' => $apport), array('Constsuivialimentaire.id' => $id1))) {
                            $this->Constsuivialimentaire->updateAll(array('Constsuivialimentaire.responsable_id' => AuthComponent::user('id')), array('Constsuivialimentaire.id' => $id1));
                            $this->Session->setFlash("Objectif modifié", "messageBon");
                            $this->redirect(array('action' => 'suivis'));
                        } else {
                            $this->Session->setFlash("L'objectif n'a pas été modifié, veuillez réessayer.", "messageErr");
                            $this->redirect(array('action' => 'editObjectif/' . $id1 . '/' . $id2));
                        }
                    }
                }
            }
            /* vérif id2 qui est l'id du client */
            $dietid = AuthComponent::user('id');
            $ok1 = false;
            $rech = $this->Demande->findAllByclientid($id2);
            foreach ($rech as $r) {
                if ($r['Demande']['dieteticienid'] == $dietid) {
                    $ok1 = true;
                }
            }
            /* verif id1 qui est l'id de l'objectif du client à modifier */
            if ($ok1) {
                $ok2 = false;
                $user = $this->User->find('first', array('conditions' => array('id' => $id2)));
                $objectif;
                foreach ($user['Constsuivialimentaire'] as $obj) {
                    if ($obj['id'] == $id1) {
                        $ok2 = true;
                        $objectif = $obj;
                        break;
                    }
                }
            }
            /* résultat */
            if (!$ok1 OR ! $ok2) {
                $ok = false;
                $this->set('affichage', false);
            } else {
                $ok = true;
                $this->set('affichage', true);
            }

            if ($ok) {
                $this->set('objectif', $objectif);
                $client = $user;
                /* Infos */
                $naiss = $client['User']['datenaissance'];
                $age = $this->Suivialimentaire->query("SELECT TIMESTAMPDIFF(YEAR,'" . $naiss . "', NOW()) as age;");
                $age = $age[0][0]['age'];
                if ($age == 0 || $age == 1 || $age == 2) {
                    $mois = $this->Suivialimentaire->query("SELECT TIMESTAMPDIFF(MONTH,'" . $naiss . "', NOW()) as age;");
                    $mois = $mois[0][0]['age'];
                }
                $grossesse = $client['User']['enceinte'] == "O" ? true : false;
                $allaitement = $client['User']['allaitante'] == "O" ? true : false;
                if ($grossesse) {
                    $moisgrossesse = $client['User']['nbmoisenceinte'];
                }
                if ($allaitement) {
                    $moisallaitement = $client['User']['nbmoisallaitement'];
                }
                $obPoi = $client['User']['poids'];
                $activite = $client['User']['activite'];
                $sexe = $client['User']['sexe'];
                $ca;
                $taille = $client['User']['taille'] / 100.00;

                /* Calcul du CA */
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

                /* Objectif cal */
                /* Nourrissons et jeunes enfants */
                if (isset($mois) && $mois >= 0 && $mois <= 3) {
                    $obEnKcal = (89 * $obPoi - 100) + 175;
                } elseif (isset($mois) && $mois >= 4 && $mois <= 6) {
                    $obEnKcal = (89 * $obPoi - 100) + 56;
                } elseif (isset($mois) && $mois >= 7 && $mois <= 12) {
                    $obEnKcal = (89 * $obPoi - 100) + 22;
                } elseif (isset($mois) && $mois >= 13 && $mois <= 34) {
                    $obEnKcal = (89 * $obPoi - 100) + 20;
                } /* Enfants et adolescents de 3 à 18 ans */ elseif ($age >= 3 && $age <= 8 && $sexe == "homme") {
                    $obEnKcal = 88.5 - (61.9 * $age) + $ca * ((26.7 * $obPoi) + (903 * $taille)) + 20;
                } elseif ($age >= 9 && $age <= 18 && $sexe == "homme") {
                    $obEnKcal = 88.5 - (61.9 * $age) + $ca * ((26.7 * $obPoi) + (903 * $taille)) + 25;
                } elseif ($age >= 3 && $age <= 8 && $sexe == "femme") {
                    $obEnKcal = 135.3 - (30.8 * $age) + $ca * ((10.0 * $obPoi) + (934 * $taille)) + 20;
                } elseif ($age >= 9 && $age <= 18 && $sexe == "femme") {
                    $obEnKcal = 135.3 - (30.8 * $age) + $ca * ((10.0 * $obPoi) + (934 * $taille)) + 25;
                } /* Adultes de 19 ans et plus */ elseif ($age >= 19 && $sexe == "homme") {
                    $obEnKcal = 662 - (9.53 * $age) + $ca * ((15.91 * $obPoi) + (539.6 * $taille));
                } elseif ($age >= 19 && $sexe == "femme") {
                    $obEnKcal = 354 - (9.91 * $age) + $ca * ((9.36 * $obPoi) + (726 * $taille));
                } /* Grossesse */
                if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
                    $obEnKcal = $obEnKcal + 340;
                } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                    $obEnKcal = $obEnKcal + 452;
                } /* Allaitement */
                if ($allaitement && $moisallaitement >= 0 && $moisallaitement <= 6) {
                    $obEnKcal = $obEnKcal + 500 - 170;
                } if ($allaitement && $moisallaitement >= 7 && $moisallaitement <= 12) {
                    $obEnKcal = $obEnKcal + 400;
                }

                /* Objectif defaut protéines */
                $con = $this->Constante->findAllBycategorie(2);
                if ($age < 2) {
                    $obPro = 0;
                } elseif ($age >= 2 && $age < 4) {
                    $obPro = $obPoi * $con[0]['Constante']['valeur'];
                } elseif ($age >= 4 && $age < 8) {
                    $obPro = $obPoi * $con[1]['Constante']['valeur'];
                } elseif ($age >= 8 && $age < 13) {
                    $obPro = $obPoi * $con[2]['Constante']['valeur'];
                } elseif ($age >= 14 && $age <= 18) {
                    $obPro = $obPoi * $con[3]['Constante']['valeur'];
                } elseif ($age >= 19 && $age <= 50) {
                    $obPro = $obPoi * $con[4]['Constante']['valeur'];
                } elseif ($age > 50) {
                    $obPro = $obPoi * $con[9]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 0 && $moisgrossesse <= 3) {
                    $obPro = $obPoi * $con[5]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
                    $obPro = $obPoi * $con[6]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                    $obPro = $obPoi * $con[7]['Constante']['valeur'];
                } if ($allaitement) {
                    $obPro = $obPoi * $con[8]['Constante']['valeur'];
                }

                /* Objectif defaut lipides */
                $obLip = ($obEnKcal * 35 / 100) / 9;

                /* Objectif defaut fibres */
                $con = $this->Constante->findAllBycategorie(1);
                if ($age < 2) {
                    $obFib = 0;
                } elseif ($age >= 2 && $age < 4) {
                    $obFib = $con[0]['Constante']['valeur'];
                } elseif ($age >= 4 && $age <= 8) {
                    $obFib = $con[1]['Constante']['valeur'];
                } elseif ($age >= 9 && $age <= 13 && $sexe == "homme") {
                    $obFib = $con[2]['Constante']['valeur'];
                } elseif ($age >= 9 && $age <= 13 && $sexe == "femme") {
                    $obFib = $con[3]['Constante']['valeur'];
                } elseif ($age >= 14 && $age <= 18 && $sexe == "homme") {
                    $obFib = $con[4]['Constante']['valeur'];
                } elseif ($age >= 14 && $age <= 18 && $sexe == "femme") {
                    $obFib = $con[5]['Constante']['valeur'];
                } elseif ($age >= 19 && $age <= 50 && $sexe == "homme") {
                    $obFib = $con[6]['Constante']['valeur'];
                } elseif ($age >= 19 && $age <= 50 && $sexe == "femme") {
                    $obFib = $con[7]['Constante']['valeur'];
                } elseif ($age > 50 && $sexe == "homme") {
                    $obFib = $con[10]['Constante']['valeur'];
                } elseif ($age > 50 && $sexe == "femme") {
                    $obFib = $con[11]['Constante']['valeur'];
                } if ($grossesse) {
                    $obFib = $con[8]['Constante']['valeur'];
                } if ($allaitement) {
                    $obFib = $con[9]['Constante']['valeur'];
                }

                /* Objectif defaut sel */
                $con = $this->Constante->findAllBycategorie(4);
                if ($age < 2) {
                    $obSel = 0;
                } elseif ($age >= 2 && $age < 4) {
                    $obSel = $con[0]['Constante']['valeur'];
                } elseif ($age >= 4 && $age < 9) {
                    $obSel = $con[1]['Constante']['valeur'];
                } elseif ($age >= 9 && $age < 13) {
                    $obSel = $con[2]['Constante']['valeur'];
                } elseif ($age >= 14 && $age <= 18) {
                    $obSel = $con[3]['Constante']['valeur'];
                } elseif ($age >= 19 && $age <= 50) {
                    $obSel = $con[4]['Constante']['valeur'];
                } elseif ($age > 50) {
                    $obSel = $con[9]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 0 && $moisgrossesse <= 3) {
                    $obSel = $con[5]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
                    $obSel = $con[6]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                    $obSel = $con[7]['Constante']['valeur'];
                } if ($allaitement) {
                    $obSel = $con[8]['Constante']['valeur'];
                }

                /* Mise en forme */
                $obPro = intval($obPro);
                $obLip = intval($obLip);
                $obFib = intval($obFib);
                $obSel = intval($obSel);

                $this->set('obPro', $obPro);
                $this->set('obLip', $obLip);
                $this->set('obFib', $obFib);
                $this->set('obSel', $obSel);
                $this->set('poids', $obPoi);
                if (!empty($objectif['proteines'])) {
                    /* Modification protéines */
                    $this->set('modif', 1);
                    $this->set('obPro', $obPro);
                    $this->set('fixPro', $objectif['proteines']);
                } elseif (!empty($objectif['lipides'])) {
                    /* Modification lipides */
                    $this->set('modif', 2);
                    $this->set('obLip', $obLip);
                    $this->set('obEnKcal', $obEnKcal);
                    $this->set('fixLip', $objectif['lipides']);
                } elseif (!empty($objectif['fibres'])) {
                    /* Modification fibres */
                    $this->set('modif', 3);
                    $this->set('obFib', $obFib);
                    $this->set('fixFib', $objectif['fibres']);
                } elseif (!empty($objectif['sel'])) {
                    /* Modification sel */
                    $this->set('modif', 4);
                    $this->set('obSel', $obSel);
                    $this->set('fixSel', $objectif['sel']);
                }
            }
        }
    }

    public function deleteObjectif($id1 = null, $id2 = null) {
        if (AuthComponent::user('role') == 'dieteticien') {
            if ($this->request->is('post')) {
                $this->Constsuivialimentaire->id = $id1;
                if ($this->Constsuivialimentaire->delete()) {
                    $this->Session->setFlash("Objectif supprimé", "messageBon");
                    $this->redirect(array('action' => 'suivis'));
                } else {
                    $this->Session->setFlash("L'objectif n'a pas été supprimé. Merci de réessayer.", "messageErr");
                    $this->redirect(array('action' => 'deleteObjectif/' . $id1 . '/' . $id2));
                }
            }
            /* vérif id2 qui est l'id du client */
            $dietid = AuthComponent::user('id');
            $ok1 = false;
            $rech = $this->Demande->findAllByclientid($id2);
            foreach ($rech as $r) {
                if ($r['Demande']['dieteticienid'] == $dietid) {
                    $ok1 = true;
                }
            }
            /* verif id1 qui est l'id de l'objectif du client à supprimer */
            if ($ok1) {
                $ok2 = false;
                $user = $this->User->find('first', array('conditions' => array('id' => $id2)));
                $objectif;
                foreach ($user['Constsuivialimentaire'] as $obj) {
                    if ($obj['id'] == $id1) {
                        $ok2 = true;
                        $objectif = $obj;
                        break;
                    }
                }
            }
            /* résultat */
            if (!$ok1 OR ! $ok2) {
                $ok = false;
                $this->set('affichage', false);
            } else {
                $ok = true;
                $this->set('affichage', true);
            }

            if ($ok) {
                $this->set('objectif', $objectif);
            }
        } else {
            $this->Session->setFlash("Vous n'êtes pas autoriser à acceder à cette ressource.", 'messageAvert');
            $this->redirect(['controller' => 'users',
                'action' => 'login',
                'full_base' => true]);
        }
    }

    public function addObjectif($id1 = null, $id2 = null) {
        if (AuthComponent::user('role') == 'dieteticien') {
            if ($this->request->is('post')) {
                $this->Constsuivialimentaire->create();
                $user = $this->User->find('first', array('conditions' => array('id' => $id2)));
                $this->Constsuivialimentaire->set('user_id', $user['User']['id']);
                $this->Constsuivialimentaire->set('responsable_id', AuthComponent::user('id'));
                if (isset($_POST['apport1'])) {
                    /* PROTEINES */
                    $this->Constsuivialimentaire->set('proteines', $_POST['apport1']);
                    if ($this->Constsuivialimentaire->save()) {
                        $this->Session->setFlash("Votre objectif à bien été enregistré", "messageBon");
                        return $this->redirect(array('action' => 'suivis'));
                    } else {
                        $this->Session->setFlash("Erreur lors de l'enregistrement de votre objectif, veuillez réessayer", "messageErr");
                        $this->redirect(array('action' => 'addObjectif/' . $id1 . '/' . $id2));
                    }
                } elseif (isset($_POST['apport2'])) {
                    /* Lipides */
                    $this->Constsuivialimentaire->set('lipides', $_POST['apport2']);
                    if ($this->Constsuivialimentaire->save()) {
                        $this->Session->setFlash("Votre objectif à bien été enregistré", "messageBon");
                        return $this->redirect(array('action' => 'suivis'));
                    } else {
                        $this->Session->setFlash("Erreur lors de l'enregistrement de votre objectif, veuillez réessayer", "messageErr");
                        $this->redirect(array('action' => 'addObjectif/' . $id1 . '/' . $id2));
                    }
                } elseif (isset($_POST['apport3'])) {
                    /* fibres */
                    $apport = $_POST['apport3'];
                    /* verif */
                    if (!(preg_match("`^[0-9]{1,2}$`", $apport) AND $apport > 0 AND $apport <= 100)) {
                        $fin = true;
                        $message = "Avertissement, la quantitée est invalide";
                    } else {
                        $fin = false;
                    }
                    if ($fin) {
                        $this->Session->setFlash($message, "messageAvert");
                        $this->redirect(array('action' => 'addObjectif/' . $id1 . '/' . $id2));
                    } else {
                        $this->Constsuivialimentaire->set('fibres', $apport);
                        if ($this->Constsuivialimentaire->save()) {
                            $this->Session->setFlash("Votre objectif à bien été enregistré", "messageBon");
                            return $this->redirect(array('action' => 'suivis'));
                        } else {
                            $this->Session->setFlash("Erreur lors de l'enregistrement de votre objectif, veuillez réessayer", "messageErr");
                            $this->redirect(array('action' => 'addObjectif/' . $id1 . '/' . $id2));
                        }
                    }
                } elseif (isset($_POST['apport4'])) {
                    /* sel */
                    $apport = $_POST['apport4'];
                    /* verif */
                    if (!(preg_match("`^[0-9]{1,4}$`", $apport) AND $apport > 0 AND $apport <= 10000)) {
                        $fin = true;
                        $message = "Avertissement, la quantitée est invalide";
                    } else {
                        $fin = false;
                    }
                    if ($fin) {
                        $this->Session->setFlash($message, "messageAvert");
                        $this->redirect(array('action' => 'addObjectif/' . $id1 . '/' . $id2));
                    } else {
                        $this->Constsuivialimentaire->set('sel', $apport);
                        if ($this->Constsuivialimentaire->save()) {
                            $this->Session->setFlash("Votre objectif à bien été enregistré", "messageBon");
                            return $this->redirect(array('action' => 'suivis'));
                        } else {
                            $this->Session->setFlash("Erreur lors de l'enregistrement de votre objectif, veuillez réessayer", "messageErr");
                            $this->redirect(array('action' => 'addObjectif/' . $id1 . '/' . $id2));
                        }
                    }
                }
            }
            /* vérif id2 qui est l'id du client */
            $dietid = AuthComponent::user('id');
            $ok1 = false;
            $rech = $this->Demande->findAllByclientid($id2);
            foreach ($rech as $r) {
                if ($r['Demande']['dieteticienid'] == $dietid) {
                    $ok1 = true;
                }
            }

            /* résultat */
            if (!$ok1) {
                $ok = false;
                $this->set('affichage', false);
            } else {
                $ok = true;
                $this->set('affichage', true);
            }
            if ($id1 <= 0 OR $id1 > 4) {
                $ok = false;
                $this->set('affichage', false);
            }
            if ($ok) {
                $client = $this->User->find('first', array('conditions' => array('id' => $id2)));
                /* Infos */
                $naiss = $client['User']['datenaissance'];
                $age = $this->Suivialimentaire->query("SELECT TIMESTAMPDIFF(YEAR,'" . $naiss . "', NOW()) as age;");
                $age = $age[0][0]['age'];
                if ($age == 0 || $age == 1 || $age == 2) {
                    $mois = $this->Suivialimentaire->query("SELECT TIMESTAMPDIFF(MONTH,'" . $naiss . "', NOW()) as age;");
                    $mois = $mois[0][0]['age'];
                }
                $grossesse = $client['User']['enceinte'] == "O" ? true : false;
                $allaitement = $client['User']['allaitante'] == "O" ? true : false;
                if ($grossesse) {
                    $moisgrossesse = $client['User']['nbmoisenceinte'];
                }
                if ($allaitement) {
                    $moisallaitement = $client['User']['nbmoisallaitement'];
                }
                $obPoi = $client['User']['poids'];
                $activite = $client['User']['activite'];
                $sexe = $client['User']['sexe'];
                $ca;
                $taille = $client['User']['taille'] / 100.00;

                /* Calcul du CA */
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

                /* Objectif cal */
                /* Nourrissons et jeunes enfants */
                if (isset($mois) && $mois >= 0 && $mois <= 3) {
                    $obEnKcal = (89 * $obPoi - 100) + 175;
                } elseif (isset($mois) && $mois >= 4 && $mois <= 6) {
                    $obEnKcal = (89 * $obPoi - 100) + 56;
                } elseif (isset($mois) && $mois >= 7 && $mois <= 12) {
                    $obEnKcal = (89 * $obPoi - 100) + 22;
                } elseif (isset($mois) && $mois >= 13 && $mois <= 34) {
                    $obEnKcal = (89 * $obPoi - 100) + 20;
                } /* Enfants et adolescents de 3 à 18 ans */ elseif ($age >= 3 && $age <= 8 && $sexe == "homme") {
                    $obEnKcal = 88.5 - (61.9 * $age) + $ca * ((26.7 * $obPoi) + (903 * $taille)) + 20;
                } elseif ($age >= 9 && $age <= 18 && $sexe == "homme") {
                    $obEnKcal = 88.5 - (61.9 * $age) + $ca * ((26.7 * $obPoi) + (903 * $taille)) + 25;
                } elseif ($age >= 3 && $age <= 8 && $sexe == "femme") {
                    $obEnKcal = 135.3 - (30.8 * $age) + $ca * ((10.0 * $obPoi) + (934 * $taille)) + 20;
                } elseif ($age >= 9 && $age <= 18 && $sexe == "femme") {
                    $obEnKcal = 135.3 - (30.8 * $age) + $ca * ((10.0 * $obPoi) + (934 * $taille)) + 25;
                } /* Adultes de 19 ans et plus */ elseif ($age >= 19 && $sexe == "homme") {
                    $obEnKcal = 662 - (9.53 * $age) + $ca * ((15.91 * $obPoi) + (539.6 * $taille));
                } elseif ($age >= 19 && $sexe == "femme") {
                    $obEnKcal = 354 - (9.91 * $age) + $ca * ((9.36 * $obPoi) + (726 * $taille));
                } /* Grossesse */
                if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
                    $obEnKcal = $obEnKcal + 340;
                } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                    $obEnKcal = $obEnKcal + 452;
                } /* Allaitement */
                if ($allaitement && $moisallaitement >= 0 && $moisallaitement <= 6) {
                    $obEnKcal = $obEnKcal + 500 - 170;
                } if ($allaitement && $moisallaitement >= 7 && $moisallaitement <= 12) {
                    $obEnKcal = $obEnKcal + 400;
                }

                /* Objectif defaut protéines */
                $con = $this->Constante->findAllBycategorie(2);
                if ($age < 2) {
                    $obPro = 0;
                } elseif ($age >= 2 && $age < 4) {
                    $obPro = $obPoi * $con[0]['Constante']['valeur'];
                } elseif ($age >= 4 && $age < 8) {
                    $obPro = $obPoi * $con[1]['Constante']['valeur'];
                } elseif ($age >= 8 && $age < 13) {
                    $obPro = $obPoi * $con[2]['Constante']['valeur'];
                } elseif ($age >= 14 && $age <= 18) {
                    $obPro = $obPoi * $con[3]['Constante']['valeur'];
                } elseif ($age >= 19 && $age <= 50) {
                    $obPro = $obPoi * $con[4]['Constante']['valeur'];
                } elseif ($age > 50) {
                    $obPro = $obPoi * $con[9]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 0 && $moisgrossesse <= 3) {
                    $obPro = $obPoi * $con[5]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
                    $obPro = $obPoi * $con[6]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                    $obPro = $obPoi * $con[7]['Constante']['valeur'];
                } if ($allaitement) {
                    $obPro = $obPoi * $con[8]['Constante']['valeur'];
                }

                /* Objectif defaut lipides */
                $obLip = ($obEnKcal * 35 / 100) / 9;

                /* Objectif defaut fibres */
                $con = $this->Constante->findAllBycategorie(1);
                if ($age < 2) {
                    $obFib = 0;
                } elseif ($age >= 2 && $age < 4) {
                    $obFib = $con[0]['Constante']['valeur'];
                } elseif ($age >= 4 && $age <= 8) {
                    $obFib = $con[1]['Constante']['valeur'];
                } elseif ($age >= 9 && $age <= 13 && $sexe == "homme") {
                    $obFib = $con[2]['Constante']['valeur'];
                } elseif ($age >= 9 && $age <= 13 && $sexe == "femme") {
                    $obFib = $con[3]['Constante']['valeur'];
                } elseif ($age >= 14 && $age <= 18 && $sexe == "homme") {
                    $obFib = $con[4]['Constante']['valeur'];
                } elseif ($age >= 14 && $age <= 18 && $sexe == "femme") {
                    $obFib = $con[5]['Constante']['valeur'];
                } elseif ($age >= 19 && $age <= 50 && $sexe == "homme") {
                    $obFib = $con[6]['Constante']['valeur'];
                } elseif ($age >= 19 && $age <= 50 && $sexe == "femme") {
                    $obFib = $con[7]['Constante']['valeur'];
                } elseif ($age > 50 && $sexe == "homme") {
                    $obFib = $con[10]['Constante']['valeur'];
                } elseif ($age > 50 && $sexe == "femme") {
                    $obFib = $con[11]['Constante']['valeur'];
                } if ($grossesse) {
                    $obFib = $con[8]['Constante']['valeur'];
                } if ($allaitement) {
                    $obFib = $con[9]['Constante']['valeur'];
                }

                /* Objectif defaut sel */
                $con = $this->Constante->findAllBycategorie(4);
                if ($age < 2) {
                    $obSel = 0;
                } elseif ($age >= 2 && $age < 4) {
                    $obSel = $con[0]['Constante']['valeur'];
                } elseif ($age >= 4 && $age < 9) {
                    $obSel = $con[1]['Constante']['valeur'];
                } elseif ($age >= 9 && $age < 13) {
                    $obSel = $con[2]['Constante']['valeur'];
                } elseif ($age >= 14 && $age <= 18) {
                    $obSel = $con[3]['Constante']['valeur'];
                } elseif ($age >= 19 && $age <= 50) {
                    $obSel = $con[4]['Constante']['valeur'];
                } elseif ($age > 50) {
                    $obSel = $con[9]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 0 && $moisgrossesse <= 3) {
                    $obSel = $con[5]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 3 && $moisgrossesse <= 6) {
                    $obSel = $con[6]['Constante']['valeur'];
                } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                    $obSel = $con[7]['Constante']['valeur'];
                } if ($allaitement) {
                    $obSel = $con[8]['Constante']['valeur'];
                }

                /* Mise en forme */
                $obPro = intval($obPro);
                $obLip = intval($obLip);
                $obFib = intval($obFib);
                $obSel = intval($obSel);

                $this->set('obPro', $obPro);
                $this->set('obLip', $obLip);
                $this->set('obFib', $obFib);
                $this->set('obSel', $obSel);
                $this->set('poids', $obPoi);
                if ($id1 == 1) {
                    /* Modification protéines */
                    $this->set('modif', 1);
                    $this->set('obPro', $obPro);
                } elseif ($id1 == 2) {
                    /* Modification lipides */
                    $this->set('modif', 2);
                    $this->set('obLip', $obLip);
                    $this->set('obEnKcal', $obEnKcal);
                } elseif ($id1 == 3) {
                    /* Modification fibres */
                    $this->set('modif', 3);
                    $this->set('obFib', $obFib);
                } elseif ($id1 == 4) {
                    /* Modification sel */
                    $this->set('modif', 4);
                    $this->set('obSel', $obSel);
                }
            }
        }
    }

}
