<?php

App::uses('AppController', 'Controller');
// On importe l'utilitaire d'api pour google analytics
App::import('Vendor', 'googleapi', array('file' => 'googleapi/autoload.php'));

/**
 * Stats Controller
 *
 * @property Stat $Stat
 */
class StatsController extends AppController {
    
    // On ne veut pas de table sql liée aux statistiques (externalisées sur google analytics)
    var $uses = array();

    public function beforeFilter() {
        parent::beforeFilter();
        if (AuthComponent::user('role') != 'administrateur') {
            $this->Session->setFlash("Vous n'avez pas les droits pour accèder à cette fonctionnalité.", 'messageAvert');
            return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
        $this->set('page_cours', 'violet');
    }

    public function visite() {

        // report id (DEV ICI) à récupérer dans l'url d'analytics
        $id_report = 119162875;

        // connexion auprès des services analytics de google (DEV ICI)
        $service_account_email = 'bon-78@mapyramide-analytics-1261.iam.gserviceaccount.com';
        $key_file_location = '../Vendor/mapy-dev.p12';

        // Create and configure a new client object.
        $client = new Google_Client();
        $client->setApplicationName("AnalyticsHelper");
        $analytics = new Google_Service_Analytics($client);

        // Read the generated client_secrets.p12 key.
        $key = file_get_contents($key_file_location);
        $cred = new Google_Auth_AssertionCredentials(
                $service_account_email, array(Google_Service_Analytics::ANALYTICS_READONLY), $key
        );
        $client->setAssertionCredentials($cred);
        if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion($cred);
        }




        if ($this->request->is('post')) {
            // on récupére la durée selectionnée
            $dateDeb = $this->request->data('dateDeb');
            $dateFin = $this->request->data('dateFin');

            // si une des dates n'a pas été spécifié
            if (empty($dateDeb) OR empty($dateFin)) {
                $this->Session->setFlash("Une ou plusieurs dates n'ont pas été spécifiées, merci de spécifier une période complète avec deux dates", "messageAvert");
                $this->redirect(array('action' => 'visite'));
            }

            // on spécifié ces variables pour indiqué la période que l'utilisateur a sélectionné dans la vue
            $this->set('dateFin', $dateFin);
            $this->set('dateDeb', $dateDeb);

            // GÉNÉRAL
            if (array_key_exists('gen', $this->request->data)) {

                // il y a des problèmes d'affichage si la période dépasse les 2 mois, on l'indique à l'utilisateur si on entre dans cette situation
                $date1 = new DateTime($dateDeb);
                $date2 = new DateTime($dateFin);
                $interval = $date1->diff($date2);
                if ($interval->m > 2) {
                    $this->Session->setFlash("La période que vous avez choisi dépasse 2 mois, il se peut que vous rencontriez certain problème d'affichage, réduisez la période si c'est le cas", "messageAvert");
                }

                $var = $analytics->data_ga->get(
                        'ga:' . $id_report, $dateDeb, // date de départ
                        $dateFin, // jusqu'à date de fin
                        'ga:sessions', // metrics d'analytics
                        array(
                    'dimensions' => 'ga:date',
                    'sort' => 'ga:date',
                    'max-results' => 100
                        )
                );
                $rows = $var->getRows();
                /**
                 * Format data as JSON
                 */
                $data = array();
                foreach ($rows as $row) {
                    $data[] = array(
                        'date' => date("d/m/Y", strtotime($row[0])),
                        'visiteurs' => round($row[1],2)
                    );
                }
               /* echo "<pre>";
                var_dump($data);
                echo "</pre>";*/
                $this->set('data', json_encode($data));
                $this->set('type', "Général");
            } else if (array_key_exists('lan', $this->request->data)) {
                // PAR ORIGINE GÉOGRAPHIQUE
                $var = $analytics->data_ga->get(
                        'ga:' . $id_report, $dateDeb, // date de départ
                        $dateFin, // jusqu'à date de fin
                        'ga:sessions', // metrics d'analytics
                        array(
                    'dimensions' => 'ga:country',
                    'sort' => 'ga:country',
                    'max-results' => 15
                        )
                );
                $rows = $var->getRows();
                /* echo "<pre>";
                  var_dump($rows);
                  echo "</pre>"; */
                /**
                 * Format data as JSON
                 */
                $data = array();
                foreach ($rows as $row) {
                    $data[] = array(
                        'pays' => $row[0],
                        'visiteurs' => round($row[1],2)
                    );
                }

                $this->set('data', json_encode($data));
                $this->set('type', "Origine géographique");
            } else if (array_key_exists('pag', $this->request->data)) {
                // PAR PAGES LES PLUS CONSULTÉES
                $var = $analytics->data_ga->get(
                        'ga:' . $id_report, $dateDeb, // date de départ
                        $dateFin, // jusqu'à date de fin
                        'ga:sessions', // metrics d'analytics
                        array(
                    'dimensions' => 'ga:pageTitle',
                    'sort' => 'ga:pageTitle',
                    'max-results' => 15
                        )
                );
                $rows = $var->getRows();
                /* echo "<pre>";
                  var_dump($rows);
                  echo "</pre>"; */
                /**
                 * Format data as JSON
                 */
                $data = array();
                foreach ($rows as $row) {
                    $data[] = array(
                        'pages' => $row[0],
                        'visiteurs' => round($row[1],2)
                    );
                }

                $this->set('data', json_encode($data));
                $this->set('type', "Pages les plus visités");
            } else if (array_key_exists('dur', $this->request->data)) {
                // PAR DURÉE DE VISITE
                $var = $analytics->data_ga->get(
                        'ga:' . $id_report, $dateDeb, // date de départ
                        $dateFin, // jusqu'à date de fin
                        'ga:avgTimeOnPage', // metrics d'analytics
                        array(
                    'dimensions' => 'ga:pageTitle',
                    'sort' => '-ga:avgTimeOnPage',
                    'max-results' => 15
                        )
                );
                $rows = $var->getRows();
                /* echo "<pre>";
                  var_dump($rows);
                  echo "</pre>"; */
                /**
                 * Format data as JSON
                 */
                $data = array();
                foreach ($rows as $row) {
                    $data[] = array(
                        'pages' => $row[0],
                        'temps moyen (seconde)' => round($row[1],0)
                    );
                }

                $this->set('data', json_encode($data));
                $this->set('type', "Temps moyen passé sur une page");
                
            } else if (array_key_exists('mot', $this->request->data)) {
                // PAR MOT-CLÉS UTILISÉS POUR TROUVER LE SITE
                $var = $analytics->data_ga->get(
                        'ga:' . $id_report, $dateDeb, // date de départ
                        $dateFin, // jusqu'à date de fin
                        'ga:sessions', // metrics d'analytics
                        array(
                    'dimensions' => 'ga:keyword',
                    'sort' => 'ga:sessions',
                    'max-results' => 15
                        )
                );
                $rows = $var->getRows();
                /* echo "<pre>";
                  var_dump($rows);
                  echo "</pre>"; */
                /**
                 * Format data as JSON
                 */
                $data = array();
                foreach ($rows as $row) {
                    $data[] = array(
                        'mot-clé' => $row[0],
                        'visiteurs' => round($row[1],2)
                    );
                }

                $this->set('data', json_encode($data));
                $this->set('type', "Mot-clés les plus utilisés");
            }
        }
    }

}
