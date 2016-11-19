<?php
App::uses('AppModel', 'Model');
/**
 * Aliment Model
 *
 * @property Famillealiments $Famillealiments
 * @property Donneescompilee $constituant
 */
class Alimentsdetaille extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nom';

/**
 * hasMany associations
 *
 * @var array
 */
	// Un aliment à plusieurs données le concernant
	public $hasMany = array(
		'Aliment' => array(
			'className' => 'Aliment',
			'foreignKey' => 'id',
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
