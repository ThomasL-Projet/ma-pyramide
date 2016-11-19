<?php
App::uses('AppModel', 'Model');
/**
 * Mesrecette Model
 *
 */
class Mesrecette extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nom';
	
	// Une recette a plusieurs modes de preparation
	public $hasMany = array(
		'Modespreparation' => array(
			'className' => 'Modespreparation',
			'foreignKey' => 'id_mode',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'Modespreparation.etape ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	// Une recette apartien a une famille d'aliment
	public $belongsTo = array(
		'Famillealiment' => array(
			'className' => 'Famillealiment',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
       
}
