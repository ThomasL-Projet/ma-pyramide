<?php

App::uses('AppController', 'Controller');

/**
 * Donneescompilees Controller
 *
 * @property Donneescompilee $Donneescompilee
 */
class EvolutionphysiquesController extends AppController {

    // Pour utiliser des modèles spécifiques
    public $uses = array('Suiviphysique', 'User', 'Activitephysique');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('page_cours', 'rouge');
    }

    public function index() {

        if ($this->request->is('post')) {
            // on récupére la durée selectionnée
            $dateDeb = $this->request->data('dateDeb');
            $dateFin = $this->request->data('dateFin');

            // si une des dates n'a pas été spécifié
            if (empty($dateDeb) OR empty($dateFin)) {
                $this->Session->setFlash("Une ou plusieurs dates n'ont pas été spécifiées, merci de spécifier une période complète avec deux dates", "messageAvert");
                $this->redirect(array('action' => 'index'));
            }

            // on spécifié ces variables pour indiqué la période que l'utilisateur a sélectionné dans la vue
            $this->set('dateFin', $dateFin);
            $this->set('dateDeb', $dateDeb);

            // on récupère les informations de l'utilisateur
            $id = AuthComponent::user('id');
            $poids = AuthComponent::user('poids');

            //on récupère tous les suiviphysiques en fonction des dates indiqués
            $resultats = $this->Suiviphysique->find('all', array('conditions' => array('AND' => array(
                        array('user_id' => $id),
                        array('Suiviphysique.jourAP BETWEEN ? AND ?' => array($dateDeb, $dateFin))
                    )),
                'fields' => array('Activitephysique.MET', 'Suiviphysique.tempsAP', 'Suiviphysique.jourAP'),
                'order' => array('Suiviphysique.jourAP' => 'desc')));
            /*------------ UTILE POUR LE DÉBUG --------------
              echo "<pre>";
              var_dump($resultats);
              echo "</pre>";
            */
            // si il n'y as aucun résultat on l'indique à l'utilisateur
            if (empty($resultats)) {
                $this->Session->setFlash("Nous n'avons trouvé aucune donnée lié à vos activités physiques sur la période spécifiée", "messageAvert");
                $this->redirect(array('action' => 'index'));
            }

            //on calcul pour chaque jour : MET ( de l'activité) x poids (utilisateur) x duree(heure)
            $data = array();

            // on récupére la première valeur
            $data[0] = array(
                'calories' => floatval(str_replace(",", ".",$resultats[0]['Activitephysique']['MET'])) * ($resultats[0]['Suiviphysique']['tempsAP'] / 64) * $poids,
                'date' => date("d/m/Y", strtotime($resultats[0]['Suiviphysique']['jourAP']))
            );

            // variable d'itération pour simplifier notre boucle
            $i = 0;
            
            // on crée notre tableau type pour amCharts (axe y puis x)
            foreach ($resultats as $resultat) {
               if ($i == 0) {
                    $i++;
                    continue;
                } 
                
                    
                // si on est encore sur le même jour on incrémente les calories consommées
                if (date_create($resultats[$i - 1]['Suiviphysique']['jourAP'])->format('Y-m-d') ==
                date_create($resultat['Suiviphysique']['jourAP'])->format('Y-m-d')) {
                    $temp_calo = $data[count($data)-1]['calories'];
                    $data[count($data)-1] = array(
                        'calories' => $temp_calo + floatval(str_replace(",", ".",$resultat['Activitephysique']['MET'])) * ($resultat['Suiviphysique']['tempsAP'] / 64.0) * $poids,
                        'date' => $data[count($data)-1]['date']
                    );
                    
                } else {
                    // sinon on ajoute un jour à par entière
                    $data[count($data)] = array(
                        'calories' => floatval(str_replace(",", ".",$resultat['Activitephysique']['MET'])) * ($resultat['Suiviphysique']['tempsAP'] / 64.0) * $poids,
                        'date' => date("d/m/Y", strtotime($resultats[$i]['Suiviphysique']['jourAP']))
                    );
                }
                
                $i++;
            }
            $this->set('data', json_encode($data));
        } else {
            // si on ouvre la page direct 
        } 
    }

    public function edit() {
        $id = AuthComponent::user('id');
        //date d'aujourd'hui en format mysql et francais
        $today = date("Y-m-d 00:00:00");
        $todayfr = date("d/m/Y");

        //date de 6 jours avant aujourdhui
        $todaymoinssix = date("Y-m-d 00:00:00", mktime(0, 0, 0, date("m"), date("d") - 6, date("Y")));

        //dates de la semaine passé en format mysql
        $jour1 = date("Y-m-d 00:00:00", mktime(0, 0, 0, date("m"), date("d") - 6, date("Y")));
        $jour2 = date("Y-m-d 00:00:00", mktime(0, 0, 0, date("m"), date("d") - 5, date("Y")));
        $jour3 = date("Y-m-d 00:00:00", mktime(0, 0, 0, date("m"), date("d") - 4, date("Y")));
        $jour4 = date("Y-m-d 00:00:00", mktime(0, 0, 0, date("m"), date("d") - 3, date("Y")));
        $jour5 = date("Y-m-d 00:00:00", mktime(0, 0, 0, date("m"), date("d") - 2, date("Y")));
        $jour6 = date("Y-m-d 00:00:00", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));

        //dates de la semaine passé en francais
        $jourfr1 = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d") - 6, date("Y")));
        $jourfr2 = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d") - 5, date("Y")));
        $jourfr3 = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d") - 4, date("Y")));
        $jourfr4 = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d") - 3, date("Y")));
        $jourfr5 = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d") - 2, date("Y")));
        $jourfr6 = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));

        $resultats = $this->Suiviphysique->find('all', array('conditions' => array('AND' => array(
                    array('user_id' => $id),
                    array('Suiviphysique.jourAP BETWEEN ? AND ?' => array($todaymoinssix, $today))
        ))));
        $this->set('resultats', $resultats);
        //envoi des valeur
        $this->set('todayfr', $todayfr);
        $this->set('jourfr1', $jourfr1);
        $this->set('jourfr2', $jourfr2);
        $this->set('jourfr3', $jourfr3);
        $this->set('jourfr4', $jourfr4);
        $this->set('jourfr5', $jourfr5);
        $this->set('jourfr6', $jourfr6);
        $this->set('today', $today);
        $this->set("todaymoinssix", $todaymoinssix);
    }

    public function delete($idsuiv = null) {
        $id = AuthComponent::user('id');

        /* Vérification que le idsuiv en get soit bien un suiviAlimentaire de l'utilisateur */
        $ok = false;
        $verifs = $this->Suiviphysique->findAllByuser_id($id);
        foreach ($verifs as $verif) {
            if ($verif['Suiviphysique']['id'] == $idsuiv) {
                $ok = true;
            }
        }

        $this->set('affichage', $ok);
        if ($ok) {
            /* Suivi concerné */
            $suiv = $this->Suiviphysique->find('first', array('conditions' => array('Suiviphysique.id' => $idsuiv)));

            /* Recherche de l'aliment concerné */
            $act = $this->Activitephysique->find('first', array('conditions' => array('Activitephysique.id' => $suiv['Suiviphysique']['activitephysique_id'])));

            $this->set('suivi', $suiv);
            $this->set('activite', $act);

            if ($this->request->is('post')) {
                $this->Suiviphysique->id = $idsuiv;
                if ($this->Suiviphysique->delete()) {
                    $this->Session->setFlash(__("Activité supprimé"));
                    $this->redirect(array('action' => 'edit'));
                } else {
                    $this->Session->setFlash(__("L'activité n'a pas pu être supprimé. Merci de réessayer."));
                    $this->redirect(array('action' => 'edit'));
                }
            }
        }
    }

    public function modif($idsuiv = null) {
        $id = AuthComponent::user('id');

        /* Vérification que le idsuiv en get soit bien un suiviAlimentaire de l'utilisateur */
        $ok = false;
        $verifs = $this->Suiviphysique->findAllByuser_id($id);
        foreach ($verifs as $verif) {
            if ($verif['Suiviphysique']['id'] == $idsuiv) {
                $ok = true;
            }
        }

        $this->set('affichage', $ok);
        if ($ok) {
            /* Suivi concerné */
            $suiv = $this->Suiviphysique->find('first', array('conditions' => array('Suiviphysique.id' => $idsuiv)));

            /* Recherche de l'aliment concerné */
            $act = $this->Activitephysique->find('first', array('conditions' => array('Activitephysique.id' => $suiv['Suiviphysique']['activitephysique_id'])));
            /* recherche date concerné */
            //$dat = $this->SuiviPhyqique->find('first',array('conditions'=> array('Suiviphyque.jourAP'=> $suiv['Suiviphysique']['jourAP'])));
            //dubug($dat);
            $this->set('suivi', $suiv);
            $this->set('activite', $act);
            //$this->set('date', $dat); 

            if ($this->request->is('post')) {
                if (!isset($_POST['duree'])) {
                    $this->Session->setFlash(__("Vous devez modifier une valeur pour modifier votre activité"));
                } else {
                    $this->Suiviphysique->updateAll(array('Suiviphysique.tempsAP' => '\'' . $_POST['duree'] . '\''), array('Suiviphysique.id' => $idsuiv));
                    $this->Suiviphysique->updateAll(array('Suiviphysique.jourAP' => '\'' . $_POST['date'] . '\''), array('Suiviphysique.id' => $idsuiv));
                    $this->Session->setFlash(__("Activité modifié"));

                    $this->redirect(array('action' => 'edit'));
                }
            }
        }
    }

}
