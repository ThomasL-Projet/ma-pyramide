<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 */
class Message extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'message';
        
        // Un message appartient à un utilisateur
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'idcli',
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
	// Règles de validation des nouveaux messages
	public $validate = array(
            'repondu' => array(
                'notempty' => array(
                    'rule' => array('inList',array('oui', 'non')),
                    
                ),
            ),
        );
}
