<?php
App::uses('AppModel', 'Model');
/**
 * Actualite Model
 *
 * @property Category $Category
 */
class Actualite extends AppModel {
	// Une actualite appartient à une catégorie
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Categories',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));
}
