<?php
App::uses('AppModel', 'Model');
/**
 * Constsuivialimentaire Model
 *
 */
class Constsuivialimentaire extends AppModel {
        
        // les constantes de suivi alimentaire appartient à un utilisateur
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
		
}
