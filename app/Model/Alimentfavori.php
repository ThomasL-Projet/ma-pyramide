<?php
App::uses('AppModel', 'Model');
/**
 * Alimentfavori Model
 *
 */
class Alimentfavori extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'idali';
        
        // Un aliment favori appartient à un utilisateur
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'iduti',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);        
}
