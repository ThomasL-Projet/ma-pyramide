<?php
App::uses('AppModel', 'Model');
/**
 * Carnet Model
 *
 */
class Carnet extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'dateC';
        
        // Un cart de bordappartient  à un utilisateur
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
