<?php

App::uses('AppController', 'Controller');

/**
 * 
 */
class MonDossierController extends AppController {

    // Pour utiliser des modèles spécifiques
    public $uses = array('Aliment', 'Donneescompilee', 'Suivialimentaire', 'User', 'Alimentsdetaille', 'Alimentfavori', 'Constante', 'Alimhorsclassification', 'Suiviphysique');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('page_cours', 'rouge');
         $this->Auth->allow('index');
    }

    public function index() {
    }

    public function reglages() {

        // on vérifie que l'utilisateur est connecté sinon on lui indique que c'est impossible
        if (AuthComponent::user('id') == null) {
            $this->Session->setFlash("Vous devez êtes connecté pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        } // ELSE :
        $id = AuthComponent::user('id');

        // récupération type donnée médicale
        $typeDonnee = $this->Suivialimentaire->query("SELECT * FROM typedonneesmed");
        $this->set('typeDonnee', $typeDonnee);
        /* echo "<pre>";
          var_dump($typeDonnee);
          echo "</pre>"; */

        // récupération de l'état d'activation des données médicales
        $this->set('paramact', $this->Suivialimentaire->query("SELECT * FROM paramactive WHERE iduser = " . $id));

        // récupération des données ajoutées récemment
        // TODO: récupére avec SQL avec create BETWEEN pour simplifier le code
        $dateDerniereAjout = $this->Suivialimentaire->query("SELECT created, id, typedonnee FROM donnemedicales WHERE user = " . $id . " ORDER BY created");
        /* echo "<pre>";
          var_dump($this->Suivialimentaire->query("SELECT * FROM paramactive WHERE id = " . $id));
          echo "</pre>"; */

        $nbDonneesTrouvees = array();
        for ($i = 0; $i < count($dateDerniereAjout); $i++) {
            $date = new DateTime($dateDerniereAjout[$i]["donnemedicales"]["created"]);

            // on regarde si la donnee ajoute date d'aujourd'hui
            if ($date->format('Y-m-d') == date('Y-m-d')) {
                // si c'est le cas et que l'on a pas ajouter le type de donnée on l'ajoute pour le prévenir dans la vue
                if (!in_array($dateDerniereAjout[$i]["donnemedicales"]["typedonnee"], $nbDonneesTrouvees)) {
                    $nbDonneesTrouvees[] = $dateDerniereAjout[$i]["donnemedicales"]["typedonnee"];
                }
            }
        }
        // Ajout pour la vue
        $this->set('donneeDejaFait', $nbDonneesTrouvees);

        if ($this->request->is("post")) {
            // Ajout des données du formulaire dans la BD 
            for ($i = 0; $i < count($typeDonnee); $i++) {

                if (!empty($_POST[$i]) AND $_POST[$i] != "Déjà renseigné aujourd'hui") {

                    $dateDerniereAjout = $this->Suivialimentaire->query("INSERT INTO donnemedicales VALUES('', '" . $id . "','" . $i . "','" . $_POST[$i] . "', '" . date("Y-m-d H:i:s") . "')");
                }
                if (isset($_POST[$i + 1 . "_act"]) && $_POST[$i + 1 . "_act"] == 1) {
                    $active = 1;
                } else {
                    $active = 0;
                }
                // update de l'activation des élèments dans la base de donnée
                $io = $i + 1;
                $this->Suivialimentaire->query("UPDATE paramactive SET active = " . $active . ", created = '" . date('Y-m-d H:i:s') . "' WHERE iduser = " . $id . " AND idparam = " . $io);
            }

            // message
            $this->Session->setFlash("Vos données ont bien été mises à jour.", "messageBon");
            $this->redirect(array(
                'controller' => 'monDossier',
                'action' => 'reglages')
            );
        }
    }

    public function mesdonneessante() {

        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

        $today = new DateTime();

        // on vérifie que l'utilisateur est connecté sinon on lui indique que c'est impossible
        if (AuthComponent::user('id') == null) {
            $this->Session->setFlash("Vous devez êtes connecté pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        } // ELSE :
        $id = AuthComponent::user('id');
        // si requête on la traite
        if ($this->request->is("post")) { // TODO : modifier true en regardant si on traite un POST ou un GET (en gros)
            // on récupére les durées des suivis que l'utilisateur à sollicité
            // TODO PASSÉ LES PARAMÈTRES AVEC DES BUTTONS OU SUBMIT
            $dureeSuiviAliment = $this->request->data('dureeAliment');
            $dureeSuiviPhysique = $this->request->data('dureePhysique');
            $dureeParamsMedicaux = $this->request->data('dureeParams');


            $user = $this->Suivialimentaire->query("SELECT poids FROM users where id = " . $id)[0]["users"]["poids"];

            /* ------------- GESTION PHYSIQUE - SUIVI ------------------------ */

            $styleCssSup = "<style>";

            switch ($dureeSuiviAliment) {
                case "jour" :
                    $dureeSuiviAliment = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -1 day'));
                    $styleCssSup .= "#alimjour { background : #2C3E50; }";
                    break;
                case "semaine" :
                    $dureeSuiviAliment = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -7 day'));
                    $styleCssSup .= "#alimsem { background : #2C3E50; }";
                    break;
                case "mois" :
                    $dureeSuiviAliment = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -30 day'));
                    $styleCssSup .= "#alimmois { background : #2C3E50; }";
                    break;
            }

            if (empty($dureeSuiviPhysique)) {
                $dureeSuiviPhysique = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -7 day'));
                $styleCssSup .= "#physsem { background : #2C3E50; }";
            }

            switch ($dureeSuiviPhysique) {
                case "jour" :
                    $dureeSuiviPhysique = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -1 day'));
                    $styleCssSup .= "#physjour { background : #2C3E50; }";
                    break;
                case "semaine" :
                    $dureeSuiviPhysique = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -7 day'));
                    $styleCssSup .= "#physsem { background : #2C3E50; }";
                    break;
                case "mois" :
                    $dureeSuiviPhysique = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -30 day'));
                    $styleCssSup .= "#physmois { background : #2C3E50; }";
                    break;
            }

            if (empty($dureeSuiviAliment)) {
                $dureeSuiviAliment = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -7 day'));
                $styleCssSup .= "#alimsem { background : #2C3E50; }";
            }date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -1 day'));

            switch ($dureeParamsMedicaux) {
                case "jour" :
                    $dureeParamsMedicaux = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -1 day'));
                    $styleCssSup .= "#paramjour { background : #2C3E50; }";
                    break;
                case "semaine" :
                    $dureeParamsMedicaux = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -7 day'));
                    $styleCssSup .= "#paramsem { background : #2C3E50; }";
                    break;
                case "mois" :
                    $dureeParamsMedicaux = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -30 day'));
                    $styleCssSup .= "#parammois { background : #2C3E50; }";
                    break;
            }

            if (empty($dureeParamsMedicaux)) {
                $dureeParamsMedicaux = date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s') . ' -7 day'));
                $styleCssSup .= "#paramsem { background : #2C3E50; }";
            }

            $this->set('styleCssSup', $styleCssSup . "</style>");


            //on récupère tous les suiviphysiques en fonction des dates indiqués
            $this->set('suiviPhys', $this->Suiviphysique->find('all', array('conditions' => array('AND' => array(
                                array('user_id' => $id),
                                array('Suiviphysique.jourAP BETWEEN ? AND ?' => array($dureeSuiviPhysique, date('Y/m/d')))
                            )),
                        'fields' => array('Activitephysique.MET', 'Suiviphysique.tempsAP', 'Suiviphysique.jourAP', 'Activitephysique.id'),
                        'group' => array('Activitephysique.id'),
                        'order' => array('Suiviphysique.jourAP' => 'desc'))));

            // Création des données de suivi physique

            $rslt = $this->Suiviphysique->find('all', array('conditions' => array('AND' => array(
                        array('Suiviphysique.user_id' => $id), // TODO : mettre $dureeSuiviPhysique au lieu d'une date dans le dur 
                        array('Suiviphysique.jourAP BETWEEN ? AND ?' => array($dureeSuiviPhysique, date('Y/m/d')))
                    )),
                'fields' => array('(Activitephysique.MET * Suiviphysique.tempsAP * ' . $user . ') as kcal', 'Suiviphysique.jourAP as date', 'Suiviphysique.tempsAP as tmps', 'Activitephysique.GRANDE_RUBRIQUE as type', 'Activitephysique.id as id'),
                'order' => array('Suiviphysique.jourAP' => 'desc')));


            $data = array();
            foreach ($rslt as $row) {
                
                $data[$row["Activitephysique"]["type"]." - Total ".$row["Suiviphysique"]["tmps"]." mins"][] = array(
                    'kcal' => $row[0]["kcal"],
                    'date' => $newDate = date("d/m/Y", strtotime($row["Suiviphysique"]["date"]))
                );
            }

            // mise en forme des données correctements pour l'utilisation avec amchart
            $physiqueChart = array();
            foreach ($data as $key => $row) {
                $physiqueChart[] = array($key, json_encode($row));
            }

            $this->set('suiviPhys', $physiqueChart);

            /* --------------- GESTION ALIMENTAIRE - SUIVI ------------------- */

            /* récupération des constantes (objectifs nutritionnels journaliés pour un l'individu */
            // tableau organisé comme ordreDonneeAlimen
            $const = $this->getValJour($id);
            
            $infosSuiviAli = $this->getConsommeDetail($user, $dureeSuiviAliment);

            if ($infosSuiviAli != null) {
                // mise en forme des données correctements pour l'utilisation avec amchart
                $alimentaireChart = array();
                // $coSel $coFib  $coEau $coLip $coPro $coEnKJ $coEnKcal $coGlu
                $ordreDonneeAlimen = array(array("Sel", "mg"), array("Fibre", "g"), array("Eau", "ml"),
                    array("Lipide", "g"), array("Protéïne", "g"), array("Glucide", "g"), array("Bilan énergétique (kj)", "KJ"),
                    array("Bilan énergétique (kcal)", "Kcal"));
                $i = 0;
                // formatage correct des données pour amchart
                $constantePourChart = array();
                
                
                foreach ($infosSuiviAli as $row) {

                    foreach ($row as $date => $valeur) {

                        $alimentaireChart[$ordreDonneeAlimen[$i][0] . "-" . $ordreDonneeAlimen[$i][1]."-".$const[$i]][] = array(
                            $ordreDonneeAlimen[$i][1] => "" . $valeur . "",
                            'date' => $date
                        );
                    }
                    $i++;
                }
                // TODO : faire des regroupements par date si semain ou mois
                $alimentaireChartsFinal = array();
                foreach ($alimentaireChart as $constituant => $informationApropos) {

                    $alimentaireChartsFinal[] = array($constituant, json_encode($informationApropos));
                }
                
                $alimentaireConstFinal = array();
                foreach ($constantePourChart as $constituant => $informationApropos) {

                    $alimentaireConstFinal[] = array($constituant, json_encode($informationApropos));
                }
                
                
                $this->set('suiviAlim', $alimentaireChartsFinal);
                $this->set('suiviAlimConst', $alimentaireConstFinal);
            } else {

                $this->set('suiviAlim', null);
                $this->set('suiviAlimConst', null);
            }

            /* ------- GESTION PARAMÈTRES MÉDICAUX ------------ */

            // récupération type donnée médicale
            $typeDonnee = $this->Suivialimentaire->query("SELECT * FROM typedonneesmed");

            // récupération des données ajoutées récemment
            // TODO: récupére avec SQL avec create BETWEEN pour simplifier le code
            $dateDerniereAjout = $this->User->query("SELECT created, id, typedonnee, donneeenregistree FROM donnemedicales WHERE user = " .
                    $id . " AND created BETWEEN '" . $dureeParamsMedicaux . "' AND '" . date("Y-m-d H:i:s") . "'");


            $dataParamFrst = array();

            $chartFinalParam = array();
            /* RÉcupération des ids des paramètres activé */
            $idParamActive = $this->User->query("SELECT idparam FROM paramactive WHERE iduser = " .$id." AND active = 1");
            /* bon param pour recherche */
            $idParBien = array();
            foreach($idParamActive as $act){
                $idParBien[] = $act["paramactive"]["idparam"];
            }

            foreach ($dateDerniereAjout as $key => $row) {

                /* index 0 : nom, index 1 : unité */
                $nomEtUnite = $this->extractNomUniteParams($row["donnemedicales"]["typedonnee"], $typeDonnee);
                
                if (in_array($row["donnemedicales"]["typedonnee"], $idParBien) && $row["donnemedicales"]["created"] > $dureeParamsMedicaux) {
                    $dataParamFrst[$nomEtUnite[0] . "-" . $nomEtUnite[1]][] = array($nomEtUnite[1] => $row["donnemedicales"]["donneeenregistree"],
                        "date" => date("d/m/Y", strtotime($row["donnemedicales"]["created"])));
                }
            }
            foreach ($dataParamFrst as $key => $row) {
                $chartFinalParam[] = array($key, json_encode($row));
            }
            $this->set('suiviParam', $chartFinalParam);
            /* echo "<b>chartFinalParam</b><pre>";
              var_dump($chartFinalParam);
              echo "</pre>";
              echo "<hr>"; */
        } else {

            /*             * ********************************************************
             * SI L'UTILISATEUR OUVRE SIMPLEMENT LA PAGE
             */

            $this->set('styleCssSup', "<style> #physsem {background:#2C3E50;} #alimsem {background:#2C3E50;} #paramsem {background:#2C3E50;}</style>");

            $user = $this->Suivialimentaire->query("SELECT poids FROM users where id = " . $id)[0]["users"]["poids"];

            /* ------------- GESTION PHYSIQUE - SUIVI ------------------------ */

            //on récupère tous les suiviphysiques en fonction des dates indiqués
            $this->set('suiviPhys', $this->Suiviphysique->find('all', array('conditions' => array('AND' => array(
                                array('user_id' => $id),
                                array('Suiviphysique.jourAP BETWEEN ? AND ?' => array(date_sub($today, date_interval_create_from_date_string("7 days"))->format('Y-m-d H:i:s'), date('Y/m/d')))
                            )),
                        'fields' => array('Activitephysique.MET', 'Suiviphysique.tempsAP', 'Suiviphysique.jourAP', 'Activitephysique.id'),
                        'group' => array('Activitephysique.id'),
                        'order' => array('Suiviphysique.jourAP' => 'desc'))));

            // Création des données de suivi physique

            $rslt = $this->Suiviphysique->find('all', array('conditions' => array('AND' => array(
                        array('Suiviphysique.user_id' => $id), // TODO : mettre $dureeSuiviPhysique au lieu d'une date dans le dur 
                        array('Suiviphysique.jourAP BETWEEN ? AND ?' => array(date_sub($today, date_interval_create_from_date_string("7 days"))->format('Y-m-d H:i:s'), date('Y/m/d')))
                    )),
                'fields' => array('(Activitephysique.MET * Suiviphysique.tempsAP * ' . $user . ') as kcal', 'Suiviphysique.jourAP as date', 'Suiviphysique.tempsAP as tmps', 'Activitephysique.GRANDE_RUBRIQUE as type', 'Activitephysique.id as id'),
                'order' => array('Suiviphysique.jourAP' => 'desc')));


            $data = array();
            foreach ($rslt as $row) {
                $data[$row["Activitephysique"]["type"]." - Total ".$row["Suiviphysique"]["tmps"]." mins"][] = array(
                    'kcal' => $row[0]["kcal"],
                    'date' => $newDate = date("d/m/Y", strtotime($row["Suiviphysique"]["date"]))
                );
            }
            // mise en forme des données correctements pour l'utilisation avec amchart
            $physiqueChart = array();
            foreach ($data as $key => $row) {
                $physiqueChart[] = array($key, json_encode($row));
            }

            $this->set('suiviPhys', $physiqueChart);

            /* --------------- GESTION ALIMENTAIRE - SUIVI ------------------- */

            /* récupération des constantes (objectifs nutritionnels journaliés pour un l'individu */
            // tableau organisé comme ordreDonneeAlimen
            $const = $this->getValJour($id);

            $dureeSuiviAliment = date_sub($today, date_interval_create_from_date_string("7 days"))->format('Y-m-d H:i:s');

            $infosSuiviAli = $this->getConsommeDetail($user, $dureeSuiviAliment);

            if ($infosSuiviAli != null) {
                // mise en forme des données correctements pour l'utilisation avec amchart
                $alimentaireChart = array();
                // $coSel $coFib  $coEau $coLip $coPro $coEnKJ $coEnKcal $coGlu
                $ordreDonneeAlimen = array(array("Sel", "mg"), array("Fibre", "g"), array("Eau", "ml"),
                    array("Lipide", "g"), array("Protéïne", "g"), array("Glucide", "g"), array("Bilan énergétique (kj)", "KJ"),
                    array("Bilan énergétique (kcal)", "Kcal"));
                $i = 0;
                // formatage correct des données pour amchart
                foreach ($infosSuiviAli as $row) {

                    foreach ($row as $date => $valeur) {

                        $alimentaireChart[$ordreDonneeAlimen[$i][0] . "-" . $ordreDonneeAlimen[$i][1] . "-" . $const[$i]][] = array(
                            $ordreDonneeAlimen[$i][1] => "" . $valeur . "",
                            'date' => $date
                        );
                    }
                    $i++;
                }
                // TODO : faire des regroupements par date si semain ou mois
                $alimentaireChartsFinal = array();
                foreach ($alimentaireChart as $constituant => $informationApropos) {

                    $alimentaireChartsFinal[] = array($constituant, json_encode($informationApropos));
                }
                $this->set('suiviAlim', $alimentaireChartsFinal);
            } else {
                $this->set('suiviAlim', '');
            }
            
            /* ------- GESTION PARAMÈTRES MÉDICAUX ------------ */

            // récupération type donnée médicale
            $typeDonnee = $this->Suivialimentaire->query("SELECT * FROM typedonneesmed");

            // récupération des données ajoutées récemment
            // TODO: récupére avec SQL avec create BETWEEN pour simplifier le code
            $dateDerniereAjout = $this->User->query("SELECT created, id, typedonnee, donneeenregistree FROM donnemedicales WHERE user = " .
                    $id . " AND created BETWEEN '" . date_sub($today, date_interval_create_from_date_string("7 days"))->format('Y-m-d H:i:s') . "' AND '" . date("Y-m-d H:i:s") . "' ORDER BY created");

            // tableau intermédiaire pour la transformation au format json pour amChart
            $dataParamFrst = array();

            $chartFinalParam = array();
            /* RÉcupération des ids des paramètres activé */
            $idParamActive = $this->User->query("SELECT idparam FROM paramactive WHERE iduser = " .$id." AND active = 1");
            /* bon param pour recherche */
            $idParBien = array();
            foreach($idParamActive as $act){
                $idParBien[] = $act["paramactive"]["idparam"];
            }
            // on créer le json pour amChart
            foreach ($dateDerniereAjout as $key => $row) {

                /* index 0 : nom, index 1 : unité */
                $nomEtUnite = $this->extractNomUniteParams($row["donnemedicales"]["typedonnee"], $typeDonnee);
                if (in_array($row["donnemedicales"]["typedonnee"], $idParBien)) {
                    $dataParamFrst[$nomEtUnite[0] . "-" . $nomEtUnite[1]][] = array($nomEtUnite[1] => $row["donnemedicales"]["donneeenregistree"],
                        "date" => date("d/m/Y", strtotime($row["donnemedicales"]["created"])));
                }
            }
            // Finalisation json
            foreach ($dataParamFrst as $key => $row) {
                $chartFinalParam[] = array($key, json_encode($row));
            }
            $this->set('suiviParam', $chartFinalParam);
            
            
        }
    }

    public function extractNomUniteParams($typedonnee, $lesdonnees) {

        foreach ($lesdonnees as $row) {

            if ($row["typedonneesmed"]["id"] == $typedonnee) {
                return array($row["typedonneesmed"]["nom"], $row["typedonneesmed"]["unite"]);
            }
        }
    }

    /** Récupére les détails des consommations d'un individu de la date spécifiée jusqu'à aujourd'hui */
    public function getConsommeDetail($user, $date) {
        $id = AuthComponent::user('id');
        /* Chaque suivi al imentaire entrée par l'utilisateur */
        $infosSuivi = $this->Suivialimentaire->query("SELECT * FROM suivialimentaires WHERE id_user = " . $id
                . " AND created BETWEEN '" . $date . "' AND '" . date("Y-m-d H:i:s") . "' ORDER BY created");

        $idAliments = array();
        //  récupération des infos des aliments du suivi physique
        for ($i = 0; $i < count($infosSuivi); $i++) {
            $idAliments[$i][0] = $infosSuivi[$i]["suivialimentaires"]["id_aliment"]; // ID DE L'ALIMENT
            $idAliments[$i][1] = $infosSuivi[$i]["suivialimentaires"]["quantite"]; // QUANTITE CONSOMMÉE
            $idAliments[$i][2] = $infosSuivi[$i]["suivialimentaires"]["portion"]; // NB PORTION
            $idAliments[$i][3] = count(explode("@", $infosSuivi[$i]['suivialimentaires']['nomSA'])); // NB REPAS
        }

        // données spécifiques aux aliments du suivi
        $infosAliment = array();
        for ($i = 0; $i < count($idAliments); $i++) {
            $infosAliment[$i] = $this->Aliment->findAllByid($idAliments[$i][0]);
        }

        /* Calculs concernant ces aliments 
         * enregistrement date par date
         */
        /* Calcul energie en Kcal */

        $coEnKcal = array();
        // aide pour factoriser les suivis en date 
        $date;

        for ($i = 0; $i < count($infosSuivi); $i++) {
            // si l'information concerne un même jour (on ajoute au même indice<=>date dans le tableau)
            if ($date == date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))) {
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[1];
                    $coEnKcal[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coEnKcal[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coEnKcal[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coEnKcal[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($infosAliment[$i][0]['Donneesaliment'][1]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            } else { // si c'est une autre date
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[1];
                    $coEnKcal[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coEnKcal[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($infosAliment[$i][0]['Donneesaliment'][1]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            }
            // pour la prochaine itération
            $date = date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]));
        }

        $date = "";
        /* Calcul energie en KJ */
        $coEnKJ = array();
        for ($i = 0; $i < count($infosSuivi); $i++) {
            // si l'information concerne un même jour (on ajoute au même indice<=>date dans le tableau)
            if ($date == date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))) {
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[0];
                    $coEnKJ[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coEnKJ[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coEnKJ[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coEnKJ[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($infosAliment[$i][0]['Donneesaliment'][0]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            } else { // si c'est une autre date
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[0];
                    $coEnKJ[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coEnKJ[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($infosAliment[$i][0]['Donneesaliment'][0]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            }
            // pour la prochaine itération
            $date = date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]));
        }

        $date = "";
        /* Calcul Protéines */
        $coPro = array();
        for ($i = 0; $i < count($infosSuivi); $i++) {
            // si l'information concerne un même jour (on ajoute au même indice<=>date dans le tableau)
            if ($date == date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))) {
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[16];
                    $coPro[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coPro[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coPro[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coPro[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($infosAliment[$i][0]['Donneesaliment'][16]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            } else { // si c'est une autre date
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[16];
                    $coPro[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coPro[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($infosAliment[$i][0]['Donneesaliment'][16]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            }
            // pour la prochaine itération
            $date = date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]));
        }

        $date = "";
        /* Calcul Lipides */
        $coLip = array();
        for ($i = 0; $i < count($infosSuivi); $i++) {
            // si l'information concerne un même jour (on ajoute au même indice<=>date dans le tableau)
            if ($date == date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))) {
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[23];
                    $coLip[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coLip[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coLip[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coLip[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($infosAliment[$i][0]['Donneesaliment'][23]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            } else { // si c'est une autre date
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[23];
                    $coLip[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coLip[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($infosAliment[$i][0]['Donneesaliment'][23]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            }
            // pour la prochaine itération
            $date = date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]));
        }

        $date = "";
        /* Calcul Glucide */
        $coGlu = array();
        for ($i = 0; $i < count($infosSuivi); $i++) {
            // si l'information concerne un même jour (on ajoute au même indice<=>date dans le tableau)
            if ($date == date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))) {
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[18];
                    $coGlu[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coGlu[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coGlu[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coGlu[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($infosAliment[$i][0]['Donneesaliment'][18]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            } else { // si c'est une autre date
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[18];
                    $coGlu[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coGlu[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($infosAliment[$i][0]['Donneesaliment'][18]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            }
            // pour la prochaine itération
            $date = date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]));
        }

        $date = "";
        /* Calcul Eau */
        $coEau = array();
        for ($i = 0; $i < count($infosSuivi); $i++) {
            // si l'information concerne un même jour (on ajoute au même indice<=>date dans le tableau)
            if ($date == date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))) {
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[4];
                    $coEau[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coEau[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coEau[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coEau[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($infosAliment[$i][0]['Donneesaliment'][4]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            } else { // si c'est une autre date
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[4];
                    $coEau[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coEau[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($infosAliment[$i][0]['Donneesaliment'][4]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            }
            // pour la prochaine itération
            $date = date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]));
        }

        $date = "";
        /* Calcul Fibre */
        $coFib = array();
        for ($i = 0; $i < count($infosSuivi); $i++) {
            // si l'information concerne un même jour (on ajoute au même indice<=>date dans le tableau)
            if ($date == date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))) {
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[22];
                    $coFib[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coFib[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coFib[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coFib[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($infosAliment[$i][0]['Donneesaliment'][22]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            } else { // si c'est une autre date
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[22];
                    $coFib[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coFib[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($infosAliment[$i][0]['Donneesaliment'][22]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            }
            // pour la prochaine itération
            $date = date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]));
        }

        $date = "";
        /* Calcul Sel */
        $coSel = array();
        for ($i = 0; $i < count($infosSuivi); $i++) {
            // si l'information concerne un même jour (on ajoute au même indice<=>date dans le tableau)
            if ($date == date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))) {
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[5];
                    $coSel[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coSel[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coSel[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = $coSel[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] + ($infosAliment[$i][0]['Donneesaliment'][5]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            } else { // si c'est une autre date
                if (isset($infosAliment[$i][0]['Alimhorsclassification'])) {
                    $valsplit = explode("@", $infosAliment[$i][0]['Alimhorsclassification']['nutri']);
                    $valresul = $valsplit[5];
                    $coSel[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($valresul * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                } else {
                    $coSel[date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]))] = ($infosAliment[$i][0]['Donneesaliment'][5]['valmoy'] * $idAliments[$i][3] * $idAliments[$i][1] * $idAliments[$i][2] / 100);
                }
            }
            // pour la prochaine itération
            $date = date("d/m/Y", strtotime($infosSuivi[$i]["suivialimentaires"]["created"]));
        }
        if (count($coSel) == 0 && count($coFib) == 0 && count($coEau) == 0 && count($coLip) == 0 &&
                count($coPro) == 0 && count($coEnKJ) == 0 && count($coEnKcal) == 0 && count($coGlu) == 0) {
            return null;
        }

        // mise en forme des données correctements pour l'utilisation avec amchart
        return array($coSel, $coFib, $coEau, $coLip, $coPro, $coGlu, $coEnKJ, $coEnKcal);
        /// $coSel $coFib  $coEau $coLip $coPro $coEnKJ $coEnKcal $coGlu
    }

    /** Récupére les valeurs journalières pour un individu */
    public function getValJour($id) {
        /*
         * Calcul des constantes à atteindre en fonction du du poid/age de l'utilisateur
         * ainsi que la taille, son CA en fonction de son activité physique, si l'utilisateur
         * est une femme et est enceinte, etc
         */
        /* poids utilisateur */
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
        $obEnKJ = intval($obEnKcal * 4, 18);
        $obPro = intval($obPro);
        $obLip = intval($obLip);
        $obGlu = intval($obGlu * 100);
        $obPoi = intval($obPoi);
        $obFib = intval($obFib);
        $obSel = intval($obSel);

        $obEau = $obEnKcal;

        $this->set('obEnKcal', $obEnKcal);
        $this->set('obEnKJ', $obEnKJ);
        $this->set('obPro', $obPro);
        $this->set('obLip', $obLip);
        $this->set('obGlu', $obGlu);
        $this->set('obEau', $obEau);
        $this->set('obFib', $obFib);
        $this->set('obSel', $obSel);
        $this->set('obPoi', $obPoi);
        $this->set('obVitA', $obVitA);
        $this->set('obVitC', $obVitC);
        $this->set('obCal', $obCal);
        $this->set('obFer', $obFer);
        /// 
        return(array($obSel, $obFib, $obEau, $obLip, $obPro, $obGlu, $obEnKJ, $obEnKcal));
        /* $this->set('obPhos', $obPhos);
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
          $this->set('obVitB3', $obVitB3); */
    }

}
