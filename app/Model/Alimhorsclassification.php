<?php
App::uses('AppModel', 'Model');
/**
 * Alimhorsclassification Model
 *
 */
class Alimhorsclassification extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nom';
	
	// Un alim hors classification a plusieurs ingredients
	public $hasMany = array(
		'Alimhorsingrediant' => array(
			'className' => 'Alimhorsingrediant',
			'foreignKey' => 'alim_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'Alimhorsingrediant.nom ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
       
}
