<?php
App::uses('AppModel', 'Model');
/**
 * Demande Model
 *
 */
class Cinqobjectif extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';
	
	// Un objectif appartient à un utilisateur
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	// Règles de validation des nouveaux objectifs
	public $validate = array(
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Vous devez saisir le contenu de votre objectif',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'between' => array(
                'rule'    => array('between', 1, 400),
                'message' => 'Entre 1 et 400 caractères'
            ),
		),
		'conseil' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Vous devez saisir le contenu du conseil',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'between' => array(
                'rule'    => array('between', 1, 400),
                'message' => 'Entre 1 et 400 caractères'
            ),
		),
	);
}