<?php
App::uses('AppModel', 'Model');
/**
 * Suivialimentaire Model
 *
 */
class Suiviphysique extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nomsuivi';
        
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
