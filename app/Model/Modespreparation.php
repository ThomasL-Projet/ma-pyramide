<?php
App::uses('AppModel', 'Model');
/**
 * Modespreparation Model
 *
 */
class Modespreparation extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'descri';
        
        // Un mode de préparation appartient à une recette
	public $belongsTo = array(
		'Mesrecette' => array(
			'className' => 'Mesrecette',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	
	
	
       
}
