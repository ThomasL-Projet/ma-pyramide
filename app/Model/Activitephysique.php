<?php
App::uses('AppModel', 'Model');
/**
 * Actualite Model
 *
 * @property Category $Category
 */
class Activitephysique extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'ACTIVITE_SPECIFIQUE';
        
        // Une activitée physique appartient à plusieurs suivis physiques
	public $hasMany = array(
		'Suiviphysique' => array(
			'className' => 'Suiviphysique',
			'foreignKey' => 'activitephysique_id',
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
