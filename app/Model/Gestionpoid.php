<?php
App::uses('AppModel', 'Model');
/**
 * Donneescompilee Model
 *
 * @property User $User
 */
class Gestionpoid extends AppModel {


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
	);
	public $hasMany = array(
		'Objectifpoid' => array(
			'className' => 'Objectifpoid',
			'foreignKey' => 'idclient',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		));
}
?>