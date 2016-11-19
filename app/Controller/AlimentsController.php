<?php

App::uses('AppController', 'Controller');

/**
 * Aliments Controller
 *
 * @property Aliments $Aliments
 */
class AlimentsController extends AppController {

    // Pour utiliser des modèles spécifiques
    public $uses = array('Aliment', 'Alimentsdetaille', 'Constituantaliment', 'Donneescompilee', 'Famillealiment', 'Suivialimentaire', 'User', 'Alimentfavori', 'Constante');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('page_cours', 'rouge');
        $this->Auth->allow('index');
    }

    public function index($id1 = NULL, $id2 = NULL) {
        /* Recherche des categories d'aliments qui seront présents dans la 1ere boite a liste */
        $familles = $this->Alimentsdetaille->find('all', array(
            'fields' => 'type',
            'group' => array('type')));
        $this->set('familles', $familles);
        $sous_types = $this->Alimentsdetaille->find('all', array(
            'fields' => array('sous_type', 'type'),
            'group' => array('sous_type')));
        $this->set('sous_types', $sous_types);
        $classe = $this->Alimentsdetaille->find('all', array(
            'fields' => array('classe', 'sous_type', 'type'),
            'group' => array('classe')));
        $this->set('classes', $classe);
        $sous_classe = $this->Alimentsdetaille->find('all', array(
            'fields' => array('sous_classe', 'classe', 'sous_type', 'type'),
            'group' => array('sous_classe')));
        $this->set('sous_classes', $sous_classe);
        if ($this->request->is('post')) {
            /* Ancienne recherche 
              if (!empty ($_POST['zone-aliment'])) {
              $aRechercher = $_POST['zone-aliment'];
              $resultats = $this->Aliment->find('all', array('conditions' => array('OR' => array(
              array('Aliment.nomFR LIKE' => '%'. ucfirst(strtolower($aRechercher)) .'%'),
              array('Aliment.nomFR LIKE' => '%'. strtolower($aRechercher) .'%')))));
              $this->set('resultats', $resultats);
              }
             */
            if (!empty($_POST['rechbtn'])) {
                /* Lancement recherche */
                if (!empty($_POST['rech4'])) {
                    /* Aliment contenant une sous-classe */
                    $resultats = $this->Alimentsdetaille->find('all', array('conditions' => array(
                            'AND' => array(
                                array('type' => $_POST['rech']),
                                array('sous_type' => $_POST['rech2']),
                                array('classe' => $_POST['rech3']),
                                array('sous_classe' => $_POST['rech4']))
                    )));
                    $this->set('resultats', $resultats);
                } elseif (!empty($_POST['rech3'])) {
                    /* Aliment contenant une classe */
                    $resultats = $this->Alimentsdetaille->find('all', array('conditions' => array(
                            'AND' => array(
                                array('type' => $_POST['rech']),
                                array('sous_type' => $_POST['rech2']),
                                array('classe' => $_POST['rech3']))
                    )));
                    $this->set('resultats', $resultats);
                } elseif (!empty($_POST['rech2'])) {
                    /* Aliment contenant un sous-type et un type -> obligé, classe & sous-classe sont facultatifs mais sous-type obligé */
                    $resultats = $this->Alimentsdetaille->find('all', array('conditions' => array(
                            'AND' => array(
                                array('type' => $_POST['rech']),
                                array('sous_type' => $_POST['rech2']))
                    )));
                    $this->set('resultats', $resultats);
                }
            }
            if (!empty($_POST['repas1'])) {
                /* Un repas a été ajouté, sauvegarde */
                $id = AuthComponent::user('id');
                if ($id != null) {
                    /* L'utilisateur est enregister */
                    $this->Suivialimentaire->create();
                    /* L'utilisateur à désactivé le javascript et essaye d'enregistrer un repas sans moment */
                    if (!isset($_POST['group1']) AND ! isset($_POST['group2']) AND ! isset($_POST['group3']) AND ! isset($_POST['group4'])) {
                        $this->Session->setFlash("Vous devez sélectionner un moment de repas pour pouvoir enregistrer cet aliment", "messageAvert");
                    } else {
                        /* Création du champ concernant le moment ou le repas à été éjouté */
                        $sep = '@'; /* Séparateur de la chaine, la chaine sera par exemple : "Petit déjeuner@Dîner" */
                        $res = "";
                        if (isset($_POST['group1'])) {
                            $res = $res . $_POST['group1'] . '@';
                        }
                        if (isset($_POST['group2'])) {
                            $res = $res . $_POST['group2'] . '@';
                        }
                        if (isset($_POST['group3'])) {
                            $res = $res . $_POST['group3'] . '@';
                        }
                        if (isset($_POST['group4'])) {
                            $res = $res . $_POST['group4'] . '@';
                        }
                        /* Suppression du dernier séparateur */
                        $res = substr($res, 0, strlen($res) - 1);
                        /* Séparation des valeurs des portions et des noms des portions */
                        $split = explode("@", $_POST['portion']);
                        $valPortion = $split[0];
                        $nomPortion = $split[1];
                        /* Construction requête */
                        $this->Suivialimentaire->set(array(
                            'id_user' => $id,
                            'id_aliment' => $id1,
                            'quantite' => $_POST['quantite'],
                            'portion' => $valPortion,
                            'nomPortion' => $nomPortion,
                            'nomSA' => $res));
                        if ($this->Suivialimentaire->save()) {
                            $this->Session->setFlash("L'aliment a bien été ajouté à votre repas", "messageBon");
                        } else {
                            $this->Session->setFlash("Erreur lors de l'ajout de l'aliment", 'messageErr');
                        }
                    }
                } else {
                    $this->Session->setFlash("Vous devez vous connecter pour utiliser cette fonctionnalitée", "messageAvert");
                }
            }
            if (!empty($_POST['repas2'])) {
                /* Un repas a été ajouté, sauvegarde */
                $id = AuthComponent::user('id');
                if ($id != null) {
                    /* L'utilisateur est enregister */
                    $this->Suivialimentaire->create();
                    /* L'utilisateur à désactivé le javascript et essaye d'enregistrer un repas sans moment */
                    if (!isset($_POST['group12']) AND ! isset($_POST['group22']) AND ! isset($_POST['group32']) AND ! isset($_POST['group42'])) {
                        $this->Session->setFlash("Vous devez sélectionner un moment de repas pour pouvoir enregistrer cet aliment", 'messageAvert');
                    } else {
                        /* Création du champ concernant le moment ou le repas à été éjouté */
                        $sep = '@'; /* Séparateur de la chaine, la chaine sera par exemple : "Petit déjeuner@Dîner" */
                        $res = "";
                        if (isset($_POST['group12'])) {
                            $res = $res . $_POST['group12'] . '@';
                        }
                        if (isset($_POST['group22'])) {
                            $res = $res . $_POST['group22'] . '@';
                        }
                        if (isset($_POST['group32'])) {
                            $res = $res . $_POST['group32'] . '@';
                        }
                        if (isset($_POST['group42'])) {
                            $res = $res . $_POST['group42'] . '@';
                        }
                        /* Suppression du dernier séparateur */
                        $res = substr($res, 0, strlen($res) - 1);
                        /* Séparation des valeurs des portions et des noms des portions */
                        $split = explode("@", $_POST['portion2']);
                        $valPortion = $split[0];
                        $nomPortion = $split[1];
                        /* Construction requête */
                        $this->Suivialimentaire->set(array(
                            'id_user' => $id,
                            'id_aliment' => $id2,
                            'quantite' => $_POST['quantite2'],
                            'portion' => $valPortion,
                            'nomPortion' => $nomPortion,
                            'nomSA' => $res));
                        if ($this->Suivialimentaire->save()) {
                            $this->Session->setFlash("L'aliment a bien été ajouté à votre repas", "messageBon");
                        } else {
                            $this->Session->setFlash("Erreur lors de l'ajout de l'aliment", "messageAvert");
                        }
                    }
                } else {
                    
                }
            }
            if (!empty($_POST['ajouterfav2'])) {
                /* Aliment de droite ajouté aux favoris */
                $id = AuthComponent::user('id');
                if ($id != null) {
                    $this->Alimentfavori->set(array(
                        'iduti' => $id,
                        'idali' => $id2));
                    if ($this->Alimentfavori->save()) {
                        $this->Session->setFlash("L'aliment a bien été ajouté à vos aliments favoris", 'messageBon');
                        if ($id1 == null) {
                            $this->redirect(array('action' => 'index/' . $id2));
                        } else {
                            $this->redirect(array('action' => 'index/' . $id1 . '/' . $id2));
                        }
                    } else {
                        $this->Session->setFlash("Erreur lors de l'ajout de l'aliment aux favoris", "messageErr");
                    }
                } else {
                    $this->Session->setFlash("Vous devez vous connecter pour utiliser cette fonctionnalitée", "messageAvert");
                }
            }
            if (!empty($_POST['ajouterfav1'])) {
                /* Aliment de gauche ajouté aux favoris */
                $id = AuthComponent::user('id');
                if ($id != null) {
                    $this->Alimentfavori->set(array(
                        'iduti' => $id,
                        'idali' => $id1));
                    if ($this->Alimentfavori->save()) {
                        $this->Session->setFlash("L'aliment a bien été ajouté à vos aliments favoris", "messageBon");
                        if ($id2 == null) {
                            $this->redirect(array('action' => 'index/' . $id1));
                        } else {
                            $this->redirect(array('action' => 'index/' . $id1 . '/' . $id2));
                        }
                    } else {
                        $this->Session->setFlash("Erreur lors de l'ajout de l'aliment aux favoris", "meessageErr");
                    }
                } else {
                    $this->Session->setFlash("Vous devez vous connecter pour utiliser cette fonctionnalitée", "messageAvert");
                }
            }
            if (!empty($_POST['retirerfav1'])) {
                $id = AuthComponent::user('id');
                if ($id != null) {
                    $iduti = $id;
                    $idali = $id1;
                    if ($this->Alimentfavori->deleteAll(array('Alimentfavori.iduti' => $iduti, 'Alimentfavori.idali' => $idali), false)) {
                        $this->Session->setFlash("L'aliment a bien été retiré de vos aliments favoris", "messageBon");
                        if ($id2 == null) {
                            $this->redirect(array('action' => 'index/' . $id1));
                        } else {
                            $this->redirect(array('action' => 'index/' . $id1 . '/' . $id2));
                        }
                    } else {
                        $this->Session->setFlash("Erreur lors du retrait de l'aliment des favoris", "messageErr");
                    }
                } else {
                    $this->Session->setFlash("Vous devez vous connecter pour utiliser cette fonctionnalitée", "messageAvert");
                }
            }
            if (!empty($_POST['retirerfav2'])) {
                $id = AuthComponent::user('id');
                if ($id != null) {
                    $iduti = $id;
                    $idali = $id2;
                    if ($this->Alimentfavori->deleteAll(array('Alimentfavori.iduti' => $iduti, 'Alimentfavori.idali' => $idali), false)) {
                        $this->Session->setFlash("L'aliment a bien été retiré de vos aliments favoris", "messageBon");
                        if ($id1 == null) {
                            $this->redirect(array('action' => 'index/' . $id2));
                        } else {
                            $this->redirect(array('action' => 'index/' . $id1 . '/' . $id2));
                        }
                    } else {
                        $this->Session->setFlash("Erreur lors du retrait de l'aliment des favoris","messageErr");
                    }
                } else {
                    $this->Session->setFlash("Vous devez vous connecter pour utiliser cette fonctionnalitée", "messageAvert");
                }
            }
            if (!empty($_POST['alifav'])) {
                /* Bouton aliments favoris */
                $res = $this->Alimentfavori->find('all', array('conditions' => array('iduti' => AuthComponent::user('id'))));
                $resultats = array();
                $i = 0;
                foreach ($res as $r) {
                    $resultats[$i] = $this->Alimentsdetaille->find('first', array('conditions' => array('id' => $r['Alimentfavori']['idali'])));
                    $i++;
                }
                $this->set('resultats', $resultats);
                $this->set('alimentfavori', true);
            }
        }

        if ($id1 != NULL) {
            $aliment1 = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $id1)));
            if (!empty($aliment1)) {


                $this->set('aliment1', $aliment1);


                //On récupère la quantité du premier aliment que l'utilisateur souhaite comparer
                if (isset($_POST['quantite'])) {
                    $quantiteAliment1 = $_POST['quantite'];
                    $this->set('quantiteAliment1', $quantiteAliment1);
                } elseif (!isset($quantiteAliment1)) {
                    $this->set('quantiteAliment1', 1);
                }

                //On récupère la portion du premier aliment que l'utilisateur souhaite comparer
                if (isset($_POST['portion'])) {
                    $split = explode("@", $_POST['portion']);
                    $quantitePortion1 = $split[0];
                    $this->set('quantitePortion1', $quantitePortion1);
                } else {
                    $this->set('quantitePortion1', $aliment1['Aliment']['P1Quantite']);
                }
            }
        }

        if ($id2 != NULL) {

            $aliment2 = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $id2)));
            if (!empty($aliment2)) {

                $this->set('aliment2', $aliment2);

                //On récupère la quantité du deuxième aliment que l'utilisateur souhaite comparer
                if (isset($_POST['quantite2'])) {
                    $quantiteAliment2 = $_POST['quantite2'];
                    $this->set('quantiteAliment2', $quantiteAliment2);
                } elseif (!isset($quantiteAliment2)) {
                    $this->set('quantiteAliment2', 1);
                }

                //On récupère la portion du deuxième aliment que l'utilisateur souhaite comparer
                if (isset($_POST['portion2'])) {
                    $split = explode("@", $_POST['portion2']);
                    $quantitePortion2 = $split[0];
                    $this->set('quantitePortion2', $quantitePortion2);
                } else {
                    $this->set('quantitePortion2', $aliment2['Aliment']['P1Quantite']);
                }
            }
        }
        if (AuthComponent::user('id') != null) {
            $user = $this->User->find('first', array('conditions' => array('User.id' => AuthComponent::user('id'))));
            $this->set('user', $user);

            /* Recherche constantes suivi alimentaire */
            $obPoi = $user['User']['poids'];
            /* age utilisateur */
            $naiss = $user['User']['datenaissance'];
            $age = $this->Aliment->query("SELECT TIMESTAMPDIFF(YEAR,'" . $naiss . "', NOW()) as age;");
            $age = $age[0][0]['age'];
            if ($age == 0 || $age == 1 || $age == 2) {
                $mois = $this->Aliment->query("SELECT TIMESTAMPDIFF(MONTH,'" . $naiss . "', NOW()) as age;");
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


            /* Calcul protéines */
            $ok = false;
            if (!empty($user['Constsuivialimentaire'])) {
                /* Un diététicien ou un administrateur lui a fixé une valeur, analyse valeur */
                $constante = null;
                foreach ($user['Constsuivialimentaire'] as $const) {
                    if (!empty($const['proteines'])) {
                        $constante = $const['proteines'];
                        break;
                    }
                }
                if (!empty($constante)) {
                    $obPro = $obPoi * $constante;
                    $ok = true;
                }
            }
            if (!$ok) {
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
            }

            /* Calcul lipides */
            $ok = false;
            if (!empty($user['Constsuivialimentaire'])) {
                /* Un diététicien ou un administrateur lui a fixé une valeur, analyse valeur */
                $constante = null;
                foreach ($user['Constsuivialimentaire'] as $const) {
                    if (!empty($const['lipides'])) {
                        $constante = $const['lipides'];
                        break;
                    }
                }
                if (!empty($constante)) {
                    $obLip = ($obEnKcal * $constante) / 9;
                    $ok = true;
                }
            }
            if (!$ok) {
                $obLip = ($obEnKcal * 35 / 100) / 9;
            }

            /* Calcul glucide */
            $ok = false;
            if (!empty($user['Constsuivialimentaire'])) {
                /* Un diététicien ou un administrateur lui a fixé une valeur, analyse valeur */
                $constante = null;
                foreach ($user['Constsuivialimentaire'] as $const) {
                    if (!empty($const['lipides'])) {
                        $constante = $const['lipides'];
                        break;
                    }
                }
                if (!empty($constante)) {
                    $pourLip = $constante;
                    $ok = true;
                }
            }
            if (!$ok) {
                $con = $this->Constante->findAllBycategorie(3);
                $pourLip = $con[0]['Constante']['valeur'];
            }
            $ePro = $obPro * 4;
            $pourPro = $ePro / $obEnKcal;
            $obGlu = 1 - ($pourPro + $pourLip);
            $obGlu = $obEnKcal * ($obGlu / 100);
            $obGlu = $obGlu / 4;

            /* Calcul fibres */
            $ok = false;
            if (!empty($user['Constsuivialimentaire'])) {
                /* Un diététicien lui a fixé une valeur, analyse valeur */
                $constante = null;
                foreach ($user['Constsuivialimentaire'] as $const) {
                    if (!empty($const['fibres'])) {
                        $constante = $const['fibres'];
                        break;
                    }
                }
                if (!empty($constante)) {
                    $obFib = $constante;
                    $ok = true;
                }
            }
            if (!$ok) {
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
            }

            /* Calcul sel */
            $ok = false;
            if (!empty($user['Constsuivialimentaire'])) {
                /* Un diététicien lui a fixé une valeur, analyse valeur */
                $constante = null;
                foreach ($user['Constsuivialimentaire'] as $const) {
                    if (!empty($const['sel'])) {
                        $constante = $const['sel'];
                        break;
                    }
                }
                if (!empty($constante)) {
                    $obSel = $constante;
                    $ok = true;
                }
            }
            if (!$ok) {
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
            }
            /* Calcul vitamine A */
            if ($age < 1) {
                $obVitA = 350;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitA = 400;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitA = 450;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitA = 500;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitA = 550;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitA = 700;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitA = 600;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitA = 800;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitA = 600;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitA = 800;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitA = 600;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitA = 700;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitA = 600;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitA = 700;
            } if ($allaitement) {
                $obVitA = 950;
            }

            /* Calcul vitamine C */
            if ($age < 1) {
                $obVitC = 50;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitC = 60;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitC = 75;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitC = 90;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitC = 100;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitC = 110;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitC = 110;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitC = 110;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitC = 110;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitC = 110;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitC = 110;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitC = 120;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitC = 120;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitC = 120;
            } if ($allaitement) {
                $obVitC = 130;
            }

            /* Calcul calcium */
            if ($age < 1) {
                $obCal = 0;
            } elseif ($age >= 1 && $age <= 3) {
                $obCal = 500;
            } elseif ($age >= 4 && $age <= 6) {
                $obCal = 700;
            } elseif ($age >= 7 && $age <= 9) {
                $obCal = 900;
            } elseif ($age >= 10 && $age <= 12) {
                $obCal = 1200;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obCal = 1200;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obCal = 1200;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obCal = 1200;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obCal = 1200;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "homme") {
                $obCal = 900;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "femme") {
                $obCal = 900;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "homme") {
                $obCal = 1200;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "femme") {
                $obCal = 1200;
            } elseif ($age >= 75) {
                $obCal = 1200;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obCal = 1000;
            } if ($allaitement) {
                $obCal = 1000;
            }

            /* Calcul Fer */
            if ($age < 1) {
                $obFer = 0;
            } elseif ($age >= 1 && $age <= 3) {
                $obFer = 7;
            } elseif ($age >= 4 && $age <= 6) {
                $obFer = 7;
            } elseif ($age >= 7 && $age <= 9) {
                $obFer = 8;
            } elseif ($age >= 10 && $age <= 12) {
                $obFer = 10;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obFer = 13;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obFer = 16;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obFer = 13;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obFer = 16;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "homme") {
                $obFer = 9;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "femme") {
                $obFer = 16;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "homme") {
                $obFer = 9;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "femme") {
                $obFer = 9;
            } elseif ($age >= 75) {
                $obFer = 10;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obFer = 30;
            } if ($allaitement) {
                $obFer = 10;
            }

            /* Calcul phosphore */
            if ($age < 1) {
                $obPhos = 0;
            } elseif ($age >= 1 && $age <= 3) {
                $obPhos = 360;
            } elseif ($age >= 4 && $age <= 6) {
                $obPhos = 450;
            } elseif ($age >= 7 && $age <= 9) {
                $obPhos = 600;
            } elseif ($age >= 10 && $age <= 12) {
                $obPhos = 830;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obPhos = 830;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obPhos = 800;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obPhos = 800;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obPhos = 800;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "homme") {
                $obPhos = 750;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "femme") {
                $obPhos = 750;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "homme") {
                $obPhos = 750;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "femme") {
                $obPhos = 800;
            } elseif ($age >= 75) {
                $obPhos = 800;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obPhos = 800;
            } if ($allaitement) {
                $obPhos = 850;
            }

            /* Calcul magnésium */
            if ($age < 1) {
                $obMagn = 0;
            } elseif ($age >= 1 && $age <= 3) {
                $obMagn = 80;
            } elseif ($age >= 4 && $age <= 6) {
                $obMagn = 130;
            } elseif ($age >= 7 && $age <= 9) {
                $obMagn = 200;
            } elseif ($age >= 10 && $age <= 12) {
                $obMagn = 280;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obMagn = 410;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obMagn = 370;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obMagn = 410;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obMagn = 370;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "homme") {
                $obMagn = 420;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "femme") {
                $obMagn = 360;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "homme") {
                $obMagn = 420;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "femme") {
                $obMagn = 360;
            } elseif ($age >= 75) {
                $obMagn = 400;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obMagn = 400;
            } if ($allaitement) {
                $obMagn = 390;
            }

            /* Calcul zinc */
            if ($age < 1) {
                $obZinc = 0;
            } elseif ($age >= 1 && $age <= 3) {
                $obZinc = 6;
            } elseif ($age >= 4 && $age <= 6) {
                $obZinc = 7;
            } elseif ($age >= 7 && $age <= 9) {
                $obZinc = 9;
            } elseif ($age >= 10 && $age <= 12) {
                $obZinc = 12;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obZinc = 13;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obZinc = 10;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obZinc = 13;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obZinc = 10;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "homme") {
                $obZinc = 12;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "femme") {
                $obZinc = 10;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "homme") {
                $obZinc = 11;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "femme") {
                $obZinc = 11;
            } elseif ($age >= 75) {
                $obZinc = 12;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obZinc = 14;
            } if ($allaitement) {
                $obZinc = 19;
            }

            /* Calcul Cuivre */
            if ($age < 1) {
                $obCui = 0;
            } elseif ($age >= 1 && $age <= 3) {
                $obCui = 0.8;
            } elseif ($age >= 4 && $age <= 6) {
                $obCui = 1;
            } elseif ($age >= 7 && $age <= 9) {
                $obCui = 1.2;
            } elseif ($age >= 10 && $age <= 12) {
                $obCui = 1.5;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obCui = 1.5;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obCui = 1.5;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obCui = 1.5;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obCui = 1.5;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "homme") {
                $obCui = 2;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "femme") {
                $obCui = 1.5;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "homme") {
                $obCui = 1.5;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "femme") {
                $obCui = 1.5;
            } elseif ($age >= 75) {
                $obCui = 1.5;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obCui = 2;
            } if ($allaitement) {
                $obCui = 2;
            }


            /* Calcul Iode */
            if ($age < 1) {
                $obIod = 0;
            } elseif ($age >= 1 && $age <= 3) {
                $obIod = 80;
            } elseif ($age >= 4 && $age <= 6) {
                $obIod = 90;
            } elseif ($age >= 7 && $age <= 9) {
                $obIod = 120;
            } elseif ($age >= 10 && $age <= 12) {
                $obIod = 150;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obIod = 150;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obIod = 150;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obIod = 150;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obIod = 150;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "homme") {
                $obIod = 150;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "femme") {
                $obIod = 150;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "homme") {
                $obIod = 150;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "femme") {
                $obIod = 150;
            } elseif ($age >= 75) {
                $obIod = 150;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obIod = 200;
            } if ($allaitement) {
                $obIod = 200;
            }

            /* Calcul Sélénium */
            if ($age < 1) {
                $obSelenium = 0;
            } elseif ($age >= 1 && $age <= 3) {
                $obSelenium = 20;
            } elseif ($age >= 4 && $age <= 6) {
                $obSelenium = 30;
            } elseif ($age >= 7 && $age <= 9) {
                $obSelenium = 40;
            } elseif ($age >= 10 && $age <= 12) {
                $obSelenium = 45;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obSelenium = 50;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obSelenium = 50;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obSelenium = 50;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obSelenium = 50;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "homme") {
                $obSelenium = 60;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "femme") {
                $obSelenium = 50;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "homme") {
                $obSelenium = 70;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "femme") {
                $obSelenium = 60;
            } elseif ($age >= 75) {
                $obSelenium = 60;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obSelenium = 60;
            } if ($allaitement) {
                $obSelenium = 60;
            }

            /* Calcul Potassium */
            if ($age < 1) {
                $obPotass = 0;
            } elseif ($age >= 1 && $age <= 3) {
                $obPotass = 3000;
            } elseif ($age >= 4 && $age <= 6) {
                $obPotass = 3800;
            } elseif ($age >= 7 && $age <= 9) {
                $obPotass = 4500;
            } elseif ($age >= 10 && $age <= 12) {
                $obPotass = 4500;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obPotass = 4700;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obPotass = 4700;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obPotass = 4700;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obPotass = 4700;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "homme") {
                $obPotass = 4700;
            } elseif ($age >= 20 && $age <= 64 && $sexe == "femme") {
                $obPotass = 4700;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "homme") {
                $obPotass = 4700;
            } elseif ($age >= 65 && $age <= 75 && $sexe == "femme") {
                $obPotass = 4700;
            } elseif ($age >= 75) {
                $obPotass = 4700;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obPotass = 4700;
            } if ($allaitement) {
                $obPotass = 5100;
            }

            /* Calcul vitamine B6 */
            if ($age < 1) {
                $obVitB6 = 0.3;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitB6 = 0.6;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitB6 = 0.8;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitB6 = 1;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitB6 = 1.3;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitB6 = 1.6;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitB6 = 1.5;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitB6 = 1.8;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitB6 = 1.5;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitB6 = 1.8;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitB6 = 1.5;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitB6 = 2.2;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitB6 = 2.2;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitB6 = 2;
            } if ($allaitement) {
                $obVitB6 = 2;
            }

            /* Calcul vitamine B12 */
            if ($age < 1) {
                $obVitB12 = 0.5;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitB12 = 0.8;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitB12 = 1.1;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitB12 = 1.4;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitB12 = 1.9;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitB12 = 2.3;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitB12 = 2.3;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitB12 = 2.4;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitB12 = 2.4;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitB12 = 2.4;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitB12 = 2.4;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitB12 = 3;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitB12 = 3;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitB12 = 2.6;
            } if ($allaitement) {
                $obVitB12 = 2.8;
            }

            /* Calcul vitamine D */
            if ($age < 1) {
                $obVitD = 22.5;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitD = 10;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitD = 5;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitD = 5;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitD = 5;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitD = 5;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitD = 5;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitD = 5;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitD = 5;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitD = 5;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitD = 5;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitD = 10;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitD = 15;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitD = 10;
            } if ($allaitement) {
                $obVitD = 10;
            }

            /* Calcul vitamine E */
            if ($age < 1) {
                $obVitE = 4;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitE = 6;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitE = 7.5;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitE = 9;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitE = 11;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitE = 12;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitE = 12;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitE = 12;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitE = 12;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitE = 12;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitE = 12;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitE = 20;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitE = 50;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitE = 12;
            } if ($allaitement) {
                $obVitE = 12;
            }

            /* Calcul vitamine K */
            if ($age < 1) {
                $obVitK = 7.5;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitK = 15;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitK = 20;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitK = 30;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitK = 40;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitK = 45;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitK = 45;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitK = 65;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitK = 65;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitK = 45;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitK = 45;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitK = 70;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitK = 70;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitK = 45;
            } if ($allaitement) {
                $obVitK = 45;
            }

            /* Vitamine B9 ou Folates totaux */
            if ($age < 1) {
                $obVitB9 = 70;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitB9 = 100;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitB9 = 150;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitB9 = 200;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitB9 = 250;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitB9 = 300;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitB9 = 300;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitB9 = 330;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitB9 = 300;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitB9 = 330;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitB9 = 300;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitB9 = 330;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitB9 = 400;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitB9 = 400;
            } if ($allaitement) {
                $obVitB9 = 400;
            }

            /* Vitamine B1 ou Thiamine (mg/100g) */
            if ($age < 1) {
                $obVitB1 = 0.2;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitB1 = 0.4;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitB1 = 0.6;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitB1 = 0.8;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitB1 = 1;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitB1 = 1.3;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitB1 = 1.1;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitB1 = 1.3;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitB1 = 1.1;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitB1 = 1.3;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitB1 = 1.1;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitB1 = 1.2;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitB1 = 1.2;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitB1 = 1.8;
            } if ($allaitement) {
                $obVitB1 = 1.8;
            }

            /* Vitamine B2 ou Riboflavine (mg/100g) */
            if ($age < 1) {
                $obVitB2 = 0.4;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitB2 = 0.8;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitB2 = 1;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitB2 = 1.3;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitB2 = 1.4;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitB2 = 1.6;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitB2 = 1.4;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitB2 = 1.6;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitB2 = 1.5;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitB2 = 1.6;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitB2 = 1.5;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitB2 = 1.6;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitB2 = 1.6;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitB2 = 1.6;
            } if ($allaitement) {
                $obVitB2 = 1.8;
            }

            /* Vitamine B3 ou PP ou Niacine */
            if ($age < 1) {
                $obVitB3 = 3;
            } elseif ($age >= 1 && $age <= 3) {
                $obVitB3 = 6;
            } elseif ($age >= 4 && $age <= 6) {
                $obVitB3 = 8;
            } elseif ($age >= 7 && $age <= 9) {
                $obVitB3 = 9;
            } elseif ($age >= 10 && $age <= 12) {
                $obVitB3 = 10;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "homme") {
                $obVitB3 = 13;
            } elseif ($age >= 13 && $age <= 15 && $sexe == "femme") {
                $obVitB3 = 11;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "homme") {
                $obVitB3 = 14;
            } elseif ($age >= 16 && $age <= 19 && $sexe == "femme") {
                $obVitB3 = 11;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "homme") {
                $obVitB3 = 14;
            } elseif ($age >= 20 && $age <= 74 && $sexe == "femme") {
                $obVitB3 = 11;
            } elseif ($age >= 75 && $sexe == "homme") {
                $obVitB3 = 14;
            } elseif ($age >= 75 && $sexe == "femme") {
                $obVitB3 = 11;
            } if ($grossesse && $moisgrossesse > 6 && $moisgrossesse <= 9) {
                $obVitB3 = 16;
            } if ($allaitement) {
                $obVitB3 = 15;
            }

            /* Mise en forme */
            $obEnKcal = intval($obEnKcal);
            $obPro = intval($obPro);
            $obLip = intval($obLip);
            $obGlu = intval($obGlu * 100);
            $obPoi = intval($obPoi);
            $obFib = intval($obFib);
            $obSel = intval($obSel);

            $this->set('obEnKcal', $obEnKcal);
            $this->set('obPro', $obPro);
            $this->set('obLip', $obLip);
            $this->set('obGlu', $obGlu);
            $this->set('obFib', $obFib);
            $this->set('obSel', $obSel);
            $this->set('obPoi', $obPoi);
            $this->set('obVitA', $obVitA);
            $this->set('obVitC', $obVitC);
            $this->set('obCal', $obCal);
            $this->set('obFer', $obFer);
            $this->set('obPhos', $obPhos);
            $this->set('obMagn', $obMagn);
            $this->set('obZinc', $obZinc);
            $this->set('obCui', $obCui);
            $this->set('obIod', $obIod);
            $this->set('obSelenium', $obSelenium);
            $this->set('obPotass', $obPotass);
            $this->set('obVitB6', $obVitB6);
            $this->set('obVitB12', $obVitB12);
            $this->set('obVitD', $obVitD);
            $this->set('obVitE', $obVitE);
            $this->set('obVitK', $obVitK);
            $this->set('obVitB9', $obVitB9);
            $this->set('obVitB1', $obVitB1);
            $this->set('obVitB2', $obVitB2);
            $this->set('obVitB3', $obVitB3);
        }
    }

    public function edit($id1 = NULL) {
        $this->set('page_cours', 'violet');
        /* Recherche des cathegories d'aliements qui seront présents dans la 1ere boite a liste */
        $familles = $this->Alimentsdetaille->find('all', array(
            'fields' => 'type',
            'group' => array('type')));
        $this->set('familles', $familles);
        $sous_types = $this->Alimentsdetaille->find('all', array(
            'fields' => array('sous_type', 'type'),
            'group' => array('sous_type')));
        $this->set('sous_types', $sous_types);
        $classe = $this->Alimentsdetaille->find('all', array(
            'fields' => array('classe', 'sous_type', 'type'),
            'group' => array('classe')));
        $this->set('classes', $classe);
        $sous_classe = $this->Alimentsdetaille->find('all', array(
            'fields' => array('sous_classe', 'classe', 'sous_type', 'type'),
            'group' => array('sous_classe')));
        $this->set('sous_classes', $sous_classe);


        if ($this->request->is('post')) {
            if (!empty($_POST['rechbtn'])) {
                /* Lancement recherche */
                if (!empty($_POST['rech4'])) {
                    /* Aliment contenant une sous-classe */
                    $resultats = $this->Alimentsdetaille->find('all', array('conditions' => array(
                            'AND' => array(
                                array('type' => $_POST['rech']),
                                array('sous_type' => $_POST['rech2']),
                                array('classe' => $_POST['rech3']),
                                array('sous_classe' => $_POST['rech4']))
                    )));
                    $this->set('resultats', $resultats);
                } elseif (!empty($_POST['rech3'])) {
                    /* Aliment contenant une classe */
                    $resultats = $this->Alimentsdetaille->find('all', array('conditions' => array(
                            'AND' => array(
                                array('type' => $_POST['rech']),
                                array('sous_type' => $_POST['rech2']),
                                array('classe' => $_POST['rech3']))
                    )));
                    $this->set('resultats', $resultats);
                } elseif (!empty($_POST['rech2'])) {
                    /* Aliment contenant un sous-type et un type -> obligé, classe & sous-classe sont facultatifs mais sous-type obligé */
                    $resultats = $this->Alimentsdetaille->find('all', array('conditions' => array(
                            'AND' => array(
                                array('type' => $_POST['rech']),
                                array('sous_type' => $_POST['rech2']))
                    )));
                    $this->set('resultats', $resultats);
                }
            }
            if (!empty($_POST['modifier'])) {
                $compteur = 1001;
                while (1) {
                    $present = $this->Aliment->find('count', array('conditions' => array('Aliment.chemin LIKE' => $compteur . '%')
                    ));
                    if ($present == 0) {
                        break;
                    } else {
                        $compteur++;
                    }
                }

                $this->set('present', $present);
                $this->set('compteur', $compteur);

                //if(!empty($this->request->data)){
                $this->Aliment->id = $id1;
                //$this->request->data['Aliment']['id'] = $id1;
                //$this->Aliment->saveField('chemin', 'jpg');
                //$this->Aliment->save($this->request->data);
                $extension = strtolower(pathinfo($this->request->data['Aliment']['chemin_file']['name'], PATHINFO_EXTENSION));
                //$extension = 'jpg';
                if (
                        !empty($this->request->data['Aliment']['chemin_file']['tmp_name']) &&
                        in_array($extension, array('png', 'jpeg', 'jpg'))) {
                    move_uploaded_file($this->request->data['Aliment']['chemin_file']['tmp_name'], IMAGES . 'imagesAliment' . DS . $compteur . '.' . $extension);
                    $this->Aliment->saveField('chemin', $compteur . '.jpg');
                    $this->Session->setFlash('La photo a bien été changée', "messageBon");
                    $this->redirect(array('action' => 'edit/' . $id1));
                } else if (!empty($this->request->data['Aliment']['chemin_file']['tmp_name'])) {
                    $this->Session->setFlash('Vous ne pouvez pas envoyer ce type de fichier', "messageAvert");
                    $this->redirect(array('action' => 'edit/' . $id1));
                }

                //} else {
                //$this->Aliment->chemin = $compteur;
                //$this->request->data = $this->Aliment->read();
                //}
            }
        }



        if ($id1 != NULL) {
            $aliment1 = $this->Aliment->find('first', array('conditions' => array('Aliment.id' => $id1)));
            if (!empty($aliment1)) {


                $this->set('aliment1', $aliment1);

                //On récupère la quantité du premier aliment que l'utilisateur souhaite comparer
                if (isset($_POST['quantite'])) {
                    $quantiteAliment1 = $_POST['quantite'];
                    $this->set('quantiteAliment1', $quantiteAliment1);
                } elseif (!isset($quantiteAliment1)) {
                    $this->set('quantiteAliment1', 1);
                }

                //On récupère la portion du premier aliment que l'utilisateur souhaite comparer
                if (isset($_POST['portion'])) {
                    $split = explode("@", $_POST['portion']);
                    $quantitePortion1 = $split[0];
                    $this->set('quantitePortion1', $quantitePortion1);
                } else {
                    $this->set('quantitePortion1', $aliment1['Aliment']['P1Quantite']);
                }
            }
        }
    }

}
