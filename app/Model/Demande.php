<?php
App::uses('AppModel', 'Model');
/**
 * Demande Model
 *
 */
class Demande extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'accepte';
        
        // Une demande appartient à un utilisateur diététicient
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'clientid',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
/**
 * Validation rules
 *
 * @var array
 */
	// Règles de validation des nouvelles demandes
	public $validate = array(
            'accepte' => array(
                'notempty' => array(
                    'rule' => array('inList',array('oui', 'non', 'pas encore')),
                    
                ),
            ),
        );
}
