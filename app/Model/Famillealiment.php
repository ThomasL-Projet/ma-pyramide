<?php
App::uses('AppModel', 'Model');
/**
 * Famillealiment Model
 *
 */
class Famillealiment extends AppModel {

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
	// Les familles d'aliment contiennent plusieurs aliments
	public $hasMany = array(
		'Aliment' => array(
			'className' => 'Aliment',
			'foreignKey' => 'famillealiments_id',
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
