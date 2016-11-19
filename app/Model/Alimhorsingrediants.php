<?php
App::uses('AppModel', 'Model');
/**
 * Alimhorsingrediants Model
 *
 */
class Alimhorsingrediants extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'descri';
        
        // Un ingrédient appartient à un aliment hors classification
	public $belongsTo = array(
		'Alimhorsclassification' => array(
			'className' => 'Alimhorsclassification',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	
	
	
       
}
