<?php
class UsersController extends AppController {

    public $uses = array('Imcenfant', 'User');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'login'); // Letting users register themselves
        $this->set('page_cours', 'violet');
    }

    //Permet à l'utilisateur de se connecter en cliquant sur le bouton "me connecter" situé en haut à droite de chaque page
    public function login() {
        if (($id = AuthComponent::user('id')) == NULL) {
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    $this->redirect($this->Auth->redirect());
                    if (AuthComponent::user('role') == "administrateur") {
                        // On ajoute cette variable de session pour permettre à un admin
                        // d'utiliser l'upload de photo à travers CKEditor
                        $_SESSION['KCEDITOR']['disabled'] = false;
                    }
                } else {
                    $this->Session->setFlash("Nom d'utilisateur ou mot de passe incorrect(s). Réessayez.", 'messageAvert');
                }
            }
        } else {
            $this->Session->setFlash("Vous êtes déjà connecté.", 'messageAvert');
            $this->redirect(['controller' => 'pages',
                'action' => 'home',
                'full_base' => true]);
        }
    }

    //Permet à l'utilisateur de se déconnecter en cliquant sur le bouton "me déconnecter" situé en haut à droite de chaque page une fois que l'utilisateur
    //s'est authentifié
    public function logout() {
        if (AuthComponent::user('role') == "administrateur") {
            unset($_SESSION['KCEDITOR']['disabled']);
        }
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        if (AuthComponent::user('role') == 'administrateur') {

            $this->set('users', $this->User->find('all'));
        } elseif (AuthComponent::user('id') != null) {
            $users = $this->User->find('all', array('conditions' => array('id' => AuthComponent::user('id'))));
            $this->set('users', $users);
            if ($users[0]['User']['fils'] != null) {
                /* utilisateur a des fils */
                $filss = explode(";", $users[0]['User']['fils']);
                $fils = array();
                $i = 0;
                foreach ($filss as $f) {
                    $fils[$i]['username'] = $f;
                    $temp = $this->User->find('first', array('conditions' => array('username' => $f)));
                    $fils[$i]['id'] = $temp['User']['id'];
                    $i++;
                }
                $this->set('fils', $fils);
            }
        }
    }

    public function information($id = null) {
        if ($this->request->is('post')) {
            $sexe = $_POST['sexe'];
            $taille = $_POST['taille'];
            $poids = $_POST['poids'];
            $email = $_POST['email'];
            $activite = $_POST['activite'];
            $fin = false;
            /* verif post */
            /* verif taille */
            if (!(preg_match("`^[0-9]{1,3}$`", $taille) AND $taille > 0 AND $taille <= 250)) {
                $fin = true;
                $message = "Erreur, la taille est invalide";
            }
            /* verif poids */
            if (!(preg_match("^[0-9]{1,3}$^", $poids) AND $poids > 0 AND $poids <= 300)) {
                $fin = true;
                $message = "Erreur, le poids est invalide";
            }
            /* vérif email */
            if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) {
                $fin = true;
                $message = "Erreur, le format de l'adresse email est invalide";
            }
            /* fin verif */
            if (!$fin) {
                $this->User->updateAll(array('User.sexe' => '"' . $sexe . '"'), array('User.id' => $id));
                $this->User->updateAll(array('User.taille' => '"' . $taille . '"'), array('User.id' => $id));
                $this->User->updateAll(array('User.poids' => '"' . $poids . '"'), array('User.id' => $id));
                $this->User->updateAll(array('User.email' => '"' . $email . '"'), array('User.id' => $id));
                $this->User->updateAll(array('User.activite' => '"' . $activite . '"'), array('User.id' => $id));
                $this->Session->setFlash(__("Le compte de votre enfant a bien été modifié"), 'messageBon');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__($message), 'messageAvert');
            }
        }
        $enfant = $this->User->find('first', array('conditions' => array('id' => $id)));
        $user = $this->User->find('first', array('conditions' => array('id' => AuthComponent::user('id'))));
        $this->set('affiche', true);
        if (empty($enfant)) {
            $this->Session->setFlash('Utilisateur invalide', 'messageAvert');
            $this->set('affiche', false);
        } else {
            $age = $this->User->query("SELECT TIMESTAMPDIFF(YEAR,'" . $enfant['User']['datenaissance'] . "', NOW()) as age;");
            $age = $age[0][0]['age'];
            if ($enfant['User']['parent'] != $user['User']['username']) {
                $this->Session->setFlash('Utilisateur invalide', 'messageAvert');
                $this->set('affiche', false);
            } else {
                $this->set('enfant', $enfant);

                $this->set('age', $age);
            }
        }
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur invalide'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    //Permet à l'tuilisateur de créer son profil en cliquant sur "créer mon profil" situé en haut à droite de chaque page 
    public function add() {
                    $fin = false;
        /* Calcul de l'imc */

        function imc($age, $poids, $taille, $sexe, $AP, $imcenfants) {
            $imc = ($poids / ($taille * $taille)) * 10000;
            //Si l'utilisateur est un enfant (age <=18)
            if ($age < 18) {
                if ($imc < 11 OR $imc > 32) {

                    $this->Session->setFlash(__('Votre IMC ne peut pas être affiché dans le graphe'), 'messageAvert');
                }

                //Que l'enfant soit un garçon & une fille, on recherche dans la bdd le poids minimal et le poids maximal correspondant à son âge et à son sexe
                if ($sexe == 'homme') {
                    $imcMin = $imcenfants['Imcenfant']['ming'];
                    $imcMax = $imcenfants['Imcenfant']['maxg'];
                    $garcon = 1;
                } else {
                    $imcMin = $imcenfants['Imcenfant']['minf'];
                    $imcMax = $imcenfants['Imcenfant']['maxf'];
                    $fille = 1;
                }
                //Si l'utilisateur est un adulte, son IMC doit être compris entre 18.5 et 25 inclus
            } else {
                $imcMin = 18.5;
                $imcMax = 25;
            }

            if ($sexe == 'homme') {
                switch ($AP) {
                    case "sédentaire":
                        $AP = 1.0;
                        break;
                    case "peu actif":
                        $AP = 1.11;
                        break;
                    case "actif":
                        $AP = 1.25;
                        break;
                    case "très actif":
                        $AP = 1.48;
                }
                //Calcul des besoins énergétiques estimés pour un homme en fonction de son age et de son poids
                $BEE = round(864 - 9.72 * $age + $AP * (14.2 * $poids + 503 * $taille / 100));
            } else {
                switch ($AP) {
                    case "sédentaire":
                        $AP = 1.0;
                        break;
                    case "peu actif":
                        $AP = 1.12;
                        break;
                    case "actif":
                        $AP = 1.27;
                        break;
                    case "très actif":
                        $AP = 1.45;
                }
                //Calcul des besoins énergétiques estimés pour une femme en fonction de son age et de son poids
                $BEE = round(387 - 7.31 * $age + $AP * (10.9 * $poids + 660.7 * $taille / 100));
            }

            $res = array('imc' => $imc, 'imcMin' => $imcMin, 'imcMax' => $imcMax, 'BEE' => $BEE);
            return $res;
        }

        if (($id = AuthComponent::user('id')) == NULL) {
            if ($this->request->is('post')) {

                /* Vérification des variables post */
                $this->request->data['User']['email'] = $_POST['data']['User']['email'];
                if (!(strlen($_POST['data']['User']['username']) >= 5 AND strlen($_POST['data']['User']['username']) < 20)) {
                    $fin = true;
                    $message = "Erreur, le pseudo doit faire entre 5 et 20 caractères";
                }


                if ($_POST['data']['User']['email'] != null) {
                    $this->set('email', $_POST['data']['User']['parent']);
                    /* Traitement du père de l'enfant */
                    $parent = $this->User->find('first', array('conditions' => array('email' => $_POST['data']['User']['email'])));
                    if (!empty($parent)) {
                        $message = "Attention, l'adresse email est déja utilisée, veuillez la changer.";
                        $fin = true;
                    }
                }


                /* date nais */
                setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                $date = date('Y-m-d');
                if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST['data']['User']['datenaissance']))) {
                    $fin = true;
                    $message = "Erreur, la date de naissance est invalide, elle doit être sous format 'YYYY-MM-DD'";
                } else {
                    if ($_POST['data']['User']['datenaissance'] > $date) {
                        $fin = true;
                        $message = "Erreur, la date de naissance ne peut être supérieure à la date d'aujourd'hui";
                    }
                    $age = $this->User->query("SELECT TIMESTAMPDIFF(YEAR,'" . $_POST['data']['User']['datenaissance'] . "', NOW()) as age;");
                    $age = $age[0][0]['age'];
                    $this->set('age', $age);
                    if ($age >= 0 AND $age < 18 AND ! $fin) {
                        /* inscription impossible si le javascript n'est pas activé */
                        if ($age <= 3) {
                            $fin = true;
                            $message = "Attention, vous avez moins de 2 ans vous ne pouvez donc pas vous inscrire";
                        }
                        if (!(isset($_POST['data']['User']['parent']) AND $_POST['data']['User']['parent'] != null)) {
                            $fin = true;
                            $message = "Attention, vous êtes mineur, vous ne pouvez pas vous inscrire si vous n'avez pas de compte parental";
                        }
                    }
                }

                /* vérif nb de mois */
                if ($_POST['data']['User']['nbmoisenceinte'] != null) {
                    if (!(preg_match("`^[0-9]{1}$`", $_POST['data']['User']['nbmoisenceinte']) AND $_POST['data']['User']['nbmoisenceinte'] >= 0 AND $_POST['data']['User']['nbmoisenceinte'] <= 9)) {
                        $fin = true;
                        $message = "Erreur, Le nombre de mois dont vous êtes enceinte est invalide";
                    }
                }
                if ($_POST['data']['User']['nbmoisallaitante'] != null) {
                    if (!(preg_match("`^[0-9]{1,3}$`", $_POST['data']['User']['nbmoisallaitante']) AND $_POST['data']['User']['nbmoisallaitante'] >= 0 )) {
                        $fin = true;
                        $message = "Erreur, Le nombre de mois dont vous êtes allaitante est invalide";
                    }
                }

                /* verif taille */
                if (!(preg_match("`^[0-9]{1,3}$`", $_POST['data']['User']['taille']) AND $_POST['data']['User']['taille'] > 0 AND $_POST['data']['User']['taille'] <= 250)) {
                    $fin = true;
                    $message = "Erreur, la taille est invalide";
                }
                /* verif poids */
                if (!(preg_match("^[0-9]{1,3}$^", $_POST['data']['User']['poids']) AND $_POST['data']['User']['poids'] > 0 AND $_POST['data']['User']['poids'] <= 300)) {
                    $fin = true;
                    $message = "Erreur, le poids est invalide";
                }

                /* verif mot de passe */
                if (!(strlen($_POST['data']['User']['password']) >= 7 AND $_POST['data']['User']['password'] == $_POST['data']['User']['passwordconfirmation'])) {
                    $fin = true;
                    $message = "Erreur, les mots de passe ne correspondent pas et/ou le mot de passe doit faire plus de 7 caractères";
                }

                /* vérif email */
                if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $_POST['data']['User']['email'])) {
                    $fin = true;
                    $message = "Erreur, le format de l'adresse email est invalide";
                }
                /* vérif sexe */
                if ($_POST['data']['User']['sexe'] == null) {
                    $fin = true;
                    $message = "Erreur, Vous devez choisir un sexe pour vous inscrire";
                }
                /* fin verif */

                if ($fin) {
                    // MODIFIER LE MESSAGE D'ERREUR 
                    $this->Session->setFlash(__($message), 'messageAvert');
                    return;
                }
                    $this->set('username', $_POST['data']['User']['username']);
                    $this->set('datenaissance', $_POST['data']['User']['datenaissance']);
                    $this->set('taille', $_POST['data']['User']['taille']);
                    $this->set('poids', $_POST['data']['User']['poids']);
                    $this->set('nom', $_POST['data']['User']['nom']);
                    $this->set('prenom', $_POST['data']['User']['prenom']);
                    $this->set('email', $_POST['data']['User']['email']);
                    $this->set('sexe', $_POST['data']['User']['sexe']);
                    $imcenfants = $this->Imcenfant->find('first', array('conditions' => array('Imcenfant.id' => $age)));
                    $imc = imc($age, $_POST['data']['User']['poids'], $_POST['data']['User']['taille'], $_POST['data']['User']['sexe'], $_POST['data']['User']['activite'], $imcenfants);
                    $this->set('valeurimc', $imc["imc"]);
                    $this->set('valeurimcmin', $imc["imcMin"]);
                    $this->set('valeurimcmax', $imc["imcMin"]);
                    $this->set('valeurbee', $imc["BEE"]);

                    if (isset($_POST['data']['User']['enceinte']) && $_POST['data']['User']['enceinte'] != null) {
                        $this->set('enceinte', $_POST['data']['User']['enceinte']);
                    } else {
                        $this->set('enceinte', 'N');
                        $this->request->data['User']['enceinte'] = 'N';
                    }
                    if (isset($_POST['data']['User']['allaitante']) && $_POST['data']['User']['allaitante'] != null) {
                        $this->set('allaitante', $_POST['data']['User']['allaitante']);
                    } else {
                        $this->set('allaitante', 'N');
                        $this->request->data['User']['allaitante'] = 'N';
                    }
                    if (isset($_POST['data']['User']['activite']) && $_POST['data']['User']['activite'] != null) {
                        $this->set('activite', $_POST['data']['User']['activite']);
                    }
                    if ($_POST['data']['User']['nbmoisenceinte'] != null) {
                        $this->set('nbmoisenceinte', $_POST['data']['User']['nbmoisenceinte']);
                    } else {
                        unset($_POST['data']['User']['nbmoisenceinte']);
                    }
                    if ($_POST['data']['User']['nbmoisallaitante'] != null) {
                        $this->set('nbmoisallaitante', $_POST['data']['User']['nbmoisallaitante']);
                    } else {
                        unset($_POST['data']['User']['nbmoisallaitante']);
                    }
                    if ($_POST['data']['User']['parent'] != null) {
                        $this->set('parent', $_POST['data']['User']['parent']);
                        /* Traitement du père de l'enfant */
                        $parent = $this->User->find('first', array('conditions' => array('username' => $_POST['data']['User']['parent'])));
                        $ageParent = 0;
                        if (empty($parent)) {
                            $this->Session->setFlash("Le nom de compte de votre parent n'existe pas, veuillez réessayer...", 'messageAvert');
                            $fin = true;
                        } else {
                            $ageParent = $this->User->query("SELECT TIMESTAMPDIFF(YEAR,'" . $parent['User']['datenaissance'] . "', NOW()) as age;");
                            $ageParent = $ageParent[0][0]['age'];
                            if ($ageParent < 18) {
                                $this->Session->setFlash("Votre parent est trop jeune pour être votre responsable", 'messageAvert');
                                $fin = true;
                            }
                        }
                    } else {
                        unset($_POST['data']['User']['parent']);
                    }
         
                if ($fin) {
                return;
                }
                    $pseudoExiste = $this->User->find('first', array('conditions' => array('username' => $this->request->data['User']['username'])));
                    if (empty($pseudoExiste)) {
                        $this->request->data['User']['role'] = 'utilisateur';
                        unset($_POST['data']['User']['passwordconfirmation']);

                        /* Calcul de l'imc */
                        $imcenfants = $this->Imcenfant->find('first', array('conditions' => array('Imcenfant.id' => $age)));
                        $imc = imc($age, $_POST['data']['User']['poids'], $_POST['data']['User']['taille'], $_POST['data']['User']['sexe'], $_POST['data']['User']['activite'], $imcenfants);
                        $this->set('imc', $imc["imc"]);
                        $this->set('bee', $imc["BEE"]);

                        $this->User->create();
                        if ($this->User->save($this->request->data)) {

                            $ido = $this->User->id;
                            // initialisation de l'activation ou non des paramètres pour le tableau de bord dans la bd
                            $typeDonnee = $this->User->query("SELECT * FROM typedonneesmed");

                            // Ajout des données du formulaire dans la BD 
                            for ($i = 0; $i < count($typeDonnee); $i++) {

                                $this->User->query("INSERT INTO paramactive VALUES('', '" . $ido . "','" . $i . "','1', '" . date("Y-m-d H:i:s") . "')");
                            }

                            if (isset($parent)  && count($parent) > 0) {
                                /* Ajout d'un fils suplémentaire au père */
                                $enfants = $parent['User']['fils'];
                                if ($enfants == null) {
                                    // pas encore de fils
                                    if ($this->User->updateAll(array('User.fils' => '"' . $_POST['data']['User']['username'] . '"'), array('User.id' => $parent['User']['id']))) {
                                        /* ok */
                                        // MODIFIER LE MESSAGE D'ERREUR 
                                        $this->Session->setFlash("Le compte a été créé. Vous pouvez maintenant vous connecter.", 'messageBon');
                                    } else {
                                        /* Ne doit pas se produire */
                                        $this->Session->setFlash("Votre compte a été créé mais vous ne pouvez pas être lié avec votre parent. Vous pouvez maintenant vous connecter.", 'messageAvert');
  
                                    }
                                } else {
                                    // déjà au moins un fils
                                    $aenfants = $enfants . ";" . $_POST['data']['User']['username'];
                                    if ($this->User->updateAll(array('User.fils' => '"' . $aenfants . '"'), array('User.id' => $parent['User']['id']))) {
                                        /* ok */
                                        $this->Session->setFlash("Le compte a été créé. Vous pouvez maintenant vous connecter.", 'messageBon');
                                        $this->set('aenfants', $aenfants);
                                        $this->set('enfants', $enfants);
                                    } else {
                                        /* Ne doit pas se produire */
                                        $this->Session->setFlash("Votre compte a été créé mais vous ne pouvez pas être lié avec votre parent. Vous pouvez maintenant vous connecter.", 'messageAvert');
                                    }
                               }
  

                            } else {
                                $this->Session->setFlash("Le compte a été créé. Vous pouvez maintenant vous connecter.", 'messageBon');
                            }
                        } else {
                            $this->Session->setFlash("Erreur lors de la creation du compte. Merci de réessayer.", 'messageAvert');
                        }
                    } else {
                        $this->Session->setFlash("Le nom d'utilisateur existe déjà, veuillez en choisir un autre", 'messageErr');
                    }
            } else {
                $this->set('username', null);
                $this->set('datenaissance', null);
                $this->set('taille', null);
                $this->set('poids', null);
                $this->set('email', null);
                $this->set('nom', null);
                $this->set('prenom', null);
                $this->set('sexe', null);
                $this->set('enceinte', null);
                $this->set('allaitante', null);
                $this->set('activite', null);
                $this->set('nbmoisenceinte', null);
                $this->set('nbmoisallaitante', null);
                $this->set('parent', null);

            }
        } else {
            $this->Session->setFlash("Vous êtes déjà connecté.", 'messageAvert');
            $this->redirect(['controller' => 'pages',
                'action' => 'home',
                'full_base' => true]);
        }
    }

    //Permet de modfier le profil d'un utilisateur
    public function edit($id = null) {

        if (AuthComponent::user('role') != 'administrateur') {
            $id = AuthComponent::user('id');
        }

        $this->User->id = $id;

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur invalide'));
        }

        $user = $this->User->find('first', array('conditions' => array('id' => $id)));
        $this->set('username', $user['User']['username']);
        $this->set('datenaissance', $user['User']['datenaissance']);
        $this->set('taille', $user['User']['taille']);
        $this->set('poids', $user['User']['poids']);
        $this->set('nom', $user['data']['User']['nom']);
        $this->set('prenom', $user['data']['User']['prenom']);
        $this->set('email', $user['User']['email']);
        $this->set('sexe', $user['User']['sexe']);
        $this->set('enceinte', $user['User']['enceinte']);
        $this->set('allaitante', $user['User']['allaitante']);
        $this->set('activite', $user['User']['activite']);
        $this->set('fils', $user['User']['fils']);
        $this->set('parent', $user['User']['parent']);
        $age = $this->User->query("SELECT TIMESTAMPDIFF(YEAR,'" . $user['User']['datenaissance'] . "', NOW()) as age;");
        $age = $age[0][0]['age'];
        $this->set('age', $age);

        if ($this->request->is('post') || $this->request->is('put')) {
            /* Vérification des variables post */
            $fin = false;
            if (!isset($_POST['data']['User']['datenaissance'])) {
                $_POST['data']['User']['datenaissance'] = $user['User']['datenaissance'];
            }
            /* date nais */
            setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
            $date = date('Y-m-d');
            if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST['data']['User']['datenaissance']))) {
                $fin = true;
                $message = "Erreur, la date de naissance est invalide, elle doit être sous format 'YYYY-MM-DD'";
            } else {
                if ($_POST['data']['User']['datenaissance'] > $date) {
                    $fin = true;
                    $message = "Erreur, la date de naissance ne peut être supérieure à la date d'aujourd'hui";
                }
                $age = $this->User->query("SELECT TIMESTAMPDIFF(YEAR,'" . $_POST['data']['User']['datenaissance'] . "', NOW()) as age;");
                $age = $age[0][0]['age'];
                $ageactu = $this->User->query("SELECT TIMESTAMPDIFF(YEAR,'" . $user['User']['datenaissance'] . "', NOW()) as age;");
                $ageactu = $ageactu[0][0]['age'];
                if ($ageactu >= 18 AND $age >= 0 AND $age < 18 AND ! $fin) {
                    $fin = true;
                    $message = "Vous ne pouvez pas référencer une date de naissance inférieure à 18 ans";
                } elseif ($age >= 18) {
                    if ($user['User']['activite'] == null) {
                        $this->User->set('activite', 'sédentaire');
                    }
                }
            }

            /* vérif nb de mois */
            if ($_POST['data']['User']['nbmoisenceinte'] != null) {
                if (!(preg_match("`^[0-9]{1}$`", $_POST['data']['User']['nbmoisenceinte']) AND $_POST['data']['User']['nbmoisenceinte'] >= 0 AND $_POST['data']['User']['nbmoisenceinte'] <= 9)) {
                    $fin = true;
                    $message = "Erreur, Le nombre de mois dont vous êtes enceinte est invalide";
                }
            }
            if ($_POST['data']['User']['nbmoisallaitante'] != null) {
                if (!(preg_match("`^[0-9]{1,3}$`", $_POST['data']['User']['nbmoisallaitante']) AND $_POST['data']['User']['nbmoisallaitante'] >= 0 )) {
                    $fin = true;
                    $message = "Erreur, Le nombre de mois dont vous êtes allaitante est invalide";
                }
            }

            /* verif taille */
            if (!(preg_match("`^[0-9]{1,3}$`", $_POST['data']['User']['taille']) AND $_POST['data']['User']['taille'] > 0 AND $_POST['data']['User']['taille'] <= 250)) {
                $fin = true;
                $message = "Erreur, la taille est invalide";
            }
            /* verif poids */
            if (!(preg_match("^[0-9]{1,3}$^", $_POST['data']['User']['poids']) AND $_POST['data']['User']['poids'] > 0 AND $_POST['data']['User']['poids'] <= 300)) {
                $fin = true;
                $message = "Erreur, le poids est invalide";
            }

            /* verif mot de passe */
            if (!(strlen($_POST['data']['User']['password']) >= 7 AND $_POST['data']['User']['password'] == $_POST['data']['User']['passwordconfirmation'])) {
                $fin = true;
                $message = "Erreur, les mots de passe ne correspondent pas et/ou le mot de passe doit faire plus de 7 caractères";
            }

            /* vérif email */
            if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $_POST['data']['User']['email'])) {
                $fin = true;
                $message = "Erreur, le format de l'adresse email est invalide";
            }
            /* fin verif */
            if ($fin) {
                $this->Session->setFlash(__($message), 'messageAvert');
                
            } else {
                unset($_POST['data']['User']['passwordconfirmation']);
                if ($this->User->save($this->request->data)) {
                    if (AuthComponent::user('role') == 'administrateur') {
                        $this->Session->setFlash(__("L'utilisateur a été modifié"), 'messageBon');
                    } else {
                        $this->Session->setFlash(__("Votre profil a bien été modifié"), 'messageBon');
                    }
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__("L'utilisateur n'a pas pu être modifié. Merci de réessayer."), 'messageErr');
                }
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    //Permet de supprimer le compte d'un utilisateur 
    public function delete($id = null) {
        $message = "Veuillez confirmer la suppression du compte";

        if (AuthComponent::user('role') != 'administrateur') {
            $id = AuthComponent::user('id');
            $message = "Veuillez confirmer la suppression de votre compte";
        }
        $this->Session->setFlash($message, 'messageAvert');

        $user = $this->User->find('first', array('conditions' => array('id' => $id)));
        $this->set('user', $user);

        if ($this->request->is('post')) {

            if (AuthComponent::user('role') != 'administrateur') {
                $id = AuthComponent::user('id');
            }

            $this->User->id = $id;
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Utilisateur invalide'));
            }

            $ok = true;
            if ($this->User->delete()) {
                if ($user['User']['fils'] != null) {
                    $fils = explode(";", $user['User']['fils']);
                    foreach ($fils as $fil) {
                        $enfant = $this->User->find('first', array('conditions' => array('username' => $fil)));
                        if ($this->User->updateAll(array('User.parent' => '\'"'), array('User.id' => $enfant['User']['id']))) {
                            
                        } else {
                            $ok = false;
                        }
                    }
                }
                if ($user['User']['parent'] != null) {
                    $parent = $user['User']['parent'];
                    $parent = $this->User->find('first', array('conditions' => array('username' => $parent)));
                    $aModif = explode(";", $parent['User']['fils']);
                    $res = "";
                    $compte = 0;
                    foreach ($aModif as $modif) {
                        if ($compte == 0) {
                            if ($modif != $user['User']['username']) {
                                $res = $res . $modif;
                            }
                        } else {
                            if ($modif != $user['User']['username']) {
                                $res = $res . ';' . $modif;
                            }
                        }
                        $compte++;
                    }
                    if ($this->User->updateAll(array('User.fils' => '"' . $res . '"'), array('User.id' => $parent['User']['id']))) {
                        
                    } else {
                        $ok = false;
                    }
                }
                if ($ok) {
                    $this->Session->setFlash(__('Utilisateur supprimé'), 'messageBon');
                    if (AuthComponent::user('role') != 'administrateur') {
                        $this->redirect($this->Auth->logout());
                    }
                } else {
                    $this->Session->setFlash(__("L'utilisateur n'a pas pu être supprimé. Merci de réessayer."), 'messageAvert');
                }
            } else {
                $this->Session->setFlash(__("L'utilisateur n'a pas pu être supprimé. Merci de réessayer."), 'messageAvert');
            }
            $this->redirect(array('action' => 'index'));
        }
    }
}
