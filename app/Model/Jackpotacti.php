<?php
App::uses('AppModel', 'Model');
/**
 * Suivialimentaire Model
 *
 */
class Jackpotacti extends AppModel {

/**
 * Display field
 *
 * @var string
 */

        
        // Un suivi alimentaire appartient à un utilisateur
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            
                'Activitephysique' => array(
			'className' => 'Activitephysique',
			'foreignKey' => 'activitephysique_id',
			'conditions' => '',
			'fields' => '',
			'order' => '')
	);
}
