<?php
App::uses('AppModel', 'Model');
/**
 * Actualite Model
 *
 * @property Category $Category
 */
class Statique extends AppModel {
	// Une actualite appartient à une catégorie
	public $belongsTo = array(
		'Categoriesimage' => array(
			'className' => 'Categoriesimage',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));
}