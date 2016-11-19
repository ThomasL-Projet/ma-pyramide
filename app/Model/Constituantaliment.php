<?php
App::uses('AppModel', 'Model');
/**
 * Constituantaliment Model
 *
 * @property Donneescompilee $Aliments
 */
class Constituantaliment extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


/**
 * hasMany associations
 *
 * @var array
 */
	// Un constituant appartient à plusieurs aliments
	public $hasMany = array(
		'Donneesaliment' => array(
			'className' => 'Donneescompilee',
			'foreignKey' => 'constituantaliments_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
