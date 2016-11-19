<?php
App::uses('AppModel', 'Model');
/**
 * Aliment Model
 *
 * @property Famillealiments $Famillealiments
 * @property Donneescompilee $constituant
 */
class Aliment extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nomFR';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	// Un aliment appartient à une famille d'aliments
	public $belongsTo = array(
		'Famillealiments' => array(
			'className' => 'Famillealiment',
			'foreignKey' => 'famillealiments_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		), 
		'Alimentsdetaille' => array(
			'className' => 'Alimentsdetaille',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	// Un aliment à plusieurs données le concernant
	public $hasMany = array(
		'Donneesaliment' => array(
			'className' => 'Donneescompilee',
			'foreignKey' => 'aliments_id',
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
