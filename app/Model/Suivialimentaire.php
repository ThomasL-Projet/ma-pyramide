<?php
App::uses('AppModel', 'Model');
/**
 * Suivialimentaire Model
 *
 */
class Suivialimentaire extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'message';
        
        // Un suivi alimentaire appartient à un utilisateur
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'id_user',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Alimhorsclassification' => array(
			'className' => 'Alimhorsclassification',
			'foreignKey' => 'id_horsclass',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
		
}
