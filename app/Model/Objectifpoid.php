<?php
App::uses('AppModel', 'Model');
/**
 * Objectifpoid Model
 *
 * @property User $User
 */
class Objectifpoid extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	// Un poids appartient a un utilisateur
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'idclient',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Gestionpoid' => array(
			'className' => 'Gestionpoid',
			'foreignKey' => 'idclient',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
?>