<?php
App::uses('AppModel', 'Model');
/**
 * Activitetfavori Model
 *
 */
class Activitefavorite extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'idacti';
        
        // Une activité favorite appartient à un utilisateur
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
