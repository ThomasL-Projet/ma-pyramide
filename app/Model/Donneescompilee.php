<?php
App::uses('AppModel', 'Model');
/**
 * Donneescompilee Model
 *
 * @property Aliments $Aliments
 * @property Constituantaliments $Constituantaliments
 */
class Donneescompilee extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	// Les données compilées font appel aux aliments et aux constituants
	public $belongsTo = array(
		'Aliments' => array(
			'className' => 'Aliments',
			'foreignKey' => 'aliments_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Constituantaliments' => array(
			'className' => 'Constituantaliments',
			'foreignKey' => 'constituantaliments_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
